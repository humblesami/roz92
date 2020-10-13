<?php
namespace backend\components;

use yii\web\Controller;
use yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use backend\modules\core\models\User;

class BaseController extends Controller
{
	
	
    public function init()
    {
        parent::init();


//		if(!Yii::$app->user->id){
//			return $this->redirect(['/site/login']);
//		 }

		
  
		
    }

	/**
	 * On event callback
	 */
	public function beforeAction($action)
	{
		if(!Yii::$app->user->id){
			\Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'auth/login');
		} else{
			return parent::beforeAction($action);
		}

	}

	public function behaviors()
	{
		
		$arr = [];
		$cn = [];
		
		$user_id	=	Yii::$app->user->getId();

		$user_data	=	User::findOne($user_id);
		
		$role_id	=	($user_data['role_id'] != '') ? $user_data['role_id'] : '';



		$controller = (isset(Yii::$app->controller->id)) ? Yii::$app->controller->id : '';
		$module = (isset(Yii::$app->controller->module->id)) ? Yii::$app->controller->module->id : '';
		$method = (isset(Yii::$app->controller->action->id)) ? Yii::$app->controller->action->id : '';
		
		$mlink = $module ."/" . $controller ."/". $method;
		
		$check_fn = [];//$method;												
		$q = (new \yii\db\Query())
		->select('f.url,f.type')
		->from('tbl_core_roles_features rf')
		->join('join','tbl_core_module_features f', 'f.id = rf.feature_id and f.url = "' . $mlink . '"')
		->where('rf.role_id = ' . $role_id)
		->andWhere('rf.view = 1')
		->andWhere('f.status = 1')
		->andWhere('f.enable_disable = "E"');
		$command = $q->createCommand();
		$rows = $command->queryAll();	
	
		$fn = [];
		$cnn = [];
		$fn[] = 'aa';
		foreach($rows as $q_row){
			$url = $q_row['url'];

				if($url != "javascript:void(0)"){
					
					$url_array = explode('/', $url);
					
					$module_controller = $url_array[0] . "/" . $url_array['1'];
					
					
						
							$cnn[] = $module_controller; 
						
							$fn[]	=	$url_array[2];
				
				}
	
		}
		
           $arr = $fn;
		   $cn = $cnn;
		   
	   if($role_id == 1){

	   		$arr = [];
	   }
		//var_dump($arr);
		return [
				'access' => [
					'class' => AccessControl::className(),
					/*'denyCallback' => function ($rule, $action) {
						throw new \Exception('You are not allowed to access this page');
					},	*/				
					//'only' => $check_fn,
					'rules' => [

 						 [
							'allow' => true,
							'actions' => ['login', 'signup'],
							
							'roles' => ['?'],
                    	],					
						// deny all POST requests
						
						// allow authenticated users
						[
							'allow' => true,
							'actions' =>  $arr,
							//'controllers' => $cn,
							'roles' => ['@'],
						],
						// everything else is denied
					],
				],
			];		
	  
	}
	

}