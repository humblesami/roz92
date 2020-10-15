<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use backend\modules\core\models\User;
use backend\modules\core\models\TblCoreMenus;
use backend\modules\core\models\TblCoreModules;
use backend\modules\core\models\TblCoreMasterSetup;

class LeftBar extends Widget{
	public $position	=	array();
	public $menu_ids		=	array();
	private $role_id  = 0;
	public $xclass = 'nav navbar-nav';
    public function init(){
            // add your logic here
    }
    public function run(){
		
		
		$position = $this->position;
		$menu_ids	=	$this->menu_ids;
		$xclass = $this->xclass;
		$user_id	=	Yii::$app->user->getId();
		$user_data	=	User::findOne($user_id);
		if($this->menu_ids != ""){
			$menu_id = $this->menu_ids;
		}else{
			$menu_id	=	$user_data['menu_id'];
		}

		$this->role_id  =      (isset($user_data) && $user_data['role_id'] != '') ? $user_data['role_id'] : 0;

		//$this->role_id	=	($user_data['role_id'] != '') ? $user_data['role_id'] : 0;
		
		
		//$menu_id = 10;
		$menu_data = '';
		

		if(TblCoreMenus::findOne($menu_id)){
			$menu_data = TblCoreMenus::findOne($menu_id)->menu_data;
		}

	
        $uri_segment1 = Yii::$app->controller->id;

        $classs = Yii::$app->controller->id;
        $methodd = Yii::$app->controller->action->id;
		$data['menu_data'] = "";		
		if($menu_data){
			//if($classs == "cpanel" or $classs == "master_setup"){
				//$data['menu_data'] = $this->build_cpanel_menu();
			//}else if($role_id == 0){
			
				$data['menu_data'] = $this->build_menu($menu_data,'p');
			
		}		
		
            return $this->render('leftbar',$data);
    }
	
	
	function build_cpanel_menu(){
		
		$position = $this->position;
		$mclass = 'class="main-navigation-menu"';
		
		if($position == "top"){
			$mclass = 'class="' . $this->xclass . '"';
		}
		
		$menu_ul = '<ul ' . $mclass . '>';
		$menu_ul .= '<li>';
		$menu_ul .= '<a href="javascript:void(0)">';
		$menu_ul .= '<i class="clip-home-3"></i>';
		$menu_ul .=  '<span class="title">Master Setup</span>';
		$menu_ul .=  '<i class="icon-arrow"></i>';
		$menu_ul .= '</a>';			
		$menu_ul .= '<ul class="sub-menu">';
		$module_list =	TblCoreModules::find()->all();;
		
		foreach($module_list as $m_row){
			$menu_ul .= '<li>';
			$menu_ul .= '<a href="javascript:void(0)">';
			$menu_ul .=  '<span class="title">' . $m_row->module_name . '</span>';
			$menu_ul .=  '<i class="icon-arrow"></i>';										
			$menu_ul .= '</a>';
			$menu_ul .= '<ul class="sub-menu">';
			$master_setup_list = TblCoreMasterSetup::find()->where(['module_id' =>  $m_row->module_id]);
			
			foreach($master_setup_list as $row){
				$menu_ul 	.= '<li>';
				$menu_ul .= '<a href="' . Yii::app()->urlManager->createUrl('/core/master_setup/entry_form/master_setup_id') . "/" .  $row['master_setup_id'] . '">';
				$menu_ul .=  '<span class="title">' . $row['master_setup_name'] . '</span>';
				$menu_ul	.=	'</a>';
				$menu_ul	.=	'</li>';
			}
			$menu_ul .= '</ul>';
			$menu_ul  .= '</li>';
		}
		$menu_ul .= '</ul>';
		$menu_ul .= '</li>';
			

													
		$menu_ul .= '</ul>';
		return $menu_ul;
		
	}	
	
