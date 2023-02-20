<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * 
 * @property integer type
 * @property integer city_id
 * @property integer owner_id
 * @property string name
 * @property string url
 * @property string description
 * @property string photo
 * @property int status
 */

class Resources extends ActiveRecord
{
    public static function tableName(){
        return '{{%resources}}';
    }

    public function rules(){
        return [
            [['city_id', 'name', 'url'], 'required'],
            [['type', 'city_id', 'owner_id', 'status'], 'integer'],
            [['name', 'url', 'description', 'photo'], 'string'],
        ];
    }

}
