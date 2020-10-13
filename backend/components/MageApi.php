<?php
namespace backend\components;
use yii\base\Component;
use SoapClient;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: znaseem
 * Date: 2/18/16
 * Time: 12:51 PM
 */
class MageApi extends Component {
    var $urlPath = '';
    var $apiUser='';
    var $apiKey='';
    var $client='';
    var $session='';

    /*
     * Provide Magento Store's Api url and
     * Api User and key
     * @params
     * url = Mage Store SOAP Api URL
     * user = Mage SOAP Api User
     * key = Mage SOAP Api Key
     */
    public function __construct($url,$user,$key,$token=null,$api_version="soap"){

		$this->urlPath = $url.'/api/' . $api_version . '/?wsdl=1';
        $this->apiUser = $user;
        $this->apiKey = $key;
        $this->client = new SoapClient($this->urlPath, array('exceptions' => 0,'cache_wsdl' => WSDL_CACHE_NONE)); // set path to your Magento WSDL
        $this->session = $this->client->login($this->apiUser, $this->apiKey);
    }


    /*
     * Fetch Product Price from Magento Store
     * @param
     * sku = Single Product SKU
     */
    public function fetchPrice($sku){
		try{
        	$result = $this->client->call($this->session, 'catalog_product.info', array($sku) );
	        return array(
                    'name' => $result['name'],
                    'price' => $result['price'],
                    'url' => str_replace('/api/soap/?wsdl','',$this->urlPath).'/'.$result['url_path']
               );
			} catch(Exception $e){

				throw new CHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
			   
    }
	
    /*
     * Fetch Product detail
     * @param
     * sku = Single Product SKU
     */
    public function fetch_product($product_id){
		try{
        	$result  = $this->client->catalogProductInfo($this->session, $product_id);
	        return $result;
			} catch(Exception $e){

				throw new NotFoundHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
			   
    }

    /*
     * Fetch Product detail
     * @param
     * sku = Single Product SKU
     */
    public function fetch_product_customapi($sku){
        try{
        	$result  = $this->client->catalogProductCinfo($this->session, $sku);
	        return $result;
			} catch(Exception $e){
				throw new NotAcceptableHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
    }
	
    /*
     * Fetch Product detail
     * @param
     * sku = Single Product SKU
     */
    public function fetch_stock($product_id){
		try{

			$result = $this->client->catalogInventoryStockItemList($this->session, array($product_id));
	        return $result;
			} catch(Exception $e){

				throw new NotAcceptableHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
			   
    }	
		
    /*
     * Fetch Product Price from Magento Store
     * @param
     * sku = Single Product SKU
     */
    public function fetchProductByAttributes($attribute_id,$attribute_value){
		try{
        	

			
				$complexFilter = array(
					'complex_filter' => array(
						array(
							'key' => $attribute_id,
							'value' => array('key' => 'in', 'value' => $attribute_value)
						)
					)
				);			
//	        	$result = $this->client->call($this->session, 'catalog_product.list', '',$complexFilter );
				
			$result = $this->client->catalogProductList($this->session, $complexFilter);
				
				return $result;
			} catch(Exception $e){

				throw new CHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
			   
    }	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function fetchCategory(){
		try{
        	$result = $this->client->call($this->session, 'catalog_category.tree' );
	        return array(
                    'result' => $result,
               );
			} catch(Exception $e){

				throw new CHttpException(400,Yii::t('yii','Product does no exist'));
				//break;
			}
			   
    }
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function updateCategory($cate_data,$category_id){
		
        	$finalResult = array();
			$result = $this->client->call($this->session, 'catalog_category.update',array($category_id,$cate_data));
		    $finalResult[$category_id] = $result;
			return $finalResult;
			   
    }
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function moveCategory($category_id,$parent_id){
		
        	
			$result = $this->client->call($this->session, 'catalog_category.move', array('categoryId' => $category_id, 'parentId' => $parent_id));
		   
			return $result;
			   
    }	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function deleteCategory($cate_data,$category_id){
		
        	$result = $this->client->call($this->session, 'catalog_category.delete', $category_id);
			return $result;
			   
    }	
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function infoCategory($category_id){
		
        	$result = $this->client->call($this->session, 'catalog_category.info', $category_id);
			return $result;
			   
    }	
	
	
    /*
     * Create Category
     * @param
     * 
     */
    public function createCategory($cate_data,$parent_id){
		
        	$finalResult = array();
			$result = $this->client->call($this->session, 'catalog_category.create',array($parent_id,$cate_data));
		    
			return $result;
			   
    }		
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function attribute_info($attribute_code){
		
			
			$result = $this->client->call($this->session, 'product_attribute.info', $attribute_code);
			$attribute_id = $result['attribute_id'];
			return $attribute_id;
	        
			   
    }
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function createAttributeSet($attribute_set_name){
		
			$skeletonId = 4;			
			$result = $this->client->call($this->session, 'product_attribute_set.create', [$attribute_set_name,$skeletonId]);
			if(isset($result->faultcode)){
				
				$result_list = $this->client->call($this->session, 'catalog_product_attribute_set.list');
				foreach($result_list as $key => $value){
					if($value['name'] == $attribute_set_name){
						$attriubte_set_id = $value['set_id'];	
						break;
					}
				}
				
			}else{
				$attriubte_set_id = $result;	
			}
			
			
			
			return $attriubte_set_id;
	        
			   
    }	
	
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function createConfigProduct($type,$data=[],$attribute_set_id,$sku){
		
			
			$result = $this->client->call($this->session, 'product.create', array('configurable', $attribute_set_id, $sku, $data));
//			$result = $this->client->catalogProductCreate($this->session,$type,$attribute_set_id,$sku, $data);
			
			return $result;
	        
			   
    }
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function createSimpleProduct($type,$data=[],$attribute_set_id,$sku){
		
			
			$result = $this->client->catalogProductCreate($this->session,$type,$attribute_set_id,$sku, $data);
			//$result = $this->client->call($this->session, 'product.create', array($type, $attribute_set_id, $sku, $data));
			
			return $result;
	        
			   
    }
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function updateSimpleProduct($data=[],$attribute_set_id,$sku){
		
			$result = $this->client->catalogProductUpdate($this->session, $sku,$data);
			return $result;
	        
			   
    }	
	
	public function removeMedia($sku){
		$result = $this->client->call($this->session, 'catalog_product_attribute_media.list', $sku);
		if(!empty($result)){
			foreach ($result as $item){
				$removed = $this->client->call($this->session, 'catalog_product_attribute_media.remove', array('product' => $sku, 'file' => $item['file']));
			}
		}
	}
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function createMedia($image_url,$sku,$image_status,$base){
		
//		$image_url = 'https://www.urbandesign.pk/media/catalog/product/cache/1/small_image/430x404/9df78eab33525d08d6e5fb8d27136e95/1/9/19348_0.jpg';
       // $im = file_get_contents($image_url);
		
      //  $imdata = base64_encode($im);
	  $image_url = str_replace('/','_',$image_url);
		$file = array(
			'content' => $image_url,
			'mime' => 'image/jpeg',
			
		);
		if($base){
			$type = ['image','small_image','thumbnail'];
		} else{
			$type = [];
		}
		
		if($image_status == 'create'){
			$result = $this->client->call(
				$this->session,
				'catalog_product_attribute_media.create',
				array(
					$sku,
					array('file'=>$file, 'label'=>'', 'position'=>'2', 'types'=> $type, 'exclude'=>0)
				)
			);			
		}else{
			
			$result = [];		
		}

		return $result;
    }	
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function createMediaConfig($image_url,$sku,$image_status){
		
			
        $im = file_get_contents($image_url);
        $imdata = base64_encode($im); 			
		$file = array(
			'content' => $imdata,
			'mime' => 'image/jpeg'
		);
		if($image_status == 'create'){

			
			
			$result = $this->client->call(
				$this->session,
				'catalog_product_attribute_media.create',
				array(
					$sku,
					array('file'=>$file, 'label'=>'', 'position'=>'2', 'types'=>array('image','small_image','thumbnail'), 'exclude'=>0)
				)
			);			
		}else{
			
			$result = [];		
		}
		  
		var_dump($result);
    }	
		
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function CreateAttribute($attribute_data,$attribute_set_id){
		
			$attribute_code = $attribute_data['attribute_code'];
			$attribute_name = $attribute_data['attribute_name'];
			$field_type_id = $attribute_data['field_type_id'];
			$input_type = 'text';
			if($field_type_id == 1){
				$input_type = 'select';	
			}else if($field_type_id ==4){
				$input_type = 'multiselect';	
			}

			$result = $this->client->call($this->session, 'product_attribute.info', $attribute_code);
	
			if(isset($result->faultcode)){
				
				
				$data = array(
				   "attribute_code" => $attribute_code,
				   "frontend_input" => $input_type,
				   "scope" => "global",
				   "default_value" => "",
				   "is_unique" => 0,
				   "is_required" => 0,
				   "apply_to" => '',
				   "is_configurable" => 1,
				   "is_searchable" => 0,
				   "is_visible_in_advanced_search" => 0,
				   "is_comparable" => 0,
				   "is_used_for_promo_rules" => 0,
				   "is_visible_on_front" => 0,
				   "used_in_product_listing" => 0,
				   "additional_fields" => array(),
				   "frontend_label" => array(array("store_id" => "0", "label" => $attribute_name))
				  );
				
				$attribute_id = $this->client->call($this->session, 'product_attribute.create', array($data));

				
				
				
			}else{
				$attribute_id = $result;	
			}
			

			$result = $this->client->call(
				$this->session,
				"product_attribute_set.attributeAdd",
				array(
					 $attribute_id['attribute_id'],
					 $attribute_set_id
				)
			);			
			return $attribute_id;
	      
			
			   
    }
	
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function CreateAttributeDiff($attribute_data,$attribute_set_id,$diff_attr){
			
			$diff_code = '_d';
			if($diff_attr == 'filter'){
				$diff_code = '_f';
			}
		
			$attribute_code = $attribute_data['attribute_code'] . $diff_code;
			$attribute_name = $attribute_data['attribute_name'] . $diff_code;
			$field_type_id = $attribute_data['field_type_id'];
			$input_type = 'text';
			
				$input_type = 'select';	
			

			$result = $this->client->call($this->session, 'product_attribute.info', $attribute_code);
	
			if(isset($result->faultcode)){
				
				
				$data = array(
				   "attribute_code" => $attribute_code,
				   "frontend_input" => $input_type,
				   "scope" => "global",
				   "default_value" => "",
				   "is_unique" => 0,
				   "is_required" => 0,
				   "apply_to" => '',
				   "is_configurable" => 1,
				   "is_searchable" => 0,
				   "is_visible_in_advanced_search" => 0,
				   "is_comparable" => 0,
				   "is_used_for_promo_rules" => 0,
				   "is_visible_on_front" => 0,
				   "used_in_product_listing" => 0,
				   "additional_fields" => array(),
				   "frontend_label" => array(array("store_id" => "0", "label" => $attribute_name))
				  );
				
				$attribute_id = $this->client->call($this->session, 'product_attribute.create', array($data));

				
				echo '<pre>';
				echo print_r($attribute_id);
				echo '</pre>';
				//die();				
				
			}else{
				$attribute_id = $result;	

			}
			

			$result = $this->client->call(
				$this->session,
				"product_attribute_set.attributeAdd",
				array(
					 $attribute_id['attribute_id'],
					 $attribute_set_id
				)
			);			
			
			return $attribute_id;
	      
			
			   
    }	
	
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function getOptionId($attribute_code,$attribute_value){
		
			$options = $this->client->catalogProductAttributeOptions($this->session, $attribute_code); 
			$option_id = '';
			foreach($options as $option){
				if($option->label == $attribute_value){
					$option_id = $option->value;
					$found = true;
					break;	
				}	
				
			}			
	
			return $option_id;
	      
			
			   
    }
			
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function CreateAttributeOption_diff($attribute_code,$option_value,$diff_attr){
		
			$diff_code = '_d';
			if($diff_attr == 'filter'){
				$diff_code = '_f';
			}		
		$attribute_code = $attribute_code . $diff_code;
		
		$options = $this->client->call(
			$this->session,
			"product_attribute.options",
			array(
				 $attribute_code
			)
		);		


		$insert = true;
		foreach($options as $option){
			if($option['label'] == $option_value){
				$insert = false;
				break;	
			}
		}
		if($insert){
		

		
			$label = array (
			   array(
				"store_id" => array("0"),
				"value" => $option_value
			   )
			  );
			
			$data = array(
			   "label" => $label,
			    "order" => "",
				"is_default" => ""
			 
			  );
			$result = $this->client->call($this->session,"product_attribute.addOption",array($attribute_code,$data));

		}
			return $insert;
	      
			
			   
    }			
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function CreateAttributeOption($attribute_code,$option_value){
		
		
		$options = $this->client->call(
			$this->session,
			"product_attribute.options",
			array(
				 $attribute_code
			)
		);		

		$insert = true;
		foreach($options as $option){
			if($option['label'] == $option_value){
				$insert = false;
				break;	
			}
		}
		if($insert){
		

		
			$label = array (
			   array(
				"store_id" => array("0"),
				"value" => $option_value
			   )
			  );
			
			$data = array(
			   "label" => $label,
			    "order" => "",
				"is_default" => ""
			 
			  );
			$result = $this->client->call($this->session,"product_attribute.addOption",array($attribute_code,$data));

		}
			return $insert;
	      
			
			   
    }

    /*
     * Updating Price on Magento Store
     * @param
     * sku = Magento Product SKU
     * price = Price to be updated
     * array = Array consisting of SKU and their new price
     */
    public function setPrice($sku='',$price='', $array = array()){
        if(!empty($array) ){
            $finalResult = array();
            foreach($array as $sku=>$price){
                $result = $this->client->call($this->session, 'catalog_product.update', array($sku , array(
                        'price' => $price,
                    )
                ));

                $finalResult[$sku] = $result;
            }
            return $finalResult;
        }
        else{
            $result = $this->client->call($this->session, 'catalog_product.update', array($sku , array(
                    'price' => $price,
                )
            ));

            return $result;
        }

    }

    /*
     * Fetch order info
     * @param:
     * orderNo - the order number from magento
     */
    public function getOrderInfo($orderNo){
        return $result = $this->client->call($this->session, 'sales_order.info', $orderNo);
    }

    public function getAllOrders(){
        return $result = $this->client->call($this->session, 'sales_order.list');
    }

    public function getSpecificOrders($time){
        $params = array(
            array(
            'created_at' =>
                array('gt' => $time)
            )
        );

//        return $result = $this->client->call($this->session, 'sales_order.list',$params);
        return $result = $this->client->call($this->session, 'sales_order.list',$params);
    }


    /*
     * Checking SOAP Connection
     */
    public function checkConn(){
        return $result = $this->client->call($this->session, 'catalog_product_type.list');
    }

    /*
     * End SOAP session
     */
    public function destroy(){
        $this->client->endSession($this->session);
    }

	public static function getOrderStatusList()
	{
		return [
			[
				'id' => 1,
				'name' => 'Pending',
				'code' => 'PENDING',
			],
			[
				'id' => 2,
				'name' => 'Processing',
				'code' => 'PROCESSING',
			],
			[
				'id' => 3,
				'name' => 'Completed',
				'code' => 'COMPLETED',
			],
			[
				'id' => 4,
				'name' => 'Cancelled',
				'code' => 'CANCELLED',
			],
			[
				'id' => 5,
				'name' => 'Closed',
				'code' => 'CLOSED',
			],
			[
				'id' => 6,
				'name' => 'On Hold',
				'code' => 'ONHOLD',
			]
		];
	}

	public static function getOrderStatus($id)
	{
		$list = self::getOrderStatusList();
		foreach( $list as $st ) {
			if( $st['id'] == $id ) {
				return $st;
			}
		}

		return false;
	}

	public function updateOrderStatus($increment_id, $status, $comment, $notify = false)
	{
		return $this->client->call($this->session, 'sales_order.addComment', [
			'orderIncrementId' => $increment_id,
			'status' => $status,
			'comment' => $comment,
			'notify' => $notify
		]);
	}

	public function addOrderShipment($increment_id, $itemsQty = [])
	{
		return $this->client->call($this->session, 'sales_order_shipment.create', [
			'orderIncrementId' => $increment_id,
			'itemsQty' => $itemsQty,
		]);
	}

    public function addInvoiceToOrder($increment_id, $itemsQty = [])
    {
        return $this->client->call($this->session, 'sales_order_invoice.create', [
            'orderIncrementId' => $increment_id,
            'itemsQty' => $itemsQty,
        ]);
    }

    public function addTrackToShipment($increment_id, $title, $trackNumber)
    {
        return $this->client->call($this->session, 'sales_order_shipment.create', [
            'shipmentIncrementId' => $increment_id,
            'carrier' => 'custom',
            'title' => $title,
            'trackNumber' => $trackNumber
        ]);
    }

	public function cancelOrder($increment_id)
	{
		return $this->client->call($this->session, 'sales_order.cancel', $increment_id);
	}
}