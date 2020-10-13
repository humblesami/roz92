<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use backend\modules\core\models\User;
use backend\modules\core\models\TblCoreCompany;
use backend\modules\core\models\TblCoreRoles;
class Header extends Widget{
	
    public function init(){
            // add your logic here
    }
    public function run(){
		
			$user_id	=	Yii::$app->user->getId();
			$user_data	=	User::findOne($user_id);
			$seller_name = '';

			
			
			$role	=	'';
		
			$company_data	=	'';
			$data['company_name']	=	'';
			$data['company_logo']	=	'';
			$data['user_data']		=	$user_data;
			$data['portal_name']	=	'';
			
            return $this->render('header',$data);
    }
}
?>