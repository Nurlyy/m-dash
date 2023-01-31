<?php

namespace app\models;

use yii\db\ActiveRecord;

class Resources extends ActiveRecord
{
    public static function tableName(){
        return '{{resources}}';
    }

    public function rules(){
        return [
            [['type', 'city_id', 'name', 'url', 'owner_id'], 'required'],
            [['type', 'city_id', 'owner_id'], 'integer'],
            [['name', 'url', 'description', 'photo'], 'string'],
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

}
