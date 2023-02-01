<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * 
 * @property integer project_id
 * @property string name
 */

class City extends ActiveRecord
{

    public static function tableName(){
        return '{{%city}}';
    }

    public function rules(){
        return [
            [['name', 'project_id'], 'required'],
            [['name'], 'string'],
            [['project_id', 'res_count'], 'integer'],
            [['res_count'], 'default', 'value' => 0]
        ];
    }

    public static function getCitiesForProject($project_id){
        return parent::find()->select('id')->where(['project_id' => $project_id])->asArray()->all();
    }

}
