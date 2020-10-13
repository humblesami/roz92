<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapPageTemplate */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
* {
  .border-radius(0) !important;
}

#field {
    margin-bottom:20px;
}

</style>

<div class="tbl-pap-page-template-form xmagzine-template">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    

<div class="controls">
<?php 

$pages = json_decode($model->page_detail);
if(!$pages){

		$class = 'btn-success';
		$fa_class = 'glyphicon-plus';

        if(!isset($value)){
            $value = '';
        }

        $is_common = 'N';
?>
<div class="input-group entry form-group">
	

<input type="hidden" name="common_template[]" value="N" />
<input autocomplete="off" class="input" id="field1" name="page_name[]" value="<?php echo $value;?>" type="text" placeholder="Page Name" data-items="8"/>
<span class="input-group-btn"><button id="b1" class="btn add-more btn-add <?php echo $class;?>" type="button"><span class="glyphicon <?php echo $fa_class;?>"></span></button></span>

	</div>

<?php }else{?>
<?php

$last_key = key( array_slice( $pages, -1, 1, TRUE ) );
foreach($pages as $key => $p_data){

    $value  = $p_data->name;
    $is_common = $p_data->is_common;

	$class = 'btn-danger';
	$fa_class = 'glyphicon-minus';
	
	if($last_key == $key ){

		$class = 'btn-success';
		$fa_class = 'glyphicon-plus';
	}

?>	

<div class="input-group entry form-group">
	

<input type="hidden" name="common_template[]" value="<?php echo $is_common;?>" />
<input autocomplete="off" class="input" id="field1" name="page_name[]" value="<?php echo $value;?>" type="text" placeholder="Page Name" data-items="8"/>
<span class="input-group-btn"><button id="b1" class="btn add-more btn-add <?php echo $class;?>" type="button"><span class="glyphicon <?php echo $fa_class;?>"></span></button></span>

	</div>
<?php }?>
<?php }?>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$(function()
{

 $(document).on('click', '.common_check', function(e)
    {
            if ($(this).prop('checked')==true){ 
                $(this).next().val('Y');
            }else{
                $(this).next().val('N');
            }

           

    });


    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

       

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});

</script>