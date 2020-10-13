<?php
use yii\helpers\Html;

?>
<?php
$type  = "Feature";
?>
<div class="userForm clearfix contentscroll">
  <div class="row">
    
    
				<?php 
                $attributes = array('class' => 'form crt_emply', 'id' => 'edit_sub_feature','name' => 'edit_sub_feature');
                echo Html::beginForm('','post',$attributes); ?>
				<input type="hidden" value="<?php echo $type?>" name="feature_display">  
                
        <input type="hidden" name="hidden_id" value="<?php echo $fetrd_data['id']; ?>">
        <input type="hidden" name="hidden_m_id" value="<?php echo $fetrd_data['module_id']; ?>">
        <input type="hidden" name="hidden_type" value="<?php echo $fetrd_data['type']; ?>">
        <input type="hidden" name="hidden_f_parent_id" value="<?php echo $fetrd_data['id']; ?>">
                  
      <div class="tbl-core-modules-create">
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Module ID', 'feature_parent_id',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
                
	       
                      
	
               </div>
            </div>
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Name', 'name',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'name',$fetrd_data->name,['class' => 'form-control']) ?>
               </div>
            </div>  
            <?php if($fetrd_data->feature_parent_id == 0 ){?>
            <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Parent', 'feature_parent_id',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
               
					<select name="feature_parent_id" id="feature_parent_id" class="form-control search-select form-field-select-3">
                      <option value="0"> ---- Select Parent Featured ---- </option>
                      <?php foreach($fetrd_dropdown as $row1){ ?>
                      <option  value="<?php echo $row1['id']?>"><?php echo $row1['name'];?></option>
                      <?php }?>
                    </select>       
                        
					
               </div>
            </div>
            <?php }else{?>
            	<input type="hidden" name='feature_parent_id' value="<?php echo $fetrd_data->feature_parent_id?>">
            <?php }?>
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Description', 'desc',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'desc',$fetrd_data->desc,['class' => 'form-control']) ?>
               </div>
            </div>                        


	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Link', 'url',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'url',$fetrd_data->url,['class' => 'form-control']) ?>
               </div>
            </div>   
            
            
            
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Controller Param', 'controller_param',['class' => 'control-label']) ?>
                </div>
        	    <div class="col-lg-8">	
					<?= Html::input('text', 'controller_param',$fetrd_data->controller_param,['class' => 'form-control']) ?>
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
					<?= Html::input('text', 'javascript_function',$fetrd_data->javascript_function,['class' => 'form-control']) ?>
               </div>
            </div>  
            


	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Enable or Disable:', 'enable_disable',['class' => 'control-label']) ?>
                    
                    
                    
                </div>
        	    <div class="col-lg-8">	

                        <label class="radio-inline control-label">
                            <input id="enable_disable_0" type="radio" value="E" name="enable_disable" <?php if($fetrd_data['enable_disable'] == "E"){echo "checked";}?> class="grey" >
                            Enable
                        </label>
                        <label class="radio-inline control-label">
                            <input class="grey" type="radio" name="enable_disable" value="D" id="enable_disable_1" <?php if($fetrd_data['enable_disable'] == "D"){echo "checked";}?> />
                            Disable
                        </label>
					
               </div>
            </div> 
            
            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Function or Feature:', 'type',['class' => 'control-label']) ?>
                    
                    
                    
                </div>
        	    <div class="col-lg-8">	

						<label class="radio-inline control-label">
                            <input id="type_0" type="radio" value="ft" name="type" <?php if($fetrd_data['type'] == "ft"){echo "checked";}?> class="grey" >
                            Feature
                        </label>
                        <label class="radio-inline control-label">
                            <input class="grey" type="radio" name="type" value="fn" id="type_1" <?php if($fetrd_data['type'] == "fn"){echo "checked";}?> />
                            Funtion
                        </label>                       
                       
					
               </div>
            </div>              


	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					<?= Html::label('Feature Display:', 'feature_display',['class' => 'control-label']) ?>
                    
                    
                    
                </div>
        	    <div class="col-lg-8">	

 						<label class="radio-inline control-label">
                            <input id="feature_display_0" type="radio" value="f" name="feature_display" <?php if($fetrd_data['feature_display'] == "F"){echo "checked";}?> class="grey" >
                            Feature
                        </label>
                        <label class="radio-inline control-label">
                            <input class="grey" type="radio" name="feature_display" value="R" id="feature_display_1" <?php if($fetrd_data['feature_display'] == "R"){echo "checked";}?> />
                            Report
                        </label>
                        <label class="radio-inline control-label">
                            <input class="grey" type="radio" name="feature_display" value="W" id="feature_display_2" <?php if($fetrd_data['feature_display'] == "W"){echo "checked";}?> />
                            Widget
                        </label>                     
                       
					
               </div>
            </div>              

            
            
        

        

            
	        <div class="form-group row field-user-login_type required">
				<div class="col-lg-3">
					
                </div>
        	    <div class="col-lg-8 button clearfix">	
					
                    
					<button type="button" class="active btn btn-primary" onclick="save_edit_sub_feature()">
                        Save Changes
                    </button>        
                    <button type="button" onclick="close_subview()"  class="btn btn_secondary btn-sm">
                        Close
                    </button>                    
                    
               </div>
            </div>                                                            

        
      </div>
   <?php echo Html::endForm(); ?>
  </div>
</div>


