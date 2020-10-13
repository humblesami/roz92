<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_dashboards".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $url
 * @property string $dashboard_data
 * @property integer $created_by
 * @property string $datetime
 * @property integer $status_id
 */
class TblCoreDashboards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_dashboards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'dashboard_data'], 'string'],
            [['dashboard_data'], 'required'],
            [['created_by', 'status_id'], 'integer'],
            [['datetime'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 100]
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
            'desc' => 'Desc',
            'url' => 'Url',
            'dashboard_data' => 'Dashboard Data',
            'created_by' => 'Created By',
            'datetime' => 'Datetime',
            'status_id' => 'Status ID',
        ];
    }
}
