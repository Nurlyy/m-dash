<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "res_posts".
 *
 * @property int $id
 * @property int $type
 * @property int $res_id
 * @property string $item_id
 * @property string $url
 * @property string $text
 * @property string $date
 * @property string $s_date
 * @property string $attachments
 * @property int $sentiment
 */
class ResPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'res_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['type', 'res_id', 'item_id', 'url', 'text', 'date', 's_date', 'attachments', 'sentiment'], 'required'],
            [['type', 'res_id', 'sentiment'], 'integer'],
            [['url', 'text', 'attachments'], 'string'],
            [['date', 's_date'], 'safe'],
            [['item_id'], 'string', 'max' => 255],
            [['item_id'], 'unique'],
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
            'item_id' => 'Item ID',
            'url' => 'Url',
            'text' => 'Text',
            'date' => 'Date',
            's_date' => 'S Date',
            'attachments' => 'Attachments',
            'sentiment' => 'Sentiment',
        ];
    }

    /**
     * getPostsTypesCount() method for getting posts types count
     */
    public static function getPostsForResource($res_id, $start_date, $end_date){
        $posts = parent::find()->where("res_id={$res_id}")->andWhere(['between', 's_date', "{$start_date}", "{$end_date}" ])->asArray()->all();
        return $posts;
    }


    public static function getPostsWithItemId($item_ids, $start_date, $end_date){
        $posts = parent::find()->select(['item_id', 'text'])->where("item_id in (".implode(",", $item_ids).")")->andWhere(['between', 's_date', "{$start_date}", "{$end_date}" ])->asArray()->all();
        return $posts;
    }
}
