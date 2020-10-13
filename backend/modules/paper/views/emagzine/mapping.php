
<?php
use backend\assets\AppAsset;
use yeesoft\assets\YeeAsset;
use yii\bootstrap\ActiveForm;
use yeesoft\post\models\Category;
use backend\modules\paper\models\TblPapEpaperDtl;
use yii\helpers\Html;
use yeesoft\post\widgets\MagicSuggest;
use yii\helpers\ArrayHelper;

$eDetail  = TblPapEpaperDtl::findOne($id);
$image = Yii::getAlias('@web') . '/' . $eDetail->path;
$issue_date =  date('dmY',strtotime($eDetail->mst['issue_date']));
$page_detail = $eDetail->mst['page_detail'];
$page_detail  = json_decode($page_detail);
$page = $page_detail[$eDetail->page_id]->name;


$short_code = ($eDetail->mst->station['short_code']) ? $eDetail->mst->station['short_code'] : 'Common';
$page_heading = $short_code . ' - ' . $issue_date . ' - ' . $page; 


 $map_data = $eDetail->map_data_raw;
 //echo '<pre>' . $map_data . '</pre>';
AppAsset::register($this);
$assetBundle = YeeAsset::register($this);

?>
<link rel="stylesheet" href="<?= $assetBundle->baseUrl; ?>/css/app.min.css">

<style type="text/css">
.map-left .panel-heading{ 
background: #f1f1f1;
    border-radius: 0px;
    padding: 5px;
    line-height: 33px;
}
.map-left{padding-left: 0px;padding-right: 0px;}
.map-left .btn{padding:10px; color:#008040; color:#fff;line-height:0.5;}
.map-left .table{margin-top:0px;}
.map-left .map-heading{font-size:14px;}
.map-left .affix{width:25%;}
.box-img{width:250px; background:#f1f1f1; min-height: 150px;  margin:5px; }

.post-image{margin-top:50px;}
.table>tbody>tr>td{ padding:0px 8px; }
 .table>thead>tr>th{ padding:5px 8px; }

 
label.btn span {
  font-size: 1.5em ;
}

label input[type="radio"] ~ i.fa.fa-circle-o{
    color: #c8c8c8;    display: inline;
}
label input[type="radio"] ~ i.fa.fa-dot-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
    color: #008040;    display: inline;
}
label:hover input[type="radio"] ~ i.fa {
color: #008040;
}

label input[type="checkbox"] ~ i.fa.fa-square-o{
    color: #c8c8c8;    display: inline;
}
label input[type="checkbox"] ~ i.fa.fa-check-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
    color: #008040;    display: inline;
}
label:hover input[type="checkbox"] ~ i.fa {
color: #008040;
}

div[data-toggle="buttons"] label.active{
    color: #008040;
}

div[data-toggle="buttons"] label {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 12px;
font-weight: normal;
line-height: 2em;
text-align: left;
white-space: nowrap;
vertical-align: top;
cursor: pointer;
background-color: none;
border: 0px solid 
#c8c8c8;
border-radius: 3px;
color: #c8c8c8;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

div[data-toggle="buttons"] label:hover {
color: #008040;
}

div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
-webkit-box-shadow: none;
box-shadow: none;
}
.image-mapper-img{width:899px; height: 1503px;}

.panel.panel-default>.top-heading{padding-left:89px;}
</style>


<div class="panel panel-default">
            <div class="panel-heading top-heading ">
                <?php echo $page_heading;?>      
            </div>
            <div class="panel-body" >
            
            <div class="row">
                <div class="col-sm-2 map-left" >

                <div style="height: 400px; position: fixed;width: 275px; z-index: 999"  >

                    <div class="tscrsoll" style="height: 400px; overflow-y: scroll;" >
  
                <table class="table table-condensed table-bordered"  id="image-mapper-table">
                    <thead>
                        <tr>
                            <th class="map-heading">MAP</th>
                            <th colspan="2">
                                
 <div class="text-right">
                                                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#image-shape">Add Map</button>  
                                                      <button type="button" style="display: none;" class="btn btn-success btn-sm add-row">Add Map</button>



                                                        <button type="button" class="btn btn-success btn-sm" onclick="save_area()">Save</button>             
                                                </div>


                            </th>
                        </tr>
                    </thead>
              
                <tbody>
                    <tr id='x_0'>
                        <td >

 


