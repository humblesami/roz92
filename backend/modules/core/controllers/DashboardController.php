<?php

namespace backend\modules\core\controllers;

use Yii;
use backend\modules\core\models\TblCoreDashboards;
use backend\modules\core\models\TblCoreDashboardsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
/**
 * DashboardController implements the CRUD actions for TblCoreDashboards model.
 */
class DashboardController extends BaseController
{
   

    /**
     * Lists all TblCoreDashboards models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblCoreDashboardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblCoreDashboards model.
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
     * Displays a single TblCoreDashboards model.
     * @param integer $id
     * @return mixed
     */
    public function actionMain()
    {
        return $this->render('main');
    }
	
	
   /**
     * Displays a single TblCoreDashboards model.
     * @param integer $id
     * @return mixed
     */
    public function actionBatch()
    {
        return $this->render('batch');
    }	
	
	
   /**
     * Displays a single TblCoreDashboards model.
     * @param integer $id
     * @return mixed
     */
    public function actionCase()
    {
        return $this->render('case');
    }			

    /**
     * Creates a new TblCoreDashboards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblCoreDashboards();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblCoreDashboards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblCoreDashboards model.
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
     * Finds the TblCoreDashboards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCoreDashboards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCoreDashboards::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
