<?php

namespace frontend\controllers;

use DateTime;
use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;

class MainController extends AuthController
{
    public static $total_posts = 0;
    public static $total_views = 0;
    public static $total_likes = 0;
    public static $total_reposts = 0;
    public static $total_comments = 0;
    public static $total_subs = 0;
    public static $dates = [];
    public static $date_posts = [];
    public static $date_views = [];
    public static $date_likes = [];
    public static $date_comments = [];
    public static $date_reposts = [];
    public static $date_subs = [];
    public static $organization_data = [];
    public static $regions_data = [];


    private function split_data($result){
        $this::$total_posts = [];
        $this::$total_views = [];
        $this::$total_likes = [];
        $this::$total_reposts = [];
        $this::$total_comments = [];
        $this::$total_subs = [];
        $this::$dates = [];
        $this::$date_posts = [];
        $this::$date_likes = [];
        $this::$date_comments = [];
        $this::$date_views = [];
        $this::$date_reposts = [];
        $this::$date_subs = [];
        $this::$organization_data = [];
        $this::$regions_data = [];

        foreach($result['organizations_data'] as $data){
            array_push($this::$organization_data, $data[0]);
            
        }

        foreach($result['all_data'] as $data){

            foreach($this::$organization_data as $key=>$value){
                // var_dump($value['id']);
                if($value['id'] == $data['organization_id']){
                    
                    $this::$regions_data[$value['region']]['posts']['fb'] = (isset($this::$regions_data[$value['region']]['posts']['fb'])?$this::$regions_data[$value['region']]['posts']['fb']:0) + (isset($data['fb_posts'])?$data['fb_posts']:0);
                    $this::$regions_data[$value['region']]['posts']['ig'] = (isset($this::$regions_data[$value['region']]['posts']['ig'])?$this::$regions_data[$value['region']]['posts']['ig']:0) + (isset($data['ig_posts'])?$data['ig_posts']:0);
                    $this::$regions_data[$value['region']]['posts']['tg'] = (isset($this::$regions_data[$value['region']]['posts']['tg'])?$this::$regions_data[$value['region']]['posts']['tg']:0) + (isset($data['tg_posts'])?$data['tg_posts']:0);
                    $this::$regions_data[$value['region']]['posts']['web'] = (isset($this::$regions_data[$value['region']]['posts']['web'])?$this::$regions_data[$value['region']]['posts']['web']:0) + (isset($data['web_posts'])?$data['web_posts']:0);
                    $this::$regions_data[$value['region']]['likes']['fb'] = (isset($this::$regions_data[$value['region']]['likes']['fb'])?$this::$regions_data[$value['region']]['likes']['fb']:0) + (isset($data['fb_likes'])?$data['fb_likes']:0);
                    $this::$regions_data[$value['region']]['likes']['ig'] = (isset($this::$regions_data[$value['region']]['likes']['ig'])?$this::$regions_data[$value['region']]['likes']['ig']:0) + (isset($data['ig_likes'])?$data['ig_likes']:0);
                    $this::$regions_data[$value['region']]['views']['web'] = (isset($this::$regions_data[$value['region']]['views']['web'])?$this::$regions_data[$value['region']]['views']['web']:0) + (isset($data['web_views'])?$data['web_views']:0);
                    $this::$regions_data[$value['region']]['comments']['fb'] = (isset($this::$regions_data[$value['region']]['comments']['fb'])?$this::$regions_data[$value['region']]['comments']['fb']:0) + (isset($data['fb_comments'])?$data['fb_comments']:0);
                    $this::$regions_data[$value['region']]['comments']['ig'] = (isset($this::$regions_data[$value['region']]['comments']['ig'])?$this::$regions_data[$value['region']]['comments']['ig']:0) + (isset($data['ig_comments'])?$data['ig_comments']:0);
                    $this::$regions_data[$value['region']]['reposts']['fb'] = (isset($this::$regions_data[$value['region']]['reposts']['fb'])?$this::$regions_data[$value['region']]['reposts']['fb']:0) + (isset($data['fb_reposts'])?$data['fb_reposts']:0);
                    $this::$regions_data[$value['region']]['reposts']['ig'] = (isset($this::$regions_data[$value['region']]['reposts']['ig'])?$this::$regions_data[$value['region']]['reposts']['ig']:0) + (isset($data['ig_reposts'])?$data['ig_reposts']:0);
                    $this::$regions_data[$value['region']]['reposts']['tg'] = (isset($this::$regions_data[$value['region']]['reposts']['tg'])?$this::$regions_data[$value['region']]['reposts']['tg']:0) + (isset($data['tg_reposts'])?$data['tg_reposts']:0);
                    $this::$regions_data[$value['region']]['subs']['fb'] = (isset($this::$regions_data[$value['region']]['subs']['fb'])?$this::$regions_data[$value['region']]['subs']['fb']:0) + (isset($data['fb_sub'])?$data['fb_sub']:0);
                    $this::$regions_data[$value['region']]['subs']['ig'] = (isset($this::$regions_data[$value['region']]['subs']['ig'])?$this::$regions_data[$value['region']]['subs']['ig']:0) + (isset($data['ig_sub'])?$data['ig_sub']:0);
                    $this::$regions_data[$value['region']]['subs']['tg'] = (isset($this::$regions_data[$value['region']]['subs']['tg'])?$this::$regions_data[$value['region']]['subs']['tg']:0) + (isset($data['tg_sub'])?$data['tg_sub']:0);
                }

            }
            // exit;
            
            array_push($this::$dates, $data['date']);
            $this::$total_posts[$data['organization_id']]['fb'] = (isset($this::$total_posts[$data['organization_id']]['fb'])?$this::$total_posts[$data['organization_id']]['fb']:0) + (isset($data['fb_posts'])?$data['fb_posts']:0);
            $this::$total_posts[$data['organization_id']]['ig'] = (isset($this::$total_posts[$data['organization_id']]['ig'])?$this::$total_posts[$data['organization_id']]['ig']:0) + (isset($data['ig_posts'])?$data['ig_posts']:0);
            $this::$total_posts[$data['organization_id']]['tg'] = (isset($this::$total_posts[$data['organization_id']]['tg'])?$this::$total_posts[$data['organization_id']]['tg']:0) + (isset($data['tg_posts'])?$data['tg_posts']:0);
            $this::$total_posts[$data['organization_id']]['web'] = (isset($this::$total_posts[$data['organization_id']]['web'])?$this::$total_posts[$data['organization_id']]['web']:0) + (isset($data['web_posts'])?$data['web_posts']:0);
            $this::$total_views[$data['organization_id']]['web'] = (isset($this::$total_views[$data['organization_id']]['web'])?$this::$total_views[$data['organization_id']]['web']:0) + (isset($data['web_views'])?$data['web_views']:0);
            $this::$total_likes[$data['organization_id']]['fb'] = (isset($this::$total_likes[$data['organization_id']]['fb'])?$this::$total_likes[$data['organization_id']]['fb']:0) + (isset($data['fb_likes'])?$data['fb_likes']:0);
            $this::$total_likes[$data['organization_id']]['ig'] = (isset($this::$total_likes[$data['organization_id']]['ig'])?$this::$total_likes[$data['organization_id']]['ig']:0) + (isset($data['ig_likes'])?$data['ig_likes']:0);
            $this::$total_comments[$data['organization_id']]['fb'] = (isset($this::$total_comments[$data['organization_id']]['fb'])?$this::$total_comments[$data['organization_id']]['fb']:0) + (isset($data['fb_comments'])?$data['fb_comments']:0);
            $this::$total_comments[$data['organization_id']]['ig'] = (isset($this::$total_comments[$data['organization_id']]['ig'])?$this::$total_comments[$data['organization_id']]['ig']:0) + (isset($data['ig_comments'])?$data['ig_comments']:0);
            $this::$total_reposts[$data['organization_id']]['fb'] = (isset($this::$total_reposts[$data['organization_id']]['fb'])?$this::$total_reposts[$data['organization_id']]['fb']:0) + (isset($data['fb_reposts'])?$data['fb_reposts']:0);
            $this::$total_reposts[$data['organization_id']]['ig'] = (isset($this::$total_reposts[$data['organization_id']]['ig'])?$this::$total_reposts[$data['organization_id']]['ig']:0) + (isset($data['ig_reposts'])?$data['ig_reposts']:0);
            $this::$total_reposts[$data['organization_id']]['tg'] = (isset($this::$total_reposts[$data['organization_id']]['tg'])?$this::$total_reposts[$data['organization_id']]['tg']:0) + (isset($data['tg_reposts'])?$data['tg_reposts']:0);
            $this::$total_subs[$data['organization_id']]['fb'] = (isset($this::$total_subs[$data['organization_id']]['fb'])?$this::$total_subs[$data['organization_id']]['fb']:0) + (isset($data['fb_sub'])?$data['fb_sub']:0);
            $this::$total_subs[$data['organization_id']]['ig'] = (isset($this::$total_subs[$data['organization_id']]['ig'])?$this::$total_subs[$data['organization_id']]['ig']:0) + (isset($data['ig_sub'])?$data['ig_sub']:0);
            $this::$total_subs[$data['organization_id']]['tg'] = (isset($this::$total_subs[$data['organization_id']]['tg'])?$this::$total_subs[$data['organization_id']]['tg']:0) + (isset($data['tg_sub'])?$data['tg_sub']:0);
            $this::$date_posts[$data['organization_id']][$data['date']]['fb'] = (isset($data['fb_posts'])?$data['fb_posts']:0);
            $this::$date_posts[$data['organization_id']][$data['date']]['ig'] = (isset($data['ig_posts'])?$data['ig_posts']:0);
            $this::$date_posts[$data['organization_id']][$data['date']]['tg'] = (isset($data['tg_posts'])?$data['tg_posts']:0);
            $this::$date_posts[$data['organization_id']][$data['date']]['web'] = (isset($data['web_posts'])?$data['web_posts']:0);
            $this::$date_likes[$data['organization_id']][$data['date']]['fb'] = (isset($data['fb_likes'])?$data['fb_likes']:0);
            $this::$date_likes[$data['organization_id']][$data['date']]['ig'] = (isset($data['ig_likes'])?$data['ig_likes']:0);
            $this::$date_views[$data['organization_id']][$data['date']]['web'] = (isset($data['web_views'])?$data['web_views']:0);
            $this::$date_comments[$data['organization_id']][$data['date']]['fb'] = (isset($data['fb_comments'])?$data['fb_comments']:0);
            $this::$date_comments[$data['organization_id']][$data['date']]['ig'] = (isset($data['ig_comments'])?$data['ig_comments']:0);
            $this::$date_reposts[$data['organization_id']][$data['date']]['fb'] = (isset($data['fb_reposts'])?$data['fb_reposts']:0);
            $this::$date_reposts[$data['organization_id']][$data['date']]['ig'] = (isset($data['ig_reposts'])?$data['ig_reposts']:0);
            $this::$date_reposts[$data['organization_id']][$data['date']]['tg'] = (isset($data['tg_reposts'])?$data['tg_reposts']:0);
            $this::$date_subs[$data['organization_id']][$data['date']]['fb'] = (isset($data['fb_sub'])?$data['fb_sub']:0);
            $this::$date_subs[$data['organization_id']][$data['date']]['ig'] = (isset($data['ig_sub'])?$data['ig_sub']:0);
            $this::$date_subs[$data['organization_id']][$data['date']]['tg'] = (isset($data['tg_sub'])?$data['tg_sub']:0);
            
        }  
        // foreach($this::$date_posts as $value){
        //     foreach($value as $date=>$data){
        //         var_dump($date);
        //         echo '<br>';
        //     }
            
        // }
        // exit;
        
        $this::$dates = array_unique($this::$dates);
    //     var_dump($this::$regions_data);
    // exit;
        
    }

    

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            // 'only' => ['index', 'facebook', 'instagram', 'new', 'regions', 'telegram', 'sites', 'resources'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public $layout = 'inspinia';

