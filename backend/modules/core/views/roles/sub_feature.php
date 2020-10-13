<script language="javascript">
	function sub_sub_feature(feature_id)
	{

		$("#sub_sub_feature_" + feature_id).show();
		
		$("#sub_sub_feature_" + feature_id ).html("Loading....");
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/load_ss_list/feature_id');?>/" + feature_id + "/role_id/"+ "<?php echo $role_id?>";
		$("#sub_sub_feature_" + feature_id).load(url);
		
		
		
	}
</script>    

<?php 
          $sub_feature = $roles_mod->sub_feature_list($parent_id);
          if(count($sub_feature) > 0){
?>
<div class="row">
                                                    	<div class="col-sm-12">
                                                        <h4 class="feature_head">Sub Feature</h4>
                                                            <div class="tabbable">
                                                                <ul id="myTab3" class="nav nav-tabs tab-padding tab-space-3 tab-blue">
                                                                <?php 
                                                                $ac_class= "active";
                                                                foreach($sub_feature as $s_row){
                                                        
                                                                ?>
                                                                    <li class="<?php echo $ac_class?>">
                                                                        <a href="#sb_<?php echo $s_row['id']?>" onclick="sub_sub_feature('<?php echo $s_row['id']?>')" data-toggle="tab">
                                                                            <i class="pink fa clip-stack-2"></i>
                                                                            <?php echo $s_row['name'];
                                                                            $ac_class = "";
                                                                            ?>
                                                                        </a>
                                                                    </li>
                                                                <?php }?>    
                                                                  
                                                                </ul>
                                                                
                                                                <div class="tab-content">
                                                                <?php 
                                                                
                                                                
                                                                $ac_class= "active";
                                                                foreach($sub_feature as $s_row){
                                                                ?>
                                                                
                                                                    <div class="tab-pane <?php echo $ac_class;?>" id="sb_<?php echo $s_row['id']?>">
                                                                    
                                                                    
																																					                                                                <?php
                                                                                    
                                                                                    $mcheck = "";
                                                                                    $check_data = roles_mod::model()->check_data($s_row['id'], $role_id);
                                                                                    if($check_data){
                                                                                        $mcheck = "checked";
                                                                                    }
                                                                                    
                                                                                    ?>                                                                        
                                                                                    <div class="make-switch<?php echo $parent_id;?> switch-small mySwitch pull-right"  data-on="primary" data-off="info">
                                                                                   
                                                                                        <input value="<?php echo $s_row['module_id'] ."_" . $s_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                                                    </div>   
                                                                                             <br />
<br />
                                               
                                               <div id="sub_sub_feature_<?php echo $s_row['id']?>"></div>
                                               
                                                                       <table class="table table-striped table-bordered table-hover table-full-width dataTable" id="sample-table-1">
                                                                          

                                                                       
                                                                            <?php 
																			 $ac_class = "";
                                                                            $sub_function	= roles_mod::model()->funciton_list($s_row['id']);
																			


                                                                            foreach($sub_function as $sfn_row){
                                                                            ?>
                                                                            <tr>
                                                                                	<td width="50%">
                                                                                    	<?php echo $sfn_row['name'];?>
                                                                                    </td>
                                                                                    <td width="50%">
 <?php
                                                                                    
                                                                                    $mcheck = "";
                                                                                    $check_data = roles_mod::model()->check_data($sfn_row['id'], $role_id);
                                                                                    if($check_data){
                                                                                        $mcheck = "checked";
                                                                                    }
                                                                                    
                                                                                    ?>
                        
                                                                                    <div class="make-switch<?php echo $parent_id;?> switch-small mySwitch"  data-on="primary" data-off="info">
                                                                                   
                                                                                        <input value="<?php echo $sfn_row['module_id'] ."_" . $sfn_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                                                    </div>
                                                                                    </td>
                                                                             
                                                                          </tr>
                                                                                                                                                                  
                                                                            <?php }?>
                                                                       

                     
                                                                        </table>
                                                                        
                                                                                    
                                                                    </div>
                                                                <?php }?>      
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
<?php }?>                                                        



   

<script>
    $(document).ready(function() {	
	 $('.make-switch<?php echo $parent_id;?>')['bootstrapSwitch']();
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