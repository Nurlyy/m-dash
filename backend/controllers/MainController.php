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
                        return !Yii::$app->user->identity->isAdmin();
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
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $tempdate = date('Y-m-d', (strtotime('-1 day', strtotime($start_date))));
        $start_date = $tempdate; // return $tempdate;
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
                    // return "gfgfdgfd";
                    $cities_data = City::find()->where(['project_id' => $project_id])->asArray()->all();
                    $return_posts = [];
                    if (!empty($cities_data)) {
                        // return "gfdsgfds";
                        foreach ($cities_data as $city) {
                            $resources = Resources::find()->where(['city_id' => $city['id']])->all();
                            $return_posts[$city['id']] = [];
                            foreach ($resources as $res) {
                                $item_ids = [];
                                $posts = [];
                                $posts['data'] = [];
                                $posts['posts'] = [];
                                // $return_posts[$city['id']][$res->id] = [];
                                $post_metrics = PostsMetrics::find()->select(['res_id', 'type', 'item_id', 'date', 's_date'])->where(['res_id' => $res->id])->andWhere(['between', 's_date', $start_date . " 23:59:59", $end_date . " 23:59:59"])->asArray()->all();
                                // return $post_metrics;
                                if (!empty($post_metrics)) {

                                    foreach ($post_metrics as $_post) {
                                        $posts[$_post['item_id']] = $_post;
                                        array_push($item_ids, $_post['item_id']);
                                    }
                                    if (!empty($item_ids)) {
                                        $items_chunks = array_chunk($item_ids, 15);
                                        $post_datas = [];
                                        foreach ($items_chunks as $chunk) {
                                            array_push($post_datas, ResPosts::find()->select(['sentiment', 'item_id', "DATE_FORMAT(s_date, '%Y-%m-%d') as s_date"])->where(['in', 'item_id', $chunk])->asArray()->all());
                                        }
                                        // return $post_datas;
                                        foreach ($post_datas as $_post) {
                                            foreach ($_post as $_p) {
                                                if (isset($posts[$_p['item_id']])) {
                                                    // return $posts['879183930000826'];
                                                    array_push($posts['posts'], array_merge($posts[$_p['item_id']], $_p, ['id'=>$city['id'], 'date' => $_p['s_date']]));
                                                    unset($posts[$_p['item_id']]);
                                                }
                                            }
                                        }
                                    }
                                }
                                return $posts;
                                foreach ($posts['posts'] as $_post) {
                                    $posts['data']['vk'] = isset($posts['data']['vk']) ? ($_post['type'] == 1 ? $posts['data']['vk'] += 1 : 0) : 0;
                                    $posts['data']['fb'] = isset($posts['data']['fb']) ? ($_post['type'] == 2 ? $posts['data']['fb'] += 1 : 0) : 0;
                                    $posts['data']['tw'] = isset($posts['data']['tw']) ? ($_post['type'] == 3 ? $posts['data']['tw'] += 1 : 0) : 0;
                                    $posts['data']['ig'] = isset($posts['data']['ig']) ? ($_post['type'] == 4 ? $posts['data']['ig'] += 1 : 0) : 0;
                                    $posts['data']['gg'] = isset($posts['data']['gg']) ? ($_post['type'] == 5 ? $posts['data']['gg'] += 1 : 0) : 0;
                                    $posts['data']['yt'] = isset($posts['data']['yt']) ? ($_post['type'] == 6 ? $posts['data']['yt'] += 1 : 0) : 0;
                                    $posts['data']['ok'] = isset($posts['data']['ok']) ? ($_post['type'] == 7 ? $posts['data']['ok'] += 1 : 0) : 0;
                                    $posts['data']['mm'] = isset($posts['data']['mm']) ? ($_post['type'] == 8 ? $posts['data']['mm'] += 1 : 0) : 0;
                                    $posts['data']['tg'] = isset($posts['data']['tg']) ? ($_post['type'] == 9 ? $posts['data']['tg'] += 1 : 0) : 0;
                                    $posts['data']['tt'] = isset($posts['data']['tt']) ? ($_post['type'] == 10 ? $posts['data']['tt'] += 1 : 0) : 0;
                                    $posts['data']['vk_positive'] = isset($posts['data']['vk_positive']) ? ($_post['type'] == 1 && $_post['sentiment'] == 1 ? $posts['data']['vk_positive'] += 1 : 0) : 0;
                                    $posts['data']['vk_neutral'] = isset($posts['data']['vk_neutral']) ? ($_post['type'] == 1 && $_post['sentiment'] == 0 ? $posts['data']['vk_neutral'] += 1 : 0) : 0;
                                    $posts['data']['vk_negative'] = isset($posts['data']['vk_negative']) ? ($_post['type'] == 1 && $_post['sentiment'] == -1 ? $posts['data']['vk_negative'] += 1 : 0) : 0;
                                    $posts['data']['fb_positive'] = isset($posts['data']['fb_positive']) ? ($_post['type'] == 2 && $_post['sentiment'] == 1 ? $posts['data']['fb_positive'] += 1 : 0) : 0;
                                    $posts['data']['fb_neutral'] = isset($posts['data']['fb_neutral']) ? ($_post['type'] == 2 && $_post['sentiment'] == 0 ? $posts['data']['fb_neutral'] += 1 : 0) : 0;
                                    $posts['data']['fb_negative'] = isset($posts['data']['fb_negative']) ? ($_post['type'] == 2 && $_post['sentiment'] == -1 ? $posts['data']['fb_negative'] += 1 : 0) : 0;
                                    $posts['data']['tw_positive'] = isset($posts['data']['tw_positive']) ? ($_post['type'] == 3 && $_post['sentiment'] == 1 ? $posts['data']['tw_positive'] += 1 : 0) : 0;
                                    $posts['data']['tw_neutral'] = isset($posts['data']['tw_neutral']) ? ($_post['type'] == 3 && $_post['sentiment'] == 0 ? $posts['data']['tw_neutral'] += 1 : 0) : 0;
                                    $posts['data']['tw_negative'] = isset($posts['data']['tw_negative']) ? ($_post['type'] == 3 && $_post['sentiment'] == -1 ? $posts['data']['tw_negative'] += 1 : 0) : 0;
                                    $posts['data']['ig_positive'] = isset($posts['data']['ig_positive']) ? ($_post['type'] == 4 && $_post['sentiment'] == 1 ? $posts['data']['ig_positive'] += 1 : 0) : 0;
                                    $posts['data']['ig_neutral'] = isset($posts['data']['ig_neutral']) ? ($_post['type'] == 4 && $_post['sentiment'] == 0 ? $posts['data']['ig_neutral'] += 1 : 0) : 0;
                                    $posts['data']['ig_negative'] = isset($posts['data']['ig_negative']) ? ($_post['type'] == 4 && $_post['sentiment'] == -1 ? $posts['data']['ig_negative'] += 1 : 0) : 0;
                                    $posts['data']['gg_positive'] = isset($posts['data']['gg_positive']) ? ($_post['type'] == 5 && $_post['sentiment'] == 1 ? $posts['data']['gg_positive'] += 1 : 0) : 0;
                                    $posts['data']['gg_neutral'] = isset($posts['data']['gg_neutral']) ? ($_post['type'] == 5 && $_post['sentiment'] == 0 ? $posts['data']['gg_neutral'] += 1 : 0) : 0;
                                    $posts['data']['gg_negative'] = isset($posts['data']['gg_negative']) ? ($_post['type'] == 5 && $_post['sentiment'] == -1 ? $posts['data']['gg_negative'] += 1 : 0) : 0;
                                    $posts['data']['yt_positive'] = isset($posts['data']['yt_positive']) ? ($_post['type'] == 6 && $_post['sentiment'] == 1 ? $posts['data']['yt_positive'] += 1 : 0) : 0;
                                    $posts['data']['yt_neutral'] = isset($posts['data']['yt_neutral']) ? ($_post['type'] == 6 && $_post['sentiment'] == 0 ? $posts['data']['yt_neutral'] += 1 : 0) : 0;
                                    $posts['data']['yt_negative'] = isset($posts['data']['yt_negative']) ? ($_post['type'] == 6 && $_post['sentiment'] == -1 ? $posts['data']['yt_negative'] += 1 : 0) : 0;
                                    $posts['data']['ok_positive'] = isset($posts['data']['ok_positive']) ? ($_post['type'] == 7 && $_post['sentiment'] == 1 ? $posts['data']['ok_positive'] += 1 : 0) : 0;
                                    $posts['data']['ok_neutral'] = isset($posts['data']['ok_neutral']) ? ($_post['type'] == 7 && $_post['sentiment'] == 0 ? $posts['data']['ok_neutral'] += 1 : 0) : 0;
                                    $posts['data']['ok_negative'] = isset($posts['data']['ok_negative']) ? ($_post['type'] == 7 && $_post['sentiment'] == -1 ? $posts['data']['ok_negative'] += 1 : 0) : 0;
                                    $posts['data']['mm_positive'] = isset($posts['data']['mm_positive']) ? ($_post['type'] == 8 && $_post['sentiment'] == 1 ? $posts['data']['mm_positive'] += 1 : 0) : 0;
                                    $posts['data']['mm_neutral'] = isset($posts['data']['mm_neutral']) ? ($_post['type'] == 8 && $_post['sentiment'] == 0 ? $posts['data']['mm_neutral'] += 1 : 0) : 0;
                                    $posts['data']['mm_negative'] = isset($posts['data']['mm_negative']) ? ($_post['type'] == 8 && $_post['sentiment'] == -1 ? $posts['data']['mm_negative'] += 1 : 0) : 0;
                                    $posts['data']['tg_positive'] = isset($posts['data']['tg_positive']) ? ($_post['type'] == 9 && $_post['sentiment'] == 1 ? $posts['data']['tg_positive'] += 1 : 0) : 0;
                                    $posts['data']['tg_neutral'] = isset($posts['data']['tg_neutral']) ? ($_post['type'] == 9 && $_post['sentiment'] == 0 ? $posts['data']['tg_neutral'] += 1 : 0) : 0;
                                    $posts['data']['tg_negative'] = isset($posts['data']['tg_negative']) ? ($_post['type'] == 9 && $_post['sentiment'] == -1 ? $posts['data']['tg_negative'] += 1 : 0) : 0;
                                    $posts['data']['tt_positive'] = isset($posts['data']['tt_positive']) ? ($_post['type'] == 10 && $_post['sentiment'] == 1 ? $posts['data']['tt_positive'] += 1 : 0) : 0;
                                    $posts['data']['tt_neutral'] = isset($posts['data']['tt_neutral']) ? ($_post['type'] == 10 && $_post['sentiment'] == 0 ? $posts['data']['tt_neutral'] += 1 : 0) : 0;
                                    $posts['data']['tt_negative'] = isset($posts['data']['tt_negative']) ? ($_post['type'] == 10 && $_post['sentiment'] == -1 ? $posts['data']['tt_negative'] += 1 : 0) : 0;
                                }
                                // $posts['posts'] = null;
                                unset($posts['posts']);
                                foreach ($posts['data'] as $key => $value) {
                                    // var_dump($value);exit;
                                    if ($value == 0) {
                                        unset($posts['data'][$key]);
                                        // if(isset($posts[$value['item_id']])){
                                        //     $posts[$value['item_id']] = null;
                                        //     unset($posts[$value['item_id']]);
                                        // }
                                    }
                                }
                                if (!empty($posts['data'])) {
                                    $return_posts[$city['id']][$res->id] = $posts['data'];
                                }
                                // array_push($return_posts[$city['id']], $posts);
                                // $return_posts[$city['id']][$res->id]['subs'] = SubFollow::getSubsForResource($res->id, $start_date, $end_date);
                            }
                        }
                    }
                    $result = array_merge(['all_data' => $return_posts], ['city_data' => $cities_data]);


                    // $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    // $temp_all = [];
                    // $all_data = $all_data[0];
                    // foreach ($all_data as $data) {
                    //     $temp_all[$data['id']] = [];
                    // }
                    // foreach ($all_data as $data) {
                    //     if (isset($data['id']))
                    //         array_push($temp_all[$data['id']], $data);
                    // }
                    // $all_data = $temp_all;
                    // $cities_data = $projectModel->get_cities_data($project_id, [$city_id]);
                    // $result = array_merge(['all_data' => $all_data], ['city_data' => $cities_data]);
                    break;
                case 2:

                    $all_data = $projectModel->get_all_data($city_id, $res_id, $start_date, $end_date, $type);
                    // var_dump($all_data);exit;
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
                        if ($r['city_id'] == $city_id) {
                            // echo '<pre>';
                            // var_dump($projectModel->get_res_posts($r['r_count'], $start_date, $end_date));exit;
                            // echo '</pre>';
                            // return $projectModel->get_res_posts($r['r_count'], $start_date, $end_date);
                            array_push($city_posts[$city_id], $projectModel->get_res_posts($r['r_count'], $start_date, $end_date));
                        }
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
                    $project['resources'] += Resources::find()->where(['city_id' => $city['id'], 'status' => 1])->count();
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
            $resources = Resources::find()->where(['city_id' => $city['id'], 'status' => 1])->asArray()->all();
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
                    $resource->status = 1;
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
            $resource = Resources::findOne(['id' => $resid]);
            $resource->status = 0;
            return $resource->save();
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
}
