<?php 
namespace backend\modules\core\controllers;
use backend\modules\core\models\TblCoreMasterSetup;
use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use backend\components\BaseController;
class MastersetupentryController extends BaseController {
	
	
   

	
	//public $layout='//layouts/column2';
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function actionDatalist($master_setup_id=0)
	{


			$master_data = $this->findModel($master_setup_id);
			$data['master_data']		=	 $master_data;
			$data['master_setup_id']	=	 $master_setup_id;
	
			return $this->render('entry_form',$data);
		
		
	}
	
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionCreate($master_setup_id)
	{


		if($_POST){
			$model = new TblCoreMasterSetup();
			$data = $_POST;
			$master_setup_id = $data['master_setup_id'];
			
			$model->save_entry($data);
			return $this->redirect(['datalist', 'master_setup_id' => $master_setup_id]);

			
		}else{
			$master_data = $this->findModel($master_setup_id);
			
			$data['master_setup_id']	=	 $master_setup_id;
			$data['master_data']		=	 $master_data;
			return $this->render('create',$data);
		}
	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionEdit($master_setup_id,$key_id)
	{


		if($_POST){
			$model = new TblCoreMasterSetup();
			$data = $_POST;
			$master_setup_id = $data['master_setup_id'];
				
			$model->update_save_entry($data,$key_id);

			return $this->redirect(['datalist', 'master_setup_id' => $master_setup_id]);

			
		}else{
			$master_data = $this->findModel($master_setup_id);
			
			$data['master_setup_id']	=	 $master_setup_id;
			$data['key_id']	=	 $key_id;
			$data['master_data']		=	 $master_data;
			return $this->render('edit',$data);
		}
	}	

    /**
     * Finds the TblCntFieldType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblCntFieldType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblCoreMasterSetup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */