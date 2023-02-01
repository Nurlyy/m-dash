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
use app\models\Projects;
use app\models\City;
use app\models\Resources;

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
                    'actions' => ['createproject', 'removeproject', 'getprojects', 'temp', 'turnstateproject', 'getfreeusers', 'getproject', 'applychanges', 'deleteres', 'deletecity', 'moveresource', 'deleteproj', 'getusersinformation', 'deleteuser', 'changestatus'],
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
        $project = Projects::getProjectForUser(Yii::$app->user->id);
        $project_id = $project->id;
        $project_state = $project->is_active;
        $project_cities = City::getCitiesForProject($project->id);
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

    public function actionTurnstateproject()
    {
        if (Yii::$app->request->isPost && isset($_POST['project_id']) && isset($_POST['state'])) {
            $project = Projects::findOne(['id' => $_POST['project_id']]);
            $project->is_active = intval($_POST['state']);
            return $project->save();
        }
    }


    public function actionGetprojects()
    {
        $projects = Projects::find()->asArray()->all();
        foreach ($projects as $key => $project) {
            $user = User::findOne(['id' => intval($project['user_id'])]);
            $cities = City::find()->where('project_id=' . $project['id'])->asArray()->all();
            $project['username'] = $user->username;
            $project['email'] = $user->email;
            $project['cities'] = sizeof($cities);
            $project['resources'] = 0;
            if (sizeof($cities) > 0) {
                foreach ($cities as $city) {
                    $project['resources'] += Resources::find()->where(['city_id' => $city['id']])->count();
                }
            } else {
                $project['resources'] = 0;
            }
            $projects[$key] = $project;
            $project = null;
            $cities = 0;
            $user = null;
        }
        return $projects;
    }


    public function actionCreateproject()
    {
        if (isset($_POST['id'])) {
            $project = Projects::findOne(['id' => $_POST['id']]);
        } else {
            $project = new Projects();
            $project->is_active = 0;
            $project->created_date = $_POST['created_date'];
        }
        $project->name = $_POST['name'];
        $project->user_id = $_POST['user_id'];
        return $project->save();
    }

    public function actionGetproject()
    {
        $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
        $project = [];
        $project['project'] = Projects::find()->where(['id' => $project_id])->asArray()->one();
        $project['project']['username'] = User::find()->select('username')->where(['id' => $project['project']['user_id']])->one()['username'];
        $cities = City::find()->where(['project_id' => $project_id])->asArray()->all();
        $cities_new = [];
        foreach ($cities as $key => $city) {
            $resources = Resources::find()->where(['city_id' => $city['id']])->asArray()->all();
            $city['resources'] = [];
            foreach ($resources as $resource) {
                $city['resources'][$resource['id']] = $resource;
            }
            $cities_new[$city['id']] = $city;
        }
        $project['project']['cities'] = $cities_new;
        return $project;
    }

    public function actionGetfreeusers()
    {
        $projectUsers = Projects::find()->select('user_id')->asArray()->all();
        $project_user_ids = [];
        foreach ($projectUsers as $users) {
            array_push($project_user_ids, $users['user_id']);
        }
        $users = User::find()->select(['username',  'id'])->where(['not in', 'id', $project_user_ids])->andWhere('status != 3')->all();
        return $users;
    }

    public function actionApplychanges()
    {
        $cityChanges = isset($_POST['cityChanges']) ? json_decode($_POST['cityChanges'], true) : null;
        $resourcesChanges = isset($_POST['resourcesChanges']) ? json_decode($_POST['resourcesChanges'], true) : null;
        $createdCities = isset($_POST['createdCities']) ? json_decode($_POST['createdCities'], true) : null;
        $createdResources = isset($_POST['createdResources']) ? json_decode($_POST['createdResources'], true) : null;
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
        $qarray = [];
        // todo: move city between projects not integrated
        // $city->project_id = $value['project_id']
        foreach ($dataCity as $d) {
            foreach ($d as $value) {
                if (isset($value['id'])) {
                    $city = City::findOne(['id' => $value['id']]);
                } else {
                    $city = new City();
                }
                if (isset($value['name'])) {
                    $city->name = $value['name'];
                }
                if (isset($value['project_id'])) {
                    $city->project_id = $value['project_id'];
                }
                array_push($qarray, $city->save());
            }
        }

        foreach ($dataRes as $d) {
            foreach ($d as $value) {
                if (isset($value['id'])) {
                    $resource = Resources::find(['id' => $value['id']]);
                } else {
                    $resource = new Resources();
                }
                if (isset($value['url'])) {
                    $type = 0;
                    if (strpos($value['url'], 'vk') !== false || strpos($value['url'], 'vkontakte') !== false) {
                        $type == 1;
                    } else if (strpos($value['url'], 'facebook') !== false) {
                        $type == 2;
                    } else if (strpos($value['url'], 'twitter') !== false) {
                        $type == 3;
                    } else if (strpos($value['url'], 'instagram') !== false) {
                        $type == 4;
                    } else if (strpos($value['url'], 'google') !== false) {
                        $type == 5;
                    } else if (strpos($value['url'], 'youtube') !== false) {
                        $type == 6;
                    } else if (strpos($value['url'], 'ok.ru') !== false) {
                        $type == 7;
                    } else if (strpos($value['url'], 'mail.ru') !== false) {
                        $type == 8;
                    } else if (strpos($value['url'], 'telegram') !== false) {
                        $type == 9;
                    } else if (strpos($value['url'], 'tiktok') !== false) {
                        $type == 10;
                    } else $type = 0;
                    $resource->type = $type;
                    $resource->url = $value['url'];
                }
                if (isset($value['name'])) {
                    $resource->name = $value['name'];
                }
                if (isset($value['city_id'])) {
                    $resource->city_id = $value['city_id'];
                }
                if (isset($value['photo'])) {
                    $resource->photo = $value['photo'];
                }
                if (isset($value['description'])) {
                    $resource->description = $value['description'];
                }
                array_push($qarray, $resource->save());
            }
        }
        return (in_array(false, $qarray, true)) ? false : true;
    }

    public function actionDeleteres()
    {
        if (Yii::$app->request->post()) {
            $resid = Yii::$app->request->post('resid');
            return Resources::findOne(['id' => $resid])->delete();
        }
    }

    public function actionDeleteproj()
    {
        if (Yii::$app->request->post()) {
            $projid = Yii::$app->request->post('projid');
            return Projects::findOne(['id' => $projid])->delete();
        }
    }

    public function actionDeletecity()
    {
        if (Yii::$app->request->post()) {
            $city_id = Yii::$app->request->post('city_id');
            return City::findOne(['id' => $city_id])->delete();
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

    public function actionGetusersinformation()
    {
        return Projects::getUsersInformation();
    }

    public function actionDeleteuser()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $user = User::findOne(['id' => intval($id)]);
        if (Projects::getProjectForUser($user->id) === null) {
            return $user->delete();
        }
    }

    public function actionChangestatus()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $user = User::findOne(['id' => intval($id)]);
        if (Projects::getProjectForUser($user->id) === null) {
            if ($user->status == 10) {
                $user->status = 9;
            } else if ($user->status == 9) {
                $user->status = 10;
            }
            return $user->save();
        }
    }
}
