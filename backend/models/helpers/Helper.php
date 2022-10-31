<?php 

namespace backend\models\helpers;

use Yii;

class Helper{

    public static function add_date($start_date, $end_date) {
        if(isset($start_date) & isset($end_date)){
            return " AND date between '{$start_date}' AND '{$end_date}' ";
        }else{
            return " ";
        }
    }

    
    public static function createCommand($query){
        return Yii::$app->db->createCommand($query)->queryAll();
    }


    public static function add_type($type) {
        if(isset($type)){
            return " AND type = " . $type;
        }
    }



}