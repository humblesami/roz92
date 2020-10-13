<?php

namespace backend\modules\paper\models;

use Yii;

/**
 * This is the model class for table "tbl_pap_epaper_dtl".
 *
 * @property integer $id
 * @property integer $epaper_id
 * @property integer $page_id
 * @property integer $sort_order
 * @property string $image
 * @property string $map_data
 */
class TblPapEmagzineDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pap_emagzine_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emagzine_id', 'page_id', 'image'], 'required'],
            [['emagzine_id', 'page_id', 'sort_order'], 'integer'],
            [['map_data'],'safe'],
            [['image'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emagzine_id' => 'Emagzine ID',
            'page_id' => 'Page ID',
            'sort_order' => 'Sort Order',
            'image' => 'Image',
        ];
    }

     public function getMst()
    {
        return $this->hasOne(TblPapEmagzineMst::className(), ['id' => 'emagzine_id']);
    }  

}
