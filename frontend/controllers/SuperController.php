<?php

namespace frontend\controllers;

use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;
use DateInterval;
use DatePeriod;
use common\models\User;
use common\components\AccessRule;

class SuperController extends AuthController
{
    public $layout = 'inspinia';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@', User::STATUS_ACTIVE],

                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/index"]);
                    },

                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $this->layout = 'inspinia';
        return $this->render('index');
    }


    public function actionMainpage()
    {
        $this->layout = 'empty';
        $result = json_decode(get_web_page("frontend.test.localhost/backend/main/getprojects"), true);
        return $this->render('mainpage', ['result' => $result]);
    }

    public function actionCreateproject()
    {
        $this->layout = 'empty';
        if (Yii::$app->request->post()) {
            $project_name = Yii::$app->request->post('project_name');
            $created_date = date('Y-m-d', strtotime('today'));
            $owner = Yii::$app->request->post('owner');
            $temp = [];
            $temp['project_name'] = $project_name;
            $temp['created_date'] = $created_date;
            $temp['owner'] = $owner;
            send_post("frontend.test.localhost/backend/main/createproject", $temp);
            return $this->redirect('super/mainpage');
        }
        return $this->render('createproject');
    }
}
