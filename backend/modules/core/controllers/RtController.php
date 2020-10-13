<?php

namespace backend\modules\core\controllers;

use Yii;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
use backend\components\BaseController;
/**
 * FeaturesController implements the CRUD actions for TblCoreModuleFeatures model.
 */
class RtController extends BaseController
{
    

    /**
     * Lists all TblCoreModuleFeatures models.
     * @return mixed
     */
    public function actionSeoupdate()
    {
        
     
              
         $query = Post::find()->joinWith('cats')->where(['seo_title' => null])->orderBy('published_at DESC')
          ->limit(5000);
          $post = $query->all();
          foreach ($post as $row) {
          	# code...
            $content = strip_tags($row->content);
          		$desc =  mb_substr($content,0,100);

          		//echo $row->content;
          		
          		$new_keyword = [];
          		
 						$cat = $row->cats;
                      foreach ($cat as $crow) {
                          $cat_id = $crow->id;
                          if($cat_id != 24 and $cat_id != 1){
                             $new_keyword[] = $crow->title;
                          }
                      }
                       $new_keyword = implode(', ',$new_keyword);



          		$row->seo_title = $row->title;
          		$row->keyword = $new_keyword;
          		$row->description = $desc;
          		$row->save(false);
          }
    }
	
	
}
