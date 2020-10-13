<div class="dd nestable">
                                        <?php 

										$sub_feature = $roles_mod->sub_feature_list($parent_id);
										foreach($sub_feature as $a_row){?>
                                        <div class="panel panel-default">
                                        <!-- Heading Start -->
                                        <div class="panel-heading custom_panel_heading">
                                            <label class="control-label menu_name"><?php echo $a_row['name'];?></label>                                                
                                            <div class="panel-tools">
                                                <a class="btn btn-xs btn-link panel-collapse expand"  href="javascript:void(0)" onclick="load_ff_list('<?php echo $a_row['id'];?>')">	
                                                </a>
                                            </div>                                                
                                        </div>
                                        <!-- Heading End -->
                                
                                        <div class="panel-body" style="display:none;" id="body_<?php echo $a_row['id'];?>">
                                        
                                        	
                                            <div class="dd nestable">
                                            	<?php
                                                    
                                                    $mcheck = "";
                                                    $check_data = $roles_mod->check_data($a_row['id'], $role_id);
                                                    if($check_data){
                                                        $mcheck = "checked";
                                                    }
                                                    
                                                    ?>
                                                    <div class="make-switch<?php echo $parent_id;?> switch-small pull-right mySwitch"  data-on="danger" data-off="info">
                                                        <input value="<?php echo $a_row['module_id'] ."_" . $a_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                    </div><br />
<br />

                                                    
                                                   
                                                   

                                                    <?php
                                                    	$function_list = roles_mod::model()->funciton_list($a_row['id']);

														foreach($function_list as $fn_row){
													?>
                                                    	<div class="col-sm-4"><?php echo $fn_row['name'];?></div>
                                                        <div class="col-sm-8">
                                                    		<?php
                                                            
															$mcheck = "";
															$check_data = roles_mod::model()->check_data($fn_row['id'], $role_id);

															if($check_data){
																$mcheck = "checked";
															}
															
															?>

                                                            <div class="make-switch<?php echo $parent_id;?> mySwitch"  data-on="primary" data-off="info">
                                                           
                                                                <input value="<?php echo $fn_row['module_id'] ."_" . $fn_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <!-- Feature Funcion End -->                                                    
                                                    
                                                    <!-- Feature Funcion End -->

                                            </div>
                                            <div class="sub_feature"></div>
                                            
                                        	</div>                                    
                              			</div>          
                                        <?php }?>
                                    	</div>
                                        


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