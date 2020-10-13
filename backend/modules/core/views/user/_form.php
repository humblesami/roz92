<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\core\models\TblCoreRoles;
use backend\modules\paper\models\TblPapStation;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

   
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $form->field($model, 'login_type')->dropDownList([ 'local' => 'Local', 'ldap' => 'LDAP']) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?php if($model->isNewRecord){?>
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
    <?php }?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <?php

	    $items = ArrayHelper::map(TblPapStation::find()->all(), 'id', 'name');
	?>
	<?= $form->field($model, 'station_id')->dropDownList($items,['id' => 'role_id']) ?>



    <?php
	    $items = ArrayHelper::map(TblCoreRoles::find()->all(), 'id', 'name');
	?>

	<?= $form->field($model, 'role_id')->dropDownList($items,['onchange' => 'check_role()','id' => 'role_id']) ?>



		<div class="row">
            <div class="col-lg-8 button clearfix">
	            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'active btn btn-primary' : 'active btn btn-primary']) ?>
                <a href="<?php echo Yii::$app->urlManager->createUrl('/core/user');?>" class="btn btn-default btn-squared btn-cancel">Cancel</a>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
<script language="javascript">
	function check_role(){
		role_id = $('#role_id').val();
		console.log(role_id);
		$('#seller_detail').hide();
		if(role_id == 11){
			$('#seller_detail').show();	
		}
	}
</script>
