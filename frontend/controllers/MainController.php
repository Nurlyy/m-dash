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
    public static $city_posts = [];
    public static $r_count = [];

    private function cleanVariables()
    {
        $this::$rating = [];
        $this::$date_posts = [];
        $this::$postsSentimentLine = [];
        $this::$totalResourcesDonut = [];
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
        $this::$city_posts = [];
        $this::$r_count = [];
    }

    private function splitDayByDay($id, $rawArray, $type, $start_date, $soc_name = null)
    {
        if (!empty($rawArray)) {
            $chartArray = [];
            $donutArray = [];
            $arr = isset($soc_name) ? $rawArray[$id][$soc_name] : $rawArray[$id];

            foreach ($arr as $key => $dates) {
                $prev = 0;
                foreach ($dates as $date => $value) {
                    if (strtotime($start_date) < strtotime($date)) {
                        // $chartArray[$id][$key][$date] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                        if (isset($soc_name)) {
                            $chartArray[$id][$key][$date] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                        } else {
                            $chartArray[$id][$key][$date] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                        }
                        if ($type == 'donut') {
                            if (isset($soc_name) ? $donutArray[$id][$key] : isset($donutArray[$id][$key])) {
                                // $donutArray[$id][$key] += (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                                isset($soc_name) ? $donutArray[$id][$key] : $donutArray[$id][$key] += (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                            } else {
                                // $donutArray[$id][$key] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                                isset($soc_name) ? $donutArray[$id][$key] : $donutArray[$id][$key] = (isset($prev) && $prev > 0 && $value > 0) ? (($value - $prev <= 0) ? 0 : $value - $prev) : $value;
                            }
                        }
                    }
                    (isset($value) && $value > 0) ? $prev = $value : $prev = $prev;
                }
            }
            // echo '<pre>';
            //     var_dump($chartArray);
            // echo '</pre>';
            // exit;
            if ($type == "chart") {
                return $chartArray;
            } else if ($type == "donut") {
                return $donutArray;
            }
        }
    }

    private function splitData($result, $start_date)
    {
        $this->cleanVariables();
        if (isset($result['all_data']) && isset($result['city_data'])) {
            foreach ($result['city_data'] as $c_data) {
                if (isset($result['all_data'][$c_data['id']])) {
                    foreach ($result['all_data'][$c_data['id']] as $value) {
                        $this->set_data($c_data['id'], $value, explode(" ", $value['date'])[0], $start_date);
                    }
                    // echo '<pre>';
                    // var_dump($this::$postsSentimentChart);
                    // echo '</pre>';
                    // exit;


                    $this::$totalResourcesDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$date_posts, 'donut', $start_date)[$c_data['id']];
                    // $this::$postsSentimentLine[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, 'donut')[$c_data['id']];
                    // $this::$postsSentimentChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart")[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['fb'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'fb')[$c_data['id']];
                    // var_dump($this::$postsSentimentChart);exit;
                    $this::$postsSentimentChart[$c_data['id']]['mm'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'mm')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['ig'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'ig')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['tt'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'tt')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['tg'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'tg')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['yt'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'yt')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['ok'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'ok')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['tw'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'tw')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['gg'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'gg')[$c_data['id']];
                    $this::$postsSentimentChart[$c_data['id']]['vk'] = $this->splitDayByDay($c_data['id'], $this::$postsSentimentChart, "chart", $start_date, 'vk')[$c_data['id']];
                    $this::$postsSentimentLine[$c_data['id']] = [];
                    $this::$totalLikesDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalLikesChart, "donut", $start_date)[$c_data['id']];
                    $this::$totalCommentsDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalCommentsChart, "donut", $start_date)[$c_data['id']];
                    $this::$totalRepostsDonut[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalRepostsChart, "donut", $start_date)[$c_data['id']];
                    $this::$totalLikesChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalLikesChart, "chart", $start_date)[$c_data['id']];
                    $this::$totalCommentsChart[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$totalCommentsChart, "chart", $start_date)[$c_data['id']];
                    $this::$totalRepostsChart[$c_data['id']] = $this->splitDayByday($c_data['id'], $this::$totalRepostsChart, "chart", $start_date)[$c_data['id']];
                    $temp_sentiment = [$c_data['id'] => []];
                    // var_dump($this::$postsSentimentChart[$c_data['id']]);exit;
                    foreach ($this::$postsSentimentChart[$c_data['id']] as $socials) {
                        foreach ($socials as $sentiment => $datecount) {
                            // var_dump($sentiment);exit;
                            if (!isset($temp_sentiment[$c_data['id']][$sentiment])) {
                                $temp_sentiment[$c_data['id']][$sentiment] = [];
                            }
                            if (!isset($this::$postsSentimentLine[$c_data['id']][$sentiment])) {
                                $this::$postsSentimentLine[$c_data['id']][$sentiment] = 0;
                            }
                            foreach ($datecount as $date => $count) {
                                $temp_sentiment[$c_data['id']][$sentiment][$date] = isset($temp_sentiment[$c_data['id']][$sentiment][$date]) ? $temp_sentiment[$c_data['id']][$sentiment][$date] += $count : $count;
                                // $this::$postsSentimentLine[$c_data['id']][$sentiment] = isset($postsSentimentLine[$c_data['id']][$sentiment])?$postsSentimentLine[$c_data['id']][$sentiment] += $count : $count;
                                $this::$postsSentimentLine[$c_data['id']][$sentiment] += $count;
                                // continue 2;
                            }
                        }
                        // if(!isset($temp_sentiment[$c_data['id']]['positive'])){
                        //     $temp_sentiment[$c_data['id']]['positive'] = [];
                        // }
                        // if(!isset($temp_sentiment[$c_data['id']]['neutral'])){
                        //     $temp_sentiment[$c_data['id']]['neutral'] = [];
                        // }
                        // if(!isset($temp_sentiment[$c_data['id']]['negative'])){
                        //     $temp_sentiment[$c_data['id']]['negative'] = [];
                        // }
                    }
                    // var_dump($temp_sentiment);exit;
                    if (isset($this::$postsSentimentChart[$c_data['id']])) unset($this::$postsSentimentChart[$c_data['id']]);
                    $this::$postsSentimentChart[$c_data['id']] = $temp_sentiment[$c_data['id']];

                    $this::$date_posts[$c_data['id']] = $this->splitDayByDay($c_data['id'], $this::$date_posts, "chart", $start_date)[$c_data['id']];
                    // exit;
                    // echo '<pre>';
                    // var_dump($this::$postsSentimentChart);
                    // var_dump($this::$date_posts);
                    // echo '</pre>';
                    // exit;
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
                    $donut = $this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "donut", $start_date);
                    $chrt = $this->splitDayByDay($c_data['id'], $this::$totalSubsChart, "chart", $start_date);
                    if (isset($donut[$c_data['id']])) {
                        $this::$totalSubsDonut[$c_data['id']] = $donut[$c_data['id']];
                    }
                    if (isset($chrt[$c_data['id']])) {
                        $this::$totalSubsChart[$c_data['id']] = $chrt[$c_data['id']];
                    }
                }
            }
            // echo '<pre>';
            // // $temp = [];
            // // $tmp = 0;
            // // foreach ($this::$postsSentimentChart as $chart) {
            //     // foreach ($chart as $key => $value) {
            //         // foreach ($value as $v) {
            //             // $temp[$key] = isset($temp[$key]) ? $temp[$key] + $v : $v;
            //         // }
            //     // }
            // // }
            // var_dump($this::$postsSentimentChart);
            // // print '<br>';
            // echo '</pre>';
            // echo '<pre>';
            // // foreach ($this::$date_posts as $date) {
            //     // foreach ($date as $key => $value) {
            //         // foreach ($value as $v) {
            //             // $tmp += $v;
            //         // }
            //     // }
            // // }
            // var_dump($this::$date_posts);
            // // var_dump($this::$postsSentimentLine);
            // echo '</pre>';
            // exit;

        }
        if (isset($result['r_count'])) {
            foreach ($result['r_count'] as $r) {
                if (isset($this::$r_count[$r['city_id']])) {
                    $this::$r_count[$r['city_id']] += isset($r['r_count']) ? 1 : 0;
                } else {
                    $this::$r_count[$r['city_id']] = 0;
                    $this::$r_count[$r['city_id']] += isset($r['r_count']) ? 1 : 0;
                }
            }
        }
        if (isset($result['city_data'])) {
            foreach ($result['city_data'] as $value) {
                $this::$cityInformation[$value['id']] = $value;
            }
        }
        if (isset($result['city_posts'])) {
            $this::$city_posts = $result['city_posts'];
        }


        $this::$rating = [];
        // var_dump($this::$date_posts);exit;
        foreach ($this::$date_posts as $key => $d_post) {
            $this::$rating[$key] = 0;
            foreach ($d_post as $post) {
                foreach ($post as $p) {
                    // var_dump($p);exit;
                    $this::$rating[$key] += $p;
                }
            }
        }
    }

    private function set_data($id, $value, $date, $start_date)
    {
        if (strtotime($start_date) < strtotime($date)) {
            $this::$rating[$id] = (isset($this::$rating[$id]) ? $this::$rating[$id] : 0) + (isset($value['fb']) ? $value['fb'] : 0) + (isset($value['ig']) ? $value['ig'] : 0) + (isset($value['tg']) ? $value['tg'] : 0) + (isset($value['mm']) ? $value['mm'] : 0) + (isset($value['yt']) ? $value['yt'] : 0) + (isset($value['ok']) ? $value['ok'] : 0) + (isset($value['tw']) ? $value['tw'] : 0) + (isset($value['gg']) ? $value['gg'] : 0) + (isset($value['vk']) ? $value['vk'] : 0) + (isset($value['tt']) ? $value['tt'] : 0);
        }
        if (isset($value['fb'])) {
            if (isset($this::$date_posts[$id]['fb'][$date])) {
                $this::$date_posts[$id]['fb'][$date] += $value['fb'];
            } else {
                if (intval($value['fb']) > 0) {
                    $this::$date_posts[$id]['fb'][$date] = $value['fb'];
                }
            }
        }
        if (isset($value['ig'])) {
            if (isset($this::$date_posts[$id]['ig'][$date])) {
                $this::$date_posts[$id]['ig'][$date] += $value['ig'];
            } else {
                if (intval($value['ig']) > 0) {
                    $this::$date_posts[$id]['ig'][$date] = $value['ig'];
                }
            }
        }
        if (isset($value['tg'])) {
            if (isset($this::$date_posts[$id]['tg'][$date])) {
                $this::$date_posts[$id]['tg'][$date] += $value['tg'];
            } else {
                if (intval($value['tg']) > 0) {
                    $this::$date_posts[$id]['tg'][$date] = $value['tg'];
                }
            }
        }
        if (isset($value['tt'])) {
            if (isset($this::$date_posts[$id]['tt'][$date])) {
                $this::$date_posts[$id]['tt'][$date] += $value['tt'];
            } else {
                if (intval($value['tt']) > 0) {
                    $this::$date_posts[$id]['tt'][$date] = $value['tt'];
                }
            }
        }
        if (isset($value['mm'])) {
            if (isset($this::$date_posts[$id]['mm'][$date])) {
                $this::$date_posts[$id]['mm'][$date] += $value['mm'];
            } else {
                if (intval($value['mm']) > 0) {
                    $this::$date_posts[$id]['mm'][$date] = $value['mm'];
                }
            }
        }
        if (isset($value['yt'])) {
            if (isset($this::$date_posts[$id]['yt'][$date])) {
                $this::$date_posts[$id]['yt'][$date] += $value['yt'];
            } else {
                if (intval($value['yt']) > 0) {
                    $this::$date_posts[$id]['yt'][$date] = $value['yt'];
                }
            }
        }
        if (isset($value['ok'])) {
            if (isset($this::$date_posts[$id]['ok'][$date])) {
                $this::$date_posts[$id]['ok'][$date] += $value['ok'];
            } else {
                if (intval($value['ok']) > 0) {
                    $this::$date_posts[$id]['ok'][$date] = $value['ok'];
                }
            }
        }
        if (isset($value['tw'])) {
            if (isset($this::$date_posts[$id]['tw'][$date])) {
                $this::$date_posts[$id]['tw'][$date] += $value['tw'];
            } else {
                if (intval($value['tw']) > 0) {
                    $this::$date_posts[$id]['tw'][$date] = $value['tw'];
                }
            }
        }
        if (isset($value['gg'])) {
            if (isset($this::$date_posts[$id]['gg'][$date])) {
                $this::$date_posts[$id]['gg'][$date] += $value['gg'];
            } else {
                if (intval($value['gg']) > 0) {
                    $this::$date_posts[$id]['gg'][$date] = $value['gg'];
                }
            }
        }
        if (isset($value['vk'])) {
            if (isset($this::$date_posts[$id]['vk'][$date])) {
                $this::$date_posts[$id]['vk'][$date] += $value['vk'];
            } else {
                if (intval($value['vk']) > 0) {
                    $this::$date_posts[$id]['vk'][$date] = $value['vk'];
                }
            }
        }
        // (isset($value['fb']) ? $value['fb'] : 0)(isset($this::$date_posts[$id]['fb'][$date]) ? $this::$date_posts[$id]['fb'][$date] : 0) + (isset($value['fb']) ? $value['fb'] : 0);
        // (isset($value['ig']) ? $value['ig'] : 0)(isset($this::$date_posts[$id]['ig'][$date]) ? $this::$date_posts[$id]['ig'][$date] : 0) + (isset($value['ig']) ? $value['ig'] : 0);
        // (isset($value['tg']) ? $value['tg'] : 0)(isset($this::$date_posts[$id]['tg'][$date]) ? $this::$date_posts[$id]['tg'][$date] : 0) + (isset($value['tg']) ? $value['tg'] : 0);
        // (isset($value['tt']) ? $value['tt'] : 0)(isset($this::$date_posts[$id]['tt'][$date]) ? $this::$date_posts[$id]['tt'][$date] : 0) + (isset($value['tt']) ? $value['tt'] : 0);
        // (isset($value['mm']) ? $value['mm'] : 0)(isset($this::$date_posts[$id]['mm'][$date]) ? $this::$date_posts[$id]['mm'][$date] : 0) + (isset($value['mm']) ? $value['mm'] : 0);
        // (isset($value['yt']) ? $value['yt'] : 0)(isset($this::$date_posts[$id]['yt'][$date]) ? $this::$date_posts[$id]['yt'][$date] : 0) + (isset($value['yt']) ? $value['yt'] : 0);
        // (isset($value['ok']) ? $value['ok'] : 0)(isset($this::$date_posts[$id]['ok'][$date]) ? $this::$date_posts[$id]['ok'][$date] : 0) + (isset($value['ok']) ? $value['ok'] : 0);
        // (isset($value['tw']) ? $value['tw'] : 0)(isset($this::$date_posts[$id]['tw'][$date]) ? $this::$date_posts[$id]['tw'][$date] : 0) + (isset($value['tw']) ? $value['tw'] : 0);
        // (isset($value['gg']) ? $value['gg'] : 0)(isset($this::$date_posts[$id]['gg'][$date]) ? $this::$date_posts[$id]['gg'][$date] : 0) + (isset($value['gg']) ? $value['gg'] : 0);
        // (isset($value['vk']) ? $value['vk'] : 0)(isset($this::$date_posts[$id]['vk'][$date]) ? $this::$date_posts[$id]['vk'][$date] : 0) + (isset($value['vk']) ? $value['vk'] : 0);
        $this::$postsSentimentChart[$id]['fb']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['fb']['positive'][$date]) ? $this::$postsSentimentChart[$id]['fb']['positive'][$date] : 0) + (isset($value['fb_positive']) ? $value['fb_positive'] : 0);
        $this::$postsSentimentChart[$id]['fb']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['fb']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['fb']['neutral'][$date] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0);
        $this::$postsSentimentChart[$id]['fb']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['fb']['negative'][$date]) ? $this::$postsSentimentChart[$id]['fb']['negative'][$date] : 0) + (isset($value['fb_negative']) ? $value['fb_negative'] : 0);
        $this::$postsSentimentChart[$id]['mm']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['mm']['positive'][$date]) ? $this::$postsSentimentChart[$id]['mm']['positive'][$date] : 0) + (isset($value['mm_positive']) ? $value['mm_positive'] : 0);
        $this::$postsSentimentChart[$id]['mm']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['mm']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['mm']['neutral'][$date] : 0) + (isset($value['mm_neutral']) ? $value['mm_neutral'] : 0);
        $this::$postsSentimentChart[$id]['mm']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['mm']['negative'][$date]) ? $this::$postsSentimentChart[$id]['mm']['negative'][$date] : 0) + (isset($value['mm_negative']) ? $value['mm_negative'] : 0);
        $this::$postsSentimentChart[$id]['ig']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['ig']['positive'][$date]) ? $this::$postsSentimentChart[$id]['ig']['positive'][$date] : 0) + (isset($value['ig_positive']) ? $value['ig_positive'] : 0);
        $this::$postsSentimentChart[$id]['ig']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['ig']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['ig']['neutral'][$date] : 0) + (isset($value['ig_neutral']) ? $value['ig_neutral'] : 0);
        $this::$postsSentimentChart[$id]['ig']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['ig']['negative'][$date]) ? $this::$postsSentimentChart[$id]['ig']['negative'][$date] : 0) + (isset($value['ig_negative']) ? $value['ig_negative'] : 0);
        $this::$postsSentimentChart[$id]['tt']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['tt']['positive'][$date]) ? $this::$postsSentimentChart[$id]['tt']['positive'][$date] : 0) + (isset($value['tt_positive']) ? $value['tt_positive'] : 0);
        $this::$postsSentimentChart[$id]['tt']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['tt']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['tt']['neutral'][$date] : 0) + (isset($value['tt_neutral']) ? $value['tt_neutral'] : 0);
        $this::$postsSentimentChart[$id]['tt']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['tt']['negative'][$date]) ? $this::$postsSentimentChart[$id]['tt']['negative'][$date] : 0) + (isset($value['tt_negative']) ? $value['tt_negative'] : 0);
        $this::$postsSentimentChart[$id]['tg']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['tg']['positive'][$date]) ? $this::$postsSentimentChart[$id]['tg']['positive'][$date] : 0) + (isset($value['tg_positive']) ? $value['tg_positive'] : 0);
        $this::$postsSentimentChart[$id]['tg']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['tg']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['tg']['neutral'][$date] : 0) + (isset($value['tg_neutral']) ? $value['tg_neutral'] : 0);
        $this::$postsSentimentChart[$id]['tg']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['tg']['negative'][$date]) ? $this::$postsSentimentChart[$id]['tg']['negative'][$date] : 0) + (isset($value['tg_negative']) ? $value['tg_negative'] : 0);
        $this::$postsSentimentChart[$id]['yt']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['yt']['positive'][$date]) ? $this::$postsSentimentChart[$id]['yt']['positive'][$date] : 0) + (isset($value['yt_positive']) ? $value['yt_positive'] : 0);
        $this::$postsSentimentChart[$id]['yt']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['yt']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['yt']['neutral'][$date] : 0) + (isset($value['yt_neutral']) ? $value['yt_neutral'] : 0);
        $this::$postsSentimentChart[$id]['yt']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['yt']['negative'][$date]) ? $this::$postsSentimentChart[$id]['yt']['negative'][$date] : 0) + (isset($value['yt_negative']) ? $value['yt_negative'] : 0);
        $this::$postsSentimentChart[$id]['ok']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['ok']['positive'][$date]) ? $this::$postsSentimentChart[$id]['ok']['positive'][$date] : 0) + (isset($value['ok_positive']) ? $value['ok_positive'] : 0);
        $this::$postsSentimentChart[$id]['ok']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['ok']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['ok']['neutral'][$date] : 0) + (isset($value['ok_neutral']) ? $value['ok_neutral'] : 0);
        $this::$postsSentimentChart[$id]['ok']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['ok']['negative'][$date]) ? $this::$postsSentimentChart[$id]['ok']['negative'][$date] : 0) + (isset($value['ok_negative']) ? $value['ok_negative'] : 0);
        $this::$postsSentimentChart[$id]['tw']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['tw']['positive'][$date]) ? $this::$postsSentimentChart[$id]['tw']['positive'][$date] : 0) + (isset($value['tw_positive']) ? $value['tw_positive'] : 0);
        $this::$postsSentimentChart[$id]['tw']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['tw']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['tw']['neutral'][$date] : 0) + (isset($value['tw_neutral']) ? $value['tw_neutral'] : 0);
        $this::$postsSentimentChart[$id]['tw']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['tw']['negative'][$date]) ? $this::$postsSentimentChart[$id]['tw']['negative'][$date] : 0) + (isset($value['tw_negative']) ? $value['tw_negative'] : 0);
        $this::$postsSentimentChart[$id]['gg']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['gg']['positive'][$date]) ? $this::$postsSentimentChart[$id]['gg']['positive'][$date] : 0) + (isset($value['gg_positive']) ? $value['gg_positive'] : 0);
        $this::$postsSentimentChart[$id]['gg']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['gg']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['gg']['neutral'][$date] : 0) + (isset($value['gg_neutral']) ? $value['gg_neutral'] : 0);
        $this::$postsSentimentChart[$id]['gg']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['gg']['negative'][$date]) ? $this::$postsSentimentChart[$id]['gg']['negative'][$date] : 0) + (isset($value['gg_negative']) ? $value['gg_negative'] : 0);
        $this::$postsSentimentChart[$id]['vk']['positive'][$date] = (isset($this::$postsSentimentChart[$id]['vk']['positive'][$date]) ? $this::$postsSentimentChart[$id]['vk']['positive'][$date] : 0) + (isset($value['vk_positive']) ? $value['vk_positive'] : 0);
        $this::$postsSentimentChart[$id]['vk']['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['vk']['neutral'][$date]) ? $this::$postsSentimentChart[$id]['vk']['neutral'][$date] : 0) + (isset($value['vk_neutral']) ? $value['vk_neutral'] : 0);
        $this::$postsSentimentChart[$id]['vk']['negative'][$date] = (isset($this::$postsSentimentChart[$id]['vk']['negative'][$date]) ? $this::$postsSentimentChart[$id]['vk']['negative'][$date] : 0) + (isset($value['vk_negative']) ? $value['vk_negative'] : 0);
        // $this::$postsSentimentChart[$id]['neutral'][$date] = (isset($this::$postsSentimentChart[$id]['neutral'][$date]) ? $this::$postsSentimentChart[$id]['neutral'][$date] : 0) + (isset($value['fb_neutral']) ? $value['fb_neutral'] : 0);
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
                        return !Yii::$app->user->identity->getIsAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/manage/index"]);
                    },

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
        $lang = isset($_GET['lang']) ? (in_array($_GET['lang'], ['ru', 'kz', 'en']) ? $_GET['lang'] : 'ru') : 'ru';
        $result = json_decode(get_web_page("localhost:8081/backend/main/search?type=index"), true);
        $this->splitData($result, $start_date);
        $vars = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'cityInformation' => $this::$cityInformation,
        ];
        // var_dump($result);
        // exit;
        if ($result == "false") {
            $vars['turnedOff'] = true;
        }

        return $this->render('index', $vars);
    }

    public function actionDashboard()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? htmlentities($_GET['start_date']) : null;
        $end_date = isset($_GET['end_date']) ? htmlentities($_GET['end_date']) : null;
        if (strlen($start_date) < 11 && strlen($end_date) < 11) {
            $result = json_decode(get_web_page("http://localhost:8081/backend/main/search?type=1&start_date={$start_date}&end_date={$end_date}"), true);
            // var_dump($result);exit;
            $this->splitData($result, $start_date);
            $dates = $this->getBetweenDates($start_date, $end_date);
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
            uasort($this::$postsSentimentLine, function ($a, $b) {
                // foreach($)
                // var_dump(($a['positive'] + $a['neutral'] + $a['negative']) > ($b['positive'] + $b['neutral'] + $b['negative']));exit;
                if (($a['positive'] + $a['neutral'] + $a['negative']) == ($b['positive'] + $b['neutral'] + $b['negative']) ) {
                    return 0;
                }
                return (($a['positive'] + $a['neutral'] + $a['negative']) > ($b['positive'] + $b['neutral'] + $b['negative'])) ? -1 : 1;
            });
            // var_dump($this::$postsSentimentLine);exit;
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
                'cityInformation' => $this::$cityInformation,
                'dates' => $dates,
            ]);
        }
    }

    public function actionCity()
    {
        $this->layout = 'empty';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
        if (strlen($start_date) < 11 && strlen($end_date) < 11 && is_numeric($city_id)) {
            $result = json_decode(get_web_page("localhost:8081/backend/main/search?type=2&city_id={$city_id}&start_date={$start_date}&end_date={$end_date}"), true);
            // var_dump($result);exit;
            $this->splitData($result, $start_date);
            $dates = $this->getBetweenDates($start_date, $end_date);
            $temp = [];
            foreach ($this::$cityInformation as $city) {
                if ($city['id'] == $city_id) {
                    $temp = $city;
                }
            }
            $this::$cityInformation = $temp;
            // var_dump($this::$postsSentimentLine);exit;
            return $this->render('city', [
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
            $result = json_decode(get_web_page("localhost:8081/backend/main/search?type=index&start_date={$start_date}&end_date={$end_date}"), true);
            $this->splitData($result, $start_date);
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
            $result = json_decode(get_web_page("localhost:8081/backend/main/search?type=3&start_date={$start_date}&end_date={$end_date}&first={$first}&second={$second}&discussionChart={$discussionChart}&sentimentChart={$sentimentChart}&subsChart={$subsChart}&likesChart={$likesChart}&commentsChart={$commentsChart}&repostsChart={$repostsChart}"), true);
            $this->splitData($result, $start_date);
            // var_dump($this::$rating);exit;
            $dates = $this->getBetweenDates($start_date, $end_date);

            // $this::$rating = [];
            // // var_dump($this::$date_posts);exit;
            // foreach ($this::$date_posts as $key => $d_post) {
            //     $this::$rating[$key] = 0;
            //     foreach ($d_post as $post) {
            //         foreach ($post as $p) {
            //             // var_dump($p);exit;
            //             $this::$rating[$key] += $p;
            //         }
            //     }
            // }

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
