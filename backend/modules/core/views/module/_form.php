<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-core-modules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>


<div class="row">
            <div class="col-lg-offset-4 col-lg-8 button clearfix">
	            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'active btn btn-primary' : 'active btn btn-primary']) ?>
            <button type="button" class="cancel btn btn_secondary">Cancel</button>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
