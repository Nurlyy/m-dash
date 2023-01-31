<?php

namespace app\models;

use yii\db\ActiveRecord;
use \Yii;
use yii\behaviors\BlameableBehavior;

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
}
