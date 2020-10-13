<?php
namespace backend\modules\core\controllers;
use yii;
use yii\web\Controller;
use backend\modules\core\models\TblCoreMenus;
use yii\helpers\ArrayHelper;


use backend\components\BaseController;
Yii::$app->view->params['left_menu'] = true;
class App_menuController extends BaseController {
	
	
	

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
	
	public function actionMain($menu_id=0)
	{


			$this->getView()->registerJsFile( Yii::getAlias('@web') . '/themes/basic/plugins/nestable/jquery.nestable.js');
			$this->getView()->registerJsFile( Yii::getAlias('@web') . '/themes/basic/js/ui-nestable.js');			
	
			if($menu_id == NULL){
				$menu_id = $menu_id;	
				
			}

					
					 $menu_mod = new TblCoreMenus();
					///
					$menu_list					=  	TblCoreMenus::find()->andWhere(['type' => 'F'])->all();
					$data['menu_list'] 			= 	ArrayHelper::map($menu_list,'id', 'name');
					asort($data['menu_list']);
					

					
					
					$menu_detail				=	TblCoreMenus::findOne($menu_id);
					$menu_data					= 	"";
					$menu_name					= 	"";
					if(count($menu_detail) > 0){
						$menu_data					= 	$menu_detail['menu_data'];
						$menu_name					= 	$menu_detail['name'];
					}
					$data['menu_name']			= $menu_name;
					$data['menu_detail']		=	$menu_detail;
					///
					$data['menu_id'] 			= 	$menu_id;
	
	
					$data['menu_data']			=	$this->build_menu($menu_data,'p');
					
					$data['modules_features'] 	= 	$menu_mod->list_modules_features_for_menu($menu_id);
					
					return $this->render('main',$data);	
	

	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/	
	function build_menu($menu_data_row,$parent_child){
		$menu_mod = new TblCoreMenus();
		$mclass = '';
		if($parent_child == "p"){
			$menu_data_row = json_decode($menu_data_row);
			$mclass = '';
		}
		
		if($parent_child == "c"){
			$menu_data_row = $menu_data_row->children;
			
		}
		$menu_ul = "";
		if($menu_data_row != ""){
		$menu_ul = '<ol class="dd-list">';
		
			foreach($menu_data_row as $key => $value){
				

					$id_data = explode('~',$value->id);
					$feature_id	= $id_data[0];
					$type = $id_data[1];
					$type_value = 'Custom Link';
					
					if($type == 'pg'){
						$type_value = 'Page';
					}else if($type == 'ct'){
						$type_value = 'Categories';
					}
					$menu_name	= $id_data[2];
					
					
					$menu_detail = $menu_mod->get_menu_data($feature_id);
					
					$menu_ul .= '<li class="dd-item" id="li_id_' . $feature_id. '"  data-id="' . $value->id . '" >';
					
					$menu_ul .=  '<div class="dd-handle togle_head" >' . $menu_name . '</div>';
						if(isset($value->children)){
							$menu_ul .= $this->build_menu($value,'c');
						}
					$menu_ul .= '<div class="panel-tools"><a class="btn btn-xs collapses" href="javascript:void(0)" onclick="expand_collaps(\'' . $feature_id . '\',\'' . $feature_id . '\',\'' . $menu_detail['name']. '\',\'' . $menu_name . '\')" >' . $type_value . '</a></div></li>
					';
				
				
			}
		$menu_ul .= '</ol>';
		}
		return $menu_ul;
		
	}

	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/	

	function actionSearch_menu(){
		
		$search_value = $_GET['q'];
		$data['search_result'] = menu_mod::model()->search_menu($search_value);
		$this->renderPartial('menu_search_result',$data);

	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/		
	function actionCreate_menu_save(){
		$data = $_POST;
		$menu_mod = new TblCoreMenus();
		$menu_id = $menu_mod->create_menu_save($data,'F');

//		Yii::$app->user->setFlash('menu_update', 'Menu successfully added.');
//		$this->redirect(array('/core/menu_builder/main/&menu_id=' . $menu_id));
        return $this->redirect(['main', 'menu_id' => $menu_id]);
	}
	
	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/		
	public function actionFeatures_add_to_menus_save()
	{
 		$data = $_POST;
		$menu_id = $data['menu_id'];
		$menu_mod = new TblCoreMenus();
		$menu_mod->features_add_to_menus_save($data);
//		Yii::$app()->user->setFlash('menu_update', 'Features added into menu successfully.');
		return $this->redirect(['main', 'menu_id' => $menu_id]);
		

	}	

	/**
	* Funciton main
	* This function display Control Panel Section
	* @param  
	* 
	* @return voild
	*/		
	public function actionSave_menu_custom()
	{
 		$data = $_POST;
		$menu_id = $data['menu_id'];

		$menu_id 	=	$data['menu_id'];

		$menu_data_r  =	TblCoreMenus::findOne($menu_id);
		$menu_data_old = $menu_data_r['menu_data'];
		
		$menu_data_old = json_decode($menu_data_old,true);

			$id = uniqid();
			$dl  = '~';
			$value = $id . $dl . 'cl' . $dl . $data['menu_name'] . $dl . $data['url'];
			$menu_data_old[]['id']	=	$value;	
		
		
		$menu_data = json_encode($menu_data_old);

		$menu_data_r->menu_data = $menu_data;
		$menu_data_r->save();


		//return $this->redirect(['main', 'menu_id' => $menu_id]);
		

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



		
	public function actionUpdate_menu()
	{
		if (isset($_POST['sortable'])) {
           $menu_id =  $_POST['menu_id'];
		   $menu_data =  $_POST['sortable'];
		   $menu_name = $_POST['menu_name'];
		   
			$update_array = array(
				
				'menu_data' => $menu_data,
			);
			


			$q = (new \yii\db\Query());
			$q = $q->createCommand();
			$q->update('tbl_core_menus',$update_array,'id = :id', array(':id' => $menu_id))->execute();


        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */