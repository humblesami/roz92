
<div id="panel_tab3_example1" class="tab-pane active">
    <div>
        <ol class="dd-list">
            <?php foreach($search_result as $row){?>
                <li class="dd-item" data-id="<?php echo $row['id'];?>">
                    <div class="dd-handle">
                    <input type="checkbox" name="menu_sel[]" value="<?php echo $row['id'] . "_" . $row['name']; ?>">
                    <?php echo $row['name'];?>
                    </div>
                </li>
            <?php }?>
        </ol>
	</div>
</div>
