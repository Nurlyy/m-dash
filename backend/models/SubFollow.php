<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_follow".
 *
 * @property int $id
 * @property int $type
 * @property int $res_id
 * @property string $sf_type
 * @property int $count
 * @property string $date
 */
class SubFollow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_follow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['type', 'res_id', 'sf_type', 'count', 'date'], 'required'],
            [['type', 'res_id', 'count'], 'integer'],
            [['date'], 'safe'],
            [['sf_type'], 'string', 'max' => 255],
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
            'sf_type' => 'Sf Type',
            'count' => 'Count',
            'date' => 'Date',
        ];
    }


    public static function getSubsForResource($res_id, $start_date, $end_date){
        $subs = parent::find()->select(['res_id', 'count', 'date'])->where("res_id={$res_id}")->andWhere(['between', 'date', "{$start_date}", "{$end_date}" ])->groupBy('date')->asArray()->all();
        return $subs;
    }
}
