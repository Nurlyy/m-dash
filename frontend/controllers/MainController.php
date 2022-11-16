<?php

namespace frontend\controllers;

use DateTime;
use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;
use DateInterval;
use DatePeriod;

class MainController extends AuthController
{
    public static $rating = [];
    public static $date_posts = [];
    public static $postsSentimentLine = [];
    public static $totalResourcesDonut = [];
    public static $discussionSentimentChart = [];
    public static $candidateInformation = [];
    public static $postsResourcesChart = [];
    public static $postsResourcesDonut = [];
    public static $postsSentimentChart = [];
    public static $postsSentimentDonut = [];
    public static $totalSubsChart = [];
    public static $totalSubsDonut = [];
    public static $totalLikesChart = [];
    public static $totalLikesDonut = [];
    public static $totalCommentsChart = [];
    public static $totalCommentsDonut = [];
    public static $totalRepostsChart = [];
    public static $totalRepostsDonut = [];
    public static $commentsSentimentChart = [];
    public static $commentsSentimentDonut = [];
    public static $candidates = [];
    public static $candidate_posts = [];

    // private function sortData($data)
    // {
    //     $temp = [];
    //     uasort(
    //         $data,
    //         function ($a, $b) {
    //             array_push($temp, strnatcmp($a, $b)); // or other function/code
    //         }
    //     );
    //     return $temp;
    // }

    private function cleanVariables()
    {
        $this::$rating = [];
        $this::$date_posts = [];
        $this::$postsSentimentLine = [];
        $this::$totalResourcesDonut = [];
        $this::$discussionSentimentChart = [];
        $this::$candidateInformation = [];
        $this::$postsResourcesChart = [];
        $this::$postsResourcesDonut = [];
        $this::$postsSentimentChart = [];
        $this::$postsSentimentDonut = [];
        $this::$totalSubsChart = [];
        $this::$totalSubsDonut = [];
        $this::$totalLikesChart = [];
        $this::$totalLikesDonut = [];
        $this::$totalCommentsChart = [];
        $this::$totalCommentsDonut = [];
        $this::$totalRepostsChart = [];
        $this::$totalRepostsDonut = [];
        $this::$commentsSentimentChart = [];
        $this::$commentsSentimentDonut = [];
        $this::$candidates = [];
        $this::$candidate_posts = [];
    }

