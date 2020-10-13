<?php

namespace backend\modules\paper\models;

use Yii;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $category_id
 * @property string $column_name
 * @property integer $image
 * @property integer $sort_order
 * @property string $email
 * @property string $facebook
 * @property string $twitter
 * @property string $pen_name
 * @property string $status_id
 * @property integer $created_by
 * @property string $created_at
 */
class TblProfile extends \yii\db\ActiveRecord
{

    public $username;
    public $password;    
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
            [['name', 'email', 'facebook', 'twitter','category_id'], 'required'],
            [['created_by','category_id','sort_order'], 'integer'],
            [['created_at','category_id'], 'safe'],
            [['name','username'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 255],
            
            [['email','column_name'], 'string', 'max' => 50],
            [['facebook', 'twitter', 'pen_name'], 'string', 'max' => 100],
            [['status_id'], 'string', 'max' => 1],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

  public function fields()
    {
        return [
            // field name is the same as the attribute name
            'id',
            // field name is "email", the corresponding attribute name is "email_address"
            'name',
            // field name is "name", its value is defined by a PHP callback
            'pen_name',
            'category_id',
            'image',
            'email',
            'sort_order',
            'facebook',
            'twitter',

        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            if(!empty($this->image)){
                $this->image->saveAs('uploads/profile/' . $this->image->baseName . '.' . $this->image->extension);
                return 'uploads/profile/' . $this->image->baseName . '.' . $this->image->extension;
            }else{
              return 'no_image';
          }
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
            'name' => 'Name',
            'column_name' => 'Column Name',
            'image' => 'Image',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'pen_name' => 'Pen Name',
            'status_id' => 'Status ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'category_id' => 'Category ID',
        ];
    }

     public function getCategoryx()
    {
        return $this->hasOne(\yeesoft\post\models\Category::className(), ['id' => 'category_id']);
    }

     public function getPost()
    {

        return $this->hasMany(\yeesoft\post\models\Post::className(), ['profile_id' => 'id']);

        //return $this->hasOne(\yeesoft\post\models\Category::className(), ['id' => 'category_id']);
    }        
}
