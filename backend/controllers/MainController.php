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
use backend\models\PostsMetrics;
use backend\models\ResPosts;
use backend\models\SubFollow;

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
                    'actions' => ['search', 'temp'],
                    'allow' => true,
                    'roles' => ['@', User::STATUS_ACTIVE],

                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->identity->getIsAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },

                ],
                [
                    'actions' => [
                        'createproject', 'removeproject', 'getprojects',
                        'temp', 'turnstateproject', 'getfreeusers', 'getproject',
                        'applychanges', 'deleteres', 'deletecity', 'moveresource',
                        'deleteproj', 'getusersinformation', 'deleteuser', 'changestatus',
                        'getcities', 'create-city'
                    ],
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

    public function actionTemp()
    {
        $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $resources = Resources::find()->where(['city_id' => $city_id])->all();
        $posts = [];
        foreach ($resources as $res) {
            $item_ids = [];
            $temp = [];
            $temp['posts'] = [];
            $post_metrics = PostsMetrics::getPostsForResource($res->id, $start_date, $end_date);
            if (!empty($post_metrics)) {
                foreach ($post_metrics as $_post) {
                    $temp[$_post['item_id']] = ['metrics' => $_post];
                    array_push($item_ids, $_post['item_id']);
                }
                if (!empty($item_ids)) {
                    $post_datas = ResPosts::getPostsWithItemId($item_ids, $start_date, $end_date);
                    foreach ($post_datas as $_post) {
                        array_push($temp['posts'], array_merge($temp[$_post['item_id']]['metrics'], $_post));
                        unset($temp[$_post['item_id']]);
                    }
                }
            }
            $posts[$res->id] = $temp;
            $posts[$res->id]['subs'] = SubFollow::getSubsForResource($res->id, $start_date, $end_date);
        }

        return $posts;
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
        $type = isset($_GET['type']) ? htmlentities($_GET['type']) : null;
        $start_date = isset($_GET['start_date']) ? htmlentities($_GET['start_date']) : null;
        $end_date = isset($_GET['end_date']) ? htmlentities($_GET['end_date']) : null;
        $tempdate = date('Y-m-d', (strtotime('-1 day', strtotime($start_date))));
        $start_date = $tempdate; // return $tempdate;
        $city_id = isset($_GET['city_id']) ? (in_array($_GET['city_id'], $project_cities) ? htmlentities($_GET['city_id']) : -1) : null;
        $res_id = isset($_GET['res_id']) ? (in_array($_GET['res_id'], $project_cities) ? htmlentities($_GET['res_id']) : -1) : null;
        $first = isset($_GET['first']) ? (in_array($_GET['first'], $project_cities) ? htmlentities($_GET['first']) : -1) : null;
        $second = isset($_GET['second']) ? (in_array($_GET['second'], $project_cities) ? htmlentities($_GET['second']) : -1) : null;
        $discussionChart = isset($_GET['discussionChart']) ? htmlentities($_GET['discussionChart']) : false;
        $sentimentChart = isset($_GET['sentimentChart']) ? htmlentities($_GET['sentimentChart']) : false;
        $subsChart = isset($_GET['subsChart']) ? htmlentities($_GET['subsChart']) : false;
        $likesChart = isset($_GET['likesChart']) ? htmlentities($_GET['likesChart']) : false;
        $commentsChart = isset($_GET['commentsChart']) ? htmlentities($_GET['commentsChart']) : false;
        $repostsChart = isset($_GET['repostsChart']) ? htmlentities($_GET['repostsChart']) : false;
        $result = [];
        if ($project_state == 1) {
            switch ($type) {
                case 1:
                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    $temp_all = [];
                    $all_data = $all_data[0];
                    foreach ($all_data as $data) {
                        $temp_all[$data['id']] = [];
                    }
                    foreach ($all_data as $data) {
                        if (isset($data['id']))
                            array_push($temp_all[$data['id']], $data);
                    }
                    $all_data = $temp_all;
                    $cities_data = $projectModel->get_cities_data($project_id, [$city_id]);
                    $result = array_merge(['all_data' => $all_data], ['city_data' => $cities_data]);
                    break;
                case 2:
                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    $temp_all = [];
                    $subs = $all_data['subs'];
                    unset($all_data['subs']);
                    $all_data = $all_data[0];
                    foreach ($all_data as $data) {
                        $temp_all[$data['id']] = [];
                    }
                    foreach ($all_data as $data) {
                        // var_dump($data);exit;
                        if (isset($data['id']))
                            array_push($temp_all[$data['id']], $data);
                    }
                    $all_data = $temp_all;
                    $all_data['subs'] = $subs;
                    $r_count = $projectModel->get_resources_count($city_id);
                    $cities_data = $projectModel->get_cities_data($project_id, [$city_id]);
                    $city_posts[$city_id] = [];
                    foreach ($r_count as $r) {
                        // return $start_date;
                        // $item_ids = ResPosts::find()->select(['item_id', 's_date'])->where(['res_id' => $r['r_count']])->andWhere(['between', 's_date', date('Y-m-d', (strtotime('+1 day', strtotime($start_date)))).' 23:59:59', $end_date.' 23:59:59'])->asArray()->all();
                        // return $projectModel->get_res_posts($r['r_count'], $start_date, $end_date);
                        array_push($city_posts[$city_id], $projectModel->get_res_posts($r['r_count'], date('Y-m-d', (strtotime('+1 day', strtotime($start_date)))), $end_date));
                    }
                    // var_dump($city_posts);
                    // exit;
                    $result = array_merge(['all_data' => $all_data], ['city_data' => $cities_data], ['city_posts' => $city_posts], ['r_count' => $r_count]);
                    break;
                case 3:
                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type, $first, $second, $discussionChart, $sentimentChart, $subsChart, $likesChart, $commentsChart, $repostsChart);
                    $temp_all = [];
                    $subs = $all_data['subs'];
                    unset($all_data['subs']);
                    foreach ($all_data as $d) {
                        foreach ($d as $data) {
                            if (isset($data['id']))
                                $temp_all[$data['id']] = [];
                        }
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
                    $cities_data = $projectModel->get_cities_data($project_id);
                    $result = ['city_data' => $cities_data];
                    break;
            }
            return $result;
        } else {
            return "false";
        }
    }

    public function actionApplychanges()
    {
        // return 'something';
        $cityChanges = isset($_POST['cityChanges']) ? json_decode($_POST['cityChanges'], true) : null;
        $resourcesChanges = isset($_POST['resourcesChanges']) ? json_decode($_POST['resourcesChanges'], true) : null;
        // $createdCities = isset($_POST['createdCities']) ? json_decode($_POST['createdCities'], true) : null;
        $createdResources = isset($_POST['createdResources']) ? json_decode($_POST['createdResources'], true) : null;
        $dataRes = [];
        $dataCity = [];
        if (isset($cityChanges)) {
            $dataCity['cityChanges'] = $cityChanges;
        }
        if (isset($resourcesChanges)) {
            $dataRes['resourcesChanges'] = $resourcesChanges;
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
                    $city = City::findOne(['id' => htmlentities($value['id'])]);
                } else {
                    $city = new City();
                }
                if (isset($value['name'])) {
                    $city->name = htmlentities($value['name']);
                }
                if (isset($value['project_id'])) {
                    $city->project_id = htmlentities($value['project_id']);
                }
                array_push($qarray, $city->save());
            }
        }
        // return 'something';
        foreach ($dataRes as $d) {
            foreach ($d as $value) {
                // var_dump($value['id']);exit;
                if (isset($value['id'])) {
                    $resource = Resources::findOne(htmlentities($value['id']));
                    // var_dump($resource);exit;
                } else {
                    $resource = new Resources();
                    $resource->status = 1;
                }
                // var_dump($resource);exit;
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
                    $resource->url = htmlentities($value['url']);
                }
                if (isset($value['name'])) {
                    $resource->name = $value['name'];
                    // return $resource;
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

    
}