    public function actionIndex()
    {
        $today = date('Y-m-d', strtotime('today'));
        $month_ago = date('Y-m-d', strtotime('-30 days'));

        $start_date = isset($_GET['start_date']) ? Yii::$app->request->get('start_date') : $month_ago;
        $end_date = isset($_GET['end_date']) ? Yii::$app->request->get('end_date') : $today;
        // $this->layout = 'empty';
        // ob_end_flush();
        // $url = "backend.localhost/main/search?start_date={$start_date}&end_date={$end_date}";
        // $result = json_decode(get_web_page("backend.localhost/main/search?start_date={$start_date}&end_date={$end_date}"), true);
        // echo '<pre>';
        // echo $url;
        // var_dump($result);
        // echo '</pre>';
        // exit;
        return $this->render('index', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }

    public function actionTemp(){
        var_dump(json_decode(get_web_page("backend.localhost/main/search")));
    }


    public function actionDashboard()
    {
        $this->layout = 'empty';
        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');
        $result = json_decode(get_web_page("backend.localhost/main/search?start_date={$start_date}&end_date={$end_date}"), true);
        $temp = [];        
        $temp_posts = [];
        $temp_likes = [];
        $temp_comments = [];
        $temp_reposts = [];
        $temp_subs = [];
        $temp_views = [];
        
        // exit;
        $this->split_data($result);
        // return var_dump($this::$total_subs);
        foreach($this::$organization_data as $organization){
            foreach($this::$date_posts[$organization['id']] as $date=>$values){
                $temp_posts[$date] = (isset($temp_posts[$date])?$temp_posts[$date]:0) + array_sum($values);
            }
            foreach($this::$date_likes[$organization['id']] as $date=>$values) {
                $temp_likes[$date] = (isset($temp_likes[$date])?$temp_likes[$date]:0) + array_sum($values);
            }
            foreach($this::$date_comments[$organization['id']] as $date=>$values){
                $temp_comments[$date] = (isset($temp_comments[$date])?$temp_comments[$date]:0) + array_sum($values);
            }
            foreach($this::$date_reposts[$organization['id']] as $date=>$values){
                $temp_reposts[$date] = (isset($temp_reposts[$date])?$temp_reposts[$date]:0) + array_sum($values);
            }
            foreach($this::$date_subs[$organization['id']] as $date=>$values){
                $temp_subs[$date] = (isset($temp_subs[$date])?$temp_subs[$date]:0) + array_sum($values);
            }
            foreach($this::$date_views[$organization['id']] as $date=>$values){
                $temp_views[$date] = (isset($temp_views[$date])?$temp_views[$date]:0) + array_sum($values);
            }
        }
        $this::$date_posts = $temp_posts;
        $this::$date_likes = $temp_likes;
        $this::$date_comments = $temp_comments;
        $this::$date_reposts = $temp_reposts;
        $this::$date_views = $temp_views;
        $this::$date_subs = $temp_subs;
        // foreach($this::$date_posts as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }
        // $this::$date_posts = $temp;
        // $temp = [];

        // foreach($this::$date_likes as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }
        // $this::$date_likes = $temp;
        // $temp = [];

        // foreach($this::$date_comments as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }
        // $this::$date_comments = $temp;
        // $temp = [];

        // foreach($this::$date_reposts as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }
        // $this::$date_reposts = $temp;
        // $temp = [];

        // foreach($this::$date_subs as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }

        // $this::$date_subs = $temp;
        // $temp = [];

        // foreach($this::$date_views as $ids){
        //     foreach($ids as $date=>$values){
        //         $temp[$date] = (isset($temp[$date])?$temp[$date]:0) + array_sum($values);
        //     }
        // }
        // $this::$date_views = $temp;
        // $temp = [];

        // var_dump($this::$organization_data);
        // exit;
        return $this->render('dashboard', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            "total_posts" => $this::$total_posts,
            "total_views" => $this::$total_views,
            "total_likes" => $this::$total_likes,
            "total_reposts" => $this::$total_reposts,
            "total_comments" => $this::$total_comments,
            "total_subs" => $this::$total_subs,
            "dates" => $this::$dates,
            "date_posts" => $this::$date_posts,
            "date_views" => $this::$date_views,
            "date_likes" => $this::$date_likes,
            "date_comments" => $this::$date_comments,
            "date_reposts" => $this::$date_reposts,
            "date_subs" => $this::$date_subs,
            "organization_data" => $this::$organization_data,
            "regions_data" => $this::$regions_data, 
        ]);
    }


    public function actionFacebook()
    {
        $this->layout = 'empty';
        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');
        $result = json_decode(get_web_page("backend.localhost/main/search?type=1&start_date={$start_date}&end_date={$end_date}"), true);
        // var_dump($result);
        // exit;
        
        $this->split_data($result);
        foreach($this::$organization_data as $organization){
            foreach($this::$date_posts[$organization['id']] as $date=>$values){
                $temp_posts[$date] = (isset($temp_posts[$date])?$temp_posts[$date]:0) + $values['fb'];
            }
            foreach($this::$date_likes[$organization['id']] as $date=>$values) {
                $temp_likes[$date] = (isset($temp_likes[$date])?$temp_likes[$date]:0) + $values['fb'];
            }
            foreach($this::$date_comments[$organization['id']] as $date=>$values){
                $temp_comments[$date] = (isset($temp_comments[$date])?$temp_comments[$date]:0) + $values['fb'];
            }
            foreach($this::$date_reposts[$organization['id']] as $date=>$values){
                $temp_reposts[$date] = (isset($temp_reposts[$date])?$temp_reposts[$date]:0) + $values['fb'];
            }
            foreach($this::$date_subs[$organization['id']] as $date=>$values){
                $temp_subs[$date] = (isset($temp_subs[$date])?$temp_subs[$date]:0) + $values['fb'];
            }
        }
        $this::$date_posts = $temp_posts;
        $this::$date_likes = $temp_likes;
        $this::$date_comments = $temp_comments;
        $this::$date_reposts = $temp_reposts;
        $this::$date_subs = $temp_subs;
        return $this->render('facebook', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            "total_posts" => $this::$total_posts,
            "total_views" => $this::$total_views,
            "total_likes" => $this::$total_likes,
            "total_reposts" => $this::$total_reposts,
            "total_comments" => $this::$total_comments,
            "total_subs" => $this::$total_subs,
            "dates" => $this::$dates,
            "date_posts" => $this::$date_posts,
            "date_views" => $this::$date_views,
            "date_likes" => $this::$date_likes,
            "date_comments" => $this::$date_comments,
            "date_reposts" => $this::$date_reposts,
            "date_subs" => $this::$date_subs,
            "organization_data" => $this::$organization_data,
            "regions_data" => $this::$regions_data, 
        ]);
    }

    public function actionInstagram()
    {
        $this->layout = 'empty';
        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');
        $result = json_decode(get_web_page("backend.localhost/main/search?type=2&start_date={$start_date}&end_date={$end_date}"), true);
        // var_dump($result);
        // exit;
        
        $this->split_data($result);
        foreach($this::$organization_data as $organization){
            foreach($this::$date_posts[$organization['id']] as $date=>$values){
                $temp_posts[$date] = (isset($temp_posts[$date])?$temp_posts[$date]:0) + $values['ig'];
            }
            foreach($this::$date_likes[$organization['id']] as $date=>$values) {
                $temp_likes[$date] = (isset($temp_likes[$date])?$temp_likes[$date]:0) + $values['ig'];
            }
            foreach($this::$date_comments[$organization['id']] as $date=>$values){
                $temp_comments[$date] = (isset($temp_comments[$date])?$temp_comments[$date]:0) + $values['ig'];
            }
            foreach($this::$date_reposts[$organization['id']] as $date=>$values){
                $temp_reposts[$date] = (isset($temp_reposts[$date])?$temp_reposts[$date]:0) + $values['ig'];
            }
            foreach($this::$date_subs[$organization['id']] as $date=>$values){
                $temp_subs[$date] = (isset($temp_subs[$date])?$temp_subs[$date]:0) + $values['ig'];
            }
        }
        $this::$date_posts = $temp_posts;
        $this::$date_likes = $temp_likes;
        $this::$date_comments = $temp_comments;
        $this::$date_reposts = $temp_reposts;
        $this::$date_subs = $temp_subs;
        return $this->render('instagram', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            "total_posts" => $this::$total_posts,
            "total_views" => $this::$total_views,
            "total_likes" => $this::$total_likes,
            "total_reposts" => $this::$total_reposts,
            "total_comments" => $this::$total_comments,
            "total_subs" => $this::$total_subs,
            "dates" => $this::$dates,
            "date_posts" => $this::$date_posts,
            "date_views" => $this::$date_views,
            "date_likes" => $this::$date_likes,
            "date_comments" => $this::$date_comments,
            "date_reposts" => $this::$date_reposts,
            "date_subs" => $this::$date_subs,
            "organization_data" => $this::$organization_data,
            "regions_data" => $this::$regions_data, 
        ]);
    }

    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionRegions()
    {
        return $this->render('regions');
    }

    public function actionTelegram()
    {
        return $this->render('telegram');
    }

    public function actionSites()
    {
        return $this->render('sites');
    }

    public function actionResources()
    {
        return $this->render('resources');
    }
}
