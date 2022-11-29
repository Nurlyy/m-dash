<?php

namespace frontend\controllers;

use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;
use DateInterval;
use DatePeriod;
use common\models\User;
use common\components\AccessRule;
use yii\filters\VerbFilter;

class ManageController extends AuthController
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
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/manage/index"]);
                    },
                ],
            ],

        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'create' => ['POST'],
                // 'turnstateproject' => ['POST'],
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
        // return var_dump($result);
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
            $temp['user_id'] = $owner;
            $result = send_post("frontend.test.localhost/backend/main/createproject", $temp);
            // var_dump($result);
            // exit; 
            return $this->redirect('index');
        }
        return $this->render('createproject');
    }

    public function actionTurnstateproject()
    {
        $this->layout = 'empty';
        // var_dump(Yii::$app->request->post());
        // exit;
        if (Yii::$app->request->post()) {
            // var_dump("FDJSK");
            // exit;
            $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
            $state = isset($_POST['state']) ? $_POST['state'] : "0";
            $temp = [];
            $temp['project_id'] = $project_id;
            $temp['state'] = $state;
            $result = send_post("frontend.test.localhost/backend/main/turnstateproject", $temp);
            return $this->redirect('index');
            // var_dump($result);
            // exit;
        }
    }
}
