<?php
use yii\helpers\Html;

?>
<style>
  a:link,a:hover,a:active,a:visited{color:#000;}
</style>
<link rel="stylesheet" href="<?php echo Yii::getAlias('@web') ?>/themes/basic/css/style.css">
<link rel="stylesheet" href="<?php echo Yii::getAlias('@web') ?>/themes/basic/css/theme_light.css">
<link rel="stylesheet" href="<?php echo Yii::getAlias('@web') ?>/css/custom_menus.css">

<div>
	<div class="top-content">
        <div class="row">
        	<div class="col-sm-10">
            
	            <h3>Menu Management</h3>
            </div>
        </div>
        <div class="border-btm"></div>
        </div>
    


		<div class="row">
        	<div class="col-sm-3 ht-auto-roles panel-scroll border-right">
            
            
		<div class="clearfix">	
          <h3 class="float-left">Available Menus</h3>
          <a class="red float-right" data-toggle="modal" data-target=".bs-example-modal-lged" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create Menu</a>
          
          <div class="clearfix"></div>
          <div class="border-btm"></div>
                        
        </div>

                    <div class="nav-two">
                    <ul>
                    <?php
                        foreach($menu_list as $key => $value){
                    ?>

                            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/main/');?>?menu_id=<?php echo $key;?>"><?php echo $value;?></a></li>
                    <?php
                        }
                    ?>
                                       
                       
                    </ul>
        
                           
                </div>
            
            </div>
            <?php if($menu_id != 0){?>
 
            <div class="col-lg-4 ht-auto-roles panel-scroll">
            
	            <div> 
            
            
				<div>
                        
				<?php 

					$attributes = array('class' => 'form-horizontal', 'id' => 'features_add_to_menus','name' => 'features_add_to_menus','role' => 'form');
					echo Html::beginForm(Yii::$app->urlManager->createUrl('/core/menu_builder/features_add_to_menus_save'),'post',$attributes);
					echo Html::hiddenInput('menu_id', $menu_id);
					
				?>                        
                       
							<!-- start: DRAGGABLE HANDLES 1 PANEL -->
							<div class="panel panel-default">
								
                                <h3>Features</h3>
                                <div class="border-btm"></div>
                                	<div class="tabbable menu_tab_main">
                                      <div class="navbar-collapse collapse top-nav border0">
												<ul class="nav navbar-nav menu_builder_tab" id="myTab4">
													<li class="active">
														<a data-toggle="tab" href="#panel_tab3_example1">
															Features
														</a>
													</li>
													<li class="">
														<a data-toggle="tab" href="#panel_tab3_example2">
															Search
														</a>
													</li>
												</ul>
                                       </div>
												<div class="tab-content">
                                                    <div id="panel_tab3_example1" class="tab-pane active">
                                                        <div class="panel-group accordion-custom accordion-teal" id="accordion">
  <?php
                                                                   $x = 1;
                                                                   $min = "";
                                                                    for($i=0;$i<count($modules_features);$i++)
                                                                    {
                                                                        $features=$modules_features[$i]['features'];
                                                                    ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $modules_features[$i]['module_id'];?>"> <i class="icon-arrow"></i> <?php echo $modules_features[$i]['module_name'];?> </a></h4>
    </div>
    <div id="collapse_<?php echo $modules_features[$i]['module_id'];?>" class="panel-collapse collapse <?php echo $min?>">
      <div class="panel-body"> 
        <!--Inner Tab-->
        <div class="tabbable setting-accordion" style="min-height: auto">
          <div class="navbar-collapse collapse top-nav border0" style="margin: 0px;">
            <ul class="nav navbar-nav menu_builder_tab" id="myTab<?php echo $x; ?>">
              <li class="active"> <a data-toggle="tab" href="#panel_features<?php echo $x; ?>"> Features </a> </li>
              <li class=""> <a data-toggle="tab" href="#panel_reports<?php echo $x; ?>"> Reports </a> </li>
              <li class=""> <a data-toggle="tab" href="#panel_widgets<?php echo $x; ?>"> Widgets </a> </li>
            </ul>
          </div>
          <div class="tab-content">
            <?php
                                                                                        //$min = "";
                                                                                        //$feature_list	 =	roles_mod::model()->feature_list($row['id']);
                                                                                        ?>
            <!-- Feature Data-->
            <div id="panel_features<?php echo $x; ?>" class="tab-pane active">
              <div class="leave_accor">
                <ul class="dd-list">
                  <?php
                                                                                                    $min = "";
                                                                                                    for($j=0;$j<count($features);$j++) {
                                                                                                        if($features[$j]['info']['feature_display'] == 'F'){
                                                                                                    ?>
                  <li class="dd-item" data-id="<?php echo $features[$j]['info']['id'];?>">
                    <div>
                    <label class="checkbox-inline">
                      <input class="grey" type="checkbox" name="menu_sel[]" value="<?php echo $features[$j]['info']['id'] . "_" . $features[$j]['info']['name']; ?>">
                      <!--<a href="~site_url~/<?php /*echo $features[$j]['info']['url']; */?>">--> 
                      <span><?php echo $features[$j]['info']['name']; ?></span> 
                    </label>
                      <!--</a>--> 
                    </div>
                  </li>
                  <?php }
                                                                                                    }?>
                </ul>
                <div class="bottom-action col-lg-12">
                  <button type="button" class="btn btn-primary" onclick="add_menu()">Add to menu</button>
                </div>
              </div>
            </div>
            
            <!-- Reports Data-->
            <div id="panel_reports<?php echo $x; ?>" class="tab-pane">
              <div class="leave_accor">
                <ul class="dd-list">
                  <?php
                                                                                                    $min = "";
                                                                                                    for($j=0;$j<count($features);$j++) {
                                                                                                        if($features[$j]['info']['feature_display'] == 'R'){
                                                                                                            ?>
                  <li class="dd-item" data-id="<?php echo $features[$j]['info']['id'];?>">
                    <div >
                      <input type="checkbox" name="menu_sel[]" value="<?php echo $features[$j]['info']['id'] . "_" . $features[$j]['info']['name']; ?>">
                      <!--<a href="~site_url~/<?php /*echo $features[$j]['info']['url']; */?>">--> 
                      <?php echo $features[$j]['info']['name']; ?> 
                      <!--</a>--> 
                    </div>
                  </li>
                  <?php }
                                                                                                    }?>
                </ul>
              </div>
            </div>
            
            <!-- Widgets Data-->
            <div id="panel_widgets<?php echo $x; ?>" class="tab-pane">
              <div class="leave_accor">
                <ul class="dd-list">
                  <?php
                                                                                                    $min = "";
                                                                                                    for($j=0;$j<count($features);$j++) {
                                                                                                        if($features[$j]['info']['feature_display'] == 'W'){
                                                                                                            ?>
                  <li class="dd-item" data-id="<?php echo $features[$j]['info']['id'];?>">
                    <div >
                      <input type="checkbox" name="menu_sel[]" value="<?php echo $features[$j]['info']['id'] . "_" . $features[$j]['info']['name']; ?>">
                      <!--<a href="~site_url~/<?php /*echo $features[$j]['info']['url']; */?>">--> 
                      <?php echo $features[$j]['info']['name']; ?> 
                      <!--</a>--> 
                    </div>
                  </li>
                  <?php }
                                                                                                    }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!--Inner Tab--> 
      </div>
    </div>
  </div>
  <?php
                                                                    $x++;
                                                                    }?>
</div>
                                                        
                                                          <div class="bottom-action col-lg-12">                    
                                                                    <button type="button" class="btn btn-primary" onclick="add_menu()">Add to menu</button>
                                                            
                                                                </div>
                                                                <br><br><br>
                                                    </div>
                                                    
                                                    <div id="panel_tab3_example2" class="tab-pane">
                                                    	<div class="row">
                                                        	<div class="col-lg-12">
                                                                <div class="form-group cust_search">
                                                                    <input type="text" data-original-title="Type Here" data-rel="tooltip" placeholder="Type Here" title="" name="search_menu" id="search_menu" data-placement="top" class="form-control tooltips" >
                                                                    <a class="btn btn-azure" href="javascript:void(0)" onclick="search_menu()">
                                                                        <i class="fa fa-arrow-circle-right"></i>
                                                                    </a>
                                                                </div>
                                                        
                                                        		<div id="search_result">
                                                            
                                                        	</div>
                                                        		
                                                                <?php if($menu_id != 0){?>
	                                                                <div class="bottom-action col-lg-12">                    
                                                                    <button type="button" class="btn btn-azure btn-sm" onclick="add_menu()">Add to menu</button>
                                                            
                                                                </div>
                                                                <?php }?>
                                                        		
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
												</div>
											</div>

							</div>
							<!-- end: DRAGGABLE HANDLES 1 PANEL -->
                             <?php echo Html::endForm(); ?>
						</div>                       
            </div>
            
            </div>
        
            <div class="col-lg-5 ht-auto-roles panel-scroll border-left">
            <div class="row">
    	        <div class="col-sm-6">
	    	        <h3>Features</h3>
                </div>
                <div class="col-sm-6 text-right">    
            		<a href="JavaScript:void(0);" onclick="save_menu()" >Update</a>	
                </div>
            </div>         
            <div class="border-btm"></div>
                 
				<?php 


                             if($menu_id == 0){
	                            $attributes = array('class' => 'form-horizontal', 'id' => 'create_menu','name' => 'create_menu');
							 }else{
								
	                            $attributes = array('class' => 'form-horizontal', 'id' => 'features_assigned_to_menus','name' => 'features_assigned_to_menus');								 
							 }
					
					echo Html::beginForm(Yii::$app->urlManager->createUrl('/core/menu_builder/create_menu_save'),'post',$attributes);
					echo Html::hiddenInput('menu_id', $menu_id);
				?>     
                
                
                
                                            
                                         

							<!-- start: DRAGGABLE HANDLES 2 PANEL -->
							<div class="panel panel-default">
								
								<div class="panel-body">
                                    <div class="dd nestable">
                                    

											<?php 
                                            

                                            if($menu_data != ""){
                                            
                                            		echo $menu_data;?>

                                            <?php }?>                                    

                                        
                                        
									</div>
                                    
								</div>
							</div>
							<!-- end: DRAGGABLE HANDLES 1 PANEL -->
                            <?php echo Html::endForm(); ?>
						            
            
            </div>
            <?php }?>
            
            
        </div>

        <?php 


                            
                              $attributes = array('class' => 'form-horizontal', 'id' => 'create_menu','name' => 'create_menu');
              
          
          echo Html::beginForm(Yii::$app->urlManager->createUrl('/core/menu_builder/create_menu_save'),'post',$attributes);
          echo Html::hiddenInput('menu_id', $menu_id);
        ?>   
<div class="modal fade bs-example-modal-lged" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row form-group">

        <div class="col-sm-3"><label class="control-label" for="user-login_type">Menu Name:</label></div>
            
        <div class="col-sm-6">
                <input type="text" data-original-title="Edit Menu Name" data-rel="tooltip" placeholder="Display Menu Name Here" title="" value="" data-placement="top" class="form-control tooltips menu_name_display" id="new_menu_name" name="new_menu_name">
            </div>
        </div>
            
        <div class="row form-group">
                               
        <div class="col-sm-2 button clearfix">
                   
                        <button class="btn btn-primary" type="button" onclick="create_new_menu()"> 
                            Create Menu
                        </button>
                   
                    </div>  
                        
        </div>     

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php echo Html::endForm(); ?>


<!-- start: dropdown search option -->

<!-- end: dropdown search option -->




<div id="container" class="assign_menu" >
		
							<input type="hidden" id="nestable-output">
							
		
						
                    
                    
                    <div class="clearfix"></div>



                   <div class="clear"></div>
	<!-- start: PAGE CONTENT -->


					<div class="row">
						
                        
                        
                        
                        
                        
                        
						
					</div>

					<!-- end: PAGE CONTENT-->




<script language="javascript">
<?php if($menu_id != 0){?>
$(function() {
	UINestable.init();
});
<?php }?>             
function save_menu(){
	/*if($("#new_menu_name").val() == ""){
		alert("Please, menu name is required");
		$("#new_menu_name").focus();
		return false;
	}	  */
	serial = $('#nestable-output').val();
	$("#page_loading").show();


    $csrfToken = '<?php echo Yii::$app->request->csrfToken ?>';

    menu_name = $("#new_menu_name").val();
	$.post('<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/update_menu'); ?>', {
        sortable: serial,menu_id:'<?php echo $menu_id;?>',menu_name:menu_name,<?php echo Yii::$app->request->csrfParam;?>: $csrfToken}, 		function(data) {
		$("#page_loading").hide();           
		html='<div class="alert alert-success"><button data-dismiss="alert" class="close">×</button>Menu successfully updated</div>'	;
		$(".flash-success").html(html);
		$(".flash-success").show(100);
	});

}

function add_menu(){
	document.features_add_to_menus.submit()
}

function create_new_menu(){
	if($("#new_menu_name").val() == ""){
		alert("Please, menu name is required");
		$("#new_menu_name").focus();
		return false;
	}
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/create_menu_save');?>";
	document.create_menu.submit();
	/*		$.post(url,
	$("#create_menu").serialize(),
	
	function(data){
		document.location.href = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/main/menu_id/');?>/" + data;
	});		
	*/	

}

function crate_new_menu(){
	document.location.href = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/main/menu_id/0');?>";
}
	
</script>
                    

<div id="orderResult"></div>
<div id="d_data" style="display:none">
<div class="toggle_body">
    <input type="hidden" name="feature_id[]" value="mfeature_id">
                                                        	
    <div class="col-lg-12 toggle_inner">
        <div class="form-group">
            <label class="col-lg-4 togle_inner_field"> Menu Name : </label>
            <span class="col-lg-8">
                <input type="text" data-original-title="Edit Menu Name" data-rel="tooltip" placeholder="Menu Name" value="mmenu_name" onblur="change_menu_name(this.value,mfeature_id)" title="" data-placement="top" class="form-control tooltips menu_name_display togle_inner__input_field" id="menu_name" name="menu_name[]">
            </span>
        </div>
    </div>
    
    <div class="col-lg-12 toggle_inner">
        <div class="form-group">
            <label class="col-lg-4 togle_inner_field"> Feature Name : </label>
            <span class="col-lg-8">
                <input type="text" data-original-title="Featured Name" data-rel="tooltip" placeholder="Featured Name" value="mfeature_name" title="" data-placement="top" class="form-control tooltips menu_name_display togle_inner__input_field" id="feature_name" disabled="disabled" name="feature_name[]">
            </span>
        </div>
    </div>
    
    <div class="col-lg-12">
        <ul class="togle_nav">
            <li>
                <a href="javascript:void(0)" onclick="remove_menu(mthis)">
                    Remove
                </a>
            </li>
            <li>
                <a href="#">
                    Cancel
                </a>
            </li>
        </ul>
    </div>
    
    
</div>       
</div>

<!-- start: dropdown search option -->


<!-- end: dropdown search option -->

</div>

    
</div>

<script language="javascript">
	function get_new_menu(){
		menu_id = $("#menu_id").val();
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/main')?>/?menu_id=" + menu_id;	


		document.location.href = url;
	}
	function expand_collaps(menu_id,feature_id,feature_name,menu_name){
		
		mdis = $("#li_id_"+ menu_id + " > div.toggle_body").css('display');
		
		if(mdis != "block"){
			mhtml = $("#d_data").html();
			mhtml	= mhtml.replace("mthis", menu_id);
			mhtml	= mhtml.replace("mfeature_name", feature_name);
			mhtml	= mhtml.replace("mfeature_id", feature_id);
			mhtml	= mhtml.replace("mfeature_id", feature_id);
			if(menu_name != ""){
				mhtml	= mhtml.replace("mmenu_name", menu_name);
			}else{
				mhtml	= mhtml.replace("mmenu_name", feature_name);
			}
			$("#li_id_"+ menu_id + " > div.dd-handle").after(mhtml);
		}else{
			$("#li_id_"+ menu_id + " > div.toggle_body").css('display','none');
		}
	}
	function remove_menu(menu_id){
		$("#li_id_" + menu_id).remove();
		UINestable.init()
	}
	function change_menu_name(menu_name, feature_id){
		value_id = feature_id + "_" + menu_name
		//$("#li_id_" + feature_id).attr("data-id", value_id);
		$("#li_id_" + feature_id).data('id',value_id);
		UINestable.init()
	}
	function search_menu(){
		search_value = $("#search_menu").val();	
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/search_menu')?>/q/" + search_value;
		$("#search_result").load(url);
	}
</script>