<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $facebook
 * @property string $twitter
 * @property string $pen_name
 * @property string $status_id
 * @property integer $created_by
 */
class TblProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'facebook', 'twitter', 'pen_name'], 'required'],
            [['created_by'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['facebook', 'twitter', 'pen_name'], 'string', 'max' => 100],
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
            'email' => 'Email',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'pen_name' => 'Pen Name',
            'status_id' => 'Status ID',
            'created_by' => 'Created By',
        ];
    }
}
