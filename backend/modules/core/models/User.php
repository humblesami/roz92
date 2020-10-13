<?php

namespace backend\modules\core\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property integer $updated_at
 * @property integer $imagefile
 * @property integer $station_id
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     //public $imagefile;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */

   
    public function rules()
    {
        return [
            [['username', 'password_hash','full_name', 'email', 'role_id','login_type'], 'required'],
            [['status', 'created_at', 'role_id','station_id'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
           
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imagefile->saveAs('uploads/user/' . $this->imagefile->baseName . '.' . $this->imagefile->extension);
            return 'uploads/user/' . $this->imagefile->baseName . '.' . $this->imagefile->extension;
        } else {
            return false;
        }
    }    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User ID',
			'login_type' => 'Authentication',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
			'role_id' => 'Role',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'station_id' => 'Station',
             'imagefile' => 'Picture',
             
             
            'created_at' => 'Created At',
           
        ];
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(TblCoreRoles::className(), ['id' => 'role_id']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(\backend\modules\paper\models\TblPapStation::className(), ['id' => 'station_id']);
    }	


	public function beforeSave($insert) {
		if(isset($this->password_hash)) 
		//echo $this->password_hash;

			$this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
		return parent::beforeSave($insert);
	}		
}

