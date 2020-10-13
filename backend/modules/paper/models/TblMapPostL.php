<?php

namespace backend\modules\paper\models;

use Yii;

/**
 * This is the model class for table "tbl_map_post".
 *
 * @property integer $id
 * @property integer $page_detail_id
 * @property integer $map_id
 * @property integer $post_id
 */
class TblMapPostL extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_map_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_detail_id', 'map_id', 'post_id'], 'required'],
            [['page_detail_id', 'map_id', 'post_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_detail_id' => 'Page Detail ID',
            'map_id' => 'Map ID',
            'post_id' => 'Post ID',
        ];
    }

     public function getPaperdetail()
    {
        return $this->hasOne(TblPapEpaperDtl::className(), ['id' => 'page_detail_id']);
    }

}
