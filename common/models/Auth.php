<?php

namespace common\models;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Auth model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $source
 * @property string $source_id
 * 
 */

class Auth extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'id'], 'integer'],
            [['source', 'source_id'], 'string'],
            [['user_id'], 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => "id",
            'user_id' => "user_id",
            'source' => "source",
            'source_id' => "source_id",
        ];
    }

    public function user(){
        if($this->hasOne(User::class, ['id' => 'user_id'])){
            return User::find()->where(['id' => $this->user_id])->one();
        }
    }
}
