<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\paper\models\TblPapStation;
use backend\modules\paper\models\TblPapPageTemplate;
use backend\modules\paper\models\TblPapEpaperDtl;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapEpaperMst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-pap-epaper-mst-form">

    <?php $form = ActiveForm::begin(['layout' => 'inline','options' => ['enctype' => 'multipart/form-data']]); ?>




    <?= $form->field($model, 'issue_date')->textInput(['class' => 'date-picker']) ?>

<?php

    $station_list = ArrayHelper::map(TblPapStation::find()->all(), 'id', 'name');
    ?>
    <?= $form->field($model, 'station_id')->dropDownList($station_list,
        ['prompt' => ' --- Select ---','id' => 'station_id','class' => 'form-control search-select',
        
               
        ]) 
        
    ?>

<?php
    $page_template_rows = TblPapPageTemplate::find()->all();
    $page_template_list = ArrayHelper::map($page_template_rows, 'id', 'name');
    ?>
    <?= $form->field($model, 'page_template_id')->dropDownList($page_template_list,
        ['prompt' => ' --- Select ---','id' => 'page_template_id','class' => 'form-control search-select',
        
               
        ]) 
        
    ?>



    <div class="form-group">
        <!-- <button type="button" class="btn btn-success" onclick="create_layout()">Create</button> -->
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
    </div>

    <?php if(!$model->isNewRecord){?>
    <div class="row">

        <div class="pages-data col-sm-10">
            <div class="row">
            <?php
                $no_of_pages = $model->pt['no_of_pages'];
                for($p=1;$p<=$no_of_pages;$p++){

                    $eDetail  = TblPapEpaperDtl::find()->where(['page_id' => $p,'epaper_id' => $model->id])->one();
                
            ?>
                    <div class="col-sm-3">
                        <div class="box imageupload text-center">
                                       

                            <img src="<?php echo Yii::getAlias('@web') . '/' . $eDetail->path;?>" width="150" alt="">

                            <div><a href="<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/mapping');?>?id=<?php echo $eDetail->id?>">Image Mapping</a></div>


                        </div>
                        
                    </div>

            <?php }?>
            </div>

        </div>
    </div>
    <?php }?>

    <?php ActiveForm::end(); ?>

</div>

<style>
.pages-data .box{padding:10px; margin:10px;  height: 350px; border: 1px solid #ccc}
</style>

