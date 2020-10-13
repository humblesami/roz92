<?php 
namespace backend\modules\core\controllers;
use backend\modules\core\models\TblCoreRoles;
use backend\modules\core\models\TblCoreModules;
use backend\modules\core\models\TblCoreDashboards;
use backend\modules\core\models\TblCoreMenus;
use backend\modules\core\models\TblCoreModuleFeatures;
use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use backend\components\BaseController;
Yii::$app->view->params['left_menu'] = true;
class RolesController extends BaseController {
	
	
   

	
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
	public function actionMain($role_id=0)
	{

		//$model_upload = new upload_mod;
		//$data['model_upload'] = $model_upload;

//			$this->getView()->registerJsFile('/plugins/bootstrap-switch/static/js/bootstrap-switch.js');
//			$this->getView()->registerCssFile('/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css');			


			if($role_id == NULL){
				$role_id = 0;	
			}
			$roles_mod = new TblCoreRoles();
			$data['roles_mod']			=	$roles_mod;
			$roles_list					=	TblCoreRoles::find()->where('status_id = 1')->all();
			$data['roles_list']			=	$roles_list;
			
			$data['role_id']			=	$role_id;
			
			$data['module_list'] 		= 	TblCoreModules::find()->where('status = 1')->all();
	
			$role_name	=	"";
			$menu_id	=	"";
			$dashboard_id	=	"";
			$role_desc = '';
			if($role_id !=0){
				$role_data	=	 TblCoreRoles::findOne($role_id);
				$role_name	=	$role_data['name'];
				$role_desc	=	$role_data['desc'];
				$menu_id	=	$role_data['menu_id'];
				$dashboard_id	=	$role_data['dashboard_id'];
			}
			$data['role_desc']	= $role_desc;
			$data['role_name']	= $role_name;
			$data['menu_id']	= $menu_id;
			$data['dashboard_id']	= $dashboard_id;
			
			
			////
			
			

			
			$data['parent_feature']	=	$roles_mod->assigned_parent_feature($role_id);
			
			$dashboard_list			=	TblCoreDashboards::find()->all();
			$data['dashboard_list']	=	ArrayHelper::map($dashboard_list,'id', 'name');
			
			$menu_list				=	TblCoreMenus::find()->andWhere(['type' => 'B'])->all();
			$data['menu_list']		=	$menu_list;
			
			$menu_mod = new TblCoreMenus();
			$data['menu_mod']			=	$menu_mod;
			
			return $this->render('main',$data);	
		
	}
	
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionimport_role_save(){
			
		$data	= $_POST;
		
		$role_id	=	$data['role_id'];


		$model_upload = new upload_mod;
		
		$file_name	=	"";
		$path = 'uploads/roles_file/';
		$model_upload->upload_file = CUploadedFile::getInstance($model_upload,'userfile');
		 if($model_upload->validate()) {
			$model_upload->upload_file->saveAs($path . $model_upload->upload_file);
			$file_name = $model_upload->upload_file;
			
		 }else{
			var_dump($model_upload->getErrors());
		 }

		$data['file_name']	= $file_name;		

		$file_path = "uploads/roles_file/".$file_name;
		
		if (($handle = fopen($file_path, "r")) !== FALSE) {
				
				
				
				$mdata = fread($handle,filesize($file_path));
					
				$mdata	=	str_replace("mrole", $role_id, $mdata);
				$mdata	=	json_decode($mdata);
				
				
				$d = Yii::app()->db->createCommand();
				$d->delete('tbl_core_roles_features', 'role_id=:id', array(':id'=> $role_id));
				foreach($mdata as $key => $value){
					
					$insert_data = array(
						'role_id'		=> $value->role_id,
						'module_id'		=>	$value->module_id,
						'feature_id'	=>	$value->feature_id,
						'view'			=>	$value->view,
						'status'		=>	$value->status,
						'created_by'	=>	Yii::app()->user->getstate('tuser'),
					);
					
					$q = Yii::app()->db->createCommand();
					$q->insert('tbl_core_roles_features', $insert_data);
					
					//$this->db->insert('tbl_core_roles_features',$insert_data);
				}

			}		
		
		// PC Vesion Image
		
		$this->redirect(array('/core/roles/main/role_id/' . $role_id));


				//redirect('core/roles/main/'. $role_id);
		
	}		
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionAssign_role_save(){
			
		$data = $_POST;
		roles_mod::model()->assign_role_save($data);
	}
	
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionAssing_role_save(){
			
			
		$data_value = $_GET['data_value'];
		$state 		= $_GET['state'];
		$roles_mod = new TblCoreRoles();
		$roles_mod->assing_role_save($data_value, $state);
	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionCreate_role_save(){
			
		$data = $_POST;	
		roles_mod::model()->create_role_save($data);
		
	}	
	
	
	/**
	* Funciton create
	* This function create role
	* @param  
	* 
	* @return voild
	*/
	public function actionCreate(){
		
		if($_POST){
			$data = $_POST;	
			$roles_mod = new TblCoreRoles();
			$roles_mod->create_role_save($data);
	
		}else{
			return $this->renderPartial('create');
		}
		
		
	}		
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionUpdate_role(){
			
		$data = $_POST;
		roles_mod::model()->update_role($data);
		
	}
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionexport_role($role_id){
			
		$role_list = roles_mod::model()->roles_list_by_id($role_id);
		$export_data =  json_encode($role_list);
		
		

		
		
			$handle = fopen("file.txt", "w");
			fwrite($handle, $export_data);
			fclose($handle);
		
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename('file.txt'));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('file.txt'));
			readfile('file.txt');		
		
	}			
		

	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionDefault_setting($role_id){

		if($_POST){
			$data = $_POST;

            $roles_mod = new TblCoreRoles();
            $roles_mod->update_role($data);
		}else{
			$data['role_id'] = $role_id;
			$role_data	=	 TblCoreRoles::findOne($role_id);
			$data['role_data']	= $role_data;
			return $this->renderPartial('default_setting',$data);
		}
	}
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionFeature_detail($feature_id,$role_id){
		
		$feature_data	=	 TblCoreModuleFeatures::findOne($feature_id);
		$data['feature_id'] = $feature_id;
		$data['role_id'] = $role_id;
		$data['feature_data'] = $feature_data;
		$roles_mod = new TblCoreRoles();
		$data['roles_mod']			=	$roles_mod;
		
		
		return $this->renderPartial('feature_detail',$data);
	}
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionLoad_ff_list($feature_id,$role_id){
		
		$data['parent_id'] = $feature_id;
		$data['role_id'] = $role_id;
		
			$roles_mod = new TblCoreRoles();
			$data['roles_mod']			=	$roles_mod;
		
		return $this->renderPartial('sub_feature',$data);
	}
	
		/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function actionLoad_ss_list($feature_id,$role_id){
		
		$data['parent_id'] = $feature_id;
		$data['role_id'] = $role_id;
			$roles_mod = new TblCoreRoles();
			$data['roles_mod']			=	$roles_mod;
		
		return $this->renderPartial('sub_sub_feature',$data);
	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/
	public function import_role_save(){
			
		$data	= $this->input->post();
		
		$role_id	=	$data['role_id'];


		$this->load->library('upload');

		
		// PC Vesion Image
		$aa['upload_path'] = './uploads/roles_file/';
		$aa['allowed_types'] = '*';
		$aa['max_size']	= '50000';
		$aa['overwrite']  = false;
		$this->upload->initialize($aa); 

		if ($this->upload->do_upload($field = 'userfile')){
			$f_data = $this->upload->data();
			
			$file_path = "uploads/roles_file/".$f_data['file_name'];
	
			if (($handle = fopen($file_path, "r")) !== FALSE) {
				
				
				
				$mdata = fread($handle,filesize($file_path));
					
				$mdata	=	str_replace("mrole", $role_id, $mdata);
				$mdata	=	json_decode($mdata);
				foreach($mdata as $key => $value){
					
					$insert_data = array(
						'role_id'		=> $value->role_id,
						'module_id'		=>	$value->module_id,
						'feature_id'	=>	$value->feature_id,
						'view'			=>	$value->view,
						'status'		=>	$value->status,
						'created_by'	=>	$this->session->userdata('tuser'),
					);
					$this->db->insert('tbl_core_roles_features',$insert_data);
				}

			}
		}else{
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
		}
		
				redirect('core/roles/main/'. $role_id);
		
	}		
	
	
	// Custom Drop Down
	public function makeDropDown_custom($data,$Title,$value,$option){
			  $dropdown =array();
			  $dropdown[''] = ' --- Select ' . $Title . ' ---';
			  foreach($data->result() as $row)
				{
				$dropdown[$row->$value] = $row->$option;
			  }
			  return $dropdown;		
	
	}
	
	/**
	* Funciton change_role
	* This function display Dashboards
	* @param  
	* 
	* @return voild
	*/
	function actionchange_role($user_id, $role_id, $dashboard_id, $menu_id)
	{	
		roles_mod::model()->change_role($user_id, $role_id, $dashboard_id, $menu_id);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */