<?php
use yii\helpers\Html;
?>
<div class="row">
  <div class="col-md-12"> 
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-default">
      <div class="panel-heading"> <?php echo $master_data->master_setup_name?> </div>
      <div class="panel-body">
        <div class="row">
          <div class=" col-md-8 col-md-offset-2">
            <?php 

					$attributes = array('class' => 'form crt_emply', 'id' => 'frm_master_setup','name' => 'frm_master_setup','role' => 'form');
					echo Html::beginForm('','post',$attributes);
					$fields = json_decode($master_data->fields,true);
					$master_set_value = json_decode($master_data->master_setup_value,true);
				?>
                <input type="hidden" name="master_setup_id" value="<?php echo $master_setup_id;?>">
                <input type="hidden" name="master_setup_name" value="<?php echo $master_data->master_setup_name;?>">
              <?php
              foreach($fields as $f_key => $f_value){
			  ?>  
              <input type="hidden" name="field_id[]" value="<?php echo $f_value;?>">
            <div class="form-group">
              <label class="col-sm-3 control-label" for="name"><?php echo $f_value;?>&nbsp;: &nbsp;<span class="symbol required"></span> </label>
              <div class="col-sm-7">
                <input id="master_setup_value" value="<?php echo (isset($master_set_value[$key_id][$f_value])) ? $master_set_value[$key_id][$f_value] : '';?>" class="form-control" type="text" data-placement="top" title="" placeholder="" name="field_value[]" required>
              </div>
            </div>
            <div class="clearfix"></div>
            <?php }?>
            <div class="bottom-action col-sm-12">
              <button type="submit" class="btn btn-azure"> Save </button>
              &nbsp;&nbsp;&nbsp; <a href="<?php echo Yii::$app->urlManager->createUrl('/core/mastersetupentry/datalist')?>?master_setup_id=<?php echo $master_setup_id;?>"  class="btn btn-danger"> Cancel </a> </div>
            <?php echo Html::endForm(); ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY --> 
<script>
			jQuery(document).ready(function() {
				FormElements.init();
				jQuery("#frm_master_setup").validate();
			});
		</script>