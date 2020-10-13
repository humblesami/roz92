<?php

namespace common\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $role
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $access_token
 */
class TblAccount extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    const ROLE_ADMIN = '1';
    const ROLE_CUSTOMER = '2';
    const ROLE_ROOT =  '3';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status'], 'integer'],
           
            [['username', 'email', 'auth_key', 'access_token'], 'string', 'max' => 250],
            [['password', 'password_hash', 'password_reset_token'], 'string', 'max' => 300],
            [['role'], 'string', 'max' => 50],
            ['username', 'unique', 'targetAttribute' => ['username', 'email']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
          
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!self::isPasswordResetTokenValid($token)) {
            return null;
        }
        return self::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = 7200;
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function beforeSave($insert)
    {
        if( $insert ) {
            $this->password = 'asdf@12345';
            $this->email = $this->username;
            $this->generateAuthKey();
            $this->setPassword($this->password);
           
            $this->status = self::STATUS_ACTIVE;
            $this->password = md5($this->password);
        }
       
        return parent::beforeSave($insert);
    }

    public static function findAccount($username, $email)
    {
        return self::find()
            ->where(['email' => $email])
            ->orWhere(['username' => $username])
            ->one();
    }

    // filter out and blacklist some sensitive fields.
    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token'], $fields['password']);

        return $fields;
    }

    public function resetPassword()
    {
        $this->generateAuthKey();
        $this->setPassword($this->password);
        $this->password = md5($this->password);
        return $this->save();
    }

    public function isRoot()
    {
        return $this->username === 'root';
    }


}
