<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_modules".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $module_order
 * @property integer $created_by
 * @property string $datetime
 * @property integer $status
 *
 * @property TblCoreModuleFeatures[] $tblCoreModuleFeatures
 */
class TblCoreModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['name'], 'required'],
            [['module_order', 'created_by', 'status'], 'integer'],
            [['datetime'], 'safe'],
            [['name'], 'string', 'max' => 255]
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
            'module_order' => 'Module Order',
            'created_by' => 'Created By',
            'datetime' => 'Datetime',
            'status' => 'Status',
        ];
    }



	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$this->created_by = Yii::$app->user->getId();
			// Place your custom code here
	
			return true;
		} else {
			return false;
		}
	}
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCoreModuleFeatures()
    {
        return $this->hasMany(TblCoreModuleFeatures::className(), ['module_id' => 'id']);
    }
	
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }	
}
