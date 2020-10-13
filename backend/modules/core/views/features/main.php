<?php
use yii\helpers\Html;
?>
		
<script language="javascript">


// Cancel Button
function do_cancel(){
	$("#ajax-modal").modal('hide');
}

// Featured List
function load_list(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/feature/feature_list');?>";
	$("#data").load(url);
}

// Module List
function load_module(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/app_admin/module_list');?>";
	$("#data").load(url);
}

// Add Feature
function load_form(type){
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/add_feature');?>?type=" + type;
			//$(".popups").html($("#pre_circle").html());
			$('.popups h3').html('Register Application Feature');
			$('#popup_data').load(url);
			
}

function load_popup2(url,heading){




			$("#sub_view_page").html($("#pre_circle").html());
			var customOptions = new Object;
			customOptions.content = "#sub_view_page";
			customOptions.onShow = $('#sub_view_page').load(url);
			$.subview(customOptions);		

			//$(".popups").html($("#pre_circle").html());
//			$('.popups h3').html(heading);
//			$('.xPop').css('opacity','1')
//			$('#popup_data').load(url);
			
}

// Save Feature Data
function save_featdure(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/save_create_feature');?>";
	$('#desc').val($(".nicEdit-main").html());
	$.post(url,
	$("#add_feature").serialize(),

	function(data){
		load_module();
		close_subview();
	});
}

// Add Sub Feature
function load_sub_feature(id, type){
	
			url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/add_sub_feature/id');?>/" + id + "/type/" + type;
			$("#sub_view_page").html($("#pre_circle").html());
			var customOptions = new Object;
			customOptions.content = "#sub_view_page";
			customOptions.onShow = $('#sub_view_page').load(url);
			$.subview(customOptions);		
}


// Save Sub Feature Data
function save_sub_feature(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/submit_sub_feature/');?>";
	$('#desc').val($(".nicEdit-main").html());
	$.post(url,
	$("#create_sub_feature").serialize(),
	function(data){
		document.location.href = document.location.href;
		xpopup('close');

	});
}

// Edit Sub Feature Form	
function load_edit_sub_feature_fn(id, type){

	url = "<?php echo Yii::$app->urlManager->createUrl('/core/app_admin/edit_sub_feature');?>/id/" + id;
	$("#sub_view_page").html($("#pre_circle").html());
	var customOptions = new Object;
	customOptions.content = "#sub_view_page";
	customOptions.onShow = $('#sub_view_page').load(url);
	$.subview(customOptions);			
}

// Save Edit Data
function save_edit_sub_feature(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/update_sub_feature/');?>";
	$.post(url,
	$("#edit_sub_feature").serialize(),
	function(data){
			document.location.href = document.location.href;
			xpopup('close');
	});	
}

// Edit Feature Form	
function load_edit(id){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/feature/edit_feature/id/');?>" + id;
			$("#sub_view_page").html($("#pre_circle").html());
			var customOptions = new Object;
			customOptions.content = "#sub_view_page";
			customOptions.onShow = $('#sub_view_page').load(url);
			$.subview(customOptions);		
}

// Save Edit Data
function save_edit(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/feature/update_feature/');?>";
	$('#desc').val($(".nicEdit-main").html());
	$.post(url,
	$("#edit_feature").serialize(),
	function(data){
		
		
		load_list();
		close_subview();
		});	
}

// Delete Feature
function delete_feature(id){
if(confirm("Are you sure delete this record...")){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/delete_feature');?>?id=" + id;
	$.get(url,{
	},
	function(data, textStatus){
		document.location.href = document.location.href;
	});
}}

// Add Module Form
function module_form(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/app_admin/add_module');?>";
	$("#sub_view_page").html($("#pre_circle").html());
	var customOptions = new Object;
	customOptions.content = "#sub_view_page";
	customOptions.onShow = $('#sub_view_page').load(url);
	$.subview(customOptions);

}

// Save Module Data


	function sel_feature_list(module_id,f_type)
	{

		$('.nav-two li').each(function(index, element) {
            $(this).removeClass('active');
        });
		$('#m_' + module_id).addClass('active');
		$("#" + f_type + "_data").html("Loading...")
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/features/featureddata');?>?module_id=" + module_id + "&f_type=" + f_type;
    	$("#" + f_type + "_data").load(url,function(){
			//$.getScript("basic/js/xlib.js");	
		});
		
	}
	
function close_subview(){
	subview_action = "close";
	$.hideSubview();
	e.preventDefault();
	
}
</script>
 <div>

<div class="top-content">
        <div class="row">
        	<div class="col-sm-10" >
	            <h3>Application Feature</h3>
            </div>
            
            
        </div>
        <div class="border-btm"></div>
        </div>

<div class="row">

        <div class="col-sm-2 ht-auto-roles panel-scroll">
        
        <div class="nav-two">
                    <ul>
                    
            <?php

                foreach($module_list as $key => $value){
			?>
                    <li id="m_<?php echo $key;?>">
                    <a href="javascript:void(0)" onclick="sel_feature_list('<?php echo $key;?>','F')"><?php echo $value;?></a>
                    </li>
            <?php
                }
            ?>
            
                    </ul>
                   </div>
        
        	
            
        </div>
        
        

        <div class="col-sm-10 ht-auto-roles panel-scroll border-left">
        
        	<?php
            $url =  Yii::$app->urlManager->createUrl('/core/features/add_feature') . '?type=F';
			?>
	        <button class="btn btn-azure" href="javascript:void(0)"  onclick="load_popup('<?php echo $url?>','Register Application Feature')">Register New Application Feature</button> 
            
        	<div id="F_data"></div>
        </div>
        
    </div>


</div>
    
    
      
    


 
<div class="subviews">
	<div class="subviews-container"></div>
</div>

<div id="sub_view_page" class="no-display">
				
</div>

       
            

 


