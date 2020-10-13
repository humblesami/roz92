<?php

namespace efrontend\models;

use Yii;

/**
 * This is the model class for table "tbl_ajj_column".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $profile_image
 * @property integer $category_id
 * @property integer $map_id
 * @property string $image_url
 * @property string $cat_url
 * @property string $title
 * @property string $profile_name
 * @property string $slug
 * @property integer $publish_date
 */
class TblAjjColumn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ajj_column';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'profile_image', 'category_id', 'map_id', 'image_url', 'cat_url', 'title', 'profile_name', 'slug', 'publish_date'], 'required'],
            [['post_id', 'category_id', 'map_id', 'publish_date'], 'integer'],
            [['profile_image', 'image_url', 'cat_url', 'title', 'slug'], 'string', 'max' => 200],
            [['profile_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'profile_image' => 'Profile Image',
            'category_id' => 'Category ID',
            'map_id' => 'Map ID',
            'image_url' => 'Image Url',
            'cat_url' => 'Cat Url',
            'title' => 'Title',
            'profile_name' => 'Profile Name',
            'slug' => 'Slug',
            'publish_date' => 'Publish Date',
        ];
    }
}
