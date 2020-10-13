<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-core-master-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_id')->textInput() ?>

    <?= $form->field($model, 'master_setup_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'master_setup_value')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
