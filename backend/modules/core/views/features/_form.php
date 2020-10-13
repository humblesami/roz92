<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\core\models\TblCoreModules;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModuleFeatures */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-core-module-features-form">

    <?php $form = ActiveForm::begin(); ?>
	<?php
      $items = ArrayHelper::map(TblCoreModules::find()->all(), 'id', 'name');
	?>
    <?= $form->field($model, 'module_id')->dropDownList($items) ?>

    <?= $form->field($model, 'feature_parent_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'controller_param')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'javascript_base')->dropDownList([ 'N' => 'N', 'Y' => 'Y', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'javascript_function')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_icon')->textInput() ?>

    <?= $form->field($model, 'menu_order')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'ft' => 'Ft', 'fn' => 'Fn', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'repeat_function')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>


		<div class="row">
            <div class="col-lg-offset-4 col-lg-8 button clearfix">
	            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'active btn btn-primary' : 'active btn btn-primary']) ?>
            <button type="submit" class="cancel btn btn_secondary">Cancel</button>
            </div>
        </div>
        
        
       

    <?php ActiveForm::end(); ?>

</div>
