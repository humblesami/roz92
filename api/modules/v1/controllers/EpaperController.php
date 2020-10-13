<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii;
use backend\modules\paper\models\TblPapEpaperDtl;
/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class EpaperController extends ActiveController
{
	public $modelClass = 'backend\modules\paper\models\TblPapEpaperMst';
    public function behaviors(){
      $behaviors = parent::behaviors();
      $behaviors['authenticator'] = [
        'class' => QueryParamAuth::className(),
      ];
      return $behaviors;
    }

 
     public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex($issue_date=0,$format='json')
    {

        if($format == 'xml'){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        }else{
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
\Yii::$app->response->charset = 'UTF-8';
/* Yii::$app->response->formatters = [
        'xml' => [
            'class' => 'yii\web\XmlResponseFormatter',
           // 'rootTag' => 'data',
        ],
    ];*/
$a = 1;
 /*   return [
        $a => 'b',
        ['c', 'd'],
        'e' => ['f', 'g']
    ];*/

        //code'
        if($issue_date == 0){
            $epaper = $this->modelClass::find()->where(['type' => 'N'])->orderBy('issue_date desc')->limit(30)->all();
        }else{
            $epaper = $this->modelClass::find()->where(['type' => 'N','issue_date' => $issue_date])->orderBy('issue_date desc')->all();
        }
        
        $epaper_data = [];
        foreach ($epaper as $row) {
         //   var_dump();
        	# code...

            $pageDetail = $row['page_detail'];
            $pageDetail = json_decode($pageDetail,true);
            $uploaded_by = $row->user['full_name'];

            $short_name = ($row->station['short_code'] == "") ? $common_name : $row->station['short_code'];
            $paper_name = $short_name . " - " . date('dmY',strtotime($row['issue_date']));
            $status = ($row['paper_status'] == 'D') ? 'Draft' : 'Publish';

        	$issue_date   = 'Date-' . $row['issue_date'];
            $station_name = $row->station['name'];
        	$epaper_data[$issue_date][$station_name]['station-name']      = $row->station['name'];
            $epaper_data[$issue_date][$station_name]['paper-name']        = $paper_name;
            $epaper_data[$issue_date][$station_name]['issue-date']        = $issue_date;
            $epaper_data[$issue_date][$station_name]['uploaded-by']        = $uploaded_by;
            $epaper_data[$issue_date][$station_name]['status']              = $status;
           
            foreach ($pageDetail as $key => $value) {
                $page_detail = TblPapEpaperDtl::find()->where(['epaper_id' => $row['id'],'page_id' => $key])->one();
                $image = str_replace('api','backend',Yii::getAlias('@web')) . '/' . $page_detail['path'];
                $page_name = (isset($value['name'])) ? $value['name'] : '';
                $page_id = 'page' . ($key +1);
                $epaper_data[$issue_date][$station_name]['pages'][$page_id]['page_name']        = $page_name;
                $epaper_data[$issue_date][$station_name]['pages'][$page_id]['page_image']        = $image;
            }
            
        }
        return $epaper_data;
    }   
}