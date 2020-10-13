<?php

namespace backend\modules\core\models;
use backend\modules\build_content\models\TblCntUnit;
use Yii;

/**
 * This is the model class for table "tbl_core_master_setup".
 *
 * @property integer $master_setup_id
 * @property integer $module_id
 * @property string $master_setup_name
 * @property string $tbl_name
 * @property integer $created_by
 * @property string $status_id
 * @property string $master_setup_value
 */
class TblCoreMasterSetup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_master_setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'master_setup_name', 'tbl_name'], 'required'],
            [['module_id', 'created_by'], 'integer'],
            [['master_setup_value'], 'string'],
            [['master_setup_name', 'tbl_name'], 'string', 'max' => 50],
            [['status_id'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'master_setup_id' => 'Master Setup ID',
            'module_id' => 'Module ID',
            'master_setup_name' => 'Master Setup Name',
            'tbl_name' => 'Tbl Name',
            'created_by' => 'Created By',
            'status_id' => 'Status ID',
            'master_setup_value' => 'Master Setup Value',
        ];
    }
	
	
    /**
     * Save Master Entry
     */	
	public function update_save_entry($data=array(),$key_id){


        $master_setup_id 		= 	$data['master_setup_id'];

		$master_data			=	TblCoreMasterSetup::findOne($master_setup_id);

		$master_data_result		= 	json_decode($master_data->master_setup_value);
		$master_data_result		=	(array) $master_data_result;
		$mcount					=  count($master_data_result) ;

		$mcount = $mcount + 1;	
	
		// Check already exsist value
		
		foreach($data['field_id'] as $f_key => $f_value){
			$master_data_result[$key_id][$f_value] = $data['field_value'][$f_key];
			
		}
		$master_data_result[$key_id]['status'] = 1;
		$master_data_result[$key_id]['created_by'] = Yii::$app->user->getId();
		$master_data_result[$key_id]['datetime'] = date('Y-m-d H:i:s');
		

		$master_data			=  json_encode($master_data_result);		

		$update_data = array(
		
			'master_setup_value' => $master_data,
		);
		
		$c = (new \yii\db\Query());
		$c = $c->createCommand();			
		$c->update('tbl_core_master_setup', $update_data, 'master_setup_id = :master_setup_id', array(':master_setup_id' => $master_setup_id))->execute();

		
		
	}	
    /**
     * Save Master Entry
     */	
	public function save_entry($data=array()){


        $master_setup_id 		= 	$data['master_setup_id'];

		$master_data			=	TblCoreMasterSetup::findOne($master_setup_id);

		$master_data_result		= 	json_decode($master_data->master_setup_value);
		$master_data_result		=	(array) $master_data_result;
		$mcount					=   key( array_slice( $master_data_result, -1, 1, TRUE ) ); //count($master_data_result) ;

		$mcount = $mcount + 1;	
	
		// Check already exsist value
		
		foreach($data['field_id'] as $f_key => $f_value){
			$master_data_result[$mcount][$f_value] = $data['field_value'][$f_key];
			
		}
		$master_data_result[$mcount]['status'] = 1;
		$master_data_result[$mcount]['created_by'] = Yii::$app->user->getId();
		$master_data_result[$mcount]['datetime'] = date('Y-m-d H:i:s');
		

		$master_data			=  json_encode($master_data_result);		

		$update_data = array(
		
			'master_setup_value' => $master_data,
		);
		
		$c = (new \yii\db\Query());
		$c = $c->createCommand();			
		$c->update('tbl_core_master_setup', $update_data, 'master_setup_id = :master_setup_id', array(':master_setup_id' => $master_setup_id))->execute();

		
			
	}
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function make_data($data)
	{
		$data = json_decode($data);
		$data_array = array();
		if($data){
			foreach($data as $key => $value)
			{
				if($value->status != 0){
					$data_array[$key] = ucfirst($value->value);
				}
			}
		}
		return $data_array;
	}

	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	*
	* @return voild
	*/
	public function make_group_data($data)
	{
		$data = json_decode($data);
		$data_array = array();
		if($data){
			foreach($data as $key => $value)
			{
				if($value->status != 0){
					$data_array[$value->group_label][$key] = ucfirst($value->value);
				}
			}
		}
		return $data_array;
	}
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function create_diemension($data,$key)
	{

		$diemension = '';
		if($data != ''){
			if($data['h'] != '' or $data['w'] != '' or $data['d'] != ''){
				$diemension = $data['h'] . ' ' . $data[$key . 'h_dtype'] . ' x ' . $data['w'] . ' ' . $data[$key . 'w_dtype'] . ' x ' . $data['d'] . ' ' . $data[$key . 'd_dtype'];
			}
		}
		return $diemension;
	}
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function shipping_diemension($data)
	{
	
		
		$shipping_html = '<table class="table">';
		$shipping_html .= '<thead><tr><th>Item #</th><th>Description</th><th>Diemention</th></tr>';
		foreach($data as $key => $value){
			$shipping_html .=  '<tr><td>' .$value['item_no'] . '</td><td>' . $value['description'] .'</td><td>' . $this->create_diemension($value['shipping_diemention'],'') . '</td></tr>';
		}
		$shipping_html .= '</table>';
		return $shipping_html;
	}	
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function shipping_weight($data)
	{
		
		
		$shipping_html = '<table class="table">';
		$shipping_html .= '<thead><tr><th>Item #</th><th>Description</th><th>Weight</th></tr>';
		foreach($data as $key => $value){
			$shipping_html .=  '<tr><td>' .$value['item_no'] . '</td><td>' . $value['description'] .'</td><td>' . $this->create_weight($value['weight_amount'],$value['weight_type']) . '</td></tr>';
		}
		$shipping_html .= '</table>';
		return $shipping_html;
	}		
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function create_weight($weight_amount,$weight_type)
	{

		$weight = '';
		if($weight_amount != ''){
			$unit_data = TblCntUnit::findOne($weight_type);
			$unit = $unit_data['name'];
			$weight = $weight_amount . ' ' . $unit;
		}
		return $weight;
	}	
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function multiple_pieces($value,$assembly)
	{

		
		if($value == 'Yes'){
			$value = $value . ', Required Assembly: ' . $assembly;
		}
		return $value;
	}	
	
	/**
	* Funciton make_data
	* This function display Dashboards
	* @param  $data
	* 
	* @return voild
	*/	
	public function getValue($id,$table)
	{
		$value = '';
		if($id != ''){
			$table_data = TblCoreMasterSetup::find()->where(['tbl_name' => $table])->One()->master_setup_value;
			$table_data	=	json_decode($table_data,true);	
			
			$value =  $table_data[$id]['value'];
		}
		return $value;
	}				
	
	
}
