 <?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\modules\paper\models\TblPapEmagzineMst;

?> 
  <div class="panel panel-default">
                    
    <div class="panel-body news-sbox">
      <div class="row" >
        <?php
        $type = $posts;

        if($xlimit == 0){
          $mag = TblPapEmagzineMst::find()->where(['type' => $type,'paper_status' => 'P'])->orderBy('issue_date desc')->all();
        }else{
          $mag = TblPapEmagzineMst::find()->where(['type' => $type,'paper_status' => 'P'])->orderBy('issue_date desc')->limit(9)->all();
        }
        $aa = 0;
        $mcount = 0;
        foreach ($mag as $row) {
          $aa = $aa + 1;
          $mcount = $mcount + 1;
          # code...
          $issue_date = $row['issue_date'];
          $strdate = strtotime($issue_date);
          $year = date('Y',$strdate);
          $month = date('m',$strdate);
          $iDate = date('dmY',$strdate);

          $image = 'backend/web/uploads/emagzine/' . $type . '/' . $year . "/" . $month . "/" . $iDate . "/1.jpg";
                  
            ?>
          <div class="col-md-4" style="float:right;margin-bottom:20px;">
            <a href="<?php echo Yii::$app->urlManager->createUrl('efrontend/web/magzine');?>?type=<?php echo $type;?>&issue_date=<?php echo $issue_date;?>">
              <img src="<?php echo $image;?>" class="img-responsive" width="200" />
            </a>
          </div>

          <?php 
          if($aa == 3){
              $aa = 0;
              echo '</div><div class="row">';
          }

        }?>
      </div>
      
  </div>
</div>