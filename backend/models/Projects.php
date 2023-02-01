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
 * @property integer $user_id
 * @property string $created_date
 * @property integer $is_active
 */

class Projects extends ActiveRecord
{ 
    public function rules(){
        return [
            [['name', 'user_id', 'created_date'], 'required'],
            [['name'], 'string', 'max'=>150],
            [['user_id'], 'integer'],
            ['user_id', 'checkUser'],
            [['is_active'], 'integer', 'max'=>1],
            [['created_date'], 'date', 'format'=>'Y-m-d']
        ];
    }

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

    public function checkUser($attribute, $params){
        $user = User::findOne(['id' => $this->user_id]);
        if(!$user === null && !$this->getProjectForUser($this->user_id)===null){
            $this->addError($attribute, "User does not exist or already has a project");
        }
    }
}
