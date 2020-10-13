<?php

namespace backend\modules\columiest\models;

use yeesoft\behaviors\MultilingualBehavior;
use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yeesoft\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $slug
 * @property string $view
 * @property string $layout
 * @property integer $category_id
 * @property integer $status
 * @property integer $comment_status
 * @property string $thumbnail
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $revision
 *
 * @property PostCategory $category
 * @property User $createdBy
 * @property User $updatedBy
 * @property PostLang[] $postLangs
 * @property Tag[] $tags
 * @property Cat[] $cats
 */
class Post extends ActiveRecord implements OwnerAccess
{

    const STATUS_PENDING = 0;
    const STATUS_PUBLISHED = 1;
    const COMMENT_STATUS_CLOSED = 0;
    const COMMENT_STATUS_OPEN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isNewRecord && $this->className() == Post::className()) {
            $this->published_at = time();
        }

        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'updateRevision']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveTags']);

        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveCats']);  
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'saveCats']);      
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'saveTags']);
    }


  public function fields()
{
    return [
        // field name is the same as the attribute name
        'newsid' => 'id',
        // field name is "email", the corresponding attribute name is "email_address"
        'slug',
        // field name is "name", its value is defined by a PHP callback
        'title',
        'categories' => function ($model) {
            $cat = $model->catValues;
            $cat = str_replace('[', '', $cat);
            $cat = str_replace(']', '', $cat);

            return $cat;
        },
        'image' => function ($model) {
            return $model->thumbnail;
        },
        'epaper_image' => function ($model) {
            $post_id = $model->id;
            $image_url = '';

            $post_map = \backend\modules\paper\models\TblMapPost::find()->where(['post_id' => $post_id])->one();
            if($post_map){
              $map_data   =  $post_map->paperdetail->map_data_raw;
             ;
             
              $map_id     = $post_map->map_id;
              $map_data   = json_decode($map_data,true);
              $image_url  =  $map_data[$map_id]['href'];  
            
            }

            return $image_url;
        },
        'publishedDate',
        'updateddate',
        'columiest_name' => function ($model) {
            return $model->profile['name'];
        },
        'status' => 'StatusText',
        'content',

    ];
}  
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'post_id',
                'tableName' => "{{%post_lang}}",
                'attributes' => [
                    'title', 'content',
                ]
            ],

          
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_by', 'updated_by', 'status', 'comment_status', 'revision', 'category_id','profile_id'], 'integer'],
            [['title','seo_title','keyword','description', 'content', 'view', 'layout'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 127],
            [['thumbnail'], 'string', 'max' => 255],
            ['published_at', 'date', 'timestampAttribute' => 'published_at', 'format' => 'yyyy-MM-dd'],
            ['published_at', 'default', 'value' => time()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'created_by' => Yii::t('yee', 'Author'),
            'updated_by' => Yii::t('yee', 'Updated By'),
            'slug' => Yii::t('yee', 'Slug'),
            'view' => Yii::t('yee', 'View'),
            'layout' => Yii::t('yee', 'Layout'),
            'title' => Yii::t('yee', 'Title'),
            'seo_title' => Yii::t('yee', 'Title'),
            'keyword' => Yii::t('yee', 'Keyword'),
            'description' => Yii::t('yee', 'Description'),
            'status' => Yii::t('yee', 'Status'),
            'comment_status' => Yii::t('yee', 'Comment Status'),
            'content' => Yii::t('yee', 'Content'),
            'category_id' => Yii::t('yee', 'Category'),
            'thumbnail' => Yii::t('yee/post', 'Thumbnail'),
            'published_at' => Yii::t('yee', 'Published'),
            'created_at' => Yii::t('yee', 'Created'),
            'updated_at' => Yii::t('yee', 'Updated'),
            'revision' => Yii::t('yee', 'Revision'),
            'tagValues' => Yii::t('yee', 'Tags'),
            'catValues' => Yii::t('yee', 'Category'),
            'profile_id' => 'Columniest',
        ];
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
         return parent::find()->where(['post_type' => 2]);
       
        //return new PostQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagValues()
    {
        $ids = [];
        $tags = $this->tags;
        foreach ($tags as $tag) {
            $ids[] = $tag->id;
        }

        return json_encode($ids);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatValues()
    {
        $ids = [];
        $cats = $this->cats;
        foreach ($cats as $cat) {
            $ids[] = $cat->id;
        }

        return json_encode($ids);
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                    ->viaTable('{{%post_tag_post}}', ['post_id' => 'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCats()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
                    ->viaTable('{{%post_cat_post}}', ['post_id' => 'id']);
    }   

    /**
     * Handle save tags event of the owner.
     */
    public function saveTags()
    {
        /** @var Post $owner */
        $owner = $this->owner;

        $post = Yii::$app->getRequest()->post('Post');
        $tags = (isset($post['tagValues'])) ? $post['tagValues'] : null;

        if (is_array($tags)) {
            $owner->unlinkAll('tags', true);

            foreach ($tags as $tag) {
                if (!ctype_digit($tag) || !$linkTag = Tag::findOne($tag)) {
                    $linkTag = new Tag(['title' => (string) $tag]);
                    $linkTag->setScenario(Tag::SCENARIO_AUTOGENERATED);
                    $linkTag->save();
                }

                $owner->link('tags', $linkTag);
            }
        }
    }


   /**
     * Handle save tags event of the owner.
     */
    public function saveCats()
    {
        /** @var Post $owner */
        $owner = $this->owner;

        $post = Yii::$app->getRequest()->post('Post');
        $cats = (isset($post['catValues'])) ? $post['catValues'] : null;
       
        if (is_array($cats)) {
            $owner->unlinkAll('cats', true);

            foreach ($cats as $cat) {
                $linkCat = Category::findOne($cat);
                
                
                $owner->link('cats', $linkCat);
            }
        }
    }    

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getPublishedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->published_at);
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getPublishedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->published_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getPublishedDatetime()
    {
        return "{$this->publishedDate} {$this->publishedTime}";
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }

    public function getStatusText()
    {
        return $this->getStatusList()[$this->status];
    }

    public function getCommentStatusText()
    {
        return $this->getCommentStatusList()[$this->comment_status];
    }

    public function getRevision()
    {
        return ($this->isNewRecord) ? 1 : $this->revision;
    }

    public function updateRevision()
    {
        $this->updateCounters(['revision' => 1]);
    }

    public function getShortContent($delimiter = '<!-- pagebreak -->', $allowableTags = '<a>')
    {
        $content = explode($delimiter, $this->content);
        return strip_tags($content[0], $allowableTags);
    }

    public function getThumbnail($options = ['class' => 'thumbnail pull-left', 'style' => 'width: 240px'])
    {
        if (!empty($this->thumbnail)) {
            return Html::img($this->thumbnail, $options);
        }

        return;
    }

    /**
     * getTypeList
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => Yii::t('yee', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('yee', 'Published'),
        ];
    }

    /**
     * getStatusOptionsList
     * @return array
     */
    public static function getStatusOptionsList()
    {
        return [
            [self::STATUS_PENDING, Yii::t('yee', 'Pending'), 'default'],
            [self::STATUS_PUBLISHED, Yii::t('yee', 'Published'), 'primary']
        ];
    }

    /**
     * getCommentStatusList
     * @return array
     */
    public static function getCommentStatusList()
    {
        return [
            self::COMMENT_STATUS_OPEN => Yii::t('yee', 'Open'),
            self::COMMENT_STATUS_CLOSED => Yii::t('yee', 'Closed')
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullPostAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
    public function getProfile()
    {
        return $this->hasOne(\backend\modules\paper\models\TblProfile::className(), ['id' => 'profile_id']);
    } 
}