<div class="btn-group btn-group-vertical" data-toggle="buttons">
        <label class="btn active">
          <input type="radio" class="radio" name="im[0][active]" value="1"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span></span>
        </label>
        
      </div>

    </div>
  </div>










                                     

                                    <select name="im[0][shape]" style="display: none" class="form-control input-sm shape">
                                <option value="">---</option>
                                <option value="rect" selected="">Rect</option>
                                <option value="poly">Poly</option>
                                <option value="circle">Circle</option>
                                    </select>
                                    <input type="text" class="href" style="display: none" name="im[0][href]" value="" placeholder="Link" class="form-control input-sm">
                                    <input type="text" name="im[0][title]" style="display: none" value="" placeholder="Title" class="form-control input-sm">

                                    <select name="im[0][target]" class="target" style="display: none" class="form-control input-sm">
                                <option value="">---</option>
                                <option value="_blank">_blank</option>
                                <option value="_parent">_parent</option>
                                <option value="_self">_self</option>
                                <option value="_top">_top</option>
                                    </select>



                            </div>
                        </td>
                        
                        <td width="23%" class="ntitle"><input type="text"  name="im[0][title_display]" style="border:0px" value="0" placeholder="num" class="form-control input-sm display_title"></td>
                        
                       
                        <td>
                             <button class="btn-link theLink" name="im[0][edit]" >Edit</button> | 
                            <button class="btn-link remove-row" name="im[0][remove]">Delete
                            </button>
                        </td>
                    </tr>


                </tbody>
                                
                </table>

            </div>

</div>






                   


                </div> <!-- col-4 -->
                <div class="col-sm-10 isscroll" style="margin-left:246px;">



                        <div class="col-md-12" id="image-map-wrapper">
                            <div id="image-map-container">
                                <div id="image-map" style="max-width: 100%">

                                    <img class="image-mapper-img" width="899" height="1503" src="">





                                    <span class="glyphicon glyphicon-picture"></span>
                                </div>
                            </div>
                        </div>




                </div> <!-- col-9 -->
            </div>

                    
                    
                                        
                    
                    
                    
                                       
        
                                
                    
                      
                                        
                                            
               
            </div> <!-- body Panel -->
</div> <!-- panel -->


<div>

    
    
  
    <div class="modal fade " id="image-edit" tabindex="-1" role="dialog" aria-labelledby="image-mapper-load-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="image-mapper-dialog">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="image-mapper-load-label">Image Map: 001</h4>
                </div>
                <div class="modal-body" style="height: 500px; overflow-y: scroll">

