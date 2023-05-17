<?php

namespace frontend\controllers;

use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;
use DateInterval;
use DatePeriod;
use common\models\User;
use common\components\AccessRule;
use frontend\models\SignupForm;
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
        $result = json_decode(get_web_page("rating.imas.kz/backend/main/getprojects"), true);
        // var_dump($result);exit;
        return $this->render('mainpage', ['result' => $result]);
    }

    public function actionCreateproject()
    {
        $this->layout = 'empty';
        $result = json_decode(get_web_page("rating.imas.kz/backend/main/getfreeusers"), true);
        // var_dump($result);exit;
        if (Yii::$app->request->post()) {
            $project_name = Yii::$app->request->post('project_name');
            $created_date = date('Y-m-d', strtotime('today'));
            $owner = Yii::$app->request->post('owner');
            $temp = [];
            $temp['name'] = $project_name;
            $temp['created_date'] = $created_date;
            $temp['user_id'] = $owner;
            if ($owner !== null && $owner !== "" && $project_name != null && $project_name !== "")
                return send_post("rating.imas.kz/backend/main/createproject", $temp);
        }
        return $this->render('createproject', ['result' => $result]);
    }

    public function actionDeleteres()
    {
        if (Yii::$app->request->post()) {
            $resid = [];
            $resid['resid'] = Yii::$app->request->post('resid');
            return send_post("rating.imas.kz/backend/main/deleteres", $resid);
        }
    }

    public function actionDeleteproj()
    {
        if (Yii::$app->request->post()) {
            $projid = [];
            $projid['projid'] = Yii::$app->request->post('projid');
            return send_post("rating.imas.kz/backend/main/deleteproj", $projid);
        }
    }

    public function actionEditpage()
    {
        $this->layout = 'empty';
        if (Yii::$app->request->post()) {
            $project_name = Yii::$app->request->post('project_name');
            $created_date = date('Y-m-d', strtotime('today'));
            $owner = Yii::$app->request->post('owner');
            $projectid = Yii::$app->request->post('projectid');
            // var_dump($owner);
            // exit; 
            $temp = [];
            $temp['name'] = $project_name;
            $temp['created_date'] = $created_date;
            $temp['id'] = $projectid;
            $temp['user_id'] = $owner;
            $result = send_post("rating.imas.kz/backend/main/createproject", $temp);
            return $this->redirect('index');
        }
        $project_id = null;
        $project_id = $_GET['project_id'];
        // var_dump($project_id);exit;
        $result = json_decode(get_web_page("rating.imas.kz/backend/main/getproject?project_id={$project_id}"), true);
        // var_dump($result);exit;
        $users = json_decode(get_web_page("rating.imas.kz/backend/main/getfreeusers"), true);
        // echo "<pre>";
        // var_dump($result['project']['cities']);
        // echo "</pre>";
        // exit;
        return $this->render('editpage', ['result' => $result, 'users' => $users, 'project_id' => $project_id]);
    }

    public function actionMoveresource()
    {
        if (Yii::$app->request->post()) {
            $res_id = isset($_POST['res_id']) ? $_POST['res_id'] : null;
            $newregion = isset($_POST['newregion']) ? $_POST['newregion'] : null;
            return send_post("rating.imas.kz/backend/main/moveresource", ['res_id' => $res_id, 'newregion' => $newregion]);
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
            return send_post("rating.imas.kz/backend/main/turnstateproject", $temp);
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
            // $createdCities = isset($_POST['createdCities']) ? $_POST['createdCities'] : null;
            if ($cityChanges) {
                $sendData['cityChanges'] = json_encode($cityChanges);
            }
            if ($resourcesChanges) {
                $sendData['resourcesChanges'] = json_encode($resourcesChanges);
            }
            if ($createdResources) {
                $sendData['createdResources'] = json_encode($createdResources);
            }
            $result = send_post("rating.imas.kz/backend/main/applychanges", $sendData);
            var_dump($result);
            exit;
        }
    }

    public function actionShowmodal()
    {
        $this->layout = 'empty';
        $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
        $project_id = Yii::$app->request->get('project_id');
        $result = json_decode(get_web_page("rating.imas.kz/backend/main/getproject?project_id={$project_id}"), true);
        return $this->render("cityedit_modal", ['city_id' => $city_id, 'result' => $result]);
    }

    public function actionSaveprojectchanges()
    {
        if (Yii::$app->request->post()) {
            $projectname = isset($_POST['projectname']) ? $_POST['projectname'] : null;
            $owner = isset($_POST['owner']) ? $_POST['owner'] : null;
            $projectid = isset($_POST['projectid']) ? $_POST['projectid'] : null;
            $result = send_post("rating.imas.kz/backend/main/createproject", ['name' => $projectname, 'user_id' => $owner, 'id' => $projectid]);
            return $result;
        }
    }

    public function actionDeletecity()
    {
        if (Yii::$app->request->post()) {
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
            $result = send_post("rating.imas.kz/backend/cities/deletecity", ['city_id' => $city_id]);
            return $result;
        }
    }

    public function actionUsers()
    {
        $this->layout = 'empty';
        return $this->render('users');
    }

    public function actionDeleteuser()
    {
        // var_dump($_POST['id']);exit;
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id !== null) {
            return send_post("rating.imas.kz/backend/main/deleteuser", ['id' => $id]);
        }
        return 'false';
    }

    public function actionChangestatus()
    {
        // return "foo";
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id !== null) {
            return send_post("rating.imas.kz/backend/main/changestatus", ['id' => $id]);
        }
        return 'false';
    }


    public function actionCreateuser()
    {
        if (Yii::$app->request->post()) {
            $username = isset($_POST['username']) ? $_POST['username'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->setPassword($password);
            $user->generateAccessToken();
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            if ($user->save()) {
                return 'true';
            }
            return 'false';
        }
        return 'false';
    }

    public function actionUsersTable(){
        $this->layout = 'empty';
        $users = json_decode(get_web_page("rating.imas.kz/backend/main/getusersinformation"), true);
        return $this->render('_users_table', ['users' => $users]);
    }

    public function actionGetcities(){
        // return "true";
        $project_id = $_GET['project_id'];
        if(isset($project_id)){
            $cities = json_decode(get_web_page("rating.imas.kz/backend/cities/getcities?project_id=$project_id"), true);
            return $this->renderAjax('_cities', ['cities' => $cities, 'project_id' => $project_id]);
        }
        return 'false';
    }

    public function actionCreateCity(){
        if($this->request->isPost){
            $project_id = $_POST['project_id'];
            $city_name = $_POST['city_name'];
            return send_post("rating.imas.kz/backend/cities/create-city", ['project_id' => $project_id, 'city_name' => $city_name]);
        }
    }

    public function actionGetCitiesList(){
        $project_id = $_GET['project_id'];
        if(isset($project_id)){
            $cities = get_web_page("rating.imas.kz/backend/cities/getcities?project_id=$project_id");
            return $cities;
        }
        return 'false';
    }
}
