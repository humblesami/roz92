<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ColumniestController extends ActiveController
{
    public $modelClass = 'backend\modules\paper\models\TblProfile';
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


      public function actionIndex($format='json')
    {
      if($format == 'xml'){
          \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
      }else{
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      }
      \Yii::$app->response->charset = 'UTF-8';
	    $cat = $this->modelClass::find()->all();
	    return $cat;
    }  

}