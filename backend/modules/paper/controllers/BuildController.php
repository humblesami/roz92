<?php
namespace backend\modules\paper\controllers;

use Yii;
use common\models\LoginForm;
use efrontend\models\PasswordResetRequestForm;
use efrontend\models\ResetPasswordForm;
use efrontend\models\SignupForm;
use efrontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yeesoft\post\models\Post;
use efrontend\models\TblAjjColumn;
use yii\helpers\VarDumper;
use backend\modules\paper\models\TblPapEpaperMst;
use backend\modules\paper\models\TblPapEpaperDtl;
use backend\modules\paper\models\TblMapPost;
use yii\helpers\Html;

use yeesoft\post\models\Category;
/**
 * Site controller
 */
class BuildController extends Controller
{
   public function actionIndex(){
        Yii::$app->db->createCommand()->truncateTable('tbl_ajj_column')->execute();
         $cdate =   date('Y-m-d') ;
                       
                                    $query = Post::find()->joinWith('profile')->where([
                                      'status' => Post::STATUS_PUBLISHED,
                                       "DATE_FORMAT(FROM_UNIXTIME(`published_at`), '%Y-%m-%d')" => $cdate,
                                      'post_type' => '2',
                                      //"DATE_FORMAT(published_at, '%Y-%m-%d')" => date('Y-m-d')
                                     
                                  ])->orderBy('tbl_profile.sort_order');
         $posts = $query->all();
         foreach ($posts as $post) :

                $post_id = $post->id;
                $profile_image =  str_replace('efrontend','backend',Yii::getAlias('@web')) . '/' . $post->profile['image'];

                $map_post = TblMapPost::find()->where(['post_id' => $post['id']])->one();
                                          $map_data = $map_post->paperdetail['map_data_raw'];
                                          $map_id     = $map_post->map_id;
                                          $map_data   = json_decode($map_data,true);
                                          $image_url  =  $map_data[$map_id]['href'];
                $category_id = $post->profile['category_id'];
                $murl = '';
                if($category_id){
                    $cat = \yeesoft\post\models\Category::findOne($category_id);
                    $murl = '../../../category/' . $cat->slug;
                }   

                $ajj = new TblAjjColumn;
                $ajj->post_id = $post_id;
                $ajj->profile_image  = $profile_image;
                $ajj->category_id = $category_id;
                $ajj->map_id = $map_id;
                $ajj->image_url = $image_url;
                $ajj->cat_url = $murl;
                $ajj->title = $post->title;
                $ajj->slug = $post->slug;
                $ajj->publish_date = $post->published_at;
                $ajj->profile_name = $post->profile['name'];
                $ajj->save(false);                                                                        

         endforeach;     

         return $this->redirect(Yii::$app->request->referrer);                             

   }

   public function actionFlush(){
      // VarDumper::dump("Hellow");
       //Yii::$app->cache->flush();
        Yii::$app->frontcache->flush();
       // echo 'Flush Fronend <br>';
       Yii::$app->efrontcache->flush();
       // echo 'Flush epaper <br>';
       return $this->redirect(Yii::$app->request->referrer);
       
   }
   public function actionNomi(){
       VarDumper::dump("Hellow");
      // Yii::$app->cache->flush();
        //Yii::$app->frontcache->flush();
       // echo 'Flush Fronend <br>';
       //Yii::$app->efrontcache->flush();
       // echo 'Flush epaper <br>';
       //return $this->redirect(Yii::$app->request->referrer);
       
   }
}
