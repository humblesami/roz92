<?php

namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
use yii\data\Pagination;
use efrontend\models\TblAjjColumn;
class PostWidget extends Widget
{
    public $heading;
    public $category_id;
    public $view_post;
    public $limit = "5";
    public $type;

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

         $limit = $this->limit;
         $type = $this->type;

         $cdate = date('Y-m-d') ;
     
       

         if($type == 'page'){
                $query = Post::find()->joinWith('profile')->where([
                    'status' => Post::STATUS_PUBLISHED,
                     "DATE_FORMAT(FROM_UNIXTIME(`published_at`), '%Y-%m-%d')" => $cdate,
                    'post_type' => '2',
                    //"DATE_FORMAT(published_at, '%Y-%m-%d')" => date('Y-m-d')
                   
                ])->orderBy('tbl_profile.sort_order');


                $countQuery = clone $query;

                $pagination = new Pagination([
                    'totalCount' => $countQuery->count(),
                    'defaultPageSize' => Yii::$app->settings->get('reading.page_size', 10),

                ]);

                $posts = $query->all();

               













         }else if($type == 'cat'){
           
                 $query = Post::find()->joinWith('cats')->where([
                    'status' => Post::STATUS_PUBLISHED,
                    
                    Category::tableName() . '.id' => 22,
                ])->andWhere(['<', 'DATE_FORMAT(FROM_UNIXTIME(`published_at`), "%Y-%m-%d")', $cdate])->orderBy('published_at DESC');


                $countQuery = clone $query;

                $pagination = new Pagination([
                    'totalCount' => $countQuery->count(),
                    'defaultPageSize' => '15',
                    //'_pageSize' => 15,
                ]);
               
                $posts = $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

                $data['pagination']  = $pagination;


         }else if($type == 'midweek' ){
                $posts = '1';
         }else if($type == 'sunday' ){
                $posts = '2';


         }else if($type =="khabarpage"){


                $query = Post::find()->joinWith('cats')->where([
                    'status' => Post::STATUS_PUBLISHED,
                    "DATE_FORMAT(FROM_UNIXTIME(`published_at`), '%Y-%m-%d')" => $cdate,
                    Category::tableName() . '.id' => $this->category_id,
                ])->orderBy('published_at DESC');


                $posts = $query->all();               
         }else if($type =="column"){


                    $cat_id = $this->category_id;


                

                $posts = TblAjjColumn::getDb()->cache(function ($db) use ($cat_id,$cdate) {

                        $q = TblAjjColumn::find()->all();


                        
                    return $q;
                }, 3600);      
         }else if($type =="pagecolumn"){


               


                $cat_id = $this->category_id;


                

                $posts = TblAjjColumn::getDb()->cache(function ($db) use ($cat_id,$cdate) {

                        $q = TblAjjColumn::find()->all();


                        
                    return $q;
                }, 3600);
        }else{


                $query = Post::find()->joinWith('cats')->where([
                    'status' => Post::STATUS_PUBLISHED,
                    Category::tableName() . '.id' => $this->category_id,
                ])->orderBy('published_at DESC');


                $posts = $query->limit($limit)
                    ->all();
            
        }


        $data['posts'] = $posts;
        $data['xlimit'] = $limit;
        
        return $this->render($this->view_post,$data);
    }
}