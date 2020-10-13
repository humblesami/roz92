<?php

namespace backend\modules\core\controllers;

use Yii;
use backend\modules\core\models\User;
use backend\modules\core\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;

use yii\web\UploadedFile;
Yii::$app->view->params['left_menu'] = true;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
		
		
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$dataProvider->pagination->pageSize=20;
        return $this->render('index', [
            'dataProvider' 	=> $dataProvider,
			'searchModel'	=>	$searchModel,
        ]);
    }

    /**
     * Displays a single user model.
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
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new \backend\modules\core\models\User();

 

        if ($model->load(Yii::$app->request->post())) {



            

                if($model->save()){

                    
                    \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'User has been created.'));
                    return $this->redirect(['index', 'id' => $model->id]);
                }else{
                    var_dump($model->errors);
                }
                    
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        if ($model->load(Yii::$app->request->post())) {



            

                if($model->save()){
                \Yii::$app->session->setFlash('crudMessage', Yii::t('yee', 'User has been updated.'));
                    return $this->redirect(['index', 'id' => $model->id]);
                }else{
                    var_dump($model->errors);
                }
                    
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing user model.
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
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	

}
