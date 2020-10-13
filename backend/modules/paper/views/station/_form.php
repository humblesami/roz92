<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\core\models\TblCoreRegionCity;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapStation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-pap-station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urdu_name')->textInput(['maxlength' => true]) ?>

<?php
$state_list = [1,2,3,5,70,71,72,73];
    $city_list = ArrayHelper::map(TblCoreRegionCity::find()->where(['in','state_id',$state_list])->all(), 'id', 'name');
    ?>
    <?= $form->field($model, 'city_id')->dropDownList($city_list,
        ['prompt' => ' --- Select ---','id' => 'city_id','class' => 'form-control search-select',
        
               
        ]) 
        
    ?>

    <?= $form->field($model, 'short_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->textInput(['class' => 'date-picker']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
