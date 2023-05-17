<?php 

namespace backend\controllers;

use yii\rest\Controller;
use common\models\User;
use app\models\City;
use app\models\Resources;
use common\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use Yii;

class ResourcesController extends Controller {
    public function behaviors(){
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    'matchCallback' => function($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function($rule, $action) {
                        return $this->redirect(['/main/search']);
                    }
                ]
            ]
        ];

        return $behaviors;
    }

    public function actionDeleteres()
    {
        if (Yii::$app->request->post()) {
            $resid = Yii::$app->request->post('resid');
            $resource = Resources::findOne(['id' => $resid]);
            $resource->status = 0;
            return $resource->save();
        }
    }

    public function actionMoveresource()
    {
        if (Yii::$app->request->post()) {
            $res_id = Yii::$app->request->post('res_id');
            $newregion = Yii::$app->request->post('newregion');
            $resource = Resources::findOne(['id' => $res_id]);
            $resource->city_id = $newregion;
            return $resource->save();
        }
    }
}