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

    public function get_candidates_data($id = null)
    {
        $query = "SELECT * from candidate";
        if (!empty($id[0])) {
            if(!empty($id[1])){
                $query .= " WHERE id in (".implode(', ', $id).")";
            }else {
                $query .= " WHERE id = {$id[0]}";
            }
        }
        // return $query;
        return $this->helper::createCommand($query);
    }

    public function get_candidate_posts($candidate_id, $start_date, $end_date)
    {
        if (isset($candidate_id)) {
            $query = "SELECT * from candidate_posts where candidate_id = {$candidate_id} and date between '{$start_date}' and '{$end_date}'";
            return $this->helper::createCommand($query);
            // return $query;
        }
    }

    public function get_all_data($candidate_id, $start_date, $end_date, $type, $first=null, $second=null, $discussionChart=null, $sentimentChart=null, $subsChart=null, $likesChart=null, $commentsChart=null, $repostsChart = null)
    {
        $query = "select u.id, p.date,";

        switch ($type) {
            case 1:
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
            case 2:
                $query .= " if(s.date=p.date and p.candidate_id=s.candidate_id, s.fb, 0) as fb_sub,"
                . " if(s.date=p.date and s.candidate_id=u.id, s.ig, 0) as ig_sub,"
                . " count(case when p.type = 1 then 1 end) as fb_posts,"
                . " count(case when p.type=2 then 1 end) as ig_posts,"
                . " count(case when p.type=3 then 1 end) as tg_posts,"
                . " count(case when p.type=4 then 1 end) as web_posts,"
                . " sum(case when p.type=1 then p.comments end) as fb_comments,"
                . " sum(case when p.type=2 then p.comments end) as ig_comments, "
                . " sum(case when p.type=1 then p.reposts end) as fb_reposts,"
                . " sum(case when p.type=2 then p.reposts end) as ig_reposts,"
                . " sum(case when p.type=3 then p.reposts end) as tg_reposts, "
                . " sum(case when p.type=1 then p.likes end) as fb_likes,"
                . " sum(case when p.type=2 then p.likes end) as ig_likes, "
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
            case 3:
                $query .= ($subsChart==true ?" if(s.date=p.date and p.candidate_id=s.candidate_id, s.fb, 0) as fb_sub, if(s.date=p.date and s.candidate_id=u.id, s.ig, 0) as ig_sub,":0)
                . ($discussionChart==true ?" count(case when p.type = 1 then 1 end) as fb_posts, count(case when p.type=2 then 1 end) as ig_posts, count(case when p.type=3 then 1 end) as tg_posts, count(case when p.type=4 then 1 end) as web_posts,":"")
                . ($commentsChart==true ?" sum(case when p.type=1 then p.comments end) as fb_comments, sum(case when p.type=2 then p.comments end) as ig_comments, ":"")
                . ($repostsChart==true ?" sum(case when p.type=1 then p.reposts end) as fb_reposts, sum(case when p.type=2 then p.reposts end) as ig_reposts, sum(case when p.type=3 then p.reposts end) as tg_reposts, ":"")
                . ($likesChart==true ?" sum(case when p.type=1 then p.likes end) as fb_likes, sum(case when p.type=2 then p.likes end) as ig_likes, ":"")
                . ($sentimentChart==true ?" count(case when p.sentiment=1 and p.type = 1 then 1 end) as fb_positive, count(case when p.sentiment=2 and p.type = 1 then 1 end) as fb_neutral, count(case when p.sentiment=3 and p.type = 1 then 1 end) as fb_negative, count(case when p.sentiment=1 and p.type = 2 then 1 end) as ig_positive, count(case when p.sentiment=2 and p.type = 2 then 1 end) as ig_neutral, count(case when p.sentiment=3 and p.type = 2 then 1 end) as ig_negative, count(case when p.sentiment=1 and p.type = 3 then 1 end) as tg_positive, count(case when p.sentiment=2 and p.type = 3 then 1 end) as tg_neutral, count(case when p.sentiment=3 and p.type = 3 then 1 end) as tg_negative, count(case when p.sentiment=1 and p.type = 4 then 1 end) as web_positive, count(case when p.sentiment=2 and p.type = 4 then 1 end) as web_neutral, count(case when p.sentiment=3 and p.type = 4 then 1 end) as web_negative ":"");
                break;
            case 4:
                $query .= " count(case when p.type=4 then 1 end) as web_posts,"
                    . " sum(case when p.type=4 then p.views end) as web_views ";
                break;

            case 0:
                $query .= " if(s.date=p.date and p.candidate_id=s.candidate_id, s.fb, 0) as fb_sub,"
                    . " if(s.date=p.date and s.candidate_id=u.id, s.ig, 0) as ig_sub,"
                    . " if(s.date=p.date and s.candidate_id=u.id, s.tg, 0) as tg_sub,"
                    . " count(case when p.type = 1 then 1 end) as fb_posts,"
                    . " count(case when p.type=2 then 1 end) as ig_posts,"
                    . " count(case when p.type=3 then 1 end) as tg_posts,"
                    . " count(case when p.type=4 then 1 end) as web_posts,"
                    // . " sum(case when p.type=1 then p.views end) as fb_views,"
                    // . " sum(case when p.type=2 then p.views end) as ig_views,"
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
            case 6:
                $query .= " if(s.date=p.date and p.candidate_id=s.candidate_id, s.fb, 0) as fb_sub,"
                    . " if(s.date=p.date and s.candidate_id=u.id, s.ig, 0) as ig_sub,"
                    . " if(s.date=p.date and s.candidate_id=u.id, s.tg, 0) as tg_sub,"
                    . " count(case when p.type = 1 then 1 end) as fb_posts,"
                    . " count(case when p.type=2 then 1 end) as ig_posts,"
                    . " count(case when p.type=3 then 1 end) as tg_posts,"
                    . " count(case when p.type=4 then 1 end) as web_posts,"
                    . " sum(case when p.type=1 then p.comments end) as fb_comments,"
                    . " sum(case when p.type=2 then p.comments end) as ig_comments, "
                    . " sum(case when p.type=1 then p.reposts end) as fb_reposts,"
                    . " sum(case when p.type=2 then p.reposts end) as ig_reposts,"
                    . " sum(case when p.type=3 then p.reposts end) as tg_reposts, "
                    . " sum(case when p.type=1 then p.likes end) as fb_likes,"
                    . " sum(case when p.type=2 then p.likes end) as ig_likes, "
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
        $query .= " from candidate u "
            . " inner join post p on p.candidate_id=u.id"
            . " inner join subscriber s on p.date=s.date and u.id=s.candidate_id"
            . " where"
            . (isset($candidate_id) ? " u.id={$candidate_id} and" : "")
            . ((isset($first)&&isset($second)) ? " u.id IN ({$first}, {$second}) and" :"")
            . " p.date between '{$start_date}' and '{$end_date}'"
            . " group by p.date, u.id";
        // return $query;

        return $this->helper::createCommand($query);
    }
}
