<?php
use yii\helpers\Html;

?>
<div class="userForm clearfix contentscroll">
  <div class="row">
    
    
				<?php 
                $attributes = array('class' => 'form crt_emply', 'id' => 'frm_feature','name' => 'frm_feature');
                echo Html::beginForm('','post',$attributes); ?>
				
      <div class="tbl-core-modules-create">
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Name', 'name',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
                
				    <?= Html::input('name', 'name','',['class' => 'form-control']) ?>  
                      
					
               </div>
            </div>
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Description', 'name',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('desc', 'desc','',['class' => 'form-control']) ?>
               </div>
            </div>  
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					
                </div>
        	    <div class="col-lg-8 button clearfix">	
					
                    
					<button type="button" class="active btn btn-primary" onclick="save_role()">
                        Save Changes
                    </button>        
                    <button type="button" data-dismiss="modal"  class="btn btn_secondary btn-sm">
                        Close
                    </button>                    
                    
               </div>
            </div>                                                            

        
      </div>
   <?php echo Html::endForm(); ?>
  </div>
</div>






				

    
<script language="javascript">
function save_role(){
	//$("form#frm_feature").valid();
	//if($('form#frm_feature').valid()){	

		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/create');?>";
		$.post(url,
		$("#frm_feature").serialize(),
	
		function(data){

			$("#ajax-modal").modal('hide');
			document.location.href = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/main');?>?role_id=" + data;
			

		});
}




</script>

