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


    public function get_organizations_for_user($user_id)
    {
        $query = "SELECT organization_id from users_organization where user_id = " . $user_id;
        return $this->helper::createCommand($query);
    }

    // //TODO: maybe it won't be needed anymore
    // public function get_organizations($ids){
    //     $query = "SELECT * from organization where id in ("
    //         .implode(", ", $ids) . 
    //         ")";
    //     return $this->helper::createCommand($query);
    // }


    // public function get_total_sentiments($organization_id, $start_date, $end_date, $type){
    //     $query = "SELECT COUNT(sentiment) as count, sentiment FROM post WHERE organization_id = "
    //             . $organization_id 
    //             . $this->helper::add_date($start_date, $end_date)
    //             . $this->helper::add_type($type)
    //             ." GROUP BY sentiment";    
    //     return $this->helper::createCommand($query);
    // }


    // public function get_total_posts_data($organization_id, $start_date, $end_date, $type){
    //     $query = "SELECT COUNT(id) as posts, SUM(views) as views, SUM(likes) as likes, SUM(reposts) as reposts, SUM(comments) as comments, type from post where organization_id = "
    //             . $organization_id
    //             . $this->helper::add_date($start_date, $end_date)
    //             . $this->helper::add_type($type)
    //             . ' GROUP BY type';
    //     return $this->helper::createCommand($query);
    // }


    // public function get_date_posts_data($organization_id, $start_date, $end_date, $type){
    //     $query = "SELECT COUNT(id) AS posts, SUM(likes) as likes, SUM(reposts) as reposts, SUM(views) as views, SUM(comments) as comments, date FROM post WHERE organization_id = "
    //             . $organization_id
    //             . $this->helper::add_date($start_date, $end_date)
    //             . $this->helper::add_type($type)
    //             . " GROUP BY date";
    //     return $this->helper::createCommand($query);
    // }


    // public function get_total_subscribers_data($id, $start_date, $end_date, $type){
    //     if(isset($type)){
    //         if($type == "1") $type = "fb";
    //         if($type == "2") $type = "ig";
    //         if($type == "3") $type = "tg";
    //         $query = "SELECT SUM({$type}) as {$type} FROM subscriber WHERE organization_id = "
    //             . $id
    //             . $this->helper::add_date($start_date, $end_date);
    //     } else {
    //         $query = "SELECT SUM(fb) as fb, SUM(ig) as ig, SUM(tg) as tg FROM subscriber WHERE organization_id = "
    //             . $id
    //             . $this->helper::add_date($start_date, $end_date);
    //     }
    //     // return $query;
    //     return $this->helper::createCommand($query);
    // }


    // public function get_dates($start_date, $end_date){
    //     $query = "SELECT date from post where date between '{$start_date}' and '{$end_date}' group by date";
    //     // return $query;
    //     return $this->helper::createCommand($query);
    // }


    // public function get_date_subscribers_data($id, $start_date, $end_date, $type){
    //     if(isset($type)){
    //         if($type == "1") $type = "fb";
    //         if($type == "2") $type = "ig";
    //         if($type == "3") $type = "tg";
    //         $query = "SELECT date, SUM({$type}) as {$type} FROM subscriber WHERE organization_id = "
    //             . $id
    //             . $this->helper::add_date($start_date, $end_date)
    //             . " GROUP BY date";
    //     } else {
    //         $query = "SELECT date, SUM(fb) as fb, SUM(ig) as ig, SUM(tg) as tg FROM subscriber WHERE organization_id = "
    //             . $id
    //             . $this->helper::add_date($start_date, $end_date)
    //             . " GROUP BY date";
    //     }

    //     return $this->helper::createCommand($query);
    // }


    public function get_organization_data($id)
    {
        $query = "SELECT id, name, region FROM organization WHERE id = {$id}";
        return $this->helper::createCommand($query);
    }


    public function get_all_data($user_id, $start_date, $end_date, $type)
    {
        $query = "select p.date, if(u.user_id={$user_id}, u.organization_id, null) as organization_id,";

        switch ($type) {

            case 1:
                $query .= " if(s.date=p.date and p.organization_id=s.organization_id, s.fb, 0) as fb_sub,"
                    . " count(case when p.type = 1 then 1 end) as fb_posts,"
                    . " sum(case when p.type=1 then p.views end) as fb_views,"
                    . " sum(case when p.type=1 then p.comments end) as fb_comments,"
                    . " sum(case when p.type=1 then p.reposts end) as fb_reposts,"
                    . " sum(case when p.type=1 then p.likes end) as fb_likes ";
                break;
            case 2:
                $query .= " if(s.date=p.date and s.organization_id=u.organization_id, s.ig, 0) as ig_sub,"
                    . " count(case when p.type=2 then 1 end) as ig_posts,"
                    . " sum(case when p.type=2 then p.views end) as ig_views,"
                    . " sum(case when p.type=2 then p.comments end) as ig_comments,"
                    . " sum(case when p.type=2 then p.reposts end) as ig_reposts,"
                    . " sum(case when p.type=2 then p.likes end) as ig_likes ";
                break;
            case 3:
                $query .= " if(s.date=p.date and s.organization_id=u.organization_id, s.tg, 0) as tg_sub,"
                    . " count(case when p.type=3 then 1 end) as tg_posts,"
                    . " sum(case when p.type=3 then p.reposts end) as tg_reposts ";
                break;
            case 4:
                $query .= " count(case when p.type=4 then 1 end) as web_posts,"
                    . " sum(case when p.type=4 then p.views end) as web_views ";
                break;

            case 0:
                $query .= " if(s.date=p.date and p.organization_id=s.organization_id, s.fb, 0) as fb_sub,"
                    . " if(s.date=p.date and s.organization_id=u.organization_id, s.ig, 0) as ig_sub,"
                    . " if(s.date=p.date and s.organization_id=u.organization_id, s.tg, 0) as tg_sub,"
                    . " count(case when p.type = 1 then 1 end) as fb_posts,"
                    . " count(case when p.type=2 then 1 end) as ig_posts,"
                    . " count(case when p.type=3 then 1 end) as tg_posts,"
                    . " count(case when p.type=4 then 1 end) as web_posts,"
                    . " sum(case when p.type=1 then p.views end) as fb_views,"
                    . " sum(case when p.type=2 then p.views end) as ig_views,"
                    . " sum(case when p.type=4 then p.views end) as web_views,"
                    . " sum(case when p.type=1 then p.comments end) as fb_comments,"
                    . " sum(case when p.type=2 then p.comments end) as ig_comments, "
                    . " sum(case when p.type=1 then p.reposts end) as fb_reposts,"
                    . " sum(case when p.type=2 then p.reposts end) as ig_reposts,"
                    . " sum(case when p.type=3 then p.reposts end) as tg_reposts, "
                    . " sum(case when p.type=1 then p.likes end) as fb_likes,"
                    . " sum(case when p.type=2 then p.likes end) as ig_likes ";
                    break;
            case 5:
                $query .= " count(case when p.type = 1 then 1 end) as fb_posts,"
                    . " count(case when p.type=2 then 1 end) as ig_posts,"
                    . " count(case when p.type=3 then 1 end) as tg_posts,"
                    . " count(case when p.type=4 then 1 end) as web_posts,"
                    . " count(case when p.sentiment=1 and p.type = 1 then 1 end) as fb_positive,"
                    . " count(case when p.sentiment=2 and p.type = 1 then 1 end) as fb_neutral,"
                    . " count(case when p.sentiment=3 and p.type = 1 then 1 end) as fb_negative,"
                    . " count(case when p.sentiment=1 and p.type = 2 then 1 end) as ig_positive,"
                    . " count(case when p.sentiment=2 and p.type = 2 then 1 end) as ig_neutral,"
                    . " count(case when p.sentiment=3 and p.type = 2 then 1 end) as ig_negative,"
                    . " count(case when p.sentiment=1 and p.type = 3 then 1 end) as tg_positive,"
                    . " count(case when p.sentiment=2 and p.type = 3 then 1 end) as tg_neutral,"
                    . " count(case when p.sentiment=3 and p.type = 3 then 1 end) as tg_negative,"
                    . " count(case when p.sentiment=1 and p.type = 4 then 1 end) as web_positive,"
                    . " count(case when p.sentiment=2 and p.type = 4 then 1 end) as web_neutral,"
                    . " count(case when p.sentiment=3 and p.type = 4 then 1 end) as web_negative ";
                    break;
        }
        $query .= " from users_organization u "
            . " inner join post p on p.organization_id=if(u.user_id={$user_id}, u.organization_id, null)"
            . " inner join subscriber s on p.date=s.date and if(u.user_id={$user_id}, u.organization_id, null)=s.organization_id"
            . " where p.date between '{$start_date}' and '{$end_date}'"
            . " group by p.date, u.organization_id";
        // return $query;

        return $this->helper::createCommand($query);
    }
}
