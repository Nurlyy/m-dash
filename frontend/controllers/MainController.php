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
    public static $candidatePosts = [];
    public static $subsTotalChart = [];
    public static $subsTotalDonut = [];
    public static $likesTotalChart = [];
    public static $likesTotalDonut = [];
    public static $commentsTotalChart = [];
    public static $commentsTotalDonut = [];
    public static $commentsSentimentChart = [];
    public static $commentsSentimentDonut = [];
    public static $candidates = [];

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
        $this::$candidatePosts = [];
        $this::$subsTotalChart = [];
        $this::$subsTotalDonut = [];
        $this::$likesTotalChart = [];
        $this::$likesTotalDonut = [];
        $this::$commentsTotalChart = [];
        $this::$commentsTotalDonut = [];
        $this::$commentsSentimentChart = [];
        $this::$commentsSentimentDonut = [];
        $this::$candidates = [];
    }

    private function splitData($result)
    {
        $this->cleanVariables();
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
        }
        foreach ($result['candidates_data'] as $value) {
            $this::$candidateInformation[$value['id']] = $value;
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

    public $layout = 'inspinia';

    public function actionIndex()
    {
        $today = date('Y-m-d', strtotime('today'));
        $month_ago = date('Y-m-d', strtotime('-30 days'));

        $start_date = isset($_GET['start_date']) ? Yii::$app->request->get('start_date') : $month_ago;
        $end_date = isset($_GET['end_date']) ? Yii::$app->request->get('end_date') : $today;
        return $this->render('index', [
            // 'result' => $result,
            'start_date' => $start_date,
            'end_date' => $end_date,
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
        // foreach($this::$rating as $i){
        //     var_dump($i);
        // }
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
        // uasort($this::$date_posts, function ($a, $b) {
        //     if ($a == $b) {
        //         return 0;
        //     }
        //     return ($a > $b) ? -1 : 1;
        // });
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
}
