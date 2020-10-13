<?php
namespace backend\components;
use yii\base\Component;
use backend\modules\build_content\models\TblCntStore;
use yii\helpers\Inflector;

class Mage2Api extends Component {
    var $urlPath = '';
    var $apiUser='';
    var $apiPassword='';
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
    public function __construct($url,$user,$password,$key,$api_version='V1'){
        $this->urlPath = $url;
        $this->apiUser = $user;
        $this->apiPassword = $password;


        if($key == ""){            
            $this->authenticate();
        } else{
            $this->apiKey = $key;
        }
        
        
    }

    protected function authenticate(){
        $api = TblCntStore::find()->where(['website' => $this->urlPath])->one();

        $vars = array(
            'username' => $this->apiUser,
            'password' => $this->apiPassword
        );
			

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->urlPath."/rest/V1/integration/admin/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec ($ch);
        curl_close ($ch);
		
        $api->token    =   (String)json_decode($output);
        $this->apiKey = (String)json_decode($output);
        $api->save(false);
    }

    /*
     * Fetch Product Price from Magento Store
     * @param
     * sku = Single Product SKU
     */
    public function fetchPrice($sku){
		try{

            $result = json_decode($this->getProduct($sku),true);

            foreach ($result['custom_attributes'] as $value) {
                if($value['attribute_code'] == 'url_key'){
                    $result['url_path'] = $value['value'];
                }
            }

	        return array(
                    'name' => $result['name'],
                    'price' => $result['price'],
                    'url' => $this->urlPath.'/'.$result['url_path'].".html"
               );
			} catch(Exception $e){
				throw new CHttpException(400,Yii::t('yii','Product does no exist'));
				return;
			}
    }
	
	
    /*
     * Fetch Product Price from Magento Store
     * @param
     * sku = Single Product SKU
     */
    public function fetch_product($sku){
		try{
			
			

			$result = $this->getProduct($sku);
            return $result;
/*	        return array(
                    'name' => $result['name'],
                    'price' => $result['price'],
                    'sku'	=> $result['sku'],
               );*/
			} catch(Exception $e){
				throw new CHttpException(400,Yii::t('yii','Product does no exist'));
				return;
			}
    }

    /*
     * Fetch Product Price from Magento Store
     * @param
     * sku = Single Product SKU
     */
    public function fetch_product_customapi($sku) {
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/customproducts/".$sku);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


            $headers = array();
            $headers[] = 'Authorization: Bearer '.$this->apiKey;
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);

            curl_close ($ch);
            $result = json_decode($result,true);

            if( isset($result['message']) ){
                $this->authenticate( $this->urlPath, $this->apiKey, $this->apiPassword );
                return $this->fetch_product_customapi($sku);
            }

            return $result[0];
            /*	        return array(
                                'name' => $result['name'],
                                'price' => $result['price'],
                                'sku'	=> $result['sku'],
                           );*/
        } catch(Exception $e){
            throw new CHttpException(400,Yii::t('yii','Product does no exist'));
            return;
        }
    }

    public function fetchProductByAttributes($attribute_id,$attribute_value){ 
       
	   // $attribute_id = 'seller_id';
	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/products/?searchCriteria[filterGroups][0][filters][0][field]=" . $attribute_id . "&searchCriteria[filterGroups][0][filters][0][value]=" . $attribute_value . "&searchCriteria[filterGroups][0][filters][0][condition_type]=eq");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        
        curl_close ($ch);
        $result = json_decode($result,true);

        if( isset($result['message']) ){
            $this->authenticate($this->urlPath,$this->apiKey,$this->apiPassword);
            return $this->fetchProductByAttributes($attribute_id,$attribute_value);
        }
        return $result['items'];
    }

    protected function getProduct($sku){ 
	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlPath . '/rest/V1/products/'.$sku);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '. $this->apiKey;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        
        curl_close ($ch);
        $result = json_decode($result,true);

        if( isset($result['message']) ){
            $this->authenticate($this->urlPath,$this->apiKey,$this->apiPassword);
            return $this->getProduct($sku);
        }
		
        return $result;
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
                $vars = $this->getProduct($sku);
                $vars['price'] = $price;
                $varss['product'] = $vars;
                $vars = json_encode($varss);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/products/".$sku);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $headers = array();
                $headers[] = 'Authorization: Bearer '.$this->apiKey;
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Accept: application/json';

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);

                curl_close ($ch);

                $finalResult[$sku] = $result;
            }
            return $finalResult;
        }
        else{
            $vars = $this->getProduct($sku);
            $vars['price'] = $price;
            $varss['product'] = $vars;
            $vars = json_encode($varss);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/products/".$sku);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = array();
            $headers[] = 'Authorization: Bearer '.$this->apiKey;
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);

            curl_close ($ch);
            return $result;
        }

    }

    public function updateStockAndPrice($sku='',$price='', $data){
        $vars = $this->getProduct($sku);
        $vars['price'] = $price;
        $vars['extension_attributes'] = $data;
        $varss['product'] = $vars;
        $post = json_encode($varss);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/products/".$sku);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);
        return $result;

    }


    /**
     * @return mixed
     * Get All orders from magento 2.0
     */
    public function getAllOrders(){
        $ch = curl_init();
        //getting all orders after 2015
        curl_setopt($ch, CURLOPT_URL, $this->urlPath."/rest/V1/orders/?searchCriteria[filterGroups][0][filters][0][field]=created_at&searchCriteria[filterGroups][0][filters][0][value]=2015&searchCriteria[filterGroups][0][filters][0][condition_type]=gt&searchCriteria[filterGroups][0][filters][1][field]=customer_is_guest&searchCriteria[filterGroups][0][filters][1][value]=0&searchCriteria[filterGroups][0][filters][1][condition_type]=eq"); ///rest/V1/orders/?searchCriteria[filterGroups][0][filters][0][field]=created_at&searchCriteria[filterGroups][0][filters][0][value]=2015&searchCriteria[filterGroups][0][filters][0][condition_type]=gt
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);

        if( isset(json_decode($result,true)['message']) ) {
            $this->authenticate($this->urlPath,$this->apiKey,$this->apiPassword);
            return $this->getAllOrders();
        }
        
        $result = json_decode($result,true)['items'];
        return $result;
    }
	
    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function fetchCategory(){
      	$ch = curl_init();
        //getting specific orders after $time
        $encode = $this->urlPath."/rest/V1/categories";
		
        curl_setopt($ch, CURLOPT_URL, $encode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);




        return $result;
			   
    }	



    /*
     * Fetch Category from Magento Store
     * @param
     * 
     */
    public function infoCategory($category_id){

      	$ch = curl_init();
        //getting specific orders after $time
        $encode = $this->urlPath."/rest/V1/categories/" . $category_id;
		
        curl_setopt($ch, CURLOPT_URL, $encode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);




        return $result;
			   
    }	
    /**
     * @return mixed
     * Get All orders from magento 2.0
     */
    public function getSpecificOrders($time){
        $ch = curl_init();
        //getting specific orders after $time
        $encode = $this->urlPath."/rest/V1/orders/?searchCriteria[filterGroups][0][filters][0][field]=created_at&searchCriteria[filterGroups][0][filters][0][value]=".urlencode($time)."&searchCriteria[filterGroups][0][filters][0][condition_type]=gt&searchCriteria[filterGroups][0][filters][1][field]=customer_is_guest&searchCriteria[filterGroups][0][filters][1][value]=0&searchCriteria[filterGroups][0][filters][1][condition_type]=eq";
        curl_setopt($ch, CURLOPT_URL, $encode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);

        if(json_decode($result,true)['message']){
            $this->authenticate($this->urlPath,$this->apiKey,$this->apiPassword);
            return $this->getSpecificOrders($time);
        }

        $result = json_decode($result,true);
        return $result['items'];
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


    /*
     * Fetch Category from Magento 2 Store
     * @param
     *
     */
    public function createAttributeSet($attribute_set_name){
        $result_list = $this->curlRequest("/rest/V1/products/attribute-sets/sets/list?searchCriteria",0);
        \Yii::info($result_list,'custom');
        
        foreach($result_list['items'] as $key => $value){
            if($value['attribute_set_name'] == $attribute_set_name){
                $attriubte_set_id = $value['attribute_set_id'];
                return $attriubte_set_id;
            }
        }

        $skeletonId = 4;
        $data = ["attributeSet" => ["attribute_set_name" => $attribute_set_name],"skeletonId" => $skeletonId];
        $result = $this->curlRequest("/rest/V1/products/attribute-sets", 1, json_encode($data));
        \Yii::info("$result",'custom');
        $attriubte_set_id = $result['attribute_set_id'];

        return $attriubte_set_id;
    }

    /*
    * Fetch Category from Magento Store
    * @param
    *
    */
    public function createSimpleProduct($type,$data=[],$attribute_set_id,$sku){

        $data['type_id'] = $type;
        $data['attribute_set_id'] = $attribute_set_id;
        $data['sku'] = $sku;
        foreach($data['additional_attributes']['single_data'] as $item){
            $data['custom_attributes'][] = [ "attribute_code" => $item['key'], "value" => $item['value'] ];
        }
        $data['custom_attributes'][] = [ "attribute_code" => "description", "value" => $data['description'] ];
        $data['custom_attributes'][] = [ "attribute_code" => "short_description", "value" => $data['short_description'] ];
        array_push( $data['custom_attributes'] , ['attribute_code' => 'category_ids', 'value' => $data['categories']] );
        array_push( $data['custom_attributes'] , ['attribute_code' => 'url_key', 'value' => Inflector::slug($data['name'].' '.$sku)] );
        unset( $data['additional_attributes'], $data['categories'], $data['websites'], $data['description'], $data['short_description'], $data['tax_class_id'] );

        $result = $this->curlRequest("/rest/V1/products",1,json_encode(["product" => $data]));
        
        return $result;
    }

    /*
     * Fetch Category from Magento Store
     * @param
     *
     */
    public function updateSimpleProduct($data=[],$attribute_set_id,$sku){

        $data['sku'] = $sku;
        foreach($data['additional_attributes']['single_data'] as $item){
            $data['custom_attributes'][] = [ "attribute_code" => $item['key'], "value" => $item['value'] ];
        }
        $data['custom_attributes'][] = [ "attribute_code" => "description", "value" => $data['description'] ];
        $data['custom_attributes'][] = [ "attribute_code" => "short_description", "value" => $data['short_description'] ];
        array_push( $data['custom_attributes'] , ['attribute_code' => 'category_ids', 'value' => $data['categories']] );
        unset( $data['additional_attributes'], $data['categories'], $data['websites'], $data['description'], $data['short_description'], $data['tax_class_id'] );
        $result = $this->curlRequest("/rest/V1/products",1,json_encode($data));
        return $result;

    }

    /*
    * Fetch Category from Magento 2 Store
    * @param
    *
    */
    public function createMedia($image_url,$sku,$image_status,$base){


        $im = file_get_contents($image_url);
        $imdata = base64_encode($im);
        $file = array(
            'content' => $imdata,
            'mime' => 'image/jpeg'
        );
        if($image_status == 'create'){
            $resulttxt = "{
                          \"entry\": {
                            \"media_type\": \"image\",
                            \"position\": 1,    
                            \"disabled\" : false,    
                            \"types\": [";
            if($base){
                $resulttxt .=           "\"thumbnail\",\"image\",\"small_image\"";
            } else{
                $resulttxt .=           "";
            }

            $resulttxt .=      "],
                            \"content\": {
                              \"base64_encoded_data\":\"$imdata\", 
                                    \"type\": \"image/jpeg\",
                              \"name\": \"$sku.jpeg\"
                            }
                          }
                        }";
            $result = $this->curlRequest("/rest/V1/products/$sku/media",1,$resulttxt);

        }else{

            $result = [];
        }

    }

    /*
    * Fetch Category from Magento 2 Store
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
            $result = $this->curlRequest("/rest/V1/products/$sku/media",1,"{
                          \"entry\": {
                            \"media_type\": \"image\",
                            \"position\": 0,    
                            \"types\": [
                              \"thumbnail\",\"image\",\"small_image\"
                            ],
                            \"content\": {
                              \"base64_encoded_data\":\"$imdata\", 
                                    \"type\": \"image/jpeg\",
                              \"name\": \"$sku.jpeg\"
                            }
                          }
                        }");

        }else{

            $result = [];
        }

    }

    /*
     * Fetch Category from Magento 2 Store
     * @param
     *
     */
    public function attribute_info($attribute_code){

        $result = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code,0);
        $attribute_id = $result['attribute_id'];
        return $attribute_id;
    }

    /*
     * Fetch Category from Magento Store
     * @param
     *
     */
    public function createConfigProduct($type,$data=[],$attribute_set_id,$sku){

        $data['type_id'] = $type;
        $data['attribute_set_id'] = $attribute_set_id;
        $data['sku'] = $sku;

        /*foreach($data['additional_attributes']['single_data'] as $item){
            $data['custom_attributes'][] = [ "attribute_code" => $item['key'], "value" => $item['value'] ];
        }*/
        $data['custom_attributes'] = [];
        $data['custom_attributes'][] = [ "attribute_code" => "description", "value" => $data['description'] ];
        $data['custom_attributes'][] = [ "attribute_code" => "short_description", "value" => $data['short_description'] ];
        array_push( $data['custom_attributes'] , ['attribute_code' => 'category_ids', 'value' => $data['categories']] );
        array_push( $data['custom_attributes'] , ['attribute_code' => 'url_key', 'value' => Inflector::slug($data['name'].' '.$sku)] );
        unset( $data['categories'], $data['website_ids'], $data['description'], $data['short_description'], $data['tax_class_id'], $data['associated_skus'], $data['price'], $data['price_changes'], $data['configurable_attributes'], $data['stock_data'] );

        $result = $this->curlRequest("/rest/V1/products/", 1, json_encode(["product" => $data]));

        return $result;
        
        
    }

    /*
     * Fetch Category from Magento 2 Store
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

        $result = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code,0);

        if(isset($result['message'])){

            $data['attribute'] = array(
                "attribute_code" => $attribute_code,
                "frontend_input" => $input_type,
                "scope" => "global",
                "is_unique" => 0,
                "is_required" => 0,
                "is_searchable" => 0,
                "is_visible_in_advanced_search" => 0,
                "is_comparable" => 0,
                "is_used_for_promo_rules" => 0,
                "is_visible_on_front" => 0,
                "used_in_product_listing" => 0,
                "default_frontend_label" =>  $attribute_name,
                "frontend_labels" => array(array("store_id" => "0", "label" => $attribute_name))
            );

            $result = $this->curlRequest("/rest/V1/products/attributes/",1,json_encode($data));

            $attribute_id = $result['attribute_id'];

        }else{
            $attribute_id = $result['attribute_id'];
        }

        $result2 = $this->curlRequest("/rest/V1/products/attribute-sets/attributes",1,json_encode([
                "attributeSetId" => $attribute_set_id,
                "attributeCode" => $attribute_code,
                "attributeGroupId" => 130,
                "sortOrder" => 0
        ]) );

        return $attribute_id;

    }

    /*
    * Fetch Category from Magento 2 Store
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


        $result = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code,0);

        if( isset($result['message']) ){

            $data['attribute'] = array(
                "attribute_code" => $attribute_code,
                "frontend_input" => $input_type,
                "scope" => "global",
                "default_value" => "",
                "is_unique" => 0,
                "is_required" => 0,
                "is_searchable" => 0,
                "is_visible_in_advanced_search" => 0,
                "is_comparable" => 0,
                "is_used_for_promo_rules" => 0,
                "is_visible_on_front" => 0,
                "used_in_product_listing" => 0,
                "default_frontend_label" =>  $attribute_name,
                "frontend_labels" => array(array("store_id" => "0", "label" => $attribute_name))
            );

            $result = $this->curlRequest("/rest/V1/products/attributes/",1,json_encode($data));
            $attribute_id = $result['attribute_id'];



            //die();

        }else{
            $attribute_id = $result['attribute_id'];
        }

        $result2 = $this->curlRequest("/rest/V1/products/attribute-sets/attributes",1,json_encode([
            "attributeSetId" => $attribute_set_id,
            "attributeCode" => $attribute_code,
            "attributeGroupId" => 130,
            "sortOrder" => 0
        ]) );

        return $attribute_id;
    }

    /*
     * Fetch Category from Magento Store
     * @param
     *
     */
    public function getOptionId($attribute_code,$attribute_value){

        $options = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code."/options",0);
        $option_id = '';

        foreach($options as $option){
            if($option['label'] == $attribute_value){
                $option_id = $option['value'];
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
    public function CreateAttributeOption($attribute_code,$option_value){


        $options = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code."/options",0);

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
                    "store_id" => 1,
                    "label" => $option_value
                )
            );

            $data['option'] = array(
                "label" => $option_value,
                "value" => $option_value,
                "store_labels" => $label,
                "sort_order" => "",
                "is_default" => ""

            );

            $result = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code."/options", 1, json_encode($data) );

        }
        return $insert;

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

        $options = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code."/options",0);

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
                    "store_id" => 1,
                    "label" => $option_value
                )
            );

            $data['option'] = array(
                "label" => $option_value,
                "value" => $option_value,
                "store_labels" => $label,
                "sort_order" => 0,
                "is_default" => false

            );
            $result = $this->curlRequest("/rest/V1/products/attributes/".$attribute_code."/options", 1, json_encode($data) );

        }
        return $insert;

    }

    protected function curlRequest( $url,$post = 0,$data = array() ){
        $ch = curl_init();
        //getting specific orders after $time
        $encode = $this->urlPath.$url;
        curl_setopt($ch, CURLOPT_URL, $encode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($post){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        }


        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->apiKey;
        $headers[] = 'Content-Type: application/json';


        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        curl_close ($ch);

        $result = json_decode($result,true);
        if(isset($result['message'])){
            /*echo "<pre>";
            print_r($data);
            echo "</pre>";
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            exit;*/
            return $result;
        } else{
            return $result;
        }

    }

}