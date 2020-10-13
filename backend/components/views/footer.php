		<script>

			jQuery(document).ready(function() {
				Main.init();
				
						
			});
		</script>		
	
		
			

		
<div id="general_window"></div>
<div id="page_loading">
  <img id="loading-image" src="<?= Yii::getAlias('@web') ; ?>/themes/basic/images/loading_page.gif" alt="Loading..." />
</div> 

<div id="pre_circle" style="display:none">
 <style>

.glyphicon-refresh-animate {
    -animation: spin 1.0s infinite linear;
    -webkit-animation: spin2 1.0s infinite linear;
	-moz-animation: spin2 1.0s infinite linear;
} 
@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@-moz-keyframes spin2 {
    from { -moz-transform: rotate(0deg);}
    to { -moz-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
 </style>
 
 
 
 	<div class="row">
		<div class="col-sm-12 text-center loading_circle_mar">
            <img src="<?= Yii::getAlias('@web') ; ?>/themes/basic/images/circle_loader.png" style="width:120px;height:120px;margin-top: 0px;" class="glyphicon glyphicon-refresh glyphicon-refresh-animate">
    	</div>    	
    </div>
</div>




<div class="popups">
	<div class="xPop addFolder"><i class="close"></i>
    	<h3></h3>
        <div class="innercont">
            <div class="innerScroll">
		        <div id="popup_data"></div>
            </div>
        </div>
    </div>
    
</div>

<div class="subviews">
	<div class="subviews-container"></div>
</div>

<div id="sub_view_page" class="no-display">
				
</div>

<div id="ajax-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 id="gridSystemModalLabel"></h2>
      </div>
      <div class="modal-body panel-scroll" id="model_content">

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>       
 <script>
        jQuery(document).ready(function() {
          //  Main.init();
          
        });
    </script>
            
