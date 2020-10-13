<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
class SliderPostWidget extends Widget
{
    public $heading;
    public $category_id;

    public function init()
    {
        parent::init();
       /* if ($this->message === null) {
            $this->message = 'Hello World';
        }*/
    }

    public function run()
    {
        $data['heading'] = $this->heading;
        $data['category_id'] = $this->category_id;

        $query = Post::find()->joinWith('cats')->where([
            'status' => Post::STATUS_PUBLISHED,
            Category::tableName() . '.id' => $this->category_id,
        ])->orderBy('published_at DESC');


        $posts = $query->limit(10)
            ->all();


        $data['posts'] = $posts;
        
        return $this->render('sliderpost',$data);
    }
}