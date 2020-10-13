<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yeesoft\post\models\Category;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblProfile */
/* @var $form yii\widgets\ActiveForm */
?>
        <div class="row">
            <div class="col-sm-3">
<div class="tbl-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  

<?php

                                    $profile_list = Category::find()->all();
                                    $profile_list = ArrayHelper::map($profile_list, 'id', 'title');
                                    echo  $form->field($model, 'category_id')->dropDownList($profile_list,['prompt' => ' --- Select ---','id' => 'type','class' => 'form-control search-select',
        
               
        ]) ?>   
  <?= $form->field($model, 'image')->fileInput() ?>  
 <?= $form->field($model, 'pen_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>                         

<?if(!$model->isNewRecord):
            echo Html::activeHiddenInput($model, 'image');
        endif;
    ?>
  
<?php if($model->isNewRecord){?>
<hr>
User Details
   
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
<?php }?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div></div>