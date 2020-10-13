<?php

namespace backend\modules\core\controllers;

use Yii;
use backend\modules\core\models\TblCoreModuleFeatures;
use backend\modules\core\models\TblCoreModules;
use backend\modules\core\models\TblCoreRoles;
use backend\modules\core\models\TblCoreMenus;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\components\BaseController;
Yii::$app->view->params['left_menu'] = true;
/**
 * FeaturesController implements the CRUD actions for TblCoreModuleFeatures model.
 */
class FeaturesController extends BaseController
{
    

    /**
     * Lists all TblCoreModuleFeatures models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblCoreModuleFeatures::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	/**
	* Funciton index
	* This function display Features
	* @param  
	* 
	* @return voild
	*/
	public function actionMain()
	{


			$module_list			= TblCoreModules::find()->all();

			$data['module_list']		= ArrayHelper::map($module_list,'id', 'name');			
			

			return $this->render('main',$data);
	}	


	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/		
	
		public function actionFeatureddata($module_id,$f_type)
		{
		  $feature_mod = new TblCoreModuleFeatures();
		  $data['feature_mod']		=	$feature_mod;

		  $roles_mod = new TblCoreRoles();
		  $data['roles_mod']		=	$roles_mod;


		  $data['featured_data'] 	= $feature_mod->feature_list($module_id,$f_type);
		  $data['module_data']		= TblCoreModules::findOne($module_id);
		  
		  return $this->renderPartial('load_featured_data',$data);
		}		

    /**
     * Displays a single TblCoreModuleFeatures model.
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
     * Creates a new TblCoreModuleFeatures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblCoreModuleFeatures();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	
	/**
	* Funciton index
	* This function Create Feature
	* @param  
	* 
	* @return voild
	*/	
	public function actionAdd_feature($type)
	{   							
		  	$data['fetrd_modules'] 	= TblCoreModules::find()->all();
			
			$feature_mod = new TblCoreModuleFeatures();
			$data['feature_mod']	=	$feature_mod;


			$data['menu_list']	=	TblCoreMenus::find()->all();
			
			$data['fetrd_dropdown'] = $feature_mod->feature_list_dropdown();
			$data['type'] = $type;
			return $this->renderPartial('feature_create',$data);

	}	
	
	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/		
		public function actionEdit_sub_feature($id)
		{
			//$group_report_data = master_setup_mod::model()->find('tbl_name = "tbl_hrms_group_reports"');
			//$group_report_list =  employee_mod::model()->make_data($group_report_data['master_setup_value']);
			$data['group_report_list'] = NULL;//$group_report_list;
			$feature_data = TblCoreModuleFeatures::findOne($id);
			$data['fetrd_data'] = $feature_data;

			$data['fetrd_modules'] 	= TblCoreModules::find()->All();
			
			$feature_mod = new TblCoreModuleFeatures();
			$data['feature_mod']	=	$feature_mod;
			
			$data['fetrd_dropdown'] = $feature_mod->feature_list_dropdown();
			
			$data['menu_list']	=	$feature_mod->menu_feature_list($feature_data->id);
	
			return $this->renderPartial('edit_sub_feature',$data);
		 
		}	
	
	
	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/				
	public function actionUpdate_sub_feature()
	{
	  $data = $_POST;
	  $feature_mod = new TblCoreModuleFeatures();
	  $data['feature_mod']	=	$feature_mod;	  
	  $feature_mod->save_sub_feature_edit_data($data);	  
	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionDelete_feature($id)
	{
	    $feature_mod = new TblCoreModuleFeatures();
		
		$feature_mod->delete_feature($id);
	}			
	
	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/		
	public function actionAdd_sub_feature($id, $type)
		{
		 
		 $data['type']		=  $type;


		 $feature_mod = new TblCoreModuleFeatures();
		 $data['feature_mod']	=	$feature_mod;

		 $data['fetrd_data'] 		= $feature_mod->edit_by_id($id);			
		 $data['fetrd_dropdown'] 	= $feature_mod->feature_list_dropdown();


		 return $this->renderPartial('create_sub_feature',$data);


		}		
	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/		
		
	  public function actionSave_create_feature()
	  {
			$feature_mod = new TblCoreModuleFeatures();
			$data = $_POST;
			$feature_mod->save_feature($data);
	  }		



	

	/**
	* Funciton index
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/	
	 public function actionSubmit_sub_feature()
	  {
		$data = $_POST;
		$feature_mod = new TblCoreModuleFeatures();
		$feature_mod->save_sub_feature($data);
	  }		
		
    /**
     * Updates an existing TblCoreModuleFeatures model.
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
     * Deletes an existing TblCoreModuleFeatures model.
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
     * Finds the TblCoreModuleFeatures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCoreModuleFeatures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCoreModuleFeatures::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
