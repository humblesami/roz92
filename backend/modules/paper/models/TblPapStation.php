<?php

namespace backend\modules\paper\models;

use Yii;

/**
 * This is the model class for table "tbl_pap_station".
 *
 * @property integer $id
 * @property string $name
 * @property string $urdu_name
 * @property integer $city_id
 * @property string $short_code
 * @property string $start_date
 * @property string $created_at
 * @property integer $created_by
 * @property string $status_id
 */
class TblPapStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pap_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'urdu_name','city_id', 'short_code', 'start_date'], 'required'],
            [['city_id', 'created_by'], 'integer'],
            [['start_date', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['short_code'], 'string', 'max' => 3],
            [['status_id'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'urdu_name' => 'Urdu Name',
            'city_id' => 'City ID',
            'short_code' => 'Short Code',
            'start_date' => 'Start Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'status_id' => 'Status ID',
        ];
    }

    public function beforeSave($insert)
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->created_by = 1;
        $this->status_id = 1;
        $this->start_date = date('Y-m-d',strtotime($this->start_date));
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


    public function getPaper()
    {
        return $this->hasMany(TblPapEpaperMst::className(), ['station_id' => 'id']);
    }
}
