<?php

namespace common\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord{
    public $name;
    public $created_date;
    public $owner_id;
    public $is_active;

    public static function tableName()
    {
        return '{{%project}}';
    }

    public function rules(){
        return [
            [['name, user_id, created_date'], 'required'],
            [['name', 'created_date'], 'string', 'max'=> 255], 
            [['owner_id'], 'integer'],
            [['is_active'], 'tinyint'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название проекта',
            'user_id' => 'Выберите владельца',
        ];
    }

    public function getProject($id){

    }

    public function createProject($runValidation=true, $attributeNames = null){
        $transaction = new \Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);
        $transaction->commit();
        return $ok;
    }
}