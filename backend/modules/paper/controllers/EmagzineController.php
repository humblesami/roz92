<?php

namespace backend\modules\paper\controllers;

use Yii;
use backend\modules\paper\models\TblPapEmagzineMst;
use backend\modules\paper\models\TblPapEmagzineDtl;
use backend\modules\paper\models\TblMapPost;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yeesoft\post\models\Post;
use backend\components\BaseController;
/**
 * EpaperController implements the CRUD actions for TblPapEpaperMst model.
 */
class EmagzineController extends BaseController
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
            'query' => TblPapEmagzineMst::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
        $post_map = TblMapPost::find()->where(['page_detail_id' => $page_detail_id,'map_id' => $map_id])->One();
        $title = '';
        $slug = '';
        $content = '';
        $post_type = '';
        if($post_map){
            $post = Post::find()->where(['id' => $post_map->post_id])->one();
            $title = $post->title;
            $slug = $post->slug;
            $content = $post->content;
            $post_type = $post->post_type;



           
        }


            $data = ['title' => $title,'slug' => $slug,'content' => $content,'post_type' => $post_type];
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
        $model = new TblPapEmagzineMst();

        if ($model->load(Yii::$app->request->post()) ) {
             
                $model->station_id = 0;
            
             
             $model->page_detail =  $model->pt['page_detail'];;
             $model->save(false);
/*var_dump($model->getErrors());die();
die();*/

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
                     $post->title =$data['title'];
                     $post->slug =$data['slug'];
                     $post->content = $data['news'];
                     $post->post_type = $data['Post']['post_type'];
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

                 $this->create_folder('uploads/emagzine');
                $issue_date = date('dmY',strtotime($model->issue_date));


                $year = date('Y',strtotime($model->issue_date));
                $month = date('m',strtotime($model->issue_date));



                $this->create_folder('uploads/emagzine/' . $model->type);

                $this->create_folder('uploads/emagzine/' . $model->type . "/" . $year);


                $this->create_folder('uploads/emagzine/' . $model->type . "/" . $year . '/' . $month);

                $this->create_folder('uploads/emagzine/' . $model->type . "/" . $year . '/' . $month . "/" . $issue_date);

                $path =  'uploads/emagzine/' . $model->type . "/" . $year . '/' . $month . "/" . $issue_date  . "/";





        $fileName = 'file';
        $uploadPath = $path;//'./uploads';

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database


                    $eDetail = TblPapEmagzineDtl::find()->where(['page_id' => $page_id,'emagzine_id' => $id])->one();
                   
                    
                    if(!$eDetail){
                        $eDetail = new TblPapEmagzineDtl;
                    }
                    $eDetail->emagzine_id = $id;
                    $eDetail->sort_order = $page_id;
                    $eDetail->page_id = $page_id;
                    $eDetail->image = $file->baseName . '.' . $file->extension;
                    $eDetail->path = $path  . $file->baseName . '.' . $file->extension;
                    $eDetail->save(false);

                    $file->name = $path  . $file->baseName . '.' . $file->extension;



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
        if (($model = TblPapEmagzineMst::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