	function build_menu($menu_data_row,$parent_child){
       	$controller = Yii::$app->controller->id;
	  	$module = "";
		
		if(isset(Yii::$app->controller->module->id)){
			$module = Yii::$app->controller->module->id;
		}
		
       	$method = Yii::$app->controller->action->id;												
		$cur_url = $module ."/" . $controller ."/". $method;
		$position = $this->position;
		$mclass = 'class="sub-menu"';
		
		if($position == "top"){
			$mclass = 'class="dropdown-menu"';
		}
			
		if($parent_child == "p"){
			$menu_data_row = json_decode($menu_data_row);
			$mclass = 'class=""';
			$position = $this->position;

			if($position == "top"){
				$mclass = 'class="' . $this->xclass . '"';
				//$mclass = 'class="nav nav-tabs1"';
			}else{
				$mclass = 'class="main-navigation-menu"';
			}				
		}
		
		if($parent_child == "c"){
			$menu_data_row = $menu_data_row->children;
		}
		
		$menu_ul = '<ul ' . $mclass . '>';

        foreach($menu_data_row as $key => $value){
			$feature_id_data = explode("~",$value->id);


			$feature_id = $feature_id_data[0];
			if(count($feature_id_data) > 1)
			{
				$type = $feature_id_data[1];
			}
			if(count($feature_id_data) > 2)
			{
				$d_menu_name = $feature_id_data[2];
			}

			$menu_detail = $this->get_menu_data($feature_id);

			//if($menu_detail['enable_disable'] == 'E') {
             //   if ($cur_url == $menu_detail['url']) {
              //      $menu_ul .= '<li class="active">';
              // } else {
                    $menu_ul .= '<li>';
             //  }

                if (isset($value->children)) {
                    if ($position == "left" or $position == "left_setting") {
                        $menu_ul .= '<a href="javascript:void(0)">';
                    } else {
                        $menu_ul .= '<a href="javascript:void(0)" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">';
                    }
                } else {
                    $murl = '';

                    if($type == 'cl'){
                    	$murl = $feature_id_data[3];
                    	
                    }else if($type == 'pg'){

                    	$cat = \yeesoft\page\models\Page::findOne($feature_id);
                    	$murl = '/' . $cat->slug;

                    	
                    }else if($type == 'ct'){	
                    	$cat = \yeesoft\post\models\Category::findOne($feature_id);
                    	$murl = '/category/' . $cat->slug;
                    }
                    $menu_ul .= '<a href="' . $murl . '">';
                }

                if ($parent_child == "p") {
                    if ($position == "left" or $position == "left_setting") {
                        $menu_ul .= ' <i class="' . $menu_detail['icon_class'] . '"></i>';
                    }
                }

                if ($position == "left" or $position == "left_setting") {
                    $menu_ul .= '<span class="title">' . $d_menu_name . '</span>';
                } else {
                    $menu_ul .= $d_menu_name;
                }

                if (isset($value->children)) {
                    if ($position == "left" or $position == "left_setting") {
                        $menu_ul .= ' <i class="icon-arrow"></i>';
                    } else {
                        $menu_ul .= ' <i class="fa fa-angle-down"></i>';
                    }
                }
                $menu_ul .= '</a>';

                if (isset($value->children)) {
					
                    $menu_ul .= $this->build_menu($value, 'c');
                }
                $menu_ul .= '</li>';
           // }
		}
		$menu_ul .= '</ul>';
		return $menu_ul;
		
	}		
	function build_menu2($menu_data_row,$parent_child){
       	$controller = Yii::$app->controller->id;
	  	$module = "";
		
		if(isset(Yii::$app->controller->module->id)){
			$module = Yii::$app->controller->module->id;
		}
		
       	$method = Yii::$app->controller->action->id;												
		$cur_url = $module ."/" . $controller ."/". $method;
		$position = $this->position;
		$mclass = 'class="sub-menu"';
		
		if($position == "top"){
			$mclass = 'class="dropdown-menu"';
		}
			
		if($parent_child == "p"){
			$menu_data_row = json_decode($menu_data_row);
			$mclass = 'class="main-navigation-menu"';
			$position = $this->position;

			if($position == "top"){
				$mclass = 'class="nav navbar-nav"';
				//$mclass = 'class="nav nav-tabs1"';
			}				
		}
		
		if($parent_child == "c"){
			$menu_data_row = $menu_data_row->children;
		}
		
		$menu_ul = '<ul>';
		
		foreach($menu_data_row as $key => $value){
			$feature_id_data = explode("~",$value->id);
			$feature_id = $feature_id_data[0];
			$d_menu_name = $feature_id_data[2];

			$menu_detail = $this->get_menu_data($feature_id);
			if($cur_url ==  $menu_detail['url']){
				$menu_ul .= '<li class="active">';
			}else{
				$menu_ul .= '<li class="bdrbtm first">';
			}
			
			if(isset($value->children)){
				if($position == "left" or $position == "left_setting"){
					$menu_ul .= '<a href="javascript:void(0)">';
				}else{
					$menu_ul .= '<a href="javascript:void(0)" clsass="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">';							
				}
			}else{
				$murl = Yii::$app->urlManager->createUrl($menu_detail['url']);
				$menu_ul .= '<a href="' . $murl . '" class="animated zoomInLeft" ><i class="icon-my-folders"></i>';
			}
			
			if($parent_child == "p"){
				if($position == "left" or $position == "left_setting"){
					$menu_ul .= ' <i class="icon-my-folders"></i>';
				}
			}
			
			if($position == "left" or $position == "left_setting"){
				$menu_ul .=  '<span class="title">' . $d_menu_name . '</span>';
			}else{
				$menu_ul .=   $d_menu_name;
			}
			
			if(isset($value->children)){
				if($position == "left" or $position == "left_setting"){
					$menu_ul .=  ' <i class="icon-arrow"></i>';
				}else{
					$menu_ul .= ' <i class="fa fa-angle-down"></i>';
				}
			}
			$menu_ul .= '</a>';
			
			if(isset($value->children)){
				$menu_ul .= $this->build_menu($value,'c');
			}
			$menu_ul .= '</li>';
		}
		$menu_ul .= '</ul>';
		return $menu_ul;
		
	}	
	
	function get_menu_data($featured_id){

		$q = (new \yii\db\Query())
		->select('f.*, ic.icon_class')
		->from('tbl_core_module_features f')
		
		->leftJoin('tbl_core_icon ic','ic.icon_id = f.menu_icon')
		->where('f.id = :id', array(':id' => $featured_id));
		$command = $q->createCommand();
		$rows = $command->queryOne();		
		return $rows;

	}		
}
?>
