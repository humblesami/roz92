<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_region_state".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_code
 * @property integer $country_id
 * @property string $datetime
 * @property integer $created_by
 * @property string $status_id
 */
class TblCoreRegionState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_region_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_by'], 'required'],
            [['country_id', 'created_by'], 'integer'],
            [['datetime'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['short_code'], 'string', 'max' => 50],
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
            'short_code' => 'Short Code',
            'country_id' => 'Country ID',
            'datetime' => 'Datetime',
            'created_by' => 'Created By',
            'status_id' => 'Status ID',
        ];
    }
}
