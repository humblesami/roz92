<?php

namespace backend\modules\paper\controllers;

use Yii;
use backend\modules\paper\models\TblPapMagzineTemplate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
Yii::$app->view->params['left_menu'] = true;
use backend\components\BaseController;
/**
 * PagetemplateController implements the CRUD actions for TblPapPageTemplate model.
 */
   
class MagzinetemplateController extends BaseController
{
    public $disabledActions = ['view','bulk-activate', 'bulk-deactivate'];
    /**
     * @inheritdoc
     */

   

    /**
     * Lists all TblPapPageTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblPapMagzineTemplate::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblPapPageTemplate model.
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
     * Creates a new TblPapPageTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblPapMagzineTemplate();

        if ($model->load(Yii::$app->request->post()) ) {
            $page_name = $_POST['page_name'];
            $number_of_pages  = count($page_name);


            foreach($page_name as $key => $page){
                $common_page= $_POST['common_template'][$key];
                $page_data[] =  [
                        'name' => $page,
                        'is_common' => $common_page,
                    ];
            }
            $page_name = json_encode($page_data);

            $model->no_of_pages = $number_of_pages;
            $model->page_detail = $page_name;


            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblPapPageTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {


            $page_name = $_POST['page_name'];
            $number_of_pages  = count($page_name);

            foreach($page_name as $key => $page){
                $common_page= $_POST['common_template'][$key];
                $page_data[] =  [
                        'name' => $page,
                        'is_common' => $common_page,
                    ];
            }
            $page_name = json_encode($page_data);

          

            $model->no_of_pages = $number_of_pages;
            $model->page_detail = $page_name;   
             $model->save();         
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblPapPageTemplate model.
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
     * Finds the TblPapPageTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblPapPageTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblPapMagzineTemplate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
