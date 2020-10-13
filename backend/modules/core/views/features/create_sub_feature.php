<?php
use yii\helpers\Html;

?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Module: <?php echo $fetrd_data['module_name'] . '<br>Feature: ' . $fetrd_data['name']; ?></h4>
			</div>
			<div class="modal-body">
<?php 
$attributes = array('class' => 'form crt_emply', 'id' => 'create_sub_feature','name' => 'create_sub_feature');
echo Html::beginForm('','post',$attributes);
?>
    <input type="hidden" name="hidden_id" value="<?php echo $fetrd_data['id']; ?>">
    <input type="hidden" name="hidden_m_id" value="<?php echo $fetrd_data['module_id']; ?>">
    <input type="hidden" name="hidden_type" value="<?php echo $type; ?>">
    <input type="hidden" name="hidden_f_parent_id" value="<?php echo $fetrd_data['id']; ?>">
    
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
            <td colspan="2">
            	<div class="form-group">
                        <label class="col-sm-4 control-label" for="name">
                           Name :
                        </label>
                        <div class="col-sm-5">
                        	<input class="form-control" type="text" name="name" id="name" placeholder="Name">
                        </div>
                 </div>
             </td>

        </tr>

        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Menu Name :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="menu_name" id="menu_name" placeholder="Menu Name">
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Description :
                   </label>
                    <div class="col-sm-5">
                    	<textarea class="form-control" name="desc" id="desc" cols="" rows="" placeholder="Type your Description"></textarea>
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Link :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="url" id="url" placeholder="Url">
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
          <td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Controller Param :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="controller_param" id="controller_param" placeholder="Controller Param">
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Javascript Base :
                   </label>
                    <div class="col-sm-5">
                    	<label class="radio-inline control-label">
                            <input id="javascript_base_0" checked="checked" type="radio" value="N" name="javascript_base" class="grey">
                            No
                        </label>
                        <label class="radio-inline control-label">
                        	<input class="class="grey"" type="radio" name="javascript_base" value="Y" id="javascript_base_1" />
              				Yes
                        </label>
                    	
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Javascript Function :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="javascript_function" id="javascript_function" placeholder="Javascript Function">
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Menu Icon :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="menu_icon" id="menu_icon" placeholder="Menu Icon">
                    </div>
                </div>
           </td>
        </tr>
        
        <tr>
        	<td colspan="2">
            	<div class="form-group">
                   <label class="col-sm-4 control-label" for="name">
                   		Menu Order :
                   </label>
                    <div class="col-sm-5">
                    	<input class="form-control" type="text" name="menu_order" id="menu_order" placeholder="Menu Order">
                    </div>
                </div>
           </td>
        </tr>


    <tr>
    	<td colspan="2">
            <div class="form-group">
               <label class="col-sm-4 control-label" for="name">
                   Display :
               </label>
                <div class="col-sm-5">
                    <select name="repeat_function" id="repeat_function" class="form-control search-select">
                      <option value="Y">On List</option>
                      <option value="N">On Top</option>
                     
                     
                    </select>
                </div>
            </div>
       </td>
    </tr>
    </table>
    <?php echo Html::endForm(); ?>
</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-bricky" onclick="close_subview()">
					Close
				</button>
				<button type="button" class="btn btn-green" onClick="save_sub_feature()">
					Save changes
				</button>
			</div>

