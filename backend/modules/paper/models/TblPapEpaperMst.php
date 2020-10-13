<?php

namespace backend\modules\paper\models;
use backend\modules\core\models\User;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "tbl_pap_epaper_mst".
 *
 * @property integer $id
 * @property integer $paper_name
 * @property string $issue_date
 * @property integer $station_id
 * @property integer $page_template_id
 * @property string $created_by
 * @property integer $created_at
 * @property string $status_id
 * @property string $type
 */
class TblPapEpaperMst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFiles;
    public static function tableName()
    {
        return 'tbl_pap_epaper_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_date',  'page_template_id'], 'required'],
            [['issue_date', 'created_at','paper_name'], 'safe'],
            [['station_id', 'page_template_id', 'created_by'], 'integer'],
            [['status_id','type'], 'string', 'max' => 1],
           [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }

    public function create_folder($folder_name){

        
       
         if (!is_dir($folder_name)) {
            mkdir($folder_name,0775);
        }
          
    }

     public function upload()
        {
            if ($this->validate()) { 
                $issue_date = date('dmY',strtotime($this->issue_date));

                $this->create_folder('uploads/epaper/' . $this->station_id);

                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y'));


                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m'));

                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m') . "/" . $issue_date);




                $path =  'uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m') . "/" . $issue_date  . "/";
                $aa = 0; 
                foreach ($this->imageFiles as $file) {
                    
                    $file->saveAs(  $path .  $file->baseName . '.' . $file->extension);
                   


                    $eDetail = TblPapEpaperDtl::find()->where(['page_id' => $aa,'epaper_id' => $this->id])->one();
                   
                    
                    if(!$eDetail){
                        $eDetail = new TblPapEpaperDtl;
                    }
                    $eDetail->epaper_id = $this->id;
                    $eDetail->sort_order = $aa;
                    $eDetail->page_id = $aa;
                    $eDetail->image = $file->baseName . '.' . $file->extension;
                    $eDetail->path = $path  . $file->baseName . '.' . $file->extension;
                    $eDetail->save(false);

                    
                     $aa = $aa + 1;

                }
                return true;
            } else {
                return false;
            }
        }



     public function upload_single()
        {
            if ($this->validate()) { 
                $issue_date = date('dmY',strtotime($this->issue_date));

                $this->create_folder('uploads/epaper/' . $this->station_id);

                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y'));


                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m'));

                $this->create_folder('uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m') . "/" . $issue_date);




                $path =  'uploads/epaper/' . $this->station_id . "/" . date('Y') . '/' . date('m') . "/" . $issue_date  . "/";
                $aa = 0; 
                foreach ($this->imageFiles as $file) {
                    $file->saveAs(  $path .  $file->baseName . '.' . $file->extension);
                    $aa = $aa + 1;

                    return $path .  $file->baseName . '.' . $file->extension;
                    
                   
                    
                   

                }
                return true;
            } else {
                return "no_upload";
            }
        }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paper_name' => 'Paper Name',
            'issue_date' => 'Issue Date',
            'station_id' => 'Station',
            'page_template_id' => 'Page Template ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'status_id' => 'Status ID',
            'type' => 'type',
        ];
    }


    public function getPt()
    {
        return $this->hasOne(TblPapPageTemplate::className(), ['id' => 'page_template_id']);
    }


     public function getStation()
    {
        return $this->hasOne(TblPapStation::className(), ['id' => 'station_id']);
    }   


     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }       
    public function beforeSave($insert)
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->created_by = 1;
        $this->status_id = 1;
        $this->issue_date = date('Y-m-d',strtotime($this->issue_date));
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
