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
        $result = json_decode(get_web_page("frontend.test.localhost/backend/main/getfreeusers"), true);
        if (Yii::$app->request->post()) {
            $project_name = Yii::$app->request->post('project_name');
            $created_date = date('Y-m-d', strtotime('today'));
            $owner = Yii::$app->request->post('owner');
            // var_dump($owner);
            // exit; 
            $temp = [];
            $temp['project_name'] = $project_name;
            $temp['created_date'] = $created_date;
            $temp['user_id'] = $owner;
            $result = send_post("frontend.test.localhost/backend/main/createproject", $temp);

            return $this->redirect('index');
        }
        return $this->render('createproject', ['result' => $result]);
    }

    public function actionDeleteres()
    {
        if (Yii::$app->request->post()) {
            $resid = [];
            $resid['resid'] = Yii::$app->request->post('resid');
            return send_post("frontend.test.localhost/backend/main/deleteres", $resid);
        }
    }

    public function actionEditpage()
    {
        $this->layout = 'empty';
        if (Yii::$app->request->post()) {
            $project_name = Yii::$app->request->post('project_name');
            $created_date = date('Y-m-d', strtotime('today'));
            $owner = Yii::$app->request->post('owner');
            // var_dump($owner);
            // exit; 
            $temp = [];
            $temp['project_name'] = $project_name;
            $temp['created_date'] = $created_date;
            $temp['user_id'] = $owner;
            $result = send_post("frontend.test.localhost/backend/main/createproject", $temp);

            return $this->redirect('index');
        }

        $project_id = Yii::$app->request->get('project_id');

        $result = json_decode(get_web_page("frontend.test.localhost/backend/main/getproject?project_id={$project_id}"), true);
        $users = json_decode(get_web_page("frontend.test.localhost/backend/main/getfreeusers"), true);
        // echo "<pre>";
        // var_dump($result['project']['cities']);
        // echo "</pre>";
        // exit;
        return $this->render('editpage', ['result' => $result, 'users' => $users, 'project_id' => $project_id]);
    }

    public function actionMoveresource(){
        if(Yii::$app->request->post()){
            $res_id = isset($_POST['res_id']) ? $_POST['res_id'] : null;
            $newregion = isset($_POST['newregion'])? $_POST['newregion'] : null;
            return send_post("frontend.test.localhost/backend/main/moveresource", ['res_id'=>$res_id, 'newregion'=>$newregion]);
        }
    }

    public function actionTurnstateproject()
    {
        $this->layout = 'empty';
        // var_dump(Yii::$app->request->post());
        // exit;
        if (Yii::$app->request->post()) {
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

    public function actionApplychanges()
    {
        $this->layout = 'empty';
        // var_dump($_POST);
        // exit;
        if (Yii::$app->request->post()) {
            $sendData = [];
            $cityChanges = isset($_POST['cityChanges']) ? $_POST['cityChanges'] : null;
            $resourcesChanges = isset($_POST['resourcesChanges']) ? $_POST['resourcesChanges'] : null;
            $createdResources = isset($_POST['createdResources']) ? $_POST['createdResources'] : null;
            $createdCities = isset($_POST['createdCities']) ? $_POST['createdCities'] : null;
            if ($cityChanges) {
                $sendData['cityChanges'] = json_encode($cityChanges);
            }
            if ($resourcesChanges) {
                $sendData['resourcesChanges'] = json_encode($resourcesChanges);
            }
            if ($createdCities) {
                $sendData['createdCities'] = json_encode($createdCities);
            }
            if ($createdResources) {
                $sendData['createdResources'] = json_encode($createdResources);
            }
            $result = send_post("frontend.test.localhost/backend/main/applychanges", $sendData);
            var_dump($result);
            exit;
        }
    }

    public function actionShowmodal()
    {
        $this->layout = 'empty';
        $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
        $project_id = Yii::$app->request->get('project_id');
        $result = json_decode(get_web_page("frontend.test.localhost/backend/main/getproject?project_id={$project_id}"), true);
        return $this->render("cityedit_modal", ['city_id' => $city_id, 'result' => $result]);
    }

    public function actionSaveprojectchanges(){
        if(Yii::$app->request->post()){
            $projectname = isset($_POST['projectname']) ? $_POST['projectname'] : null;
            $owner = isset($_POST['owner']) ? $_POST['owner'] : null;
            $projectid = isset($_POST['projectid']) ? $_POST['projectid']:null;
            $result = send_post("frontend.test.localhost/backend/main/saveprojectchanges", ['projectname'=>$projectname, 'owner' => $owner, 'projectid' => $projectid]);
            return $result;
        }
    }

    public function actionDeletecity(){
        if(Yii::$app->request->post()){
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
            $result = send_post("frontend.test.localhost/backend/main/deletecity", ['city_id'=>$city_id]);
            return $result;
        }
    }
}
