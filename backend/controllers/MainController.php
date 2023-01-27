<?php

namespace backend\controllers;


// use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use app\models\Organization;
use app\models\Project;
use Yii;
use common\models\User;
use common\components\AccessRule;
use yii\filters\AccessControl;

// use yii\filters\auth\QueryParamAuth;


class MainController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'read', 'search', 'temp'];
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
                    'actions' => ['search'],
                    'allow' => true,
                    'roles' => ['@', User::STATUS_ACTIVE],

                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },

                ],
                [
                    'actions' => ['createproject', 'addcandidate', 'removeproject', 'removecandidate', 'getprojects', 'temp', 'turnstateproject', 'getfreeusers', 'getproject', 'applychanges', 'deleteres', 'saveprojectchanges', 'deletecity', 'moveresource', 'deleteproj', 'getusersinformation', 'deleteuser', 'changestatus'],
                    'allow' => true,
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    // 'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionSearch()
    {
        $projectModel = new Project();
        $project_cities = $projectModel->getProjectCandidates(Yii::$app->user->id);
        $project_id = $projectModel->getProjectId(Yii::$app->user->id);
        $project_state = $project_id[0]['is_active'];
        $project_id = $project_id[0]['id'];
        $temp = [];
        foreach ($project_cities as $i) {
            array_push($temp, $i['id']);
        }
        $project_cities = $temp;
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $city_id = isset($_GET['city_id']) ? (in_array($_GET['city_id'], $project_cities) ? $_GET['city_id'] : -1) : null;
        $res_id = isset($_GET['res_id']) ? (in_array($_GET['res_id'], $project_cities) ? $_GET['res_id'] : -1) : null;
        $first = isset($_GET['first']) ? (in_array($_GET['first'], $project_cities) ? $_GET['first'] : -1) : null;
        $second = isset($_GET['second']) ? (in_array($_GET['second'], $project_cities) ? $_GET['second'] : -1) : null;
        $discussionChart = isset($_GET['discussionChart']) ? $_GET['discussionChart'] : false;
        $sentimentChart = isset($_GET['sentimentChart']) ? $_GET['sentimentChart'] : false;
        $subsChart = isset($_GET['subsChart']) ? $_GET['subsChart'] : false;
        $likesChart = isset($_GET['likesChart']) ? $_GET['likesChart'] : false;
        $commentsChart = isset($_GET['commentsChart']) ? $_GET['commentsChart'] : false;
        $repostsChart = isset($_GET['repostsChart']) ? $_GET['repostsChart'] : false;
        $result = [];
        if ($project_state == 1) {
            switch ($type) {
                case 1:
                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    // return $all_data;
                    // $result = $all_data;
                    // break;
                    $temp_all = [];
                    $all_data = $all_data[0];
                    foreach ($all_data as $data) {
                        // return $data['id'];
                        $temp_all[$data['id']] = [];
                        // array_push($temp[$data['id']], $data);
                    }
                    foreach ($all_data as $data) {
                        if (isset($data['id']))
                            array_push($temp_all[$data['id']], $data);
                    }
                    $all_data = $temp_all;
                    // return $temp_all;
                    // break;
                    $candidates_data = $projectModel->get_cities_data($project_id, [$city_id]);
                    // return $candidates_data;
                    $result = array_merge(['all_data' => $all_data], ['city_data' => $candidates_data]);
                    break;
                case 2:

                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    // return $all_data;
                    $temp_all = [];
                    $subs = $all_data['subs'];
                    unset($all_data['subs']);
                    // return $subs;
                    // return $all_data;
                    $all_data = $all_data[0];
                    foreach ($all_data as $data) {
                        // return $data['id'];
                        $temp_all[$data['id']] = [];
                        // array_push($temp[$data['id']], $data);
                    }
                    foreach ($all_data as $data) {
                        if (isset($data['id']))
                            array_push($temp_all[$data['id']], $data);
                    }
                    $all_data = $temp_all;
                    $all_data['subs'] = $subs;
                    // return $all_data;
                    $r_count = $projectModel->get_resources_count($city_id);
                    $candidates_data = $projectModel->get_cities_data($project_id, [$city_id]);
                    $candidate_posts[$city_id] = [];
                    // return $candidates_data;
                    foreach ($r_count as $r) {
                        if ($r['city_id'] == $city_id) {
                            array_push($candidate_posts[$city_id], $projectModel->get_res_posts($r['r_count'], $start_date, $end_date));
                        }
                    }
                    // return $candidate_posts;
                    // $candidate_posts = $projectModel->get_res_posts($city_id, $start_date, $end_date);
                    $result = array_merge(['all_data' => $all_data], ['city_data' => $candidates_data], ['city_posts' => $candidate_posts], ['r_count' => $r_count]);
                    // return $result;
                    break;
                case 3:
                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type, $first, $second, $discussionChart, $sentimentChart, $subsChart, $likesChart, $commentsChart, $repostsChart);
                    // return $all_data;
                    $temp_all = [];
                    $subs = $all_data['subs'];
                    unset($all_data['subs']);
                    foreach ($all_data as $d) {
                        foreach ($d as $data) {
                            if (isset($data['id']))
                                $temp_all[$data['id']] = [];
                        }
                        // array_push($temp[$data['id']], $data);
                    }
                    foreach ($all_data as $d) {
                        foreach ($d as $data) {
                            if (isset($data['id']))
                                array_push($temp_all[$data['id']], $data);
                        }
                    }
                    $all_data = $temp_all;
                    $all_data['subs'] = $subs;
                    $cities_data = $projectModel->get_cities_data($project_id, [$first, $second]);
                    $result = array_merge(['all_data' => $all_data], ['city_data' => $cities_data]);
                    break;
                case 'index':
                    $candidates_data = $projectModel->get_cities_data($project_id);
                    $result = ['city_data' => $candidates_data];
                    break;
            }
            return $result;
        } else {
            return "false";
        }
    }

    public function actionSaveprojectchanges()
    {
        if (Yii::$app->request->post()) {
            $projectname = isset($_POST['projectname']) ? $_POST['projectname'] : null;
            $owner = isset($_POST['owner']) ? $_POST['owner'] : null;
            $projectid = isset($_POST['projectid']) ? $_POST['projectid'] : null;
            $projectModel = new Project();
            return $projectModel->saveprojectchanges($projectname, $owner, $projectid);
        }
    }


    public function actionTurnstateproject()
    {
        $projectModel = new Project();
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
        $state = isset($_POST['state']) ? $_POST['state'] : "0";
        // return $state;
        if (isset($project_id) && isset($state))
            return $projectModel->turnOffProject($project_id, $state);
        else return false;
    }


    public function actionGetprojects()
    {
        // return "fdsafdsa";
        $result['projects'] = [];
        $projectModel = new Project();
        $projects = $projectModel->getProjects();
        foreach ($projects as $project) {
            // (!$result['projects'][$project['id']])?$result['projects'][$project['id']]=[]:$result['projects'][$project['id']];
            $q = $projectModel->get_cities_count($project['id']);
            $x = 0;
            if ($q) {
                foreach ($q as $s) {
                    $r = $projectModel->get_resources_count($s['ids']);
                    // return $r;
                    foreach ($r as $e) {
                        $x += ($e['r_count'] ? 1 : 0);
                    }
                }
                $project['cities'] = sizeof($q);
            } else {
                $project['cities'] = 0;
            }

            $project['resources'] = $x;
            array_push($result['projects'], $project);
        }
        return $result;
    }


    public function actionCreateproject()
    {
        $projectModel = new Project();
        // $post = json_decode($_POST);
        $projectid = isset($_POST['projectid']) ? $_POST['projectid'] : null;
        $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : null;
        $created_date = isset($_POST['created_date']) ? $_POST['created_date'] : null;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        return $projectModel->createProject($project_name, $user_id, $created_date, $projectid);
        // return $_POST;
    }

    public function actionRemoveproject()
    {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
        $projectModel = new Project();
        $projectModel->removeProject($project_id);
    }

    public function actionGetproject()
    {
        $projectModel = new Project();
        $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
        $project_info['project'] = $projectModel->getProject($project_id)[0];
        $x = $projectModel->get_cities_data($project_id);
        $cities = [];
        foreach ($x as $city) {
            $res = $projectModel->get_resources_count($city['id']);
            $city['resources'] = [];
            foreach ($res as $r) {
                $city['resources'][$r['r_count']] = $r;
            }
            // array_push($cities, $city);
            $cities[$city['id']] = $city;
        }
        $project_info['project']['cities'] = $cities;
        return $project_info;
    }

    public function actionGetfreeusers()
    {
        $projectModel = new Project();
        return $projectModel->get_free_users();
    }

    public function actionApplychanges()
    {
        $projectModel = new Project();
        $cityChanges = isset($_POST['cityChanges']) ? json_decode($_POST['cityChanges'], true) : null;
        $resourcesChanges = isset($_POST['resourcesChanges']) ? json_decode($_POST['resourcesChanges'], true) : null;
        $createdCities = isset($_POST['createdCities']) ? json_decode($_POST['createdCities'], true) : null;
        $createdResources = isset($_POST['createdResources']) ? json_decode($_POST['createdResources'], true) : null;
        // return $createdResources;
        $dataRes = [];
        $dataCity = [];
        if (isset($cityChanges)) {
            $dataCity['cityChanges'] = $cityChanges;
        }
        if (isset($resourcesChanges)) {
            $dataRes['resourcesChanges'] = $resourcesChanges;
        }
        if (isset($createdCities)) {
            $dataCity['createdCities'] = $createdCities;
        }
        if (isset($createdResources)) {
            $dataRes['createdResources'] = $createdResources;
        }
        $sendData = [];
        $qarray = [];
        foreach ($dataCity as $d) {
            $sendData = [];
            $temp = [];
            foreach ($d as $value) {
                if (isset($value['id'])) {
                    $temp['id'] = $value['id'];
                }
                if (isset($value['name'])) {
                    $temp['name'] = $value['name'];
                }
                if (isset($value['project_id'])) {
                    $temp['project_id'] = $value['project_id'];
                }
                array_push($sendData, $temp);
                $temp = [];
            }
            $f = $projectModel->updateOrCreateCities($sendData);
            // return $projectModel->updateOrCreateCities($sendData);   
            array_push($qarray, $f);
        }

        foreach ($dataRes as $d) {
            $sendData = [];
            $temp = [];
            foreach ($d as $value) {
                if (isset($value['id'])) {
                    $temp['id'] = $value['id'];
                }
                if (isset($value['name'])) {
                    $temp['name'] = $value['name'];
                }
                if (isset($value['url'])) {
                    $temp['url'] = $value['url'];
                }
                if (isset($value['photo'])) {
                    $temp['photo'] = $value['photo'];
                }
                if (isset($value['description'])) {
                    $temp['description'] = $value['description'];
                }
                if (isset($value['city_id'])) {
                    $temp['city_id'] = $value['city_id'];
                }
                array_push($sendData, $temp);
                $temp = [];
            }
            // return $sendData;
            // return ($projectModel->updateOrCreateResources($sendData));
            $f = $projectModel->updateOrCreateResources($sendData);
            array_push($qarray, $f);
        }
        // return $sendData;

        return (in_array('false', $qarray, true)) ? false : true;

        // return $qarray;
    }

    public function actionDeleteres()
    {
        if (Yii::$app->request->post()) {
            $resid = Yii::$app->request->post('resid');
            // return $resid;
            $projectModel = new Project();
            return $projectModel->deleteres($resid);
        }
    }

    public function actionDeleteproj()
    {
        if (Yii::$app->request->post()) {
            $projid = Yii::$app->request->post('projid');
            $projectModel  = new Project();
            return $projectModel->deleteproj($projid);
        }
    }


    public function actionTemp()
    {
        $projectModel = new Project();

        $temp = $projectModel->get_free_users();

        return $temp;
        // exit;
    }

    public function actionDeletecity()
    {
        if (Yii::$app->request->post()) {
            $city_id = Yii::$app->request->post('city_id');
            $projectModel = new Project();
            return $projectModel->deletecity($city_id);
        }
    }

    public function actionMoveresource()
    {
        if (Yii::$app->request->post()) {
            $res_id = Yii::$app->request->post('res_id');
            $newregion = Yii::$app->request->post('newregion');
            $projectModel = new Project();
            return $projectModel->moveresource($res_id, $newregion);
        }
    }

    public function actionGetusersinformation(){
        $projectModel = new Project();
        $users = $projectModel->getusersinformation();
        return $users;
    }

    public function actionDeleteuser(){
        $projectModel = new Project();
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $name = $projectModel->getStatus($id)[0]['name'];
        if($name == null) {
            return $projectModel->deleteuser($id)?"true":"false";
        }
        return false;
    }

    public function actionChangestatus(){
        $projectModel = new Project();
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $status = $projectModel->getStatus($id)[0];
        $name = $status['name'];
        $status = $status['status'];
        if($name == null){
            if($status == "10"){
                return $projectModel->setStatus($id, "9");
            }else if($status == "9"){
                return $projectModel->setStatus($id, "10");
            }
        }
        
        // return $status;
        return 'false';
    }
}
