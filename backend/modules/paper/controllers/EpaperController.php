<?php

namespace backend\modules\paper\controllers;

use Yii;
use backend\modules\paper\models\TblPapEpaperMst;
use backend\modules\paper\models\TblPapEpaperDtl;
use backend\modules\paper\models\TblMapPost;
use backend\modules\paper\models\TblMapPostL;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
use backend\components\BaseController;
/**
 * EpaperController implements the CRUD actions for TblPapEpaperMst model.
 */
class EpaperController extends BaseController
{
    /**
     * @inheritdoc
     */

     
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/


 public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}   
    /**
     * Lists all TblPapEpaperMst models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblPapEpaperMst::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all TblPapEpaperMst models.
     * @return mixed
     */
    public function actionPage_detail($epaper_id)
    {
       

        return $this->renderPartial('page_detail', [
            'epaper_id' => $epaper_id,
        ]);
    }

    /**
     * Displays a single TblPapEpaperMst model.
     * @param integer $id
     * @return mixed
     */
    public function actionReplace_image($paper_id,$page_detail_id)
    {
        Yii::$app->assetManager->bundles = [
'yii\bootstrap\BootstrapPluginAsset' => false,
'yii\bootstrap\BootstrapAsset' => false,
'yii\web\JqueryAsset' => false,
];

        $model = TblPapEpaperDtl::find()->where(['epaper_id' => $paper_id,'page_id' => $page_detail_id])->one();
        if($model){
            $model->map_data = Null;
            $model->map_data_raw = Null;
            $model->save(false);

            $id = $model->id;

            $map_post = TblMapPost::find()->where(['page_detail_id' => $id])->all();
            foreach($map_post as $mRow){
               
                $post_id = $mRow->post_id;
                $postData = Post::findOne($post_id);
                $postData->delete();
                $mRow->delete();
                
            }

        }
        return $this->renderAjax('replace_image', [
            'paper_id' => $paper_id,
             'page_detail_id' => $page_detail_id,
        ]);
    }


    /**
     * Displays a single TblPapEpaperMst model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Displays a single TblPapEpaperMst model.
     * @param integer $id
     * @return mixed
     */
    public function actionGet_map_post($page_detail_id,$map_id)
    {
        $post_map = TblMapPostL::find()
        //->from([new \yii\db\Expression(TblMapPostL::tableName(). ' PARTITION(p2) ')])
        ->where(['page_detail_id' => $page_detail_id,'map_id' => $map_id])->One();
        $title = '';
        $slug = '';
        $content = '';
        $post_type = '1';
        $cat = '';
        $profile_id = '';
        if($post_map){
            $post = Post::find()->where(['id' => $post_map->post_id])->one();
            $title = $post->title;
            $slug = $post->slug;
            $content = $post->content;
            $post_type = $post->post_type;
            $cat = $post->catValues;
            $cat = str_replace('[', '', $cat);
            $cat = str_replace(']', '', $cat);
            $cat = explode(',',$cat);
            $profile_id = $post->profile_id;
          



           
        }


            $data = ['title' => $title,'slug' => $slug,'content' => $content,'post_type' => $post_type,'cat' => $cat,'profile_id' => $profile_id];
            $data = json_encode($data);
            echo $data;

    }    

    /**
     * Creates a new TblPapEpaperMst model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblPapEpaperMst();

        if ($model->load(Yii::$app->request->post()) ) {
             if($model->type == 'C'){
                $model->station_id = 0;
             }
             
             $model->page_detail =  $model->pt['page_detail'];;
             $model->save();
//var_dump($model->getErrors());die();
//die();

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing TblPapEpaperMst model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPublish($id,$status)
    {
         $model = $this->findModel($id);
         $model->paper_status = $status;
         $model->save(false);
         return $this->redirect(['index']);
    }
    /**
     * Updates an existing TblPapEpaperMst model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

        
             $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');


            if ($model->upload()) {

                 $model->save(false);



                  return $this->redirect(['index', 'id' => $model->id]);
            }

            return $this->redirect(['index', 'id' => $model->id]);
           
        } 


         return $this->render('update', [
                        'model' => $model,
                    ]);

    }

    /**
     * Deletes an existing TblPapEpaperMst model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpload_image($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

             $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                 $data = Yii::$app->request->post();
                 //$tag = explode(',',$data['tag']);
                 if($data['title'] != ''){

                     $page_detail_id = $data['page_detail_id'];
                     $map_id = $data['map_id'];

                     $map_post = TblMapPost::find()->where(['page_detail_id' => $page_detail_id,'map_id' => $map_id])->One();

                     if(!$map_post){

                        $post = new Post;
                         $map_post = new TblMapPost;
                    }else{



                        $post = Post::findOne($map_post->post_id);
                    }
                   // $post_type = 1;
                   // if($data['Post']['post_type'] != ''){
                        $post_type = $data['Post']['post_type'];
                  //  }
                     $post->title =$data['title'];
                     $post->slug =$data['slug'];
                     $post->content = $data['news'];
                     $post->post_type = $post_type;

                     $seo_desc = $data['news'];

                     $seo_desc = strip_tags($seo_desc);

                     $seo_desc = mb_substr($seo_desc,0,100);

                     $cat_name = [];
                     $cats  = $data['Post']['catValues'];

                     foreach ($cats as $key => $value) {
                        $cat_id = $value;
                        if($cat_id != 24 and $cat_id != 1){
                            $cat_name[] = Category::findOne($cat_id)->title;
                        }
                     }

                     $cat_names = implode(', ', $cat_name);
                    // echo $cat_names;

                     $post->seo_title = $data['title'];
                     $post->description = $seo_desc;
                     $post->keyword = $cat_names;

                     if($data['Post']['post_type'] == 2){
                        $post->profile_id = $data['Post']['profile_id'];
                     }else{
                        $post->profile_id = 0;
                     }
                    // $post->category_id = $data['category_id'];
                     $post->status = 1;
                     $post->thumbnail = $data['Post']['thumbnail'];
                    // $post->tagValues = $tag;


                     

                     $post->save();




                       
                     $post_id = $post->id;

                     $map_post->page_detail_id = $page_detail_id;
                     $map_post->map_id = $map_id;
                     $map_post->post_id = $post_id;
                     $map_post->save();
                 }
           
            echo $model->upload_single();


           
        } 
    }

    /**
     * Deletes an existing TblPapEpaperMst model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionMapping($id)
    {
        $model = new TblPapEpaperMst;
         $modelpost = new Post;
        if($_POST){
            $map_data = $_POST['map_data'];
            $row_data = $_POST['row_data'];
           
            $eDetail = TblPapEpaperDtl::findOne($id);
            $eDetail->map_data = $map_data;
            $eDetail->map_data_raw = $row_data;
            $eDetail->save();
            
        }
         return $this->render('mapping',

                ['id' => $id,'model' => $model,'modelpost' => $modelpost]
        
        );
    }

    public function create_folder($folder_name){

        
       
         if (!is_dir($folder_name)) {
            mkdir($folder_name,0775);
        }
          
    }
    public function actionUpload($id,$page_id)
    {

        $model = $this->findModel($id);


                $issue_date = date('dmY',strtotime($model->issue_date));
                                $year = date('Y',strtotime($model->issue_date));
                $month = date('m',strtotime($model->issue_date));

                $this->create_folder('uploads/epaper/' . $model->station_id);

                $this->create_folder('uploads/epaper/' . $model->station_id . "/" . $year);


                $this->create_folder('uploads/epaper/' . $model->station_id . "/" . $year . '/' . $month);

                $this->create_folder('uploads/epaper/' . $model->station_id . "/" . $year . '/' . $month . "/" . $issue_date);

                $path =  'uploads/epaper/' . $model->station_id . "/" . $year . '/' . $month . "/" . $issue_date  . "/";





        $fileName = 'file';
        $uploadPath = $path;//'./uploads';

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);
            $xfile_name = rand() . "_" . $file->name;

            if ($file->saveAs($uploadPath . '/' . $xfile_name)) {
                //Now save file data to database


                    $eDetail = TblPapEpaperDtl::find()->where(['page_id' => $page_id,'epaper_id' => $id])->one();
                   
                    
                    if(!$eDetail){
                        $eDetail = new TblPapEpaperDtl;
                    }
                    $eDetail->epaper_id = $id;
                    $eDetail->sort_order = $page_id;
                    $eDetail->page_id = $page_id;
                    $eDetail->image = $xfile_name;
                    $eDetail->path = $path  . $xfile_name;
                    $eDetail->save(false);

                    $file->name = $path  . $xfile_name;



                echo \yii\helpers\Json::encode($file);
            }
        }

        return false;
    }







    /**
     * Deletes an existing TblPapEpaperMst model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblPapEpaperMst model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblPapEpaperMst the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblPapEpaperMst::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
