<?php

namespace app\models;

use yii\db\ActiveRecord;


class City extends ActiveRecord
{

    public static function tableName(){
        return '{{city}}';
    }

    public function rules(){
        return [
            [['name', 'project_id'], 'required'],
            [['name'], 'string'],
            [['project_id'], 'integer'],
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

    public static function getCitiesForProject($project_id){
        return parent::find()->select('id')->where(['project_id' => $project_id])->asArray()->all();
    }

}
