<?php

namespace app\models;

use yii\db\ActiveRecord;
use \Yii;
use yii\behaviors\BlameableBehavior;

class Projects extends ActiveRecord
{

    // public $id;
    // public $name;
    // public $user_id;
    // public $created_date;
    // public $is_active;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date'],
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return '{{projects}}';
    }

    public function rules()
    {
        return [
            [['name', 'user_id', 'created_date'], 'required'],
            [['name'], 'string'],
            [['user_id', 'is_active'], 'integer'],
            [['is_active'], 'default', 'value' => 0],
            // [['created_date'], 'integer'],
            [['created_date'], 'date', 'format' => 'Y-m-d'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->getIsNewRecord()) {
            return $this->insert($runValidation, $attributeNames);
        } else {
            return $this->update($runValidation, $attributeNames) !== false;
        }
    }

    public static function getProjectForUser($user_id){
        return parent::findOne(['user_id' => $user_id]);
    }
}
