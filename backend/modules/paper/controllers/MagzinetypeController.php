<?php

namespace backend\modules\paper\controllers;

use Yii;
use backend\modules\paper\models\TblPapMagzineType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
Yii::$app->view->params['left_menu'] = true;
/**
 * MagzinetypeController implements the CRUD actions for TblPapMagzineType model.
 */
class MagzinetypeController extends \backend\components\BaseController
{
    /**
     * @inheritdoc
     */
  

    /**
     * Lists all TblPapMagzineType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblPapMagzineType::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblPapMagzineType model.
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
     * Creates a new TblPapMagzineType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblPapMagzineType();

if ($model->load(Yii::$app->request->post())) {



             $model->image = UploadedFile::getInstance($model, 'image');
            if ($img = $model->upload()) {
                if($img != 'no_image'){
                    $model->image = $img;
                }

                if($model->save()){

                   /* $profile_id = $model->id;
                    
                    $user = new \backend\modules\core\models\User() ;
                    $user->username = $model->username;
                    $user->full_name = $model->name;
                    $user->password_hash = $model->password;
                    $user->role_id = 14;
                    $user->login_type = 'local';
                    $user->email = $model->email;
                    $user->status = 10;
                    $user->profile_id = $profile_id;
                    $user->save(false);

                    $ass = new \backend\modules\core\models\AuthAssignment();
                    $ass->item_name = 'column'; 

                    $ass->user_id = $user->id;
                    $ass->created_at = time();
                    $ass->save(false);
                    */


                     \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'Magazine has been created.'));
                    return $this->redirect(['index', 'id' => $model->id]);
                }else{
                    var_dump($model->errors);
                }
            }      
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblPapMagzineType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {

            $old_image = $model->image;

                $model->image = UploadedFile::getInstance($model, 'image');
            if ($img = $model->upload()) {


               $model->image = $old_image;     
               if($img != 'no_image'){

                    $model->image = $img;

                }


                if($model->save()){



                    
                \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'Magazine has been updated.'));
                    return $this->redirect(['index', 'id' => $model->id]);
                }else{
                    var_dump($model->errors);
                }

                
            }      
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblPapMagzineType model.
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
     * Finds the TblPapMagzineType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblPapMagzineType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblPapMagzineType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
