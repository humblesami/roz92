<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\core\models\TblCoreModules;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-core-master-setup-form">

    <?php $form = ActiveForm::begin(); ?>
	<?php
    	$module_list = ArrayHelper::map(TblCoreModules::find()->all(), 'id', 'name');
	?>
    <?= $form->field($model, 'module_id')->DropDownList($module_list) ?>

    <?= $form->field($model, 'master_setup_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn_secondary']) ?>
        <?= Html::a('Cancel', ['index'], ['class'=>'btn btn_secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
