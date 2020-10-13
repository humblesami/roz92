<?php
use backend\assets\AppAsset;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\paper\models\TblPapStation;
use backend\modules\paper\models\TblPapPageTemplate;
use backend\modules\paper\models\TblPapEpaperDtl;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapEpaperMst */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web'); ?>/themes/basic/plugins/bootstrap-imageupload/css/bootstrap-imageupload.css">
<div class="tbl-pap-epaper-mst-form">

    <?php $form = ActiveForm::begin(['layout' => 'inline','options' => ['enctype' => 'multipart/form-data']]); ?>
<?php
//var_dump($model->errors);
?>

<?php if($model->isNewRecord){?>   

    <?= $form->field($model, 'issue_date')->textInput(['class' => 'date-picker']) ?>



<?php
	
    $type_list['N'] = 'News Pages';
     $type_list['C'] = 'Common Pages';

    ?>
    <?= $form->field($model, 'type')->dropDownList($type_list,
        ['prompt' => ' --- Select ---','id' => 'type','class' => 'form-control search-select',
        
               
        ]); 
        $p_class = '';
    ?>

<?php
	$page_template_rows = TblPapPageTemplate::find()->all();
    $page_template_list = ArrayHelper::map($page_template_rows, 'id', 'name');

    ?>
    <?= $form->field($model, 'page_template_id')->dropDownList($page_template_list,
        ['prompt' => ' --- Select ---','id' => 'page_template_id','class' => 'form-control search-select',
        
               
        ]); 
        $p_class = '';
    ?>

<span id="xstation_id">
<?php

    $station_list = ArrayHelper::map(TblPapStation::find()->all(), 'id', 'name');
    ?>
    <?= $form->field($model, 'station_id')->dropDownList($station_list,
        ['prompt' => ' --- Select ---','id' => 'station_id','class' => 'form-control search-select',
        
               
        ]) 
        
    ?>
</span>


<?php }else{


	$p_class = 'pull-right';
}?>

    <div class="form-group <?php echo $p_class;?>">
    	<!-- <button type="button" class="btn btn-success" onclick="create_layout()">Create</button> -->
    	<?php
    		if(!$model->isNewRecord){    	?>
    	<a  href="<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/index/');?>" class="btn btn-primary">Save</a>
    	<?php }else{?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
        <?php }?>
    </div>

    <?php if(!$model->isNewRecord){?>
	<div class="row">

		<div class="pages-data col-sm-10">
			<div class="row">
			<?php

				$page_detail = $model['page_detail'];

				$page_detail = json_decode($page_detail);
			
				if($page_detail){
				foreach($page_detail as $key => $p_data){

					$value = $p_data->name;
					
				//	echo $p_data->is_common;
				
					$is_common = $p_data->is_common;
					if($is_common == ''){
					    $is_common = 'N';
					}
					$is_common_Value = 'Y';
					if($model->type == 'N'){
						$is_common_Value = 'N';
					}
				//	echo 'temp value ' . $is_common ."-" . $is_common_value . "-" . $value . '<br>';
					if($is_common == $is_common_Value){
					$p = $key;



					$eDetail  = TblPapEpaperDtl::find()->where(['page_id' => $p,'epaper_id' => $model->id])->one();
					$image_preview = '';
					if(isset($eDetail->path)){
						$image_preview =  Yii::getAlias('@web') . '/' . $eDetail->path;
					}
				
			?>





					<div class="col-sm-3">





						<div class="box imageupload text-center">
							<div class="heading"><?php echo $value;?></div>
							 <div class="file-tab panel-body">
							 	
<?php  echo \kato\DropZone::widget([
       'options' => [
           'maxFilesize' => '1',

           'id' => 'up-' .  $key,
           'pcontainer' => 'prv-' . $key,
         //  'dictDefaultMessage' =>  ($image_preview != "") ? '<img src=' . $image_preview . ' class="dz-image" alt="logo" width="100">' : 'Upload Paper',
           'url' => Url::toRoute(['/paper/epaper/upload','id' => $model->id,'page_id' => $key]),
           'addRemoveLinks' => true,
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file)}",
           'removedfile' => "function(file){alert(file.name + ' is removed')}",



       ], 'files' => 'getFiles(this)',//getFiles func call
   ]); ?>
							       <!--  <label class="btn btn-default btn-file">
							       	
							           <span>Browse</span>
							           The file is stored here.
							          
							       <div class="form-group field-tblpapepapermst-imagefiles has-error">
							       <label class="sr-only" for="tblpapepapermst-imagefiles">Image Files</label>
							       <input type="file" id="tblpapepapermst-imagefiles" name="TblPapEpaperMst[imageFiles][]" multiple="" accept="image/*">
							       <input type="hidden" name="TblPapEpaperMst[imageFiles][]" value="">
							       
							       
							       </div>						         
							       <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
							       </label>
							       <button type="button" class="btn btn-default">Remove</button> -->
							    </div>


						</div>
						
					</div>
<?php }?>
			<?php }?>
			<?php }?>
			</div> 

		</div>
	</div>
	<?php }?>

    <?php ActiveForm::end(); ?>

</div>

<style>
.pages-data .box{margin:10px;  height: 350px; border: 1px solid #ccc}
.pages-data .box .heading{background: #ccc; padding:5px;}
</style>


 <script src="<?= Yii::getAlias('@web'); ?>/themes/basic/plugins/bootstrap-imageupload/js/bootstrap-imageupload.js"></script>

        <script>


$(function()
{

 $(document).on('change', '#type', function(e)
    {
            type = $(this).val();

            if(type == 'C'){

            	$('#xstation_id').hide();
            }else{
            	$('#xstation_id').show();
            }

           

    });

});            	
            


function getFiles(dropzone) {

	alert('d')
}


var $imageupload = $('.imageupload');
            $imageupload.imageupload();
        </script>