<?php $form = ActiveForm::begin(['id'=>'post-form','options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-sm-12">

<div cldass="container">
  <div class="accordion-option">
    
    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
  </div>
  <div class="clearfix"></div>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          News
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body" style="border: 1px solid #ccc">
         
            <div class="row">
                <div class="col-sm-8">
                    



                                <input type="hidden" name="page_detail_id" value="<?php echo $id?>">
                                <input type="hidden" name="map_id" value="" id="map_id" >




                              
                              <div class="form-group">
                                <label for="pwd">Title:</label>
                                <input type="text" name="title" class="form-control" onblur="change_slug()" id="title">
                              </div>

                               <div class="form-group">
                                <label for="pwd">Slug:</label>
                                <input type="text" name="slug" class="form-control" id="slug">
                              </div> 
                              <div class="form-group">
                                <label for="pwd">News:</label>
                                <textarea name="news" id="news"  class="form-control" cols="30" rows="5"></textarea>
                               
                              </div>  
                             








                </div>

                <div class="col-sm-4">
                    
<?php
                                
                                $type_list[1] = 'News';
                                 $type_list[2] = 'Column';

                                ?>
                                <?= $form->field($modelpost, 'post_type')->dropDownList($type_list,
                                    ['prompt' => ' --- Select ---','id' => 'post_type','class' => 'form-control search-select',
                                    
                                           
                                    ]); 
                                    $p_class = '';
                                ?>  

                                <label>Category</label>
                                <div class="cinput" style="height: 200px; overflow-y: scroll; border: 1px solid #ccc;padding:5px;">


                                  

                                    <?php
$cc =  ArrayHelper::map(Category::getCats(), 'id', 'name');
$sel_val = json_decode($modelpost->catValues,true);

 echo $form->field($modelpost, 'catValues')->checkboxList($cc,


 ['item' => function ($index, $label, $name, $checked, $value) {
        return '<div>'
                . '<label>'
                . '<input type="checkbox" {$checked}  name="' . $name . '" value="' . $value . '"> '
                . '<span class="route-text">' . $label . '</span>'
                . '</label>'
                . '</div>';
    }]

                            )->label(false);


                                    ?>

                                <?//= $form->field($modelpost, 'catValues')->widget(MagicSuggest::className(), ['items' => Category::getCats()]); ?>

                                </div>


                                



                </div>
            </div>



 







        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Images
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body" style="border:1px solid #ccc;">
          


                            <div class="box-img">
                                   

                                   <input type="hidden" id="name_id" id="name_id" value="">

                                    <div style="display: none;">

                                    <?= $form->field($model, 'imageFiles[]')->fileInput(['id' => 'forum_image', 'accept' => 'image/*']) ?>    

                                    </div>
                                    <div class="text-center box-img">
                                           
                                            <img id="blah" src="#"  width="250" height="250" style="display: none" />
                                       
                                      
                                    </div>
                                    <div class="link-image">
                                        <a href="" onclick="return uploadImage();"><b class="photo">News Paper Image</b></a>
                                    </div>
 <!-- Image link to select imag -->


                            </div>


<hr>
<style type="text/css">
    

</style>
<div class="post-image" >
    <?= $form->field($modelpost, 'thumbnail')->widget(yeesoft\media\widgets\FileInput::className(), [
                                'name' => 'image',
                                'buttonTag' => 'button',
                                'buttonName' => Yii::t('yee', 'Browse'),
                                'buttonOptions' => ['class' => 'btn btn-default btn-file-input'],
                                'options' => ['class' => 'form-control'],
                                'template' => '<div class="post-thumbnail thumbnail"></div><div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                'thumb' => 'medium',
                                'imageContainer' => '.post-thumbnail',
                                'pasteData' => yeesoft\media\widgets\FileInput::DATA_URL,
                                'callbackBeforeInsert' => 'function(e, data) {
                                $(".post-thumbnail").show();
                            }',
                            ]) ?>
</div>




        </div>
      </div>
    </div>
     <button type="button" onclick="send()" class="btn btn-success btn-sm">Save</button>
  </div>
</div>

</div></div>













                    
                    <?php ActiveForm::end(); ?>
                </div>
                
            </div>
        </div>
    </div>


    <div class="modal fade" id="image-shape" tabindex="-1" role="dialog" aria-labelledby="image-mapper-load-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="image-mapper-dialog">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="image-mapper-load-label">Add New Map</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                             <img src="<?= $assetBundle->baseUrl; ?>/images/custom_shape.jpg" class="img-responsive" onclick="select_shape('poly');">
                         </div>
                         <div class="col-sm-4">
                            <img src="<?= $assetBundle->baseUrl; ?>/images/rec.png" class="img-responsive" onclick="select_shape('rect');">
                        </div>
                        <div class="col-sm-4">
                            <img src="<?= $assetBundle->baseUrl; ?>/images/circle.jpg" class="img-responsive" onclick="select_shape('circle');">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-code" tabindex="-1" role="dialog" aria-labelledby="modal-code-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-code-dialog">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <textarea class="form-control input-sm" readonly="readonly" id="modal-code-result" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   
</div>
<style type="text/css">
    .cinput .ms-sel-ctn input[type="text"]{border:0px;padding:0px 5px; line-height: 20px; width:100%;}
    .cinput .form-control{padding:5px 10px;}
</style>
<?= $assetBundle->baseUrl; ?>
<script src="<?= $assetBundle->baseUrl; ?>/js/mapping.js"></script>
<script>
// this script executes when click on upload images link
    function uploadImage() {
        $("#forum_image").click();
        return false;
}
</script>
 
<script type="text/javascript">

$(document).ready(function() {
   // $('.theLink').click(function(){
    $( "body" ).on( "click",".theLink", function() {    
        $('#image-edit').modal('show');
        name = $(this).attr('name');

        name = name.replace('im[','')
        name = name.replace('][edit]','')
  
        $('#name_id').val(name); 
        $('#map_id').val(name);
        name_title = 'Image Map: ' + (Math.abs(name) + 1);
        $('#image-mapper-load-label').html(name_title);

        xurl = "<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/get_map_post/');?>?page_detail_id=<?php echo $id;?>&map_id=" + name;
        $.get( xurl, function( data ) {
           
            $('#title').val(data.title);
            $('#slug').val(data.slug);
            $('#news').val(data.content);
            $('#post_type').val(data.post_type);
            $('#post_type').val(data.post_type).change();
        }, "json" );

         //$('#blah').hide();

 $(".post-thumbnail").hide();
 $('#post-thumbnail').val();
         b = $('#image-map').imageMapper("getData");
          image = b.area[name].href;
            if(image != ''){
               $('#blah').attr('src', image);
               $('#blah').show();
           }else{
             $('#blah').attr('src', '');
             $('#blah').hide();
           }
    });
/*$("body").append("svg").attr("width", 50).attr("height", 50).append("circle").attr("cx", 25).attr("cy", 25).attr("r", 25).style("fill", "purple");*/

    $("#forum_image").change(function() {
      readURL(this);
    });
});

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('#blah').show();
    }

    reader.readAsDataURL(input.files[0]);
  }
}

