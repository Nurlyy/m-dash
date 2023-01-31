<?php

namespace app\models;

use yii\db\ActiveRecord;
use \Yii;
use common\models\User;
use yii\db\Query;

/**
 * Projects model
 * 
 * @property integer $id
 * @property string $name
 * @property string $user_id
 * @property string $created_date
 * @property integer $is_active
 */

class Projects extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%projects}}';
    }

    public static function getProjectForUser($user_id){
        return parent::findOne(['user_id' => $user_id]);
    }
    
    public static function getUsersInformation(){
        $query = new Query();
        $query->from(['u' => 'user'])
            ->select(["u.id", "u.username", "u.email", "u.status", "u.created_at", "p.name", "p.id as pid"])
            ->where('`u`.`status` != 3')
            ->leftJoin(['p' => 'projects'], '`u`.`id` = `p`.`user_id`')
            ->all();
        return $query->createCommand()->queryAll();;
    }
}
