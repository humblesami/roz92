<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


?>


				<?php 
                $attributes_fall = array('id' => 'default_setting','class' => 'form-horizontal', 'name' => 'default_setting','role' => 'form');
                echo Html::beginForm('','post',$attributes_fall); ?>
<input type="hidden" name="role_id" value="<?php echo $role_id;?>">

<h3>Default Settings</h3>
<div class="form-group">
        <label class="col-sm-3 control-label">Role Name</label>
        <div class="col-sm-9">
            <input type="text" name="name" value="<?php echo $role_data['name'];?>" class="form-control">
        </div>
</div>
<div class="form-group">    
            <label class="col-sm-3 control-label">Portal Name</label>
        <div class="col-sm-9">
            <input type="text" name="portal_name" value="<?php echo $role_data['portal_name'];?>" class="form-control">
        </div>
</div>
    
<div class="form-group">        
  
            <label class="col-sm-3 control-label">Description</label>
        
        <div class="col-sm-9">
            <textarea class="form-control" name="desc"><?php echo $role_data['desc'];?></textarea>
        </div>
    
</div>    
    <hr>

<div class="form-group">    
   
        <div class="col-sm-3 col-sm-offset-3">
            <button type="button" onclick="save()" class="btn btn-primary">Save</button>
        </div>
        
</div>
<?php echo Html::endForm(); ?>

        
<script language="javascript">

	$(function() {
		$('.search-select').select2()
	});
	function save(){
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/default_setting');?>?role_id=<?php echo $role_id;?>";
		$.post(url,
		$("#default_setting").serialize(),
		function(data){
			
		});			
	}
</script>