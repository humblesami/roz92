<?php

namespace backend\modules\core\controllers;

use Yii;
use backend\modules\core\models\TblCoreCompany;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
Yii::$app->view->params['customParam'] = 1;
use backend\components\BaseController;
/**
 * CompanyController implements the CRUD actions for TblCoreCompany model.
 */
class CompanyController extends BaseController
{




    /**
     * Lists all TblCoreCompany models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblCoreCompany::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblCoreCompany model.
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
     * Creates a new TblCoreCompany model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblCoreCompany();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->company_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblCoreCompany model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$file_mod = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			

			
			$file_mod->imageFile = UploadedFile::getInstance($file_mod, 'imageFile');
            if ($file_mod->upload()) {
                // file is uploaded successfully
                return;
            }			


			
            return $this->redirect(['view', 'id' => $model->company_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'file_mod' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblCoreCompany model.
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
     * Finds the TblCoreCompany model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCoreCompany the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCoreCompany::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
