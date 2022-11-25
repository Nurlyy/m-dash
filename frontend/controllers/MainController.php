<?php

namespace frontend\controllers;

use DateTime;
use frontend\controllers\AuthController;
use yii;
use yii\filters\AccessControl;
use DateInterval;
use DatePeriod;
use common\models\User;
use common\components\AccessRule;

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
        if (isset($result['all_data']) && isset($result['candidate_data'])) {
            foreach ($result['candidate_data'] as $c_data) {
                // if(isset($value['id']))
                if (isset($result['all_data'][$c_data['id']])) {
                    foreach ($result['all_data'][$c_data['id']] as $value) {
                        $this->set_data($c_data['id'], $value, $value['date']);
                    }
                }
                else {
                    $this->set_data($c_data['id'], null, 0);
                }
            }
        }
        if (isset($result['candidate_data'])) {
            foreach ($result['candidate_data'] as $value) {
                $this::$candidateInformation[$value['id']] = $value;
            }
        }
        if (isset($result['candidate_posts'])) {
            $this::$candidate_posts = $result['candidate_posts'];
        }
    }

    private function set_data($id, $value, $date)
    {
        $this::$rating[$id] = (isset($this::$rating[$id]) ? $this::$rating[$id] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
        $this::$date_posts[$id]['fb'][$date] = (isset($this::$date_posts[$id]['fb'][$date]) ? $this::$date_posts[$id]['fb'][$date] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0);
        $this::$date_posts[$id]['ig'][$date] = (isset($this::$date_posts[$id]['ig'][$date]) ? $this::$date_posts[$id]['ig'][$date] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0);
        $this::$date_posts[$id]['tg'][$date] = (isset($this::$date_posts[$id]['tg'][$date]) ? $this::$date_posts[$id]['tg'][$date] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0);
        $this::$date_posts[$id]['web'][$date] = (isset($this::$date_posts[$id]['web'][$date]) ? $this::$date_posts[$id]['web'][$date] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
        $this::$postsSentimentLine[$id]['positive'] = (isset($this::$postsSentimentLine[$id]['positive']) ? $this::$postsSentimentLine[$id]['positive'] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0) + (isset($value['web_positive']) ? $value['web_positive'] : 0);
        $this::$postsSentimentLine[$id]['neutral'] = (isset($this::$postsSentimentLine[$id]['neutral']) ? $this::$postsSentimentLine[$id]['neutral'] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0) + (isset($value['web_neutral']) ? $value['web_neutral'] : 0);
        $this::$postsSentimentLine[$id]['negative'] = (isset($this::$postsSentimentLine[$id]['negative']) ? $this::$postsSentimentLine[$id]['negative'] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0) + (isset($value['web_negative']) ? $value['web_negative'] : 0);
        $this::$totalResourcesDonut[$id]['fb'] = (isset($this::$totalResourcesDonut[$id]['fb']) ? $this::$totalResourcesDonut[$id]['fb'] : 0) + (isset($value['fb_posts']) ? $value['fb_posts'] : 0);
        $this::$totalResourcesDonut[$id]['ig'] = (isset($this::$totalResourcesDonut[$id]['ig']) ? $this::$totalResourcesDonut[$id]['ig'] : 0) + (isset($value['ig_posts']) ? $value['ig_posts'] : 0);
        $this::$totalResourcesDonut[$id]['tg'] = (isset($this::$totalResourcesDonut[$id]['tg']) ? $this::$totalResourcesDonut[$id]['tg'] : 0) + (isset($value['tg_posts']) ? $value['tg_posts'] : 0);
        $this::$totalResourcesDonut[$id]['web'] = (isset($this::$totalResourcesDonut[$id]['web']) ? $this::$totalResourcesDonut[$id]['web'] : 0) + (isset($value['web_posts']) ? $value['web_posts'] : 0);
        $this::$postsSentimentChart[$id]['positive'][$date] = (isset($this::$postsSentimentChart[$id]['positive'][$date]) ? $this::$postsSentimentChart[$id]['positive'][$date] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0) + (isset($value['web_positive']) ? $value['web_positive'] : 0);
        $this::$postsSentimentChart[$id]['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['neutral'][$date]) ? $this::$postsSentimentChart[$id]['neutral'][$date] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0) + (isset($value['web_neutral']) ? $value['web_neutral'] : 0);
        $this::$postsSentimentChart[$id]['negative'][$date] = (isset($this::$postsSentimentChart[$id]['negative'][$date]) ? $this::$postsSentimentChart[$id]['negative'][$date] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0) + (isset($value['web_negative']) ? $value['web_negative'] : 0);
        $this::$totalSubsChart[$id]['fb'][$date] = (isset($this::$totalSubsChart[$id]['fb'][$date]) ? $this::$totalSubsChart[$id]['fb'][$date] : 0) + (isset($value['fb_sub']) ? $value['fb_sub'] : 0);
        $this::$totalSubsChart[$id]['ig'][$date] = (isset($this::$totalSubsChart[$id]['ig'][$date]) ? $this::$totalSubsChart[$id]['ig'][$date] : 0) + (isset($value['ig_sub']) ? $value['ig_sub'] : 0);
        $this::$totalSubsDonut[$id]['fb'] = (isset($this::$totalSubsDonut[$id]['fb']) ? $this::$totalSubsDonut[$id]['fb'] : 0) + (isset($value['fb_sub']) ? $value['fb_sub'] : 0);
        $this::$totalSubsDonut[$id]['ig'] = (isset($this::$totalSubsDonut[$id]['ig']) ? $this::$totalSubsDonut[$id]['ig'] : 0) + (isset($value['ig_sub']) ? $value['ig_sub'] : 0);
        $this::$totalLikesChart[$id]['fb'][$date] = (isset($this::$totalLikesChart[$id]['fb'][$date]) ? $this::$totalLikesChart[$id]['fb'][$date] : 0) + (isset($value['fb_likes']) ? $value['fb_likes'] : 0);
        $this::$totalLikesChart[$id]['ig'][$date] = (isset($this::$totalLikesChart[$id]['ig'][$date]) ? $this::$totalLikesChart[$id]['ig'][$date] : 0) + (isset($value['ig_likes']) ? $value['ig_likes'] : 0);
        $this::$totalLikesDonut[$id]['fb'] = (isset($this::$totalLikesDonut[$id]['fb']) ? $this::$totalLikesDonut[$id]['fb'] : 0) + (isset($value['fb_likes']) ? $value['fb_likes'] : 0);
        $this::$totalLikesDonut[$id]['ig'] = (isset($this::$totalLikesDonut[$id]['ig']) ? $this::$totalLikesDonut[$id]['ig'] : 0) + (isset($value['ig_likes']) ? $value['ig_likes'] : 0);
        $this::$totalCommentsChart[$id]['fb'][$date] = (isset($this::$totalCommentsChart[$id]['fb'][$date]) ? $this::$totalCommentsChart[$id]['fb'][$date] : 0) + (isset($value['fb_comments']) ? $value['fb_comments'] : 0);
        $this::$totalCommentsChart[$id]['ig'][$date] = (isset($this::$totalCommentsChart[$id]['ig'][$date]) ? $this::$totalCommentsChart[$id]['ig'][$date] : 0) + (isset($value['ig_comments']) ? $value['ig_comments'] : 0);
        $this::$totalCommentsDonut[$id]['fb'] = (isset($this::$totalCommentsDonut[$id]['fb']) ? $this::$totalCommentsDonut[$id]['fb'] : 0) + (isset($value['fb_comments']) ? $value['fb_comments'] : 0);
        $this::$totalCommentsDonut[$id]['ig'] = (isset($this::$totalCommentsDonut[$id]['ig']) ? $this::$totalCommentsDonut[$id]['ig'] : 0) + (isset($value['ig_comments']) ? $value['ig_comments'] : 0);
        $this::$totalRepostsChart[$id]['fb'][$date] = (isset($this::$totalRepostsChart[$id]['fb'][$date]) ? $this::$totalRepostsChart[$id]['fb'][$date] : 0) + (isset($value['fb_reposts']) ? $value['fb_reposts'] : 0);
        $this::$totalRepostsChart[$id]['ig'][$date] = (isset($this::$totalRepostsChart[$id]['ig'][$date]) ? $this::$totalRepostsChart[$id]['ig'][$date] : 0) + (isset($value['ig_reposts']) ? $value['ig_reposts'] : 0);
        $this::$totalRepostsChart[$id]['tg'][$date] = (isset($this::$totalRepostsChart[$id]['tg'][$date]) ? $this::$totalRepostsChart[$id]['tg'][$date] : 0) + (isset($value['tg_reposts']) ? $value['tg_reposts'] : 0);
        $this::$totalRepostsDonut[$id]['fb'] = (isset($this::$totalRepostsDonut[$id]['fb']) ? $this::$totalRepostsDonut[$id]['fb'] : 0) + (isset($value['fb_reposts']) ? $value['fb_reposts'] : 0);
        $this::$totalRepostsDonut[$id]['ig'] = (isset($this::$totalRepostsDonut[$id]['ig']) ? $this::$totalRepostsDonut[$id]['ig'] : 0) + (isset($value['ig_reposts']) ? $value['ig_reposts'] : 0);
        $this::$totalRepostsDonut[$id]['tg'] = (isset($this::$totalRepostsDonut[$id]['tg']) ? $this::$totalRepostsDonut[$id]['tg'] : 0) + (isset($value['tg_reposts']) ? $value['tg_reposts'] : 0);
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
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            // 'only' => ['index', 'facebook', 'instagram', 'new', 'regions', 'telegram', 'sites', 'resources'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@', User::STATUS_ACTIVE],

                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/manage/index"]);
                    },

                ],
                // [
                //     'allow' => true,
                //     'roles' => [User::STATUS_ACTIVE],    

                // ],
            ],
        ];
        return $behaviors;
    }


    public $layout = 'inspinia';

    public function actionIndex()
    {
        // return $this->render('temp');
        $today = date('Y-m-d', strtotime('today'));
        $month_ago = date('Y-m-d', strtotime('-30 days'));

        $start_date = isset($_GET['start_date']) ? Yii::$app->request->get('start_date') : $month_ago;
        $end_date = isset($_GET['end_date']) ? Yii::$app->request->get('end_date') : $today;
        $result = json_decode(get_web_page("frontend.test.localhost/backend/main/search?type=index"), true);
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
        if (strlen($start_date) < 11 && strlen($end_date) < 11) {
            $result = json_decode(get_web_page("frontend.test.localhost/backend/main/search?type=1&start_date={$start_date}&end_date={$end_date}"), true);

            $this->splitData($result);
            // var_dump($this::$rating);
            // exit;
            $dates = $this->getBetweenDates($start_date, $end_date);
            $temp = [];
            $tempDonut = [];
            uasort($this::$rating, function ($a, $b) {
                if ($a == $b) {
                    return 0;
                }
                return ($a > $b) ? -1 : 1;
            });
            foreach (array_keys($this::$candidateInformation) as $id) {
                if (isset($this::$date_posts[$id])) {
                    foreach ($this::$date_posts[$id] as $key => $value) {
                        foreach ($value as $k => $v) {
                            $temp[$k] = (isset($temp[$k]) ? $temp[$k] : 0) + $v;
                        }
                    }
                }
                if (isset($this::$totalResourcesDonut[$id])) {
                    foreach ($this::$totalResourcesDonut[$id] as $key => $value) {
                        $tempDonut[$key] = (isset($tempDonut[$key]) ? $tempDonut[$key] : 0) + $value;
                    }
                }
            }
            $this::$date_posts = $temp;
            $this::$totalResourcesDonut = $tempDonut;
            ksort($this::$date_posts);
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

    public function actionCandidate()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $candidate_id = isset($_GET['candidate_id']) ? $_GET['candidate_id'] : null;
        if (strlen($start_date) < 11 && strlen($end_date) < 11 && is_numeric($candidate_id)) {
            $result = json_decode(get_web_page("frontend.test.localhost/backend/main/search?type=2&candidate_id={$candidate_id}&start_date={$start_date}&end_date={$end_date}"), true);
            // var_dump($result);
            // exit;
            $this->splitData($result);
            $dates = $this->getBetweenDates($start_date, $end_date);
            $temp = [];
            foreach ($this::$candidateInformation as $candidate) {
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
    }

    public function actionCompare()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

        if (strlen($start_date) < 11 && strlen($end_date) < 11) {
            $result = json_decode(get_web_page("frontend.test.localhost/backend/main/search?type=index&start_date={$start_date}&end_date={$end_date}"), true);
            $this->splitData($result);
            return $this->render('compare', [
                // 'result' => $result,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'candidateInformation' => $this::$candidateInformation,
            ]);
        }
    }

    public function actionComparecontent()
    {
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

        if (
            strlen($start_date) < 11 && strlen($end_date) < 11
            && is_numeric($first) && is_numeric($second)
            && strlen($discussionChart) <= 5 && strlen($sentimentChart) <= 5
            && strlen($subsChart) <= 5 && strlen($likesChart) <= 5
            && strlen($commentsChart) <= 5 && strlen($repostsChart) <= 5 && strlen($rating) <= 5
        ) {
            $result = json_decode(get_web_page("frontend.test.localhost/backend/main/search?type=3&start_date={$start_date}&end_date={$end_date}&first={$first}&second={$second}&discussionChart={$discussionChart}&sentimentChart={$sentimentChart}&subsChart={$subsChart}&likesChart={$likesChart}&commentsChart={$commentsChart}&repostsChart={$repostsChart}"), true);
            $this->splitData($result);

            $temp = [];
            foreach ($this::$candidateInformation as $candidate) {
                $temp[$candidate['id']] = $candidate;
            }
            $this::$candidateInformation = $temp;

            $dates = $this->getBetweenDates($start_date, $end_date);

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
}