// this script for collecting the form data and pass to the controller action and doing the on success validations
function send(){
    $('#page_loading').show();
    var formData = new FormData($("#post-form")[0]);
    console.log(formData);
    $.ajax({
        url: "<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/upload_image/');?>?id=<?php echo $eDetail->epaper_id;?>",
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            // do some loading options
            
        },
        success: function (data) {
            // on success do some validation or refresh the content div to display the uploaded images 
            named  = $('#name_id').val(); 
            
            named = named.replace('n_','');

            if(data != "no_upload"){

                b = $('#image-map').imageMapper("getData");
                data = $.trim(data);
                b.area[named].href = '<?php echo IMPPATH;?>' + data;
                b.area[named].target = '_blank';
                
                $('#x_' + named + ' .href').val( '<?php echo IMPPATH;?>' + data);
             }

        },
 
        complete: function() {
            // success alerts
            

            $('#page_loading').hide();
             toastr.success('Post has been saved.', 'Mapping');
             save_area();
        },
 
        error: function (data) {
            alert("There may a error on uploading. Try again later")
        },
        cache: false,
        contentType: false,
        processData: false
    });
 
    return false;
}
</script>

    <script>
        (function(a) {

            /*a("#image-map").imageMapper({
                        src: "<?php echo $image;?>",
                        
                    });*/
           

/*$('.tscroll').perfectScrollbar({
                wheelSpeed: 50,
                minScrollbarLength: 20,
                suppressScrollX: true
            });

$('.iscroll').perfectScrollbar({
                wheelSpeed: 50,
                minScrollbarLength: 20,
                suppressScrollX: true
            });
$('.panel-scroll').perfectScrollbar("destroy");*/
          d =   $(document).trigger('init');
 $('.image-mapper-img').attr('src','<?php echo $image;?>')
 

map_data2 = JSON.parse('<?php echo $map_data?>');
mlength = map_data2.length;
for (i = 1; i < mlength; i++) { 
   $('.add-row').trigger('click');
}

                var b = a('#image-map').imageMapper("getData");
        // console.log(b)      
a.each(map_data2, function(nb) {
 //console.log(map_data2[nb].href);
        b.area[nb].coords = map_data2[nb].coords
        b.area[nb].shape = map_data2[nb].shape
         b.area[nb].href = map_data2[nb].href
    
});
a('#image-map').trigger('click')
                //b.area = map_data2;
               // console.log(map_data)
            //console.log(b.area);
            /*a.each(b.area, function(nb) {

                b.area[nb].title_display = 'http://www.google.com';

                nf = {naturalX: 114, naturalY: 69};
                nf1 = {naturalX: 398, naturalY: 170};

                b.area[nb].coords[0] = nf;
                b.area[nb].coords[1] = nf1;

                
            });*/

  
 
/*$("#image-map").imageMapper("custompoint",20,100).trigger('update');
$("#image-map").imageMapper("custompoint",100,200).trigger('update');*/



 




 /*$('.image-mapper-svg').html('<rect x="290" y="115" width="277" height="35" class="image-mapper-shape" data-area-index="1" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1; opacity: 0.6; cursor: pointer;"></rect><rect x="17" y="60" width="172" height="76" class="image-mapper-shape" data-area-index="0" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1; opacity: 0.6; cursor: pointer;"></rect><circle cx="290" cy="115" r="5" class="image-mapper-point" data-area-index="1" data-coord-index="0" style="fill: rgb(255, 255, 255); stroke: rgb(51, 51, 51); stroke-width: 1; opacity: 0.6; cursor: pointer;"></circle><circle cx="567" cy="150" r="5" class="image-mapper-point" data-area-index="1" data-coord-index="1" style="fill: rgb(255, 255, 255); stroke: rgb(51, 51, 51); stroke-width: 1; opacity: 0.6; cursor: pointer;"></circle>');*/
           /* setTimeout(function() {
        
       

       call_me();
    }, 100);*/
           

            
function call_me(){
   // alert('d')
    // $("#image-map").imageMapper("renderPoints").trigger("update")
}


           

           
            $('.toggle-content').show();
        })(jQuery);
        function add_map(){


        }
        function select_shape(type){
            $('.add-row').trigger('click');
             $('#image-shape').modal('toggle');
            $("input[type=radio]:last").trigger('click');

           
            $(".shape").last().val(type).change(); 
             
        }
        function save_area(){
            var row = $('#image-map').imageMapper("getData")
            row = row.area;

           row = JSON.stringify(row);


            var b = $("#image-map").imageMapper("asHTML");
            $("#modal-code-result").text(b).css("whiteSpace", "pre")
            result = $('#modal-code-result').val();


            
            url = "<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/mapping/');?>?id=<?php echo $id;?>";
           $('#page_loading').show();
            $.post(url,

            { map_data : result,
              row_data : row,
             },

            function(data){
                 $('#page_loading').hide();
                 toastr.success('Map has been saved.', 'Mapping');

            });
        }


    
    function change_slug(){
        slug = $('#title').val();
        slug = slug.replace(/\ /g, '-');;
       // $('#slug_value').text(slug)
        $('#slug').val(slug);
    }

    </script>

  