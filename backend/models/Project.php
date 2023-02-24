<?php

namespace app\models;

use Yii;
use yii\base\Model;
use backend\models\helpers\Helper;

class Project extends Model
{
    /**
     * Хелпер для сокращения файла, все вспомогательные функции там
     */
    private $helper = Helper::class;

    public function get_cities_data($project_id, $id = [])
    {
        $query = "SELECT * from city where ";
        if (isset($id[0])) {
            if (isset($id[1])) {
                $query .= " id in (" . implode(', ', $id) . ") and ";
            } else {
                $query .= " id = {$id[0]} and ";
            }
        }
        if (isset($project_id)) {
            $query .= " project_id = {$project_id}";
        }
        // return $query;
        return $this->helper::createCommand($query);
    }

    public function get_res_posts($res_id, $start_date, $end_date)
    {
        if (isset($res_id)) {
            $query = "SELECT p.*, r.photo, r.name from res_posts p inner join resources r on p.res_id=r.id where p.res_id = {$res_id} and p.s_date between '{$start_date}' and '{$end_date}' order by p.s_date desc";
            return $this->helper::createCommand($query);
            // return $query;
        }
    }


    public function get_resources_count($city_id)
    {
        if (is_array($city_id)) {
            $query = "SELECT city_id, id as r_count from resources where city_id in(" . implode(', ', $city_id) . ")";
        } else {
            // if($city_id == 0) return false;
            $query = "SELECT name, url, type, description, photo, status, city_id, id as r_count from resources where city_id = {$city_id}";
        }
        return $this->helper::createCommand($query);
    }

    public function get_all_data($city_id, $res_id, $start_date, $end_date, $type, $first = null, $second = null, $discussionChart = null, $sentimentChart = null, $subsChart = null, $likesChart = null, $commentsChart = null, $repostsChart = null)
    {
        $return = [];
        $query = "select u.id, DATE_FORMAT(p.s_date, '%Y-%m-%d') as date,";
        switch ($type) {
            case 1:
                $query .=
                    " count(distinct case when p.type=1 then t.id end) as vk,"
                    . " count(distinct case when p.type=2 then t.id end) as fb,"
                    . " count(distinct case when p.type=3 then t.id end) as tw,"
                    . " count(distinct case when p.type=4 then t.id end) as ig,"
                    . " count(distinct case when p.type=5 then t.id end) as gg,"
                    . " count(distinct case when p.type=6 then t.id end) as yt,"
                    . " count(distinct case when p.type=7 then t.id end) as ok,"
                    . " count(distinct case when p.type=8 then t.id end) as mm,"
                    . " count(distinct case when p.type=9 then t.id end) as tg,"
                    . " count(distinct case when p.type=10 then t.id end) as tt,"
                    . " count(distinct case when t.sentiment=1  and t.type = 1 then t.id end) as vk_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 1 then t.id end) as vk_neutral,"
                    . " count(distinct case when t.sentiment=-1  and t.type = 1 then t.id end) as vk_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 2 then t.id end) as fb_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 2 then t.id end) as fb_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 2 then t.id end) as fb_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 3 then t.id end) as tw_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 3 then t.id end) as tw_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 3 then t.id end) as tw_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 4 then t.id end) as ig_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 4 then t.id end) as ig_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 4 then t.id end) as ig_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 5 then t.id end) as gg_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 5 then t.id end) as gg_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 5 then t.id end) as gg_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 6 then t.id end) as yt_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 6 then t.id end) as yt_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 6 then t.id end) as yt_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 7 then t.id end) as ok_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 7 then t.id end) as ok_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 7 then t.id end) as ok_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 8 then t.id end) as mm_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 8 then t.id end) as mm_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 8 then t.id end) as mm_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 9 then t.id end) as tg_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 9 then t.id end) as tg_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 9 then t.id end) as tg_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 10 then t.id end) as tt_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 10 then t.id end) as tt_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 10 then t.id end) as tt_negative";
                break;
            case 2:
                $query .=
                    " count(distinct case when p.type=1 then t.id end) as vk,"
                    . " count(distinct case when p.type=2 then t.id end) as fb,"
                    . " count(distinct case when p.type=3 then t.id end) as tw,"
                    . " count(distinct case when p.type=4 then t.id end) as ig,"
                    . " count(distinct case when p.type=5 then t.id end) as gg,"
                    . " count(distinct case when p.type=6 then t.id end) as yt,"
                    . " count(distinct case when p.type=7 then t.id end) as ok,"
                    . " count(distinct case when p.type=8 then t.id end) as mm,"
                    . " count(distinct case when p.type=9 then t.id end) as tg,"
                    . " count(distinct case when p.type=10 then t.id end) as tt,"

                    . " sum(case when p.type=1 then p.comments end) as vk_comments,"
                    . " sum(case when p.type=2 then p.comments end) as fb_comments,"
                    . " sum(case when p.type=3 then p.comments end) as tw_comments,"
                    . " sum(case when p.type=4 then p.comments end) as ig_comments,"
                    . " sum(case when p.type=5 then p.comments end) as gg_comments,"
                    . " sum(case when p.type=6 then p.comments end) as yt_comments,"
                    . " sum(case when p.type=7 then p.comments end) as ok_comments,"
                    . " sum(case when p.type=8 then p.comments end) as mm_comments,"
                    . " sum(case when p.type=9 then p.comments end) as tg_comments,"
                    . " sum(case when p.type=10 then p.comments end) as tt_comments,"

                    . " sum(case when p.type=1 then p.reposts end) as vk_reposts,"
                    . " sum(case when p.type=2 then p.reposts end) as fb_reposts,"
                    . " sum(case when p.type=3 then p.reposts end) as tw_reposts,"
                    . " sum(case when p.type=4 then p.reposts end) as ig_reposts,"
                    . " sum(case when p.type=5 then p.reposts end) as gg_reposts,"
                    . " sum(case when p.type=6 then p.reposts end) as yt_reposts,"
                    . " sum(case when p.type=7 then p.reposts end) as ok_reposts,"
                    . " sum(case when p.type=8 then p.reposts end) as mm_reposts,"
                    . " sum(case when p.type=9 then p.reposts end) as tg_reposts,"
                    . " sum(case when p.type=10 then p.reposts end) as tt_reposts,"

                    . " sum(case when p.type=1 then p.likes end) as vk_likes,"
                    . " sum(case when p.type=2 then p.likes end) as fb_likes,"
                    . " sum(case when p.type=3 then p.likes end) as tw_likes,"
                    . " sum(case when p.type=4 then p.likes end) as ig_likes,"
                    . " sum(case when p.type=5 then p.likes end) as gg_likes,"
                    . " sum(case when p.type=6 then p.likes end) as yt_likes,"
                    . " sum(case when p.type=7 then p.likes end) as ok_likes,"
                    . " sum(case when p.type=8 then p.likes end) as mm_likes,"
                    . " sum(case when p.type=9 then p.likes end) as tg_likes,"
                    . " sum(case when p.type=10 then p.likes end) as tt_likes,"

                    . " count(distinct case when t.sentiment=1  and t.type = 1 then t.id end) as vk_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 1 then t.id end) as vk_neutral,"
                    . " count(distinct case when t.sentiment=-1  and t.type = 1 then t.id end) as vk_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 2 then t.id end) as fb_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 2 then t.id end) as fb_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 2 then t.id end) as fb_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 3 then t.id end) as tw_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 3 then t.id end) as tw_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 3 then t.id end) as tw_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 4 then t.id end) as ig_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 4 then t.id end) as ig_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 4 then t.id end) as ig_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 5 then t.id end) as gg_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 5 then t.id end) as gg_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 5 then t.id end) as gg_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 6 then t.id end) as yt_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 6 then t.id end) as yt_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 6 then t.id end) as yt_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 7 then t.id end) as ok_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 7 then t.id end) as ok_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 7 then t.id end) as ok_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 8 then t.id end) as mm_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 8 then t.id end) as mm_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 8 then t.id end) as mm_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 9 then t.id end) as tg_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 9 then t.id end) as tg_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 9 then t.id end) as tg_negative,"
                    . " count(distinct case when t.sentiment=1  and t.type = 10 then t.id end) as tt_positive,"
                    . " count(distinct case when t.sentiment=0  and t.type = 10 then t.id end) as tt_neutral,"
                    . " count(distinct case when t.sentiment=-1 and t.type = 10 then t.id end) as tt_negative ";

                $q = "select r.city_id, s.date, "
                    . "if(s.type=1, s.count, 0) as vk_sub, "
                    . "if(s.type=2, s.count, 0) as fb_sub, "
                    . "if(s.type=3, s.count, 0) as tw_sub, "
                    . "if(s.type=4, s.count, 0) as ig_sub, "
                    . "if(s.type=5, s.count, 0) as gg_sub, "
                    . "if(s.type=6, s.count, 0) as yt_sub, "
                    . "if(s.type=7, s.count, 0) as ok_sub, "
                    . "if(s.type=8, s.count, 0) as mm_sub, "
                    . "if(s.type=9, s.count, 0) as tg_sub, "
                    . "if(s.type=10, s.count, 0) as tt_sub "
                    . "from "
                    . "sub_follow s "
                    . "inner join resources r on r.city_id = {$city_id} "
                    . "where "
                    . "s.res_id = r.id "
                    . "and s.date between '{$start_date}' "
                    . "and '{$end_date}' "
                    . "group by s.date, s.type, s.count, r.city_id";
                // return $this->helper::createCommand($q);
                // return $q;
                $return['subs'] = $this->helper::createCommand($q);
                break;
            case 3:
                if ($subsChart == true) {
                    $q = "select r.city_id, s.date, "
                        . "if(s.type=1, s.count, 0) as vk_sub, "
                        . "if(s.type=2, s.count, 0) as fb_sub, "
                        . "if(s.type=3, s.count, 0) as tw_sub, "
                        . "if(s.type=4, s.count, 0) as ig_sub, "
                        . "if(s.type=5, s.count, 0) as gg_sub, "
                        . "if(s.type=6, s.count, 0) as yt_sub, "
                        . "if(s.type=7, s.count, 0) as ok_sub, "
                        . "if(s.type=8, s.count, 0) as mm_sub, "
                        . "if(s.type=9, s.count, 0) as tg_sub, "
                        . "if(s.type=10, s.count, 0) as tt_sub "
                        . "from "
                        . "sub_follow s "
                        . "inner join resources r on r.id=s.res_id "
                        . "where "
                        . "r.city_id IN ({$first}, {$second}) "
                        . "and s.date between '{$start_date}' "
                        . "and '{$end_date}' "
                        . "group by s.date, s.type, s.count, r.city_id";
                    // return $this->helper::createCommand($q);
                    // return $q;
                    $return['subs'] = $this->helper::createCommand($q);
                }
                $query .= ($discussionChart == true ?
                        " count(distinct case when p.type=1 then t.id end) as vk,"
                        . " count(distinct case when p.type=2 then t.id end) as fb,"
                        . " count(distinct case when p.type=3 then t.id end) as tw,"
                        . " count(distinct case when p.type=4 then t.id end) as ig,"
                        . " count(distinct case when p.type=5 then t.id end) as gg,"
                        . " count(distinct case when p.type=6 then t.id end) as yt,"
                        . " count(distinct case when p.type=7 then t.id end) as ok,"
                        . " count(distinct case when p.type=8 then t.id end) as mm,"
                        . " count(distinct case when p.type=9 then t.id end) as tg,"
                        . " count(distinct case when p.type=10 then t.id end) as tt,"
                        : "")
                    . ($commentsChart == true ? " sum(case when p.type=1 then p.comments end) as vk_comments,"
                        . " sum(case when p.type=2 then p.comments end) as fb_comments,"
                        . " sum(case when p.type=3 then p.comments end) as tw_comments,"
                        . " sum(case when p.type=4 then p.comments end) as ig_comments,"
                        . " sum(case when p.type=5 then p.comments end) as gg_comments,"
                        . " sum(case when p.type=6 then p.comments end) as yt_comments,"
                        . " sum(case when p.type=7 then p.comments end) as ok_comments,"
                        . " sum(case when p.type=8 then p.comments end) as mm_comments,"
                        . " sum(case when p.type=9 then p.comments end) as tg_comments,"
                        . " sum(case when p.type=10 then p.comments end) as tt_comments,"
                        : "")
                    . ($repostsChart == true ? " sum(case when p.type=1 then p.reposts end) as vk_reposts,"
                        . " sum(case when p.type=2 then p.reposts end) as fb_reposts,"
                        . " sum(case when p.type=3 then p.reposts end) as tw_reposts,"
                        . " sum(case when p.type=4 then p.reposts end) as ig_reposts,"
                        . " sum(case when p.type=5 then p.reposts end) as gg_reposts,"
                        . " sum(case when p.type=6 then p.reposts end) as yt_reposts,"
                        . " sum(case when p.type=7 then p.reposts end) as ok_reposts,"
                        . " sum(case when p.type=8 then p.reposts end) as mm_reposts,"
                        . " sum(case when p.type=9 then p.reposts end) as tg_reposts,"
                        . " sum(case when p.type=10 then p.reposts end) as tt_reposts,"
                        : "")
                    . ($likesChart == true ? " sum(case when p.type=1 then p.likes end) as vk_likes,"
                        . " sum(case when p.type=2 then p.likes end) as fb_likes,"
                        . " sum(case when p.type=3 then p.likes end) as tw_likes,"
                        . " sum(case when p.type=4 then p.likes end) as ig_likes,"
                        . " sum(case when p.type=5 then p.likes end) as gg_likes,"
                        . " sum(case when p.type=6 then p.likes end) as yt_likes,"
                        . " sum(case when p.type=7 then p.likes end) as ok_likes,"
                        . " sum(case when p.type=8 then p.likes end) as mm_likes,"
                        . " sum(case when p.type=9 then p.likes end) as tg_likes,"
                        . " sum(case when p.type=10 then p.likes end) as tt_likes,"
                        : "")
                    . ($sentimentChart == true ?
                        " count(distinct case when t.sentiment=1  and t.type = 1 then t.id end) as vk_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 1 then t.id end) as vk_neutral,"
                        . " count(distinct case when t.sentiment=-1  and t.type = 1 then t.id end) as vk_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 2 then t.id end) as fb_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 2 then t.id end) as fb_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 2 then t.id end) as fb_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 3 then t.id end) as tw_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 3 then t.id end) as tw_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 3 then t.id end) as tw_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 4 then t.id end) as ig_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 4 then t.id end) as ig_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 4 then t.id end) as ig_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 5 then t.id end) as gg_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 5 then t.id end) as gg_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 5 then t.id end) as gg_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 6 then t.id end) as yt_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 6 then t.id end) as yt_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 6 then t.id end) as yt_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 7 then t.id end) as ok_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 7 then t.id end) as ok_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 7 then t.id end) as ok_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 8 then t.id end) as mm_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 8 then t.id end) as mm_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 8 then t.id end) as mm_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 9 then t.id end) as tg_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 9 then t.id end) as tg_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 9 then t.id end) as tg_negative,"
                        . " count(distinct case when t.sentiment=1  and t.type = 10 then t.id end) as tt_positive,"
                        . " count(distinct case when t.sentiment=0  and t.type = 10 then t.id end) as tt_neutral,"
                        . " count(distinct case when t.sentiment=-1 and t.type = 10 then t.id end) as tt_negative "
                        : "");
                break;
        }
        $query .= " from city u "
            . " inner join resources r on r.city_id=u.id"
            . " inner join posts_metrics p on r.id = p.res_id"
            . " inner join res_posts t on r.id = t.res_id and p.item_id=t.item_id"
            . " where"
            . (isset($city_id) ? " u.id= :city_id and" : "")
            . (isset($res_id) ? " r.id= :res_id and" : "")
            . ((isset($first) && isset($second)) ? " u.id IN (:first, :second) and" : "")
            . " p.s_date between :start_date and :end_date"
            . " group by DATE_FORMAT(p.s_date, '%Y-%m-%d'), u.id";
        // return $query;
        if (isset($city_id)) {
            $bindValues[':city_id'] = $city_id;
        }
        if (isset($res_id)) {
            $bindValues[':res_id'] = $res_id;
        }
        if (isset($first) && isset($second)) {
            $bindValues[':first'] = $first;
            $bindValues[':second'] = $second;
        }
        if (isset($start_date) && isset($end_date)) {
            $bindValues[':start_date'] = $start_date;
            $bindValues[':end_date'] = $end_date;
        }
        // return Yii::$app->db->createCommand($query)->bindValues($bindValues)->getRawSql();

        $return[] = Yii::$app->db->createCommand($query)->bindValues($bindValues)->queryAll();
        return $return;
    }
}
