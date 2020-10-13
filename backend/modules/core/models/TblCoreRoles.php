<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_roles".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $dashboard_id
 * @property integer $menu_id
 * @property integer $created_by
 * @property string $datetime
 * @property integer $status_id
 */
class TblCoreRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['dashboard_id', 'menu_id'], 'required'],
            [['dashboard_id', 'menu_id', 'created_by', 'status_id'], 'integer'],
            [['datetime'], 'safe'],
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
            'dashboard_id' => 'Dashboard ID',
            'menu_id' => 'Menu ID',
            'created_by' => 'Created By',
            'datetime' => 'Datetime',
            'status_id' => 'Status ID',
        ];
    }
	
	/* 
		Feature List
	*/	
	public function assigned_parent_feature($role_id)
	{
		$q = (new \yii\db\Query())
		->select('f.*')
		->from('tbl_core_module_features f')
		->leftjoin('tbl_core_roles_features rf', 'rf.feature_id = f.id and rf.role_id = :role_id',array(':role_id' => $role_id))
		->where('f.feature_parent_id = 0')
		->andWhere('f.status = 1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}		
	
	/* 
		Feature List
	*/	
	public function feature_list($module_id)
	{
		$q = (new \yii\db\Query())
		->select('*')
		->from('tbl_core_module_features')
		->where('module_id = :module_id', array(':module_id' => $module_id))
		->andWhere('feature_parent_id = 0')
		->andWhere('status =  1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}		
	
	/* 
		check_data
	*/	
	public function check_data($feature_id, $role_id)
	{
		$q = (new \yii\db\Query())
		->select('id')
		->from('tbl_core_roles_features')
		->where('feature_id = :feature_id', array(':feature_id' => $feature_id))
		->andWhere('role_id = :role_id', array(':role_id' => $role_id))
		->andWhere('view = 1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		

		
		if(count($rows) == 0){
			return false;	
		}
		return true;
	}			
	
	
	/* 
		funciton_list List
	*/	
	public function sub_feature_list($feature_id)
	{
		$q = (new \yii\db\Query())
		->select('f.*')
		->from('tbl_core_module_features f')
		->where('f.feature_parent_id = :feature_parent_id', array('feature_parent_id' => $feature_id))
		->andWhere('f.type = "ft"')
		->andWhere('f.status = 1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		

		

		return $rows;
	}	
	/* 
		funciton_list List
	*/	
	public function funciton_list($feature_id)
	{
		$q = (new \yii\db\Query())
		->select('f.*')
		->from('tbl_core_module_features f')
		->where('f.feature_parent_id = :feature_parent_id', array(':feature_parent_id' => $feature_id))
		->andWhere('f.type = "fn"')
		->andWhere('f.status = 1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}		
	
	/* 
		save_edit
	*/		
	function create_role_save($data=array()){
		$q = (new \yii\db\Query());
		$q = $q->createCommand();

		$insert_array = array(
			'name' => $data['name'],
			'desc' => $data['desc'],
			'created_by' => Yii::$app->user->getId(),
		);


		$q->insert('tbl_core_roles', $insert_array)->execute();
		$id = Yii::$app->db->getLastInsertID();		
		echo $id;
	}

    /*
        Role Update
    */
    function update_role($data=array()){
        $q = (new \yii\db\Query());
        $q = $q->createCommand();
        $store_access = [];
        if(isset($data['store_access'])) {
            $store_access = $data['store_access'];
        }

        $role_id    = $data['role_id'];
        $store_access   =   json_encode($store_access);
        $insert_array = array(
            'name' => $data['name'],
            'desc' => $data['desc'],
            'portal_name' => $data['portal_name'],
            'store_access' => $store_access,

        );


        $q->update('tbl_core_roles', $insert_array,'id = ' . $role_id)->execute();


    }

    /*
        funciton_list List
    */
	function assing_role_save($data_value, $state){
		$data_value_array = explode("_",$data_value);
		$module_id	=	$data_value_array[0];
		$feature_id	=	$data_value_array[1];
		$role_id	=	$data_value_array[2];

		$q = (new \yii\db\Query())
		->select('*')
		->from('tbl_core_roles_features')
		->where('role_id = :role_id', array(':role_id' => $role_id))
		->andWhere('feature_id = :feature_id', array(':feature_id' => $feature_id))
		->andWhere('module_id = :module_id', array(':module_id' => $module_id));
		$command = $q->createCommand();
		$rows = $command->queryOne();		
		

		
		if(!$rows){

			$insert_array = array(
				'role_id' => $role_id,
				'module_id' => $module_id,
				'feature_id' => $feature_id,
				'view' => 0,
			);
			
			$c = (new \yii\db\Query());
			$c = $c->createCommand();			
			$c->insert('tbl_core_roles_features', $insert_array)->execute();
			$id = Yii::$app->db->getLastInsertID();

		}else{
				$id = $rows['id'];	
		}

		echo $id;
		
		$update_array = array(
			'view' => $state,
		);

		$c = (new \yii\db\Query());
		$c = $c->createCommand();			
		$c->update('tbl_core_roles_features',$update_array,'id = :id', array(':id' => $id))->execute();

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
					
					$menu_ul .=  '<div class="dd-handle togle_head" ><a href="javascript:void(0)" onclick="getFeatureDetail(' .  $feature_id . ')">' . $menu_name . '</a></div>';
						if(isset($value->children)){
							$menu_ul .= $this->build_menu($value,'c');
						}
					$menu_ul .= '</li>
					';
				
				
			}
		$menu_ul .= '</ol>';
		}
		return $menu_ul;
		
	}
	
	
	
}
