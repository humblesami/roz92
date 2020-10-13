<?php

namespace backend\modules\core\models;

use Yii;
use backend\modules\core\models\TblCoreModules;
/**
 * This is the model class for table "tbl_core_menus".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $created_by
 * @property string $datetime
 * @property integer $status_id
 * @property string $menu_data
 */
class TblCoreMenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'menu_data'], 'string'],
            [['created_by', 'status_id'], 'integer'],
            [['datetime'], 'safe'],
            [['menu_data'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'created_by' => 'Created By',
            'datetime' => 'Datetime',
            'status_id' => 'Status ID',
            'menu_data' => 'Menu Data',
        ];
    }
	
	/* 
		Module Feature for menu
	*/
   public function list_modules_features_for_menu($menu_id)
    {
        
        $modules_features = array();
        $i=0;
        $modules_query = TblCoreModules::find()->all();
        foreach ($modules_query as $module) {

            $j=0;
            $features_query=$this->list_features_of_a_module($module['id']);
            foreach ($features_query as $feature) {
                
				$modules_features[$i]['features'][$j]['info'] = $feature;
				$menu_feature_query=$this->list_feature_info_for_a_menu($menu_id,$feature['id']);
				$menu_feature = $menu_feature_query;
				if(count($menu_feature) == 0)
				{
					$menu_feature[0]['assigned_id']=0;
				}
				$modules_features[$i]['features'][$j]['permissions'] = $menu_feature[0];
				$j++;
            }
            
            if(isset($modules_features[$i]['features'])>0) {
                $modules_features[$i]['module_name']=$module['name'];
                $modules_features[$i]['module_id']=$module['id'];
                $i++;
            }
            
            
        }
                 
        return $modules_features;

    }	
	
	/*
		*  customer save
	*/
    function features_add_to_menus_save($data=array())
    {
		$menu_id 	=	$data['menu_id'];

		$menu_data_r				=	TblCoreMenus::findOne($menu_id);
		$menu_data_old = $menu_data_r['menu_data'];
		
		$menu_data_old = json_decode($menu_data_old,true);

		foreach($data['menu_sel'] as $key => $value){
			
			$menu_data_old[]['id']	=	$value;	
		}
		
		$menu_data = json_encode($menu_data_old);
		
		$update_array = array(
			'menu_data' => $menu_data,
		);

		$c = (new \yii\db\Query());
		$c = $c->createCommand();
		$c->update('tbl_core_menus',$update_array,'id = :id', array(':id' => $menu_id))->execute();
		
	}		
	
	/* 
		save_edit
	*/
    function list_features_of_a_module($module_id)
    {
		 $q = (new \yii\db\Query())
		 ->select('id,name,url,feature_display')
		 ->from('tbl_core_module_features')
		 ->where('module_id = :module_id', array(':module_id' => $module_id))
		 ->andWhere('type = "ft"');
		 //->order('datetime', 'DESC');
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
    }
	
	
	/* 
		save_edit
	*/
    function all_parent_ids($store_id,$category_id)
    {
		 $q = (new \yii\db\Query())
		 ->select('id')
		 ->from('tbl_cnt_category')
		 ->where('id = :category_id', array(':category_id' => $category_id));
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
    }			
	
	/* 
		save_edit
	*/	
    function list_feature_info_for_a_menu($menu_id,$feature_id)
    {
		   $q = (new \yii\db\Query())
		   ->select('feature_id as assigned_id')
		   ->from('tbl_core_menus_features')
		   ->andWhere('menu_id = :menu_id', array(':menu_id' => $menu_id))
		   ->andWhere('feature_id = :feature_id', array(':feature_id' => $feature_id));
		  // ->order('datetime', 'DESC');
			$command = $q->createCommand();
			$rows = $command->queryAll();		
			return $rows;
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
	
	function menu_sub_feature_list($feature_id){
		$q = (new \yii\db\Query())
		->select('f.*,f.id as feature_id')
		->from('tbl_core_module_features f')
		->where('f.feature_parent_id = :feature_id', array(':feature_id' => $feature_id));
			$command = $q->createCommand();
			$rows = $command->queryAll();		
			return $rows;
	}	
	function menu_feature_list($menu_id){
		$q = (new \yii\db\Query())
		->select('f.name,mf.*')
		->from('tbl_core_menus_features mf')
		->join('join','tbl_core_module_features f','f.id = mf.feature_id')
		->where('mf.menu_id = :menu_id', array(':menu_id' => $menu_id));
			$command = $q->createCommand();
			$rows = $command->queryAll();		
			return $rows;
	}			
	
	/* 
		save_edit
	*/		
	function create_menu_save($data=array(),$type='F'){

		$insert_array = array(
			'name' => $data['new_menu_name'],
			'type' => $type,
			'created_by' => Yii::$app->user->getId(),
		);		

		$q = (new \yii\db\Query());
		$q = $q->createCommand();

		$q->insert('tbl_core_menus',$insert_array)->execute();
		$id = Yii::$app->db->getLastInsertID();	
		return $id;
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
				

					$id_data = explode('_',$value->id);
					$feature_id	= $id_data[0];
					$menu_name	= $id_data[1];
					
					
					$menu_detail = $menu_mod->get_menu_data($feature_id);
					
					$menu_ul .= '<li class="dd-item" id="li_id_' . $feature_id. '"  data-id="' . $feature_id . '_' . $menu_name . '" >';
					
					$menu_ul .=  '<div class="dd-handle togle_head" >' . $menu_name . '</div>';
						if(isset($value->children)){
							$menu_ul .= $this->build_menu($value,'c');
						}
					$menu_ul .= '<div class="panel-tools"><a class="btn btn-xs" href="javascript:void(0)" onclick="expand_collaps(' . $feature_id . ',' . $feature_id . ',\'' . $menu_detail['name']. '\',\'' . $menu_name . '\')" ><i class="material-icons">expand_more</i></a></div></li>
					';
				
				
			}
		$menu_ul .= '</ol>';
		}
		return $menu_ul;
		
	}
	
}
