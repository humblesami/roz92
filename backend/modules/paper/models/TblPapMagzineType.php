<?php

namespace backend\modules\paper\models;

use Yii;

/**
 * This is the model class for table "tbl_pap_magzine_type".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $created_by
 * @property string $created_at
 * @property string $status_id
 */
class TblPapMagzineType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pap_magzine_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_by'], 'required'],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['status_id'], 'string', 'max' => 1],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if(!empty($this->image)){
                $this->image->saveAs('uploads/type/' . $this->image->baseName . '.' . $this->image->extension);
                return 'uploads/type/' . $this->image->baseName . '.' . $this->image->extension;
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
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'status_id' => 'Status ID',
             'image' => 'Image',
        ];
    }
}
