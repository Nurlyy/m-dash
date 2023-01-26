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
    public static $cityInformation = [];
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
    public static $city_posts = [];
    public static $r_count = [];

    private function cleanVariables()
    {
        $this::$rating = [];
        $this::$date_posts = [];
        $this::$postsSentimentLine = [];
        $this::$totalResourcesDonut = [];
        $this::$discussionSentimentChart = [];
        $this::$cityInformation = [];
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
        $this::$city_posts = [];
        $this::$r_count = [];
    }

    private function splitDayByDay($id, $chartArray, $type)
    {
        if (!empty($chartArray)) {
            $temp = [];
            $donutArray = [];

            foreach ($chartArray[$id] as $key => $dates) {
                $prev = 0;
                foreach ($dates as $date => $value) {
                    $temp[$id][$key][$date] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                    if (isset($donutArray[$id][$key])) {
                        $donutArray[$id][$key] += (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                    } else {
                        $donutArray[$id][$key] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                    }
                    (isset($value) && $value > 0) ? $prev = $value : $prev = $prev;
                }
            }
            if ($type == "chart") {
                return $temp;
            } else if ($type == "donut") {
                return $donutArray;
            }
        }
    }

    private function splitData($result)
    {
        $this->cleanVariables();
        if (isset($result['all_data']) && isset($result['city_data'])) {
            foreach ($result['city_data'] as $c_data) {

                if (isset($result['all_data'][$c_data['id']])) {
                    foreach ($result['all_data'][$c_data['id']] as $value) {
                        // var_dump($value);
                        // exit;
                        $this->set_data($c_data['id'], $value, explode(" ", $value['date'])[0]);
                    }
                    // var_dump($this::$date_posts);exit;
                    $this::$totalResourcesDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$date_posts, 'donut')[$c_data['id']];
                    $this::$postsSentimentLine[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, 'donut')[$c_data['id']];
                    // var_dump($this::$postsSentimentChart);
                    // $this::$date_posts = $this->splitDayByDay($c_data['id'], $this::$date_posts, "chart");
                    $this::$postsSentimentChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart")[$c_data['id']];
                    // echo "<br>";
                    // var_dump($this::$postsSentimentChart);
                    // exit;
                    $this::$totalLikesDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalLikesChart, "donut")[$c_data['id']];
                    $this::$totalCommentsDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalCommentsChart, "donut")[$c_data['id']];
                    $this::$totalRepostsDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalRepostsChart, "donut")[$c_data['id']];

                    $this::$totalLikesChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalLikesChart, "chart")[$c_data['id']];
                    $this::$totalCommentsChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalCommentsChart, "chart")[$c_data['id']];
                    $this::$totalRepostsChart[$c_data['id']] = $this->splitDayByday($c_data['id'], $this::$totalRepostsChart, "chart")[$c_data['id']];
                    $this::$date_posts[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$date_posts, "chart")[$c_data['id']];

                    // $this::$postsSentimentLine = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "donut");
                    // var_dump($this::$postsSentimentLine);exit;

                } else {
                    $this->set_data($c_data['id'], null, 0, 0);
                }
                if (isset($result['all_data']['subs'])) {
                    foreach ($result['all_data']['subs'] as $subs) {
                        $this::$totalSubsChart[$c_data['id']]['fb'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['fb'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['fb'][$subs['date']] : 0) + ((isset($subs['fb_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['fb_sub'] > 0) ? $subs['fb_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['ig'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['ig'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['ig'][$subs['date']] : 0) + ((isset($subs['ig_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['ig_sub'] > 0) ? $subs['ig_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['tg'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['tg'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['tg'][$subs['date']] : 0) + ((isset($subs['tg_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['tg_sub'] > 0) ? $subs['tg_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['tt'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['tt'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['tt'][$subs['date']] : 0) + ((isset($subs['tt_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['tt_sub'] > 0) ? $subs['tt_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['mm'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['mm'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['mm'][$subs['date']] : 0) + ((isset($subs['mm_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['mm_sub'] > 0) ? $subs['mm_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['yt'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['yt'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['yt'][$subs['date']] : 0) + ((isset($subs['yt_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['yt_sub'] > 0) ? $subs['yt_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['ok'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['ok'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['ok'][$subs['date']] : 0) + ((isset($subs['ok_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['ok_sub'] > 0) ? $subs['ok_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['tw'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['tw'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['tw'][$subs['date']] : 0) + ((isset($subs['tw_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['tw_sub'] > 0) ? $subs['tw_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['gg'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['gg'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['gg'][$subs['date']] : 0) + ((isset($subs['gg_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['gg_sub'] > 0) ? $subs['gg_sub'] : 0);
                        $this::$totalSubsChart[$c_data['id']]['vk'][$subs['date']] = (isset($this::$totalSubsChart[$c_data['id']]['vk'][$subs['date']]) ? $this::$totalSubsChart[$c_data['id']]['vk'][$subs['date']] : 0) + ((isset($subs['vk_sub']) && ($subs['city_id'] == $c_data['id']) && $subs['vk_sub'] > 0) ? $subs['vk_sub'] : 0);
                    }
                    // var_dump($this::$totalSubsChart);exit;
                    if (isset($this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "donut")[$c_data['id']])) {
                        $this::$totalSubsDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "donut")[$c_data['id']];
                    }
                    if (isset($this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "chart")[$c_data['id']])) {
                        $this::$totalSubsChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "chart")[$c_data['id']];
                    }
                    // var_dump($this::$totalSubsDonut);exit;
                }
            }
        }
        if (isset($result['r_count'])) {
            // var_dump($result['r_count']);
            // exit;
            foreach ($result['r_count'] as $r) {
                // var_dump($r['r_count']);
                // exit;
                if (isset($this::$r_count[$r['city_id']])) {
                    $this::$r_count[$r['city_id']] += isset($r['r_count']) ? 1 : 0;
                } else {
                    $this::$r_count[$r['city_id']] = 0;
                    $this::$r_count[$r['city_id']] += isset($r['r_count']) ? 1 : 0;
                }
            }
            // var_dump($this::$r_count);
            // exit;
        }
        if (isset($result['city_data'])) {
            foreach ($result['city_data'] as $value) {
                $this::$cityInformation[$value['id']] = $value;
            }
        }
        if (isset($result['city_posts'])) {
            $this::$city_posts = $result['city_posts'];
            // echo "<pre>";
            // var_dump($this::$city_posts);
            // echo "</pre>";
            // exit;
        }
    }

    private function set_data($id, $value, $date)
    {
        $this::$rating[$id] = (isset($this::$rating[$id]) ? $this::$rating[$id] : 0) + (isset($value['fb']) ? $value['fb'] : 0) + (isset($value['ig']) ? $value['ig'] : 0) + (isset($value['tg']) ? $value['tg'] : 0) + (isset($value['mm']) ? $value['mm'] : 0) + (isset($value['yt']) ? $value['yt'] : 0) + (isset($value['ok']) ? $value['ok'] : 0) + (isset($value['tw']) ? $value['tw'] : 0) + (isset($value['gg']) ? $value['gg'] : 0) + (isset($value['vk']) ? $value['vk'] : 0) + (isset($value['tt']) ? $value['tt'] : 0);

        $this::$date_posts[$id]['fb'][$date] = (isset($this::$date_posts[$id]['fb'][$date]) ? $this::$date_posts[$id]['fb'][$date] : 0) + (isset($value['fb']) ? $value['fb'] : 0);
        $this::$date_posts[$id]['ig'][$date] = (isset($this::$date_posts[$id]['ig'][$date]) ? $this::$date_posts[$id]['ig'][$date] : 0) + (isset($value['ig']) ? $value['ig'] : 0);
        $this::$date_posts[$id]['tg'][$date] = (isset($this::$date_posts[$id]['tg'][$date]) ? $this::$date_posts[$id]['tg'][$date] : 0) + (isset($value['tg']) ? $value['tg'] : 0);
        $this::$date_posts[$id]['tt'][$date] = (isset($this::$date_posts[$id]['tt'][$date]) ? $this::$date_posts[$id]['tt'][$date] : 0) + (isset($value['tt']) ? $value['tt'] : 0);
        $this::$date_posts[$id]['mm'][$date] = (isset($this::$date_posts[$id]['mm'][$date]) ? $this::$date_posts[$id]['mm'][$date] : 0) + (isset($value['mm']) ? $value['mm'] : 0);
        $this::$date_posts[$id]['yt'][$date] = (isset($this::$date_posts[$id]['yt'][$date]) ? $this::$date_posts[$id]['yt'][$date] : 0) + (isset($value['yt']) ? $value['yt'] : 0);
        $this::$date_posts[$id]['ok'][$date] = (isset($this::$date_posts[$id]['ok'][$date]) ? $this::$date_posts[$id]['ok'][$date] : 0) + (isset($value['ok']) ? $value['ok'] : 0);
        $this::$date_posts[$id]['tw'][$date] = (isset($this::$date_posts[$id]['tw'][$date]) ? $this::$date_posts[$id]['tw'][$date] : 0) + (isset($value['tw']) ? $value['tw'] : 0);
        $this::$date_posts[$id]['gg'][$date] = (isset($this::$date_posts[$id]['gg'][$date]) ? $this::$date_posts[$id]['gg'][$date] : 0) + (isset($value['gg']) ? $value['gg'] : 0);
        $this::$date_posts[$id]['vk'][$date] = (isset($this::$date_posts[$id]['vk'][$date]) ? $this::$date_posts[$id]['vk'][$date] : 0) + (isset($value['vk']) ? $value['vk'] : 0);
        $this::$postsSentimentChart[$id]['positive'][$date] = (isset($this::$postsSentimentChart[$id]['positive'][$date]) ? $this::$postsSentimentChart[$id]['positive'][$date] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0) + (isset($value['mm_positive']) ? $value['mm_positive'] : 0) + (isset($value['yt_positive']) ? $value['yt_positive'] : 0) + (isset($value['gg_positive']) ? $value['gg_positive'] : 0) + (isset($value['tw_positive']) ? $value['tw_positive'] : 0) + (isset($value['vk_positive']) ? $value['vk_positive'] : 0) + (isset($value['ok_positive']) ? $value['ok_positive'] : 0) + (isset($value['tt_positive']) ? $value['tt_positive'] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0) + (isset($value['web_positive']) ? $value['web_positive'] : 0);
        $this::$postsSentimentChart[$id]['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['neutral'][$date]) ? $this::$postsSentimentChart[$id]['neutral'][$date] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0) + (isset($value['mm_neutral']) ? $value['mm_neutral'] : 0) + (isset($value['yt_neutral']) ? $value['yt_neutral'] : 0) + (isset($value['gg_neutral']) ? $value['gg_neutral'] : 0) + (isset($value['tw_neutral']) ? $value['tw_neutral'] : 0) + (isset($value['vk_neutral']) ? $value['vk_neutral'] : 0) + (isset($value['ok_neutral']) ? $value['ok_neutral'] : 0) + (isset($value['tt_neutral']) ? $value['tt_neutral'] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0) + (isset($value['web_neutral']) ? $value['web_neutral'] : 0);
        $this::$postsSentimentChart[$id]['negative'][$date] = (isset($this::$postsSentimentChart[$id]['negative'][$date]) ? $this::$postsSentimentChart[$id]['negative'][$date] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0) + (isset($value['mm_negative']) ? $value['mm_negative'] : 0) + (isset($value['yt_negative']) ? $value['yt_negative'] : 0) + (isset($value['gg_negative']) ? $value['gg_negative'] : 0) + (isset($value['tw_negative']) ? $value['tw_negative'] : 0) + (isset($value['vk_negative']) ? $value['vk_negative'] : 0) + (isset($value['ok_negative']) ? $value['ok_negative'] : 0) + (isset($value['tt_negative']) ? $value['tt_negative'] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0) + (isset($value['web_negative']) ? $value['web_negative'] : 0);
        $this::$totalLikesChart[$id]['fb'][$date] = (isset($this::$totalLikesChart[$id]['fb'][$date]) ? $this::$totalLikesChart[$id]['fb'][$date] : 0) + (isset($value['fb_likes']) ? $value['fb_likes'] : 0);
        $this::$totalLikesChart[$id]['ig'][$date] = (isset($this::$totalLikesChart[$id]['ig'][$date]) ? $this::$totalLikesChart[$id]['ig'][$date] : 0) + (isset($value['ig_likes']) ? $value['ig_likes'] : 0);
        $this::$totalLikesChart[$id]['tt'][$date] = (isset($this::$totalLikesChart[$id]['tt'][$date]) ? $this::$totalLikesChart[$id]['tt'][$date] : 0) + (isset($value['tt_likes']) ? $value['tt_likes'] : 0);
        $this::$totalLikesChart[$id]['tg'][$date] = (isset($this::$totalLikesChart[$id]['tg'][$date]) ? $this::$totalLikesChart[$id]['tg'][$date] : 0) + (isset($value['tg_likes']) ? $value['tg_likes'] : 0);
        $this::$totalLikesChart[$id]['mm'][$date] = (isset($this::$totalLikesChart[$id]['mm'][$date]) ? $this::$totalLikesChart[$id]['mm'][$date] : 0) + (isset($value['mm_likes']) ? $value['mm_likes'] : 0);
        $this::$totalLikesChart[$id]['yt'][$date] = (isset($this::$totalLikesChart[$id]['yt'][$date]) ? $this::$totalLikesChart[$id]['yt'][$date] : 0) + (isset($value['yt_likes']) ? $value['yt_likes'] : 0);
        $this::$totalLikesChart[$id]['ok'][$date] = (isset($this::$totalLikesChart[$id]['ok'][$date]) ? $this::$totalLikesChart[$id]['ok'][$date] : 0) + (isset($value['ok_likes']) ? $value['ok_likes'] : 0);
        $this::$totalLikesChart[$id]['tw'][$date] = (isset($this::$totalLikesChart[$id]['tw'][$date]) ? $this::$totalLikesChart[$id]['tw'][$date] : 0) + (isset($value['tw_likes']) ? $value['tw_likes'] : 0);
        $this::$totalLikesChart[$id]['gg'][$date] = (isset($this::$totalLikesChart[$id]['gg'][$date]) ? $this::$totalLikesChart[$id]['gg'][$date] : 0) + (isset($value['gg_likes']) ? $value['gg_likes'] : 0);
        $this::$totalLikesChart[$id]['vk'][$date] = (isset($this::$totalLikesChart[$id]['vk'][$date]) ? $this::$totalLikesChart[$id]['vk'][$date] : 0) + (isset($value['vk_likes']) ? $value['vk_likes'] : 0);
        $this::$totalCommentsChart[$id]['fb'][$date] = (isset($this::$totalCommentsChart[$id]['fb'][$date]) ? $this::$totalCommentsChart[$id]['fb'][$date] : 0) + (isset($value['fb_comments']) ? $value['fb_comments'] : 0);
        $this::$totalCommentsChart[$id]['ig'][$date] = (isset($this::$totalCommentsChart[$id]['ig'][$date]) ? $this::$totalCommentsChart[$id]['ig'][$date] : 0) + (isset($value['ig_comments']) ? $value['ig_comments'] : 0);
        $this::$totalCommentsChart[$id]['tt'][$date] = (isset($this::$totalCommentsChart[$id]['tt'][$date]) ? $this::$totalCommentsChart[$id]['tt'][$date] : 0) + (isset($value['tt_comments']) ? $value['tt_comments'] : 0);
        $this::$totalCommentsChart[$id]['tg'][$date] = (isset($this::$totalCommentsChart[$id]['tg'][$date]) ? $this::$totalCommentsChart[$id]['tg'][$date] : 0) + (isset($value['tg_comments']) ? $value['tg_comments'] : 0);
        $this::$totalCommentsChart[$id]['mm'][$date] = (isset($this::$totalCommentsChart[$id]['mm'][$date]) ? $this::$totalCommentsChart[$id]['mm'][$date] : 0) + (isset($value['mm_comments']) ? $value['mm_comments'] : 0);
        $this::$totalCommentsChart[$id]['yt'][$date] = (isset($this::$totalCommentsChart[$id]['yt'][$date]) ? $this::$totalCommentsChart[$id]['yt'][$date] : 0) + (isset($value['yt_comments']) ? $value['yt_comments'] : 0);
        $this::$totalCommentsChart[$id]['ok'][$date] = (isset($this::$totalCommentsChart[$id]['ok'][$date]) ? $this::$totalCommentsChart[$id]['ok'][$date] : 0) + (isset($value['ok_comments']) ? $value['ok_comments'] : 0);
        $this::$totalCommentsChart[$id]['tw'][$date] = (isset($this::$totalCommentsChart[$id]['tw'][$date]) ? $this::$totalCommentsChart[$id]['tw'][$date] : 0) + (isset($value['tw_comments']) ? $value['tw_comments'] : 0);
        $this::$totalCommentsChart[$id]['gg'][$date] = (isset($this::$totalCommentsChart[$id]['gg'][$date]) ? $this::$totalCommentsChart[$id]['gg'][$date] : 0) + (isset($value['gg_comments']) ? $value['gg_comments'] : 0);
        $this::$totalCommentsChart[$id]['vk'][$date] = (isset($this::$totalCommentsChart[$id]['vk'][$date]) ? $this::$totalCommentsChart[$id]['vk'][$date] : 0) + (isset($value['vk_comments']) ? $value['vk_comments'] : 0);
        $this::$totalRepostsChart[$id]['fb'][$date] = (isset($this::$totalRepostsChart[$id]['fb'][$date]) ? $this::$totalRepostsChart[$id]['fb'][$date] : 0) + (isset($value['fb_reposts']) ? $value['fb_reposts'] : 0);
        $this::$totalRepostsChart[$id]['ig'][$date] = (isset($this::$totalRepostsChart[$id]['ig'][$date]) ? $this::$totalRepostsChart[$id]['ig'][$date] : 0) + (isset($value['ig_reposts']) ? $value['ig_reposts'] : 0);
        $this::$totalRepostsChart[$id]['tg'][$date] = (isset($this::$totalRepostsChart[$id]['tg'][$date]) ? $this::$totalRepostsChart[$id]['tg'][$date] : 0) + (isset($value['tg_reposts']) ? $value['tg_reposts'] : 0);
        $this::$totalRepostsChart[$id]['tt'][$date] = (isset($this::$totalRepostsChart[$id]['tt'][$date]) ? $this::$totalRepostsChart[$id]['tt'][$date] : 0) + (isset($value['tt_reposts']) ? $value['tt_reposts'] : 0);
        $this::$totalRepostsChart[$id]['mm'][$date] = (isset($this::$totalRepostsChart[$id]['mm'][$date]) ? $this::$totalRepostsChart[$id]['mm'][$date] : 0) + (isset($value['mm_reposts']) ? $value['mm_reposts'] : 0);
        $this::$totalRepostsChart[$id]['yt'][$date] = (isset($this::$totalRepostsChart[$id]['yt'][$date]) ? $this::$totalRepostsChart[$id]['yt'][$date] : 0) + (isset($value['yt_reposts']) ? $value['yt_reposts'] : 0);
        $this::$totalRepostsChart[$id]['ok'][$date] = (isset($this::$totalRepostsChart[$id]['ok'][$date]) ? $this::$totalRepostsChart[$id]['ok'][$date] : 0) + (isset($value['ok_reposts']) ? $value['ok_reposts'] : 0);
        $this::$totalRepostsChart[$id]['tw'][$date] = (isset($this::$totalRepostsChart[$id]['tw'][$date]) ? $this::$totalRepostsChart[$id]['tw'][$date] : 0) + (isset($value['tw_reposts']) ? $value['tw_reposts'] : 0);
        $this::$totalRepostsChart[$id]['gg'][$date] = (isset($this::$totalRepostsChart[$id]['gg'][$date]) ? $this::$totalRepostsChart[$id]['gg'][$date] : 0) + (isset($value['gg_reposts']) ? $value['gg_reposts'] : 0);
        $this::$totalRepostsChart[$id]['vk'][$date] = (isset($this::$totalRepostsChart[$id]['vk'][$date]) ? $this::$totalRepostsChart[$id]['vk'][$date] : 0) + (isset($value['vk_reposts']) ? $value['vk_reposts'] : 0);
        // var_dump($this::$postsSentimentLine);
        // $this::$postsSentimentLine[$id]['positive'] = (isset($this::$postsSentimentLine[$id]['positive']) ? $this::$postsSentimentLine[$id]['positive'] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0) + (isset($value['mm_positive']) ? $value['mm_positive'] : 0) + (isset($value['yt_positive']) ? $value['yt_positive'] : 0) + (isset($value['gg_positive']) ? $value['gg_positive'] : 0) + (isset($value['tw_positive']) ? $value['tw_positive'] : 0) + (isset($value['vk_positive']) ? $value['vk_positive'] : 0) + (isset($value['ok_positive']) ? $value['ok_positive'] : 0) + (isset($value['tt_positive']) ? $value['tt_positive'] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0) + (isset($value['web_positive']) ? $value['web_positive'] : 0);
        // $this::$postsSentimentLine[$id]['neutral'] = (isset($this::$postsSentimentLine[$id]['neutral']) ? $this::$postsSentimentLine[$id]['neutral'] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0) + (isset($value['mm_neutral']) ? $value['mm_neutral'] : 0) + (isset($value['yt_neutral']) ? $value['yt_neutral'] : 0) + (isset($value['gg_neutral']) ? $value['gg_neutral'] : 0) + (isset($value['tw_neutral']) ? $value['tw_neutral'] : 0) + (isset($value['vk_neutral']) ? $value['vk_neutral'] : 0) + (isset($value['ok_neutral']) ? $value['ok_neutral'] : 0) + (isset($value['tt_neutral']) ? $value['tt_neutral'] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0) + (isset($value['web_neutral']) ? $value['web_neutral'] : 0);
        // $this::$postsSentimentLine[$id]['negative'] = (isset($this::$postsSentimentLine[$id]['negative']) ? $this::$postsSentimentLine[$id]['negative'] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0) + (isset($value['mm_negative']) ? $value['mm_negative'] : 0) + (isset($value['yt_negative']) ? $value['yt_negative'] : 0) + (isset($value['gg_negative']) ? $value['gg_negative'] : 0) + (isset($value['tw_negative']) ? $value['tw_negative'] : 0) + (isset($value['vk_negative']) ? $value['vk_negative'] : 0) + (isset($value['ok_negative']) ? $value['ok_negative'] : 0) + (isset($value['tt_negative']) ? $value['tt_negative'] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0) + (isset($value['web_negative']) ? $value['web_negative'] : 0);
        // $this::$totalResourcesDonut[$id]['fb'] = (isset($this::$totalResourcesDonut[$id]['fb']) ? $this::$totalResourcesDonut[$id]['fb'] : 0) + (isset($value['fb']) ? $value['fb'] : 0);
        // $this::$totalResourcesDonut[$id]['ig'] = (isset($this::$totalResourcesDonut[$id]['ig']) ? $this::$totalResourcesDonut[$id]['ig'] : 0) + (isset($value['ig']) ? $value['ig'] : 0);
        // $this::$totalResourcesDonut[$id]['tg'] = (isset($this::$totalResourcesDonut[$id]['tg']) ? $this::$totalResourcesDonut[$id]['tg'] : 0) + (isset($value['tg']) ? $value['tg'] : 0);
        // $this::$totalResourcesDonut[$id]['tt'] = (isset($this::$totalResourcesDonut[$id]['tt']) ? $this::$totalResourcesDonut[$id]['tt'] : 0) + (isset($value['tt']) ? $value['tt'] : 0);
        // $this::$totalResourcesDonut[$id]['mm'] = (isset($this::$totalResourcesDonut[$id]['mm']) ? $this::$totalResourcesDonut[$id]['mm'] : 0) + (isset($value['mm']) ? $value['mm'] : 0);
        // $this::$totalResourcesDonut[$id]['yt'] = (isset($this::$totalResourcesDonut[$id]['yt']) ? $this::$totalResourcesDonut[$id]['yt'] : 0) + (isset($value['yt']) ? $value['yt'] : 0);
        // $this::$totalResourcesDonut[$id]['ok'] = (isset($this::$totalResourcesDonut[$id]['ok']) ? $this::$totalResourcesDonut[$id]['ok'] : 0) + (isset($value['ok']) ? $value['ok'] : 0);
        // $this::$totalResourcesDonut[$id]['tw'] = (isset($this::$totalResourcesDonut[$id]['tw']) ? $this::$totalResourcesDonut[$id]['tw'] : 0) + (isset($value['tw']) ? $value['tw'] : 0);
        // $this::$totalResourcesDonut[$id]['gg'] = (isset($this::$totalResourcesDonut[$id]['gg']) ? $this::$totalResourcesDonut[$id]['gg'] : 0) + (isset($value['gg']) ? $value['gg'] : 0);
        // $this::$totalResourcesDonut[$id]['vk'] = (isset($this::$totalResourcesDonut[$id]['vk']) ? $this::$totalResourcesDonut[$id]['vk'] : 0) + (isset($value['vk']) ? $value['vk'] : 0);
        // $this::$totalLikesDonut[$id]['fb'] = (isset($this::$totalLikesDonut[$id]['fb']) ? $this::$totalLikesDonut[$id]['fb'] : 0) + (isset($value['fb_likes']) ? $value['fb_likes'] : 0);
        // $this::$totalLikesDonut[$id]['ig'] = (isset($this::$totalLikesDonut[$id]['ig']) ? $this::$totalLikesDonut[$id]['ig'] : 0) + (isset($value['ig_likes']) ? $value['ig_likes'] : 0);
        // $this::$totalLikesDonut[$id]['tt'] = (isset($this::$totalLikesDonut[$id]['tt']) ? $this::$totalLikesDonut[$id]['tt'] : 0) + (isset($value['tt_likes']) ? $value['tt_likes'] : 0);
        // $this::$totalLikesDonut[$id]['tg'] = (isset($this::$totalLikesDonut[$id]['tg']) ? $this::$totalLikesDonut[$id]['tg'] : 0) + (isset($value['tg_likes']) ? $value['tg_likes'] : 0);
        // $this::$totalLikesDonut[$id]['mm'] = (isset($this::$totalLikesDonut[$id]['mm']) ? $this::$totalLikesDonut[$id]['mm'] : 0) + (isset($value['mm_likes']) ? $value['mm_likes'] : 0);
        // $this::$totalLikesDonut[$id]['yt'] = (isset($this::$totalLikesDonut[$id]['yt']) ? $this::$totalLikesDonut[$id]['yt'] : 0) + (isset($value['yt_likes']) ? $value['yt_likes'] : 0);
        // $this::$totalLikesDonut[$id]['ok'] = (isset($this::$totalLikesDonut[$id]['ok']) ? $this::$totalLikesDonut[$id]['ok'] : 0) + (isset($value['ok_likes']) ? $value['ok_likes'] : 0);
        // $this::$totalLikesDonut[$id]['tw'] = (isset($this::$totalLikesDonut[$id]['tw']) ? $this::$totalLikesDonut[$id]['tw'] : 0) + (isset($value['tw_likes']) ? $value['tw_likes'] : 0);
        // $this::$totalLikesDonut[$id]['gg'] = (isset($this::$totalLikesDonut[$id]['gg']) ? $this::$totalLikesDonut[$id]['gg'] : 0) + (isset($value['gg_likes']) ? $value['gg_likes'] : 0);
        // $this::$totalLikesDonut[$id]['vk'] = (isset($this::$totalLikesDonut[$id]['vk']) ? $this::$totalLikesDonut[$id]['vk'] : 0) + (isset($value['vk_likes']) ? $value['vk_likes'] : 0);
        // $this::$totalCommentsDonut[$id]['fb'] = (isset($this::$totalCommentsDonut[$id]['fb']) ? $this::$totalCommentsDonut[$id]['fb'] : 0) + (isset($value['fb_comments']) ? $value['fb_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['ig'] = (isset($this::$totalCommentsDonut[$id]['ig']) ? $this::$totalCommentsDonut[$id]['ig'] : 0) + (isset($value['ig_comments']) ? $value['ig_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['tt'] = (isset($this::$totalCommentsDonut[$id]['tt']) ? $this::$totalCommentsDonut[$id]['tt'] : 0) + (isset($value['tt_comments']) ? $value['tt_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['tg'] = (isset($this::$totalCommentsDonut[$id]['tg']) ? $this::$totalCommentsDonut[$id]['tg'] : 0) + (isset($value['tg_comments']) ? $value['tg_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['mm'] = (isset($this::$totalCommentsDonut[$id]['mm']) ? $this::$totalCommentsDonut[$id]['mm'] : 0) + (isset($value['mm_comments']) ? $value['mm_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['yt'] = (isset($this::$totalCommentsDonut[$id]['yt']) ? $this::$totalCommentsDonut[$id]['yt'] : 0) + (isset($value['yt_comments']) ? $value['yt_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['ok'] = (isset($this::$totalCommentsDonut[$id]['ok']) ? $this::$totalCommentsDonut[$id]['ok'] : 0) + (isset($value['ok_comments']) ? $value['ok_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['tw'] = (isset($this::$totalCommentsDonut[$id]['tw']) ? $this::$totalCommentsDonut[$id]['tw'] : 0) + (isset($value['tw_comments']) ? $value['tw_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['gg'] = (isset($this::$totalCommentsDonut[$id]['gg']) ? $this::$totalCommentsDonut[$id]['gg'] : 0) + (isset($value['gg_comments']) ? $value['gg_comments'] : 0);
        // $this::$totalCommentsDonut[$id]['vk'] = (isset($this::$totalCommentsDonut[$id]['vk']) ? $this::$totalCommentsDonut[$id]['vk'] : 0) + (isset($value['vk_comments']) ? $value['vk_comments'] : 0);
        // $this::$totalRepostsDonut[$id]['fb'] = (isset($this::$totalRepostsDonut[$id]['fb']) ? $this::$totalRepostsDonut[$id]['fb'] : 0) + (isset($value['fb_reposts']) ? $value['fb_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['ig'] = (isset($this::$totalRepostsDonut[$id]['ig']) ? $this::$totalRepostsDonut[$id]['ig'] : 0) + (isset($value['ig_reposts']) ? $value['ig_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['tg'] = (isset($this::$totalRepostsDonut[$id]['tg']) ? $this::$totalRepostsDonut[$id]['tg'] : 0) + (isset($value['tg_reposts']) ? $value['tg_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['tt'] = (isset($this::$totalRepostsDonut[$id]['tt']) ? $this::$totalRepostsDonut[$id]['tt'] : 0) + (isset($value['tt_reposts']) ? $value['tt_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['mm'] = (isset($this::$totalRepostsDonut[$id]['mm']) ? $this::$totalRepostsDonut[$id]['mm'] : 0) + (isset($value['mm_reposts']) ? $value['mm_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['yt'] = (isset($this::$totalRepostsDonut[$id]['yt']) ? $this::$totalRepostsDonut[$id]['yt'] : 0) + (isset($value['yt_reposts']) ? $value['yt_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['ok'] = (isset($this::$totalRepostsDonut[$id]['ok']) ? $this::$totalRepostsDonut[$id]['ok'] : 0) + (isset($value['ok_reposts']) ? $value['ok_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['tw'] = (isset($this::$totalRepostsDonut[$id]['tw']) ? $this::$totalRepostsDonut[$id]['tw'] : 0) + (isset($value['tw_reposts']) ? $value['tw_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['gg'] = (isset($this::$totalRepostsDonut[$id]['gg']) ? $this::$totalRepostsDonut[$id]['gg'] : 0) + (isset($value['gg_reposts']) ? $value['gg_reposts'] : 0);
        // $this::$totalRepostsDonut[$id]['vk'] = (isset($this::$totalRepostsDonut[$id]['vk']) ? $this::$totalRepostsDonut[$id]['vk'] : 0) + (isset($value['vk_reposts']) ? $value['vk_reposts'] : 0);

        // var_dump($this::$date_posts);
        // exit;
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
            ],
        ];
        return $behaviors;
    }


    public function init(){
        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        if(!empty($_REQUEST['lang'])){
            if(in_array($_REQUEST['lang'], ['en', 'ru', 'kz'])){
                $session->set('lang', $_REQUEST['lang']);
            } else {
                $session->set('lang', 'en');
            }
            
        }
        if(!empty($_SESSION['lang'])){
            Yii::$app->language = $_SESSION['lang'];
        }else{
            Yii::$app->language = 'ru';
        }
        parent::init();
    }


    public $layout = 'inspinia';

    public function actionIndex()
    {
        $today = date('Y-m-d', strtotime('today'));
        $month_ago = date('Y-m-d', strtotime('-30 days'));
        $start_date = isset($_GET['start_date']) ? Yii::$app->request->get('start_date') : $month_ago;
        $end_date = isset($_GET['end_date']) ? Yii::$app->request->get('end_date') : $today;
        $lang = isset($_GET['lang'])?(in_array($_GET['lang'], ['ru','kz','en'])?$_GET['lang']:'ru'):'ru';
        $result = json_decode(get_web_page("rating.imas.kz/backend/main/search?type=index"), true);
        $this->splitData($result);
        $vars = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'cityInformation' => $this::$cityInformation,
        ];
        // var_dump($result);
        // exit;
        if($result == "false"){
            $vars['turnedOff'] = true;
        }
        
        return $this->render('index', $vars);
    }

    public function actionDashboard()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        if (strlen($start_date) < 11 && strlen($end_date) < 11) {
            $result = json_decode(get_web_page("rating.imas.kz/backend/main/search?type=1&start_date={$start_date}&end_date={$end_date}"), true);
            // var_dump("rating.imas.kz/backend/main/search?type=1&start_date={$start_date}&end_date={$end_date}");
            // echo "<pre>";
            //     var_dump($result);
            // echo "</pre>";
            // exit;
            $this->splitData($result);
            $dates = $this->getBetweenDates($start_date, $end_date);
            // var_dump($this::$date_posts);
            // exit;
            $temp = [];
            $tempDonut = [];
            uasort($this::$rating, function ($a, $b) {
                if ($a == $b) {
                    return 0;
                }
                return ($a > $b) ? -1 : 1;
            });
            foreach (array_keys($this::$cityInformation) as $id) {
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
            // var_dump($this::$date_posts);
            // exit;
            return $this->render('dashboard', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'rating' => $this::$rating,
                'date_posts' => $this::$date_posts,
                'postsSentimentLine' => $this::$postsSentimentLine,
                'totalResourcesDonut' => $this::$totalResourcesDonut,
                'cityInformation' => $this::$cityInformation,
                'dates' => $dates,
            ]);
        }
    }

    public function actionCandidate()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
        if (strlen($start_date) < 11 && strlen($end_date) < 11 && is_numeric($city_id)) {
            $result = json_decode(get_web_page("rating.imas.kz/backend/main/search?type=2&city_id={$city_id}&start_date={$start_date}&end_date={$end_date}"), true);
            // var_dump("rating.imas.kz/backend/main/search?type=2&city_id={$city_id}&start_date={$start_date}&end_date={$end_date}");exit;
            $this->splitData($result);
            $dates = $this->getBetweenDates($start_date, $end_date);
            $temp = [];
            foreach ($this::$cityInformation as $city) {
                if ($city['id'] == $city_id) {
                    $temp = $city;
                }
            }
            $this::$cityInformation = $temp;
            // var_dump($this::$totalSubsDonut);
            // exit;
            return $this->render('candidate', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'cityInformation' => $this::$cityInformation,
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
                'city_posts' => $this::$city_posts,
                'r_count' => $this::$r_count,
            ]);
        }
    }

    public function actionCompare()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

        if (strlen($start_date) < 11 && strlen($end_date) < 11) {
            $result = json_decode(get_web_page("rating.imas.kz/backend/main/search?type=index&start_date={$start_date}&end_date={$end_date}"), true);
            $this->splitData($result);
            return $this->render('compare', [
                // 'result' => $result,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'cityInformation' => $this::$cityInformation,
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
            $result = json_decode(get_web_page("rating.imas.kz/backend/main/search?type=3&start_date={$start_date}&end_date={$end_date}&first={$first}&second={$second}&discussionChart={$discussionChart}&sentimentChart={$sentimentChart}&subsChart={$subsChart}&likesChart={$likesChart}&commentsChart={$commentsChart}&repostsChart={$repostsChart}"), true);
            $this->splitData($result);

            // var_dump("rating.imas.kz/backend/main/search?type=3&start_date={$start_date}&end_date={$end_date}&first={$first}&second={$second}&discussionChart={$discussionChart}&sentimentChart={$sentimentChart}&subsChart={$subsChart}&likesChart={$likesChart}&commentsChart={$commentsChart}&repostsChart={$repostsChart}");
            // exit;


            $dates = $this->getBetweenDates($start_date, $end_date);
            // echo "<pre>";
            // var_dump($this::$postsSentimentChart);
            // echo "</pre>";
            // exit;

            return $this->render('comparecontent', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'cityInformation' => $this::$cityInformation,
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
