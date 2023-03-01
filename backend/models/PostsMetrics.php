<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "posts_metrics".
 *
 * @property int $id
 * @property int $type
 * @property int $res_id
 * @property string $url
 * @property string $item_id
 * @property string $date
 * @property string $s_date
 * @property int $likes
 * @property int $comments
 * @property int $reposts
 */
class PostsMetrics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts_metrics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['type', 'res_id', 'url', 'item_id', 'date', 's_date', 'likes', 'comments', 'reposts'], 'required'],
            [['type', 'res_id', 'likes', 'comments', 'reposts'], 'integer'],
            [['url'], 'string'],
            [['date', 's_date'], 'safe'],
            [['item_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'res_id' => 'Res ID',
            'url' => 'Url',
            'item_id' => 'Item ID',
            'date' => 'Date',
            's_date' => 'S Date',
            'likes' => 'Likes',
            'comments' => 'Comments',
            'reposts' => 'Reposts',
        ];
    }
}