    private function splitData($result)
    {
        $this->cleanVariables();
        if (isset($result['all_data'])) {
            foreach ($result['all_data'] as $value) {
                $this::$rating[$value['id']] = (isset($this::$rating[$value['id']]) ? $this::$rating[$value['id']] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
                $this::$date_posts[$value['id']]['fb'][$value['date']] = (isset($this::$date_posts[$value['id']]['fb'][$value['date']]) ? $this::$date_posts[$value['id']]['fb'][$value['date']] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0);
                $this::$date_posts[$value['id']]['ig'][$value['date']] = (isset($this::$date_posts[$value['id']]['ig'][$value['date']]) ? $this::$date_posts[$value['id']]['ig'][$value['date']] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0);
                $this::$date_posts[$value['id']]['tg'][$value['date']] = (isset($this::$date_posts[$value['id']]['tg'][$value['date']]) ? $this::$date_posts[$value['id']]['tg'][$value['date']] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0);
                $this::$date_posts[$value['id']]['web'][$value['date']] = (isset($this::$date_posts[$value['id']]['web'][$value['date']]) ? $this::$date_posts[$value['id']]['web'][$value['date']] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
                $this::$postsSentimentLine[$value['id']]['positive'] = (isset($this::$postsSentimentLine[$value['id']]['positive']) ? $this::$postsSentimentLine[$value['id']]['positive'] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0) + (isset($value['web_positive']) ? $value['web_positive'] : 0);
                $this::$postsSentimentLine[$value['id']]['neutral'] = (isset($this::$postsSentimentLine[$value['id']]['neutral']) ? $this::$postsSentimentLine[$value['id']]['neutral'] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0) + (isset($value['web_neutral']) ? $value['web_neutral'] : 0);
                $this::$postsSentimentLine[$value['id']]['negative'] = (isset($this::$postsSentimentLine[$value['id']]['negative']) ? $this::$postsSentimentLine[$value['id']]['negative'] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0) + (isset($value['web_negative']) ? $value['web_negative'] : 0);
                $this::$totalResourcesDonut[$value['id']]['fb'] = (isset($this::$totalResourcesDonut[$value['id']]['fb']) ? $this::$totalResourcesDonut[$value['id']]['fb'] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0);
                $this::$totalResourcesDonut[$value['id']]['ig'] = (isset($this::$totalResourcesDonut[$value['id']]['ig']) ? $this::$totalResourcesDonut[$value['id']]['ig'] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0);
                $this::$totalResourcesDonut[$value['id']]['tg'] = (isset($this::$totalResourcesDonut[$value['id']]['tg']) ? $this::$totalResourcesDonut[$value['id']]['tg'] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0);
                $this::$totalResourcesDonut[$value['id']]['web'] = (isset($this::$totalResourcesDonut[$value['id']]['web']) ? $this::$totalResourcesDonut[$value['id']]['web'] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
                $this::$postsSentimentChart[$value['id']]['positive'][$value['date']] = (isset($this::$postsSentimentChart[$value['id']]['positive'][$value['date']])?$this::$postsSentimentChart[$value['id']]['positive'][$value['date']]:0) + (isset($value['fb_positive'])?$value['fb_positive']:0) + (isset($value['ig_positive'])?$value['ig_positive']:0) + (isset($value['tg_positive'])?$value['tg_positive']:0) + (isset($value['web_positive'])?$value['web_positive']:0); 
                $this::$postsSentimentChart[$value['id']]['neutral'][$value['date']] = (isset($this::$postsSentimentChart[$value['id']]['neutral'][$value['date']])?$this::$postsSentimentChart[$value['id']]['neutral'][$value['date']]:0) + (isset($value['fb_neutral'])?$value['fb_neutral']:0) + (isset($value['ig_neutral'])?$value['ig_neutral']:0) + (isset($value['tg_neutral'])?$value['tg_neutral']:0) + (isset($value['web_neutral'])?$value['web_neutral']:0); 
                $this::$postsSentimentChart[$value['id']]['negative'][$value['date']] = (isset($this::$postsSentimentChart[$value['id']]['negative'][$value['date']])?$this::$postsSentimentChart[$value['id']]['negative'][$value['date']]:0) + (isset($value['fb_negative'])?$value['fb_negative']:0) + (isset($value['ig_negative'])?$value['ig_negative']:0) + (isset($value['tg_negative'])?$value['tg_negative']:0) + (isset($value['web_negative'])?$value['web_negative']:0); 
                $this::$totalSubsChart[$value['id']]['fb'][$value['date']] = (isset($this::$totalSubsChart[$value['id']]['fb'][$value['date']])?$this::$totalSubsChart[$value['id']]['fb'][$value['date']]:0) + (isset($value['fb_sub'])?$value['fb_sub']:0);
                $this::$totalSubsChart[$value['id']]['ig'][$value['date']] = (isset($this::$totalSubsChart[$value['id']]['ig'][$value['date']])?$this::$totalSubsChart[$value['id']]['ig'][$value['date']]:0) + (isset($value['ig_sub'])?$value['ig_sub']:0);
                $this::$totalSubsDonut[$value['id']]['fb'] = (isset($this::$totalSubsDonut[$value['id']]['fb'])?$this::$totalSubsDonut[$value['id']]['fb']:0) + (isset($value['fb_sub'])?$value['fb_sub']:0);
                $this::$totalSubsDonut[$value['id']]['ig'] = (isset($this::$totalSubsDonut[$value['id']]['ig'])?$this::$totalSubsDonut[$value['id']]['ig']:0) + (isset($value['ig_sub'])?$value['ig_sub']:0);
                $this::$totalLikesChart[$value['id']]['fb'][$value['date']] = (isset($this::$totalLikesChart[$value['id']]['fb'][$value['date']])?$this::$totalLikesChart[$value['id']]['fb'][$value['date']]:0) + (isset($value['fb_likes'])?$value['fb_likes']:0);
                $this::$totalLikesChart[$value['id']]['ig'][$value['date']] = (isset($this::$totalLikesChart[$value['id']]['ig'][$value['date']])?$this::$totalLikesChart[$value['id']]['ig'][$value['date']]:0) + (isset($value['ig_likes'])?$value['ig_likes']:0);
                $this::$totalLikesDonut[$value['id']]['fb'] = (isset($this::$totalLikesDonut[$value['id']]['fb'])?$this::$totalLikesDonut[$value['id']]['fb']:0) + (isset($value['fb_likes'])?$value['fb_likes']:0);
                $this::$totalLikesDonut[$value['id']]['ig'] = (isset($this::$totalLikesDonut[$value['id']]['ig'])?$this::$totalLikesDonut[$value['id']]['ig']:0) + (isset($value['ig_likes'])?$value['ig_likes']:0);
                $this::$totalCommentsChart[$value['id']]['fb'][$value['date']] = (isset($this::$totalCommentsChart[$value['id']]['fb'][$value['date']])?$this::$totalCommentsChart[$value['id']]['fb'][$value['date']]:0) + (isset($value['fb_comments'])?$value['fb_comments']:0);
                $this::$totalCommentsChart[$value['id']]['ig'][$value['date']] = (isset($this::$totalCommentsChart[$value['id']]['ig'][$value['date']])?$this::$totalCommentsChart[$value['id']]['ig'][$value['date']]:0) + (isset($value['ig_comments'])?$value['ig_comments']:0);
                $this::$totalCommentsDonut[$value['id']]['fb'] = (isset($this::$totalCommentsDonut[$value['id']]['fb'])?$this::$totalCommentsDonut[$value['id']]['fb']:0) + (isset($value['fb_comments'])?$value['fb_comments']:0);
                $this::$totalCommentsDonut[$value['id']]['ig'] = (isset($this::$totalCommentsDonut[$value['id']]['ig'])?$this::$totalCommentsDonut[$value['id']]['ig']:0) + (isset($value['ig_comments'])?$value['ig_comments']:0);
                $this::$totalRepostsChart[$value['id']]['fb'][$value['date']] = (isset($this::$totalRepostsChart[$value['id']]['fb'][$value['date']])?$this::$totalRepostsChart[$value['id']]['fb'][$value['date']]:0) + (isset($value['fb_reposts'])?$value['fb_reposts']:0);
                $this::$totalRepostsChart[$value['id']]['ig'][$value['date']] = (isset($this::$totalRepostsChart[$value['id']]['ig'][$value['date']])?$this::$totalRepostsChart[$value['id']]['ig'][$value['date']]:0) + (isset($value['ig_reposts'])?$value['ig_reposts']:0);
                $this::$totalRepostsChart[$value['id']]['tg'][$value['date']] = (isset($this::$totalRepostsChart[$value['id']]['tg'][$value['date']])?$this::$totalRepostsChart[$value['id']]['tg'][$value['date']]:0) + (isset($value['tg_reposts'])?$value['tg_reposts']:0);
                $this::$totalRepostsDonut[$value['id']]['fb'] = (isset($this::$totalRepostsDonut[$value['id']]['fb'])?$this::$totalRepostsDonut[$value['id']]['fb']:0) + (isset($value['fb_reposts'])?$value['fb_reposts']:0);
                $this::$totalRepostsDonut[$value['id']]['ig'] = (isset($this::$totalRepostsDonut[$value['id']]['ig'])?$this::$totalRepostsDonut[$value['id']]['ig']:0) + (isset($value['ig_reposts'])?$value['ig_reposts']:0);
                $this::$totalRepostsDonut[$value['id']]['tg'] = (isset($this::$totalRepostsDonut[$value['id']]['tg'])?$this::$totalRepostsDonut[$value['id']]['tg']:0) + (isset($value['tg_reposts'])?$value['tg_reposts']:0);
            }
        }
        if (isset($result['candidate_data'])) {
            foreach ($result['candidate_data'] as $value) {
                $this::$candidateInformation[$value['id']] = $value;
            }
        }
        // var_dump($this::$totalResourcesDonut);
        // exit;
        if(isset($result['candidate_posts'])){
            $this::$candidate_posts = $result['candidate_posts'];
        }
        // foreach(array_keys($this::$candidateInformation) as $value){
        //     foreach($this::$date_posts[$value]['fb'] as $data){
        //         var_dump($data);
        //     }
        // }]
    }

    private function getBetweenDates($startDate, $endDate)
    {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($endDate);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($startDate), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format('Y-m-d');
        }

        return $array;
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
        $result = json_decode(get_web_page("backend.test.localhost/main/search?type=index"), true);
        $this->splitData($result);
        return $this->render('index', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'candidateInformation' => $this::$candidateInformation,
        ]);
    }

    public function actionDashboard()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $result = json_decode(get_web_page("backend.test.localhost/main/search?type=1&start_date={$start_date}&end_date={$end_date}"), true);
        $this->splitData($result);
        $dates = $this->getBetweenDates($start_date, $end_date);
        $temp = [];
        $tempDonut = [];
        uasort($this::$rating, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });
        // uasort($this::$candidateInformation);
        // var_dump($this::$rating);
        // exit;
        foreach (array_keys($this::$candidateInformation) as $id) {
            foreach ($this::$date_posts[$id] as $key => $value) {
                foreach ($value as $k => $v) {
                    $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                }
                // $temp[$key]
            }
            foreach ($this::$totalResourcesDonut[$id] as $key => $value) {
                $tempDonut[$key] = (isset($tempDonut[$key]) ? $tempDonut[$key] : 0) + $value;
            }
        }
        $this::$date_posts = $temp;
        $this::$totalResourcesDonut = $tempDonut;
        ksort($this::$date_posts);
        // var_dump($this::$date_posts);
        return $this->render('dashboard', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'rating' => $this::$rating,
            'date_posts' => $this::$date_posts,
            'postsSentimentLine' => $this::$postsSentimentLine,
            'totalResourcesDonut' => $this::$totalResourcesDonut,
            'candidateInformation' => $this::$candidateInformation,
            'dates' => $dates,
        ]);
    }

    public function actionCandidate()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $candidate_id = isset($_GET['candidate_id']) ? $_GET['candidate_id'] : null;

        $result = json_decode(get_web_page("backend.test.localhost/main/search?type=2&candidate_id={$candidate_id}&start_date={$start_date}&end_date={$end_date}"), true);

        $this->splitData($result);
        $dates = $this->getBetweenDates($start_date, $end_date);
        $temp = [];
        foreach($this::$candidateInformation as $candidate){
            $temp = $candidate;
        }
        $this::$candidateInformation = $temp;

        // var_dump($this::$candidate_posts);
        // exit;

        return $this->render('candidate', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'candidateInformation' => $this::$candidateInformation,
            'dates' => $dates,
            'date_posts' => $this::$date_posts,
            'totalResourcesDonut' => $this::$totalResourcesDonut,
            'postsSentimentChart' => $this::$postsSentimentChart,
            'postsSentimentLine' => $this::$postsSentimentLine,
            'totalSubsChart' => $this::$totalSubsChart,
            'totalSubsDonut' => $this::$totalSubsDonut,
            'totalLikesChart' => $this::$totalLikesChart,
            'totalLikesDonut' => $this::$totalLikesDonut,
            'totalCommentsChart' => $this::$totalCommentsChart,
            'totalCommentsDonut' => $this::$totalCommentsDonut,
            'totalRepostsChart' => $this::$totalRepostsChart,
            'totalRepostsDonut' => $this::$totalRepostsDonut,
            'candidate_posts' => $this::$candidate_posts,
        ]);
    }

    public function actionCompare(){
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

        $result = json_decode(get_web_page("backend.test.localhost/main/search?type=index&start_date={$start_date}&end_date={$end_date}"), true);
        $this->splitData($result);
        return $this->render('compare', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'candidateInformation' => $this::$candidateInformation,
        ]);
    }


    public function actionComparecontent(){
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $first = isset($_GET['first']) ? $_GET['first'] : null;
        $second = isset($_GET['second']) ? $_GET['second'] : null;
        $discussionChart = isset($_GET['discussionChart']) ? $_GET['discussionChart'] : false;
        $sentimentChart = isset($_GET['sentimentChart']) ? $_GET['sentimentChart'] : false;
        $subsChart = isset($_GET['subsChart']) ? $_GET['subsChart'] : false;
        $likesChart = isset($_GET['likesChart']) ? $_GET['likesChart'] : false;
        $commentsChart = isset($_GET['commentsChart']) ? $_GET['commentsChart'] : false;
        $repostsChart = isset($_GET['repostsChart']) ? $_GET['repostsChart'] : false;
        $rating = isset($_GET['rating']) ? $_GET['rating'] : false;

        $result = json_decode(get_web_page("backend.test.localhost/main/search?type=3&start_date={$start_date}&end_date={$end_date}&first={$first}&second={$second}&discussionChart={$discussionChart}&sentimentChart={$sentimentChart}&subsChart={$subsChart}&likesChart={$likesChart}&commentsChart={$commentsChart}&repostsChart={$repostsChart}"), true);
        $this->splitData($result);

        $temp = [];
        foreach($this::$candidateInformation as $candidate){
            $temp[$candidate['id']] = $candidate;
        }
        $this::$candidateInformation = $temp;

        $dates = $this->getBetweenDates($start_date, $end_date);
        // var_dump($discussionChart);
        // exit;
        return $this->render('comparecontent', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'candidateInformation' => $this::$candidateInformation,
            'dates' => $dates,
            'date_posts' => $this::$date_posts,
            'totalResourcesDonut' => $this::$totalResourcesDonut,
            'postsSentimentChart' => $this::$postsSentimentChart,
            'postsSentimentLine' => $this::$postsSentimentLine,
            'totalSubsChart' => $this::$totalSubsChart,
            'totalSubsDonut' => $this::$totalSubsDonut,
            'totalLikesChart' => $this::$totalLikesChart,
            'totalLikesDonut' => $this::$totalLikesDonut,
            'totalCommentsChart' => $this::$totalCommentsChart,
            'totalCommentsDonut' => $this::$totalCommentsDonut,
            'totalRepostsChart' => $this::$totalRepostsChart,
            'totalRepostsDonut' => $this::$totalRepostsDonut,
            'rating' => $this::$rating,
            'ratingToggle' => $rating,
            "discussionChart" => $discussionChart,
            "sentimentChart" => $sentimentChart,
            "subsChart" => $subsChart,
            "likesChart" => $likesChart,
            "commentsChart" => $commentsChart,
            "repostsChart" => $repostsChart,
        ]);
    }
}
