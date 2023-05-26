<?php
namespace common\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Auth extends ActiveRecord {
    public $id;
    public $user_id;
    public $source;
    public $source_id;

    public static function tableName()
    {
        return '{{%project}}';
    }

    public function rules(){
        return [
            [['user_id', 'id'], 'integer'],
            [['source', 'source_id'], 'string'],
            [['user_id'], 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
        ];
    }
}