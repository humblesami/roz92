<script src="<?= Yii::getAlias('@web'); ?>/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>
<script language="javascript">
	function sub_sub_feature(feature_id)
	{

		$("#sub_sub_feature_" + feature_id).show();
		
		$("#sub_sub_feature_" + feature_id ).html("Loading....");
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/load_ss_list');?>&feature_id=" + feature_id + "&role_id="+ "<?php echo $role_id?>";
		$("#sub_sub_feature_" + feature_id).load(url);
		
		
		
	}
</script>   
<?php
                                                            $mcheck = "";
                                                            $check_data = $roles_mod->check_data($feature_id, $role_id);
                                                            if($check_data){
                                                                $mcheck = "checked";
                                                            }
?>
<div class="panel-heading custom_panel_heading"><?php echo $feature_data['name'];?></div>

                <div class="data-txt-wrap">
                <div class="col-sm-6">
                Allow Access to this feature.
                </div>
                <div class="col-sm-2">
                <div class="make-switch  mySwitch switch-small" data-on-label="Yes" data-off-label='No' data-on="danger" data-off="info">
                <input value="<?php echo "1_" . $feature_id . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                </div>
                </div>
                <div class="col-sm-6"></div>
                <div style="clear: both;"></div>
                </div>

<div style="overflow: scroll; height: 500px">
    
    <hr>
			<div class="data-txt col-lg-12">
                                                                    <b>Users access to this feature can.</b>
                                                                </div>    

    <?php
  
     $function_list = $roles_mod->funciton_list($feature_id);
	 foreach($function_list as $row){
	?>
    
							<div class="data-txt">
                                <div class="col-lg-6"><?php echo $row['name'];?></div>
                                
                                <div class="col-lg-2">
                                      
 																			<?php
                                                                            $mcheck = "";
                                                                            $check_data = $roles_mod->check_data($row['id'], $role_id);
                                                                            if ($check_data) {
                                                                                $mcheck = "checked";
                                                                            }
                                                                            ?>
                                                                            <div class="make-switch  mySwitch switch-small" data-on-label="Yes" data-off-label='No' data-on="danger" data-off="info">
                                                                                <input value="<?php echo $row['module_id'] . "_" . $row['id'] . "_" . $role_id ?>" type="checkbox" <?php echo $mcheck; ?> >
                                                                            </div>                                      
                                      
                                  </div>
              
                            <div class="col-lg-4"></div>
                            <div style="clear: both;"></div>
                           </div>    
                                                                    
                                                                    

    <?php
	 }
    ?>    
    


<?php
$parent_id= $feature_id;
$sub_feature = $roles_mod->sub_feature_list($parent_id);
if(count($sub_feature) > 0){
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable tabs-left" style="border-top: 1px solid #ddd; padding-left: 15px;">
                <h4 class="feature_head">Sub Feature</h4>
                <div class="setting-left-wrap clearfix">
                    <div class="col-lg-3 assets-nav setting-left-nav">
                        <ul id="myTab3">
                        <?php
                        $ac_class= "active";
                        foreach($sub_feature as $s_row){
                        ?>
                            <li class="<?php echo $ac_class?>">
                                <a href="#sb_<?php echo $s_row['id']?>" onclick="sub_sub_feature('<?php echo $s_row['id']?>')" data-toggle="tab">
                                    <!--<i class="pink fa clip-stack-2"></i>-->
                                    <?php echo $s_row['name'];
                                    $ac_class = "";
                                    ?>
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                    </div>
					<div class="col-lg-9">                
		                <div class="tab-content">
                    <?php
                    $ac_class= "active";
                    foreach($sub_feature as $s_row){
                    ?>
                    <div class="tab-pane <?php echo $ac_class; ?>" id="sb_<?php echo $s_row['id'] ?>">
                        <?php
                        $mcheck = "";
                        $check_data = $roles_mod->check_data($s_row['id'], $role_id);
                        if ($check_data) {
                            $mcheck = "checked";
                        }
                        ?>
                        <div class="col-lg-6">
                            Allow Access to this feature.
                        </div>
                        <div class="col-lg-2">
                            <div class="make-switch<?php echo $parent_id; ?> mySwitch switch-small" data-on-label="Yes"
                                 data-off-label='No' data-on="primary" data-off="info">
                                <input value="<?php echo $s_row['module_id'] . "_" . $s_row['id'] . "_" . $role_id ?>"
                                       type="checkbox" <?php echo $mcheck; ?> >
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-12">
                            <hr>
                        </div>


                        <br/>
                        <br/>

                        <div id="sub_sub_feature_<?php echo $s_row['id'] ?>"></div>
                        <?php
                        $ac_class = "";
                        $sub_function = $roles_mod->funciton_list($s_row['id']);

                        if ($sub_function) {
                        ?>
                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                <b>Users with access to this feature can.</b>
                            </div>
                            <?php
                            foreach ($sub_function as $sfn_row) {
                                ?>
                                <div class="data-txt">
                                    <div class="col-lg-6"><?php echo $sfn_row['name']; ?></div>
                                    <div class="col-lg-2">
                                        <?php
                                        $mcheck = "";
                                        $check_data = $roles_mod->check_data($sfn_row['id'], $role_id);
                                        if ($check_data) {
                                            $mcheck = "checked";
                                        }
                                        ?>
                                        <div class="make-switch<?php echo $parent_id; ?> switch-small mySwitch"
                                             data-on-label="Yes" data-off-label='No' data-on="primary" data-off="info">
                                            <input
                                                value="<?php echo $sfn_row['module_id'] . "_" . $sfn_row['id'] . "_" . $role_id ?>"
                                                type="checkbox" <?php echo $mcheck; ?> >
                                        </div>
                                    </div>
                                    <div class="col-lg-6"></div>
                                    <div style="clear: both;"></div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                            
                        </div>
                    <?php }?>
                </div>
	                </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>
</div>
<script>
    $(document).ready(function() {	
			$('.make-switch')['bootstrapSwitch']();
			$('.mySwitch').on('switch-change', function (e, data) {
				var $el = $(data.el)
				  , value = data.value;
				 
				 value = data.el.val();
				if(data.value == true){
					
					checked_data(value,'1')	;
				}else{
					checked_data(value,'0')	;
				}
			});	
			
	});	
</script>