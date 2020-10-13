<?php

namespace backend\modules\core\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
/**
 * DashboardController implements the CRUD actions for TblCoreDashboards model.
 */
class RegionController extends BaseController
{
   

    public function actionState_lists($id)
    {
        $countPosts = \backend\modules\core\models\TblCoreRegionState::find()
                ->where(['country_id' => $id])
                ->count();
 
        $posts = \backend\modules\core\models\TblCoreRegionState::find()
                ->where(['country_id' => $id])
                ->orderBy('id DESC')
                ->all();
 
        if($countPosts>0){
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
 
    }
	
    public function actionCity_lists($id)
    {
        $countPosts = \backend\modules\core\models\TblCoreRegionCity::find()
                ->where(['state_id' => $id])
                ->count();
 
        $posts = \backend\modules\core\models\TblCoreRegionCity::find()
                ->where(['state_id' => $id])
                ->orderBy('id DESC')
                ->all();
 
        if($countPosts>0){
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
 
    }	
}
