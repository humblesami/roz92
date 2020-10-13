
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<script language="javascript">
// master_setup_list
function master_entry_list(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/master_setup/master_entry_list')?>/<?php echo $master_setup_id;?>";
	$("#master_data").load(url);
}

function add_new_master_setup(){
	url = "<?php echo Yii::$app->urlManager->createUrl('/core/mastersetupentry/add_new_master_setup')?>";
	var $modal = $('#ajax-modal');
    $modal.load(url, '', function () {
          $modal.modal();
    });	
}
function delete_master_entry(master_setup_id,key_id){
					if(confirm("Are you SURE you want to delete selected row?")) {
						url = "<?php echo Yii::$app->urlManager->createUrl('/core/master_setup/delete_master_entry/')?>/master_setup_id/" + master_setup_id + "/key_id/" + key_id
						window.location.replace(url);
					}
	
}
</script>


<style>
.msg{ color:#F00; }
</style>
<div align="right" style="padding:10px 0 10px 10px;">


</div>

<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-default">
<div class="panel-heading">
<?php echo $master_data->master_setup_name;?>

</div>
<div class="panel-body">

<a class="btn btn-azure" href="<?php echo Yii::$app->urlManager->createUrl('/core/mastersetupentry/create')?>?master_setup_id=<?php echo $master_setup_id?>" >Create New <?php echo $master_data->master_setup_name;?></a>
<br /><br />


<?php
$master_data_result = json_decode($master_data->master_setup_value);
$fields = json_decode($master_data->fields,true);
                        

?>
<table class="table table-striped table-hover table-full-width master_table_styl" id="sample_1">
<thead>
<tr>
<th width="10%">Id</th>
<?php foreach($fields as $f_key => $f_value){?>
<th width="20%"><?php echo $f_value;?></th>
<?php }?>

<th class="mst_tbl_cent" width="25%">Action</th>
</tr>
</thead>
<tbody>
<?php

if($master_data_result){

foreach($master_data_result as $key => $value){
if($value->status == 1){
?>  
<tr>
<td><?php echo $key;?></td>
<?php foreach($fields as $f_key => $f_value){?>
<td><?php echo (isset($value->$f_value)) ? $value->$f_value : '';?></td>
<?php }?>


<td align="center">

<a href="<?php echo Yii::$app->urlManager->createUrl('/core/mastersetupentry/edit/')?>?master_setup_id=<?php echo $master_setup_id;?>&key_id=<?php echo $key;?>"><i class="fa fa-edit font-size-tbl"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

<a href="javascript:void(0)" onclick="delete_master_entry('<?php echo $master_setup_id?>','<?php echo $key;?>')" ><i class="fa fa-trash-o font-size-tbl"></i></a>


</td>
</tr>
<?php
}
}
}
?>  
</tbody>
</table>
</div>
</div>
<!-- end: DYNAMIC TABLE PANEL -->





