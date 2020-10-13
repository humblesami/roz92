<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\data\ActiveDataProvider;
use yeesoft\post\models\Category;
/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ColumnController extends ActiveController
{
    public $modelClass = 'backend\modules\columiest\models\Post';
    public $post_type = 2;

    public function behaviors(){
      $behaviors = parent::behaviors();
      $behaviors['authenticator'] = [
        'class' => QueryParamAuth::className(),
      ];
      return $behaviors;
    }
    
     public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
       // unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }


      public function actionIndex($category_id=0,$format='json')
    {
    	if($format == 'xml'){
    			\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
    	}else{
    		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	}
	    
      \Yii::$app->response->charset = 'UTF-8';
	    
	    //$category_id = $_Get['category_id'];
	      if($category_id !=0 ){
			  return new ActiveDataProvider([
			        'query' => $this->modelClass::find()->joinWith('cats')->where(['post_type' => 2,Category::tableName() . '.id' => $category_id]),
			        'sort'  =>  [
			            'defaultOrder'  =>  [
			                'id'    =>  SORT_DESC
			            ]
			        ]
			    ]);
			}else{
			  return new ActiveDataProvider([
			        'query' => $this->modelClass::find()->where(['post_type' => 2]),
			        'sort'  =>  [
			            'defaultOrder'  =>  [
			                'id'    =>  SORT_DESC
			            ]
			        ]
			    ]);				
			}
    }   


}