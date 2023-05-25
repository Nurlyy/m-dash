<?php

namespace backend\controllers;

use common\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use common\models\User;
use Yii;
use app\models\City;
use app\models\Resources;

class CitiesController extends Controller {

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            // 'only' => ['search'],
            'rules' => [
                [
                    // 'actions' => '*',
                    'allow' => true,
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    // 'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->getIsAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionCreateCity()
    {
        if ($this->request->isPost) {
            $project_id = $_POST['project_id'];
            $city_name = $_POST['city_name'];
            $city = new City();
            $city->project_id = $project_id;
            $city->name = $city_name;
            $city->validate();
            return $city->save();
        }
    }

    public function actionGetcities()
    {
        $project_id = $_GET['project_id'];
        if (isset($project_id)) {
            // return 'true';
            $cities = City::find()->where(['project_id' => $project_id])->asArray()->all();
            foreach ($cities as &$city) {
                $city['resources'] = Resources::find()->select(['id', 'name', 'city_id', 'status'])->where(['city_id' => $city['id'], 'status' => 1])->asArray()->all();
            }
            return $cities;
        }
        return 'false';
    }

    public function actionDeletecity()
    {
        if (Yii::$app->request->post()) {
            $city_id = Yii::$app->request->post('city_id');
            return City::findOne(['id' => $city_id])->delete();
        }
    }
}

