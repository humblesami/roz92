<?php

namespace backend\modules\paper\controllers;

use Yii;
use backend\modules\paper\models\TblProfile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProfileController implements the CRUD actions for TblProfile model.
 */
class ProfileController extends \backend\components\BaseController
{
    /**
     * @inheritdoc
     */


  
    /**
     * Lists all TblProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblProfile::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblProfile model.
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
     * Creates a new TblProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblProfile();

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


                     \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'Profile has been created.'));
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
     * Updates an existing TblProfile model.
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



                    
                \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'Profile has been updated.'));
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
     * Deletes an existing TblProfile model.
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
     * Finds the TblProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
