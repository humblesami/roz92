<?php

namespace backend\modules\core\models;
use Yii;
use backend\modules\core\models\TblCoreModules;
/**
 * This is the model class for table "tbl_core_module_features".
 *
 * @property integer $id
 * @property integer $module_id
 * @property integer $feature_parent_id
 * @property string $name
 * @property string $menu_name
 * @property string $desc
 * @property string $url
 * @property string $controller_param
 * @property string $javascript_base
 * @property string $javascript_function
 * @property integer $menu_icon
 * @property integer $menu_order
 * @property integer $created_by
 * @property string $type
 * @property string $datetime
 * @property integer $status
 * @property string $feature_for
 * @property string $repeat_function
 * @property string $feature_display
 *
 * @property TblCoreModules $module
 */
class TblCoreModuleFeatures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_module_features';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'feature_parent_id', 'menu_icon', 'menu_order', 'created_by', 'status'], 'integer'],
            [['feature_parent_id', 'controller_param', 'javascript_function', 'menu_order', 'type'], 'required'],
            [['desc', 'javascript_base', 'type', 'feature_for', 'repeat_function', 'feature_display'], 'string'],
            [['datetime'], 'safe'],
            [['name', 'controller_param'], 'string', 'max' => 255],
            [['menu_name'], 'string', 'max' => 150],
            [['url', 'javascript_function'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_id' => 'Module ID',
            'feature_parent_id' => 'Feature Parent ID',
            'name' => 'Name',
            'menu_name' => 'Menu Name',
            'desc' => 'Desc',
            'url' => 'Url',
            'controller_param' => 'Controller Param',
            'javascript_base' => 'Javascript Base',
            'javascript_function' => 'Javascript Function',
            'menu_icon' => 'Menu Icon',
            'menu_order' => 'Menu Order',
            'created_by' => 'Created By',
            'type' => 'Type',
            'datetime' => 'Datetime',
            'status' => 'Status',
            'feature_for' => 'Feature For',
            'repeat_function' => 'Repeat Function',
            'feature_display' => 'Feature Display',
        ];
    }
	
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$this->created_by = Yii::$app->user->getId();
			// Place your custom code here
	
			return true;
		} else {
			return false;
		}
	}	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(TblCoreModules::className(), ['id' => 'module_id']);
    }
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */	
	public function feature_list($module_id,$f_type)
	{
		
		$q = (new \yii\db\Query())
		->select('f.*, ic.icon_class')
		->from('tbl_core_module_features f')
//		->leftJoin('tbl_core_modules m','m.id = f.module_id')
		->leftJoin('tbl_core_icon ic','ic.icon_id = f.menu_icon')
		//->leftJoin('tbl_core_module_features f2','f2.id = f.feature_parent_id')
		->where('f.status = 1')
		->andWhere('f.type = "ft"')
		->andWhere('f.feature_parent_id	 = "0"')
		->andWhere('f.module_id = :module_id', array(':module_id' => $module_id))
		->andWhere('f.feature_display = :feature_display', array(':feature_display' => $f_type));
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}	
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */		
	public function edit_by_id($edit_id)
	{
		 $q = (new \yii\db\Query())
		 ->select('f.*, m.name as module_name')
		 ->from('tbl_core_module_features f')
		 ->leftJoin('tbl_core_modules m','m.id = f.module_id')
		 ->where('f.id = :id', array(':id' => $edit_id));
		$command = $q->createCommand();
		$rows = $command->queryOne();		
		return $rows;

	}	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */		
	public function sub_feature_list($feature_id)
	{
		$q = (new \yii\db\Query())
		->select('f.*')
		->from('tbl_core_module_features f')
		->where('f.status = 1')
		->andWhere('f.feature_parent_id = :feature_parent_id', array(':feature_parent_id' => $feature_id));
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}		
	
	/* 
		funciton_list List
	*/	
	public function sub_function_list($feature_id)
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
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */	
	
	public function feature_list_dropdown()
	{
		$q = (new \yii\db\Query())
		->select('f.*, f2.name as feature_parent_name')
		->from('tbl_core_module_features f')
		->leftJoin('tbl_core_module_features f2','f2.id = f.feature_parent_id')
		->where('f.status = 1');
		$command = $q->createCommand();
		$rows = $command->queryAll();		
		return $rows;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */	
	
	public function menu_feature_list($feature_id)
	{
		$q = (new \yii\db\Query())
		->select('m.*, f.menu_id')
		->from('tbl_core_menus m')
		->leftJoin('tbl_core_menus_features f','f.menu_id = m.id and f.feature_id = :feature_id',array(':feature_id' => $feature_id));
		$command = $q->createCommand();
		$rows = $command->queryAll();	
		
		return $rows;
	}		
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */	
	public function save_sub_feature($post_data)
	{
		$input_save = array(
			'module_id' 			=>  $post_data['hidden_m_id'],
			'name' 					=>  $post_data['name'],
			'feature_parent_id' 	=>  $post_data['hidden_f_parent_id'],
			'menu_name' 			=>  $post_data['menu_name'],
			'desc' 					=>  $post_data['desc'],
			'url' 					=>  $post_data['url'],
			'controller_param' 		=>  $post_data['controller_param'],
			'javascript_base' 		=>  $post_data['javascript_base'],
			'javascript_function' 	=>  $post_data['javascript_function'],
			'type' 					=>  $post_data['hidden_type'],
			'repeat_function' 		=>  $post_data['repeat_function'],
			
			'created_by' 			=> 	Yii::$app->user->getId(),
		);

		$q = (new \yii\db\Query());
		$q = $q->createCommand();
		$q->insert('tbl_core_module_features',$input_save)->execute();

	}	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */		
	public function save_feature($post_data)
	{
		//var_dump($post_data);
		//die();
		$input_save = array(
			'module_id' 			=>  $post_data['module_id'],
			'name' 					=>  $post_data['name'],
			'feature_parent_id' 	=>  $post_data['feature_parent_id'],
			'desc' 					=>  $post_data['desc'],
			'url' 					=>  $post_data['url'],
			'controller_param' 		=>  $post_data['controller_param'],
			'javascript_base' 		=>  $post_data['javascript_base'],
			'javascript_function' 	=>  $post_data['javascript_function'],
			'created_by' 			=> 	Yii::$app->user->getId(),
			'feature_display' 		=> 	$post_data['feature_display'],
		);

		$q = (new \yii\db\Query());
		$q = $q->createCommand();
		$q->insert('tbl_core_module_features',$input_save)->execute();
		
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */		
	public function delete_feature($feature_id)
	{
		$update_array = array(
			'status' => 0
		);


		$q = (new \yii\db\Query());
		$q = $q->createCommand();
		$q->update('tbl_core_module_features',$update_array,'id = :id', array(':id' => $feature_id))->execute();
	}				
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return feature_mod the static model class
	 */		
	
	public function save_sub_feature_edit_data($post_data)
	{
        $g_report = 0;
        if(isset($post_data['group_reports'])){
            $g_report = $post_data['group_reports'];
        }

        $input_save = array(
            'name' 					=>  $post_data['name'],
            'feature_parent_id' 	=>  $post_data['feature_parent_id'],
			'menu_name' 			=>  $post_data['name'],
			'desc' 					=>  $post_data['desc'],
			'url' 					=>  $post_data['url'],
			'controller_param' 		=>  $post_data['controller_param'],
			'javascript_base' 		=>  $post_data['javascript_base'],
			'javascript_function' 	=>  $post_data['javascript_function'],
			'created_by' 			=> 	Yii::$app->user->getId(),
            'feature_display' 		=>  $post_data['feature_display'],
            'group_reports' 		=>  $g_report,
            'enable_disable' 		=>  $post_data['enable_disable'],
            'type' 		            =>  $post_data['type'],
		);


		$q = (new \yii\db\Query());
		$q = $q->createCommand();
		$q->update('tbl_core_module_features',$input_save,'id = :id', array(':id' => $post_data['hidden_id']))->execute();
		
		
	}	
	
}
