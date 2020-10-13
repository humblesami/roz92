<?php
use yii\helpers\Html;

?>

<?php
$type_value  = "Feature";
if($type == "W"){
	$type_value = "Widget";
}else if($type == "R"){
	$type_value = "Report";
}
?>



			
<div class="userForm clearfix contentscroll">
  <div class="row">
    
    
				<?php 
                $attributes = array('class' => 'form crt_emply', 'id' => 'frm_feature','name' => 'frm_feature');
                echo Html::beginForm('','post',$attributes); ?>
				<input type="hidden" value="<?php echo $type?>" name="feature_display">    
      <div class="tbl-core-modules-create">
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Module ID', 'feature_parent_id',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
                
				 <select name="module_id" id="module_idform-field-select-3" class="form-control">
                      <option value="">Select Modules</option>
                      <?php
						   foreach($fetrd_modules as $row){ ?>
							<option  value="<?php echo $row['id']?>"><?php echo $row['name'];?></option>
						  <?php }
						?>
                  </select>         
                      
				
               </div>
            </div>
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Name', 'name',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'name','',['class' => 'form-control']) ?>
               </div>
            </div>  
            
            <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Parent', 'feature_parent_id',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
               
					<select name="feature_parent_id" id="feature_parent_id" class="form-control search-select">
                      <option value="0">Select Parent Featured</option>
                      <?php foreach($fetrd_dropdown as $row1){ ?>
                      <option  value="<?php echo $row1['id']?>"><?php echo $row1['name'];?></option>
                      <?php }?>
                    </select>       
                        

               </div>
            </div>
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Description', 'desc',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'desc','',['class' => 'form-control']) ?>
               </div>
            </div>                        


	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Link', 'url',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'url','',['class' => 'form-control']) ?>
               </div>
            </div>   
            
            
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Controller Param', 'controller_param',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'controller_param','',['class' => 'form-control']) ?>
               </div>
            </div>   
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Javascript Base', 'controller_param',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	

                    <?= Html::radioList('javascript_base', true, ['Yes', 'No']);?>
               </div>
            </div>               
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Javascript Function', 'javascript_function',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'javascript_function','',['class' => 'form-control']) ?>
               </div>
            </div>  
            
             

                
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					
                </div>
                
        	    
            </div>  
                                                                      

        
      </div>
   <?php echo Html::endForm(); ?>
  </div>
</div>
<div class="form-group modal-btn">
        <button type="button" class="btn btn-primary" onclick="save_feature()">Save Changes</button>        
        <button type="button" class="btn btn_secondary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>   
         </div>





				

    
<script language="javascript">
function save_feature(){
	//$("form#frm_feature").valid();
	//if($('form#frm_feature').valid()){	

		url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/save_create_feature');?>";
		$.post(url,
		$("#frm_feature").serialize(),
	
		function(data){
			//load_module();
			document.location.href = document.location.href;
			xpopup('close');
			

		});
	//}
}



</script>

