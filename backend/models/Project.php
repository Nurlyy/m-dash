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

    public function temp()
    {
        $query = "SELECT * FROM city";
        return $this->helper::createCommand($query);
    }

    public function getProjectCandidates($user_id)
    {
        $query = "select c.id from projects p inner join city c on p.id=c.project_id where p.user_id = {$user_id};";
        // return $query;
        return $this->helper::createCommand($query);
    }

    public function turnOffProject($project_id, $state)
    {
        $query = "update projects set is_active = :is_active where id = :project_id";
        if (Yii::$app->db->createCommand($query)->bindValues([':is_active' => $state, ":project_id" => $project_id])->queryAll()) {
            return true;
        }
        return $state;
    }

    public function getProjects()
    {
        $query = "select p.id, p.name, p.created_date, p.is_active, p.user_id, u.username, u.email from projects p inner join user u on p.user_id = u.id";
        return $this->helper::createCommand($query);
        // return $query;
    }

    public function get_cities_count($project_id)
    {
        $query = Yii::$app->db->createCommand("select id as ids from city where project_id = :project_id")->bindValues([':project_id' => $project_id])->queryAll();
        return $query;
    }

    public function getProjectId($user_id)
    {
        $query = "select * from projects where user_id = {$user_id};";
        return $this->helper::createCommand($query);
    }

    public function get_free_users()
    {
        $a = $this->helper::createCommand("select user_id from projects");
        $users = [];
        foreach ($a as $b) {
            array_push($users, $b['user_id']);
        }
        $query = "select u.id, u.username from user u where u.id not in (" . implode(",", $users) . ") and u.status = 10";
        return $this->helper::createCommand($query);
    }

    public function getProject($project_id)
    {
        $query = "select p.*, u.username from projects p inner join user u on p.user_id=u.id where p.id={$project_id}";
        return $this->helper::createCommand($query);
    }

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
            $query = "SELECT p.*, r.photo, r.name from res_posts p inner join resources r on p.res_id=r.id where p.res_id = {$res_id} and p.date between '{$start_date}' and '{$end_date}' order by p.date desc";
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
        // return $city_id;
        $return = [];
        $query = "select u.id, p.date,";
        switch ($type) {
            case 1:
                $query .=
                    " count(case when p.type=1 then 1 end) as vk,"
                    . " count(case when p.type=2 then 1 end) as fb,"
                    . " count(case when p.type=3 then 1 end) as tw,"
                    . " count(case when p.type=4 then 1 end) as ig,"
                    . " count(case when p.type=5 then 1 end) as gg,"
                    . " count(case when p.type=6 then 1 end) as yt,"
                    . " count(case when p.type=7 then 1 end) as ok,"
                    . " count(case when p.type=8 then 1 end) as mm,"
                    . " count(case when p.type=9 then 1 end) as tg,"
                    . " count(case when p.type=10 then 1 end) as tt,"

                    . " count(case when t.sentiment=1  and p.type = 1 then 1 end) as vk_positive,"
                    . " count(case when t.sentiment=0  and p.type = 1 then 1 end) as vk_neutral,"
                    . " count(case when t.sentiment=-1  and p.type = 1 then 1 end) as vk_negative,"

                    . " count(case when t.sentiment=1  and p.type = 2 then 1 end) as fb_positive,"
                    . " count(case when t.sentiment=0  and p.type = 2 then 1 end) as fb_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 2 then 1 end) as fb_negative,"

                    . " count(case when t.sentiment=1  and p.type = 3 then 1 end) as tw_positive,"
                    . " count(case when t.sentiment=0  and p.type = 3 then 1 end) as tw_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 3 then 1 end) as tw_negative,"

                    . " count(case when t.sentiment=1  and p.type = 4 then 1 end) as ig_positive,"
                    . " count(case when t.sentiment=0  and p.type = 4 then 1 end) as ig_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 4 then 1 end) as ig_negative,"

                    . " count(case when t.sentiment=1  and p.type = 5 then 1 end) as gg_positive,"
                    . " count(case when t.sentiment=0  and p.type = 5 then 1 end) as gg_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 5 then 1 end) as gg_negative,"

                    . " count(case when t.sentiment=1  and p.type = 6 then 1 end) as yt_positive,"
                    . " count(case when t.sentiment=0  and p.type = 6 then 1 end) as yt_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 6 then 1 end) as yt_negative,"

                    . " count(case when t.sentiment=1  and p.type = 7 then 1 end) as ok_positive,"
                    . " count(case when t.sentiment=0  and p.type = 7 then 1 end) as ok_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 7 then 1 end) as ok_negative,"

                    . " count(case when t.sentiment=1  and p.type = 8 then 1 end) as mm_positive,"
                    . " count(case when t.sentiment=0  and p.type = 8 then 1 end) as mm_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 8 then 1 end) as mm_negative,"

                    . " count(case when t.sentiment=1  and p.type = 9 then 1 end) as tg_positive,"
                    . " count(case when t.sentiment=0  and p.type = 9 then 1 end) as tg_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 9 then 1 end) as tg_negative,"

                    . " count(case when t.sentiment=1  and p.type = 10 then 1 end) as tt_positive,"
                    . " count(case when t.sentiment=0  and p.type = 10 then 1 end) as tt_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 10 then 1 end) as tt_negative";
                break;
            case 2:
                $query .=
                    " count(case when p.type=1 then 1 end) as vk,"
                    . " count(case when p.type=2 then 1 end) as fb,"
                    . " count(case when p.type=3 then 1 end) as tw,"
                    . " count(case when p.type=4 then 1 end) as ig,"
                    . " count(case when p.type=5 then 1 end) as gg,"
                    . " count(case when p.type=6 then 1 end) as yt,"
                    . " count(case when p.type=7 then 1 end) as ok,"
                    . " count(case when p.type=8 then 1 end) as mm,"
                    . " count(case when p.type=9 then 1 end) as tg,"
                    . " count(case when p.type=10 then 1 end) as tt,"

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

                    . " count(case when t.sentiment=1  and p.type = 1 then 1 end) as vk_positive,"
                    . " count(case when t.sentiment=0  and p.type = 1 then 1 end) as vk_neutral,"
                    . " count(case when t.sentiment=-1  and p.type = 1 then 1 end) as vk_negative,"

                    . " count(case when t.sentiment=1  and p.type = 2 then 1 end) as fb_positive,"
                    . " count(case when t.sentiment=0  and p.type = 2 then 1 end) as fb_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 2 then 1 end) as fb_negative,"

                    . " count(case when t.sentiment=1  and p.type = 3 then 1 end) as tw_positive,"
                    . " count(case when t.sentiment=0  and p.type = 3 then 1 end) as tw_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 3 then 1 end) as tw_negative,"

                    . " count(case when t.sentiment=1  and p.type = 4 then 1 end) as ig_positive,"
                    . " count(case when t.sentiment=0  and p.type = 4 then 1 end) as ig_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 4 then 1 end) as ig_negative,"

                    . " count(case when t.sentiment=1  and p.type = 5 then 1 end) as gg_positive,"
                    . " count(case when t.sentiment=0  and p.type = 5 then 1 end) as gg_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 5 then 1 end) as gg_negative,"

                    . " count(case when t.sentiment=1  and p.type = 6 then 1 end) as yt_positive,"
                    . " count(case when t.sentiment=0  and p.type = 6 then 1 end) as yt_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 6 then 1 end) as yt_negative,"

                    . " count(case when t.sentiment=1  and p.type = 7 then 1 end) as ok_positive,"
                    . " count(case when t.sentiment=0  and p.type = 7 then 1 end) as ok_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 7 then 1 end) as ok_negative,"

                    . " count(case when t.sentiment=1  and p.type = 8 then 1 end) as mm_positive,"
                    . " count(case when t.sentiment=0  and p.type = 8 then 1 end) as mm_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 8 then 1 end) as mm_negative,"

                    . " count(case when t.sentiment=1  and p.type = 9 then 1 end) as tg_positive,"
                    . " count(case when t.sentiment=0  and p.type = 9 then 1 end) as tg_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 9 then 1 end) as tg_negative,"

                    . " count(case when t.sentiment=1  and p.type = 10 then 1 end) as tt_positive,"
                    . " count(case when t.sentiment=0  and p.type = 10 then 1 end) as tt_neutral,"
                    . " count(case when t.sentiment=-1 and p.type = 10 then 1 end) as tt_negative ";

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
                        . "inner join resources r on r.city_id IN ({$first}, {$second}) "
                        . "where "
                        . "s.res_id = r.id "
                        . "and s.date between '{$start_date}' "
                        . "and '{$end_date}' "
                        . "group by s.date, s.type, s.count, r.city_id";
                    // return $this->helper::createCommand($q);
                    // return $q;
                    $return['subs'] = $this->helper::createCommand($q);
                }
                $query .= ($discussionChart == true ? " count(case when p.type=1 then 1 end) as vk,"
                    . " count(case when p.type=2 then 1 end) as fb,"
                    . " count(case when p.type=3 then 1 end) as tw,"
                    . " count(case when p.type=4 then 1 end) as ig,"
                    . " count(case when p.type=5 then 1 end) as gg,"
                    . " count(case when p.type=6 then 1 end) as yt,"
                    . " count(case when p.type=7 then 1 end) as ok,"
                    . " count(case when p.type=8 then 1 end) as mm,"
                    . " count(case when p.type=9 then 1 end) as tg,"
                    . " count(case when p.type=10 then 1 end) as tt,"
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
                    . ($sentimentChart == true ? " count(case when t.sentiment=1  and p.type = 1 then 1 end) as vk_positive,"
                        . " count(case when t.sentiment=0  and p.type = 1 then 1 end) as vk_neutral,"
                        . " count(case when t.sentiment=-1  and p.type = 1 then 1 end) as vk_negative,"

                        . " count(case when t.sentiment=1  and p.type = 2 then 1 end) as fb_positive,"
                        . " count(case when t.sentiment=0  and p.type = 2 then 1 end) as fb_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 2 then 1 end) as fb_negative,"

                        . " count(case when t.sentiment=1  and p.type = 3 then 1 end) as tw_positive,"
                        . " count(case when t.sentiment=0  and p.type = 3 then 1 end) as tw_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 3 then 1 end) as tw_negative,"

                        . " count(case when t.sentiment=1  and p.type = 4 then 1 end) as ig_positive,"
                        . " count(case when t.sentiment=0  and p.type = 4 then 1 end) as ig_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 4 then 1 end) as ig_negative,"

                        . " count(case when t.sentiment=1  and p.type = 5 then 1 end) as gg_positive,"
                        . " count(case when t.sentiment=0  and p.type = 5 then 1 end) as gg_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 5 then 1 end) as gg_negative,"

                        . " count(case when t.sentiment=1  and p.type = 6 then 1 end) as yt_positive,"
                        . " count(case when t.sentiment=0  and p.type = 6 then 1 end) as yt_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 6 then 1 end) as yt_negative,"

                        . " count(case when t.sentiment=1  and p.type = 7 then 1 end) as ok_positive,"
                        . " count(case when t.sentiment=0  and p.type = 7 then 1 end) as ok_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 7 then 1 end) as ok_negative,"

                        . " count(case when t.sentiment=1  and p.type = 8 then 1 end) as mm_positive,"
                        . " count(case when t.sentiment=0  and p.type = 8 then 1 end) as mm_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 8 then 1 end) as mm_negative,"

                        . " count(case when t.sentiment=1  and p.type = 9 then 1 end) as tg_positive,"
                        . " count(case when t.sentiment=0  and p.type = 9 then 1 end) as tg_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 9 then 1 end) as tg_negative,"

                        . " count(case when t.sentiment=1  and p.type = 10 then 1 end) as tt_positive,"
                        . " count(case when t.sentiment=0  and p.type = 10 then 1 end) as tt_neutral,"
                        . " count(case when t.sentiment=-1 and p.type = 10 then 1 end) as tt_negative "
                        : "");
                break;
        }
        $query .= " from city u "
            . " inner join resources r on r.city_id=u.id"
            . " inner join posts_metrics p on r.id = p.res_id"
            . " inner join res_posts t on r.id = t.res_id and p.item_id=t.item_id"
            . " where"
            . (isset($city_id) ? " u.id={$city_id} and" : "")
            . (isset($res_id) ? " r.id={$res_id} and" : "")
            . ((isset($first) && isset($second)) ? " u.id IN ({$first}, {$second}) and" : "")
            . " p.date between '{$start_date}' and '{$end_date}'"
            . " group by p.date, u.id";
        // return $query;

        $return[] = $this->helper::createCommand($query);
        return $return;
    }


    public function createProject($project_name, $user_id, $created_date)
    {
        // return $project_name;
        if (isset($project_name) && isset($user_id)) {
            $query = "insert into projects (name, user_id, created_date, is_active) values ('{$project_name}', {$user_id}, '{$created_date}', 0)";
            return $this->helper::createCommand($query);
        } else return false;
    }


    public function createCandidate($candidate_name, $partia, $fb_account, $ig_account, $web_site, $photo, $birthday, $experience, $project_id)
    {
        $query = "insert into candidate (candidate_name, partia, fb_account, ig_account, web_site, photo, birthday, experience, project_id) values ("
            . "'{$candidate_name}', '{$partia}', '{$fb_account}', '{$ig_account}', '{$web_site}', '{$photo}', '{$birthday}', '{$experience}', '{$project_id}'";
        if ($this->helper::createCommand($query)) {
            return true;
        } else {
            return false;
        }
    }


    public function removeCandidate($candidate_id)
    {
        $query = "update table candidate set isdeleted = 1 where candidate_id = '{$candidate_id}'";
        return $this->helper::createCommand($query);
    }

    public function removeProject($project_id)
    {
        $query = "update table projects set isdeleted = 1 where project_id = {project_id}";
        if ($this->helper::createCommand($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOrCreateResources($data)
    {
        // return $data;
        $query = "";
        if (isset($data)) {
            $f = [];
            foreach ($data as $d) {
                // return $d;
                // return "FDKKPJFIOPDSFDSP";
                $type = "0";
                if (isset($d['url'])) {
                    // return "FDKKPJFIOPDSFDSP";
                    if (strpos($d['url'], 'vk')!==false || strpos($d['url'], 'vkontakte')!==false) {$type == "1";}
                    else if (strpos($d['url'], 'facebook')!==false) {$type == "2";}
                    else if (strpos($d['url'], 'twitter')!==false) {$type == "3";}
                    else if (strpos($d['url'], 'instagram')!==false) {$type == "4";}
                    else if (strpos($d['url'], 'google')!==false) {$type == "5";}
                    else if (strpos($d['url'], 'youtube')!==false) {$type == "6";}
                    else if (strpos($d['url'], 'ok.ru')!==false) {$type == "7";}
                    else if (strpos($d['url'], 'mail.ru')!==false) {$type == "8";}
                    else if (strpos($d['url'], 'telegram')!==false) {$type == "9";}
                    else if (strpos($d['url'], 'tiktok')!==false) {$type == "10";}
                    else $type = 0;
                }
                // return "FDKKPJFIOPDSFDSP";
                if (isset($d['id'])) {
                    $query .= "update resources set "
                        . (isset($d['name']) ? "name = '{$d['name']}' " : "")
                        . (isset($d['name']) && ((isset($d['photo']) || isset($d['url']) || isset($d['description']))) ? "," : "")
                        . (isset($d['url']) ? "url = '{$d['url']}' " : "")
                        . (isset($d['url']) && ((isset($d['photo']) || isset($d['description']))) ? "," : "")
                        . (isset($d['photo']) ? "photo = '{$d['photo']}' " : "")
                        . (isset($d['photo']) && (isset($d['description'])) ? "," : "")
                        . (isset($d['description']) ? "description='{$d['description']}' " : "")
                        . "where id = {$d['id']}";
                } else {
                    $query .= "insert into resources (type, "
                        . (isset($d['name']) ? " name " : "")
                        . (isset($d['name']) && ((isset($d['url']) || isset($d['photo']) || isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['url']) ? " url " : "")
                        . (isset($d['url']) && ((isset($d['photo']) || isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['photo']) ? " photo " : "")
                        . (isset($d['photo']) && ((isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['description']) ? " description " : "")
                        . (isset($d['description']) && (isset($d['city_id'])) ? "," : "")
                        . (isset($d['city_id']) ? " city_id " : "")
                        . ") values ({$type}, "
                        . (isset($d['name']) ? " '{$d['name']}' " : "")
                        . (isset($d['name']) && ((isset($d['url']) || isset($d['photo']) || isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['url']) ? "  '{$d['url']}'  " : "")
                        . (isset($d['url']) && ((isset($d['photo']) || isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['photo']) ? "  '{$d['photo']}'  " : "")
                        . (isset($d['photo']) && ((isset($d['description']) || isset($d['city_id']))) ? "," : "")
                        . (isset($d['description']) ? "  '{$d['description']}'  " : "")
                        . (isset($d['description']) && (isset($d['city_id'])) ? "," : "")
                        . (isset($d['city_id']) ? " {$d['city_id']} " : "")
                        . ")";
                }
                // return $query;
                // array_push($f, $query);
                array_push($f, ($this->helper::createCommand($query) ? true : false));
                $query = "";
                // if ($this->helper::createCommand($query)) {
                //     return true;
                // } else {
                //     return false;
                // }
            }
            return $f;
        }
    }

    public function deleteres($id)
    {
        $query = "delete from resources where id={$id}";
        return $this->helper::createCommand($query);
    }

    public function updateOrCreateCities($data)
    {
        $query = "";
        if (isset($data)) {
            $f = [];
            foreach ($data as $d) {
                if (isset($d['id'])) {
                    $query .= "update city set "
                        . (isset($d['name']) ? "name='{$d['name']}' " : "")
                        . "where id = {$d['id']}";
                } else {
                    $query .= "insert into city (res_count, "
                        . (isset($d['name']) ? " name " : "")
                        . (isset($d['project_id']) ? "," : "")
                        . (isset($d['project_id']) ? " project_id " : "")
                        . ") values (0, "
                        . (isset($d['name']) ? " '{$d['name']}' " : "")
                        . (isset($d['project_id']) ? "," : "")
                        . (isset($d['project_id']) ? " {$d['project_id']} " : "")
                        . ")";
                }
                // return $query;
                array_push($f, ($this->helper::createCommand($query) ? true : false));
                // array_push($f, $query);
                $query = "";
            }
            return $f;
        }
    }

    public function saveprojectchanges($projectname, $owner, $projectid)
    {
        $query = "update projects set " . (isset($projectname) ? "name = '{$projectname}' " : "") . (isset($projectname) && isset($owner) ? ", " : "") . (isset($owner) ? "user_id = {$owner} " : "") . "where id={$projectid}";
        return $this->helper::createCommand($query) ? true : false;
    }

    public function deletecity($city_id)
    {
        $query = "delete from city where id={$city_id}";
        return $this->helper::createCommand($query) ? true : false;
    }

    public function moveresource($res_id, $newregion){
        $query = "update resources set city_id={$newregion} where id={$res_id}";
        // return $query;
        return $this->helper::createCommand($query);
    }
}
