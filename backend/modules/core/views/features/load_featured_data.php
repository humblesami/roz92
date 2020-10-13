<script language="javascript">
	function load_sub_feature_data(parent_id,feature_id)
	{

	$("#sbd" ).html("Loading....");
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/app_admin/load_sub_featured_data/feature_id');?>/" + feature_id;
    	$("#sbd_" + parent_id).load(url);
		
	}
	
	function change_icon(feature_id){
			url = "<?php echo Yii::$app->urlManager->createUrl('/core/app_admin/change_icon/feature_id');?>/" + feature_id;
			$("#sub_view_page").html($("#pre_circle").html());
			var customOptions = new Object;
			customOptions.content = "#sub_view_page";
			customOptions.onShow = $('#sub_view_page').load(url);
			$.subview(customOptions);
			
	}

</script>
<style>
.description_text_right i{
	font-size:70px;
	text-align:center;
	margin-bottom:10px;
}
</style>

<div>
<br />

<h4>
    <?php echo $module_data['desc'];?>
</h4>

<div class="panel-group accordion-custom accordion-teal" id="accordion">
<?php 


foreach($featured_data as $data1)
{			

?>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#acc_<?php echo $data1['id']?>">
													<i class="icon-arrow"></i>
													 <?php echo $data1['name']; ?>
												</a></h4>
											</div>
											<div id="acc_<?php echo $data1['id']?>" class="panel-collapse collapse">
												<div class="panel-body">



 <div class="col-md-12 toggle_inner">
                                    <div class="row">
                                        <div class="col-sm-10 description_text_left">
                                            <h4>
                                                Description
                                            </h4>
                                            <p>
                                                <?php echo $data1['desc'];?>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </p>
                                        </div>
                                        <div id="icon_<?php echo $data1['id'];?>" class="col-sm-2 description_text_right text-center">
                                            <h4>
                                                Feature Icon
                                            </h4>
                                            <?php if($data1['menu_icon'] != "0"){?>
                                                <i class="<?php echo $data1['icon_class'];?>"></i>
                                            <?php }else{?>
                                                <i class="a-anchor"></i>
                                            <?php }?>

                                            <p class="feature_icon_footer">
                                                <a href="javascript:void(0)" onclick="change_icon('<?php echo $data1['id']?>')">
                                                    Change Icon
                                                </a>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="col-md-12">
                                    <ul class="togle_nav">
        <li>
                                        <a href="javascript:void(0)" onclick="load_sub_feature('<?php echo $data1['id']; ?>','<?php echo $data1['type'] = "fn";?>')">Create Function</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="load_edit_sub_feature_fn('<?php echo $data1['id']; ?>','<?php echo $data1['type'] = "ft";?>')">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="delete_feature('<?php echo $data1['id']; ?>','<?php echo $data1['type'] = "ft";?>')">
                                                Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                        <div class="clearfix"></div>

                                        <hr />

                                        <div class="clearfix"></div>

                                        <div class="table-responsive col-md-12">
                                        <h4>
                                            Functions
                                        </h4>
                                                                 
                            <table class="table table-hover table-bordered table-action" id="sample-table-1">
                                <thead>
                                    <tr>
                                        <th align="center">Action Item Name</th>
                                        <th align="center">Display Name</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$fetrd_data = $feature_mod->sub_feature_list($data1['id']);
									foreach($fetrd_data as $data2){
										if($data2['type'] == "fn"){			
								?>                                
                                    <tr class="odd">
                                        
                                        <td>
                                            <?php echo $data2['name']; ?>
                                        </td>
                                        
                                        <td>
                                           <?php echo $data2['name']; ?>
                                        </td>

                                        <td class="user_drop">
                                           <a class="" href="javascript:void(0)" onclick="load_edit_sub_feature_fn('<?php echo $data2['id']; ?>','<?php echo $data1['type'] = "fn";?>')">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            
                                            <a class="" href="javascript:void(0)" onclick="delete_feature('<?php echo $data2['id']; ?>','<?php echo $data1['type'] = "fn";?>')">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                            
                                            
                                        </td>
                                    </tr>
                                    
								<?php 
										}
								}?>	
                                    
                                </tbody>
                            </table>
                            
                           								 
                        </div>
                        
                        
                        											
                        </div>
                        										</div>
                                                                
                                                                
   
  <!-- /* Start Sub Feature */-->
  
  
													 <?php 

                                                    $sub_feature = $roles_mod->sub_feature_list($data1['id']);
                                                    
                                                    if(count($sub_feature) > 0){
                                                    ?>
                                                    
                                                     <ol class="dd-list">
                                                    
														<?php 
                                                            $ac_class= "active";
                                                            foreach($sub_feature as $s_row){
                                                        ?>
                                                    <li class="dd-item" data-id="13">
                                                        
													<div class="panel panel-default">
														<div class="panel-heading custom_panel_heading app_new_style">                                                        
                                                            <label class="control-label menu_name">
                                                                <?php echo $s_row['name']; ?>
                                                                <div class="panel-tools">
                                                                    <a class="btn btn-xs panel-collapse expand" href="#">	
                                                                    </a>
                                                                    
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="panel-body app_new_style_body" style="display:none">
                                                        
                                                        		  <!-- /* Start Sub Feature -> Function */-->
                                                                  
                                                                  
                                                                  
<div class="col-md-12 toggle_inner">
                                                            	<div class="row">
                                                                    <div class="col-sm-10 description_text_left">
                                                                    	<h4>
                                                                            Description
                                                                        </h4>
                                                                        <p>
                                                                        	<?php echo $s_row['desc'];?>
                                                                        </p>
                                                                    </div>
                                                                    <div id="icon_<?php echo $s_row['id'];?>" class="col-sm-2 description_text_right">
                                                                    	<h4>
                                                                        	Feature Icon
                                                                        </h4>
                                                                    	<?php if($s_row['menu_icon'] != "0"){?>
                                                                        	<i class="a-anchor"></i	
                                                                        <?php }else{?>
                                                                        	<i class="a-anchor"></i>
                                                                        <?php }?>

                                                                        <p class="feature_icon_footer">
                                                                        	<a href="javascript:void(0)" onclick="change_icon('<?php echo $s_row['id']?>')">
                                                                            	Change Icon
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="table-responsive col-md-12">
                                                                    <h4>
                                                                        Functions
                                                                    </h4>
                                                                 
                            <table class="table table-striped table-bordered table-hover table-full-width dataTable" id="sample-table-1">
                                <thead>
                                    <tr>
                                        <th align="center">Action Item Name</th>
                                        <th align="center">Display Name</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$fetrd_data = $feature_mod->sub_feature_list($s_row['id']);
									foreach($fetrd_data as $data2){
										if($data2['type'] == "fn"){			
								?>                                
                                    <tr class="odd">
                                        
                                        <td>
                                            <?php echo $data2['name']; ?>
                                        </td>
                                        
                                        <td>
                                           <?php echo $data2['name']; ?>
                                        </td>

                                        <td align="center" class="user_drop">
                                           
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-bricky dropdown-toggle">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="load_edit_sub_feature_fn('<?php echo $data2['id']; ?>','<?php echo $data1['type'] = "fn";?>')">
                                                            <i class="fa fa-pencil"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="delete_feature('<?php echo $data2['id']; ?>','<?php echo $data1['type'] = "fn";?>')">
                                                            <i class="fa fa-trash-o"></i>
                                                            Remove
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            </div>
                                            
                                            <div class="visible hidden-md hidden-lg">
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-bricky dropdown-toggle btn-sm">
                                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li role="presentation">
                                                            <a href="#" tabindex="-1" role="menuitem">
                                                                <i class="fa fa-pencil"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a href="#" tabindex="-1" role="menuitem">
                                                                <i class="fa fa-trash-o"></i> Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    
								<?php 
										}
								}?>	
                                    
                                </tbody>
                            </table>
                            
                           								 <div class="col-md-12">
                                                            	<ul class="togle_nav">
                                	<li>
                                                                    <a href="javascript:void(0)" onclick="load_sub_feature('<?php echo $s_row['id']; ?>','<?php echo $s_row['type'] = "fn";?>')">Create Function</a>
                                                                    </li>                                                                
                                                                	<li>
                                                                    	<a href="javascript:void(0)" onclick="load_edit_sub_feature_fn('<?php echo $s_row['id']; ?>','<?php echo $s_row['type'] = "ft";?>')">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                    	<a href="#">
                                                                            Remove
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                        </div>
                        </div>
                        										</div>                                                                  
                                                                  
                                                                    <!-- /* Start Sub Feature -> Function */-->
                                                        
                                                        
                                                        </div>
                                                     </div>   
                                                    
                                                                                                                   
                                                    		<li>
														<?php
                                                        }
                                                        ?>  
														</ol>	
                                                    <?php
													}
													?>  
  
  <!-- /* End Sub Feature */-->
  


												</div>
											</div>
										</div>
<?php }?>                                        
</div>



</div>
