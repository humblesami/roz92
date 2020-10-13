<?php

/* @var $this yii\web\View */
use backend\modules\paper\models\TblPapEpaperMst;
use backend\modules\paper\models\TblPapEpaperDtl;
use backend\modules\paper\models\TblMapPost;
use yii\helpers\Html;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
use efrontend\models\TblAjjColumn;
$this->title = 'Roznama';
$paper_mst = TblPapEpaperMst::find()->where(['station_id' => $station_id,'paper_status' => 'P'])->orderBy(['issue_date' =>SORT_DESC])->one();
if($xdate != ""){
  $paper_mst = TblPapEpaperMst::find()->where(['station_id' => $station_id,'issue_date' => $xdate,'paper_status' => 'P'])->orderBy(['issue_date' =>SORT_DESC])->one();
}
$image = '';
$map_data = '';

/*$paper_mst = TblPapEpaperMst::find()->where(['issue_date' => $issue_date])->one();*/
if($paper_mst){


$paper_id = $paper_mst->id;
$page_template_id = $paper_mst->page_template_id;

if($is_common == 'Y'){
  if($xdate == ""){
    $xdate = $paper_mst->issue_date;
  }

  $cpaper = TblPapEpaperMst::find()->where(['issue_date' => $xdate,'type' => 'C','page_template_id' => $page_template_id])->one();
  $paper_id =  $cpaper->id ;
}
$page_detail = TblPapEpaperDtl::find()->where(['epaper_id' => $paper_id,'page_id' => $page_id])->one();

$image = str_replace('efrontend','backend',Yii::getAlias('@web')) . '/' . $page_detail['path'];
$map_data = $page_detail['map_data'];

}


?>
<div class="row rowrtl">                      
    <div class="col-md-12 col-lg-9 col-sm-12 col-xs-12 right-col ">
      <!-- adds code -->
<?php echo \efrontend\components\Adds::widget() ?>
<!-- adds code -->
         <img src="<?php echo  $image;?>" class="ximg"    width="899" height="1503" usemap="#image-map" alt="">
        <?php echo $map_data;?>

        <!-- adds code -->
<?php echo \efrontend\components\Adds::widget() ?>
<!-- adds code -->
    </div>

     <div class="col-md-12 col-lg-3 col-sm-12 col-xs-12 left-col">
 
          <div class="cont-left-sec">

                <div class="text-right col-list">
                  <h2>آج کے کالم</h2>

                 <?php
                   //$cdate = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));
                  $cdate = date('Y-m-d') ;
                       
                                    $posts = TblAjjColumn::find()->all();


                               

                                 

                                
                  ?>
                                 <div class="ajj-col-page">
                                    <ul>
                                      <?php 
$aa = 0;
                                      foreach ($posts as $post) :
                                        $p_img = $post->profile_image;

                                          

                                         
                                          $map_id     = $post->map_id;
                                         
                                          $image_url  =  $post->image_url; 
                                          $aa = $aa + 1;

                                          
                                         ?>

                                         <?php if($aa == 5 or $aa == 8){?>
                                         <li>

                                          <!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->
</li>
<?php }?>
                                        <li>
                                            <div class="row">

                                                <div class="col-sm-4 col-xs-4">
                                                  
                                                
                                                    
                                                    <img src="<?= $p_img; ?>" alt="" class="img-responsive">
                                                                                            
                                                    </div>                                       
                                                
                                                <div class="col-sm-8 col-xs-8">
                                                    <div class="xtitle"><a href="javascript:void(0)" onclick="load_popup_col('<?php echo $image_url;?>')"><?= $post->title; ?></a></div>
                                                    <div class="xname"><b>
                                                         <?php

                                                         $category_id = $post->category_id;
                                                         if($category_id){
                                                          
                                                            $murl =  $post->cat_url;                                                 

                                                         echo  Html::a($post->profile_name, [$murl]);

                                                     }else{

                                                        echo $post->profile_name;
                                                       
                                                     }

         //echo date('Y-m-d',$post->published_at);
                                                         ?>   
                                                       </b></div>
                                                   
                                                </div>

                                            </div>
                                        </li>

                                      <?php endforeach; ?>  
                                       
                                        
                                       

                                        
                                                                                                                                                                                                        
                                    </ul>

                                    <!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->
                                </div> <!-- aaj col -->
                 



                </div> <!-- col-list -->

          </div> <!-- con-left-sec -->

          
     </div> <!-- 2nd col -->


 </div> <!-- row -->

<div id="nr-img-preview" style="display: none;">
  <div class="text-center">

        <div class="contnr-column">
          <div align="left" class="social-icons">
            <style type="text/css">
 
            #share-buttons img {
            width: 35px;
            padding: 5px;
            border: 0;
            box-shadow: 0;
            display: inline;
            border-radius: 5px !important;
                box-sizing: border-box
            }
             
            </style>
            <!-- I got these buttons from simplesharebuttons.com -->
            <div id="share-buttons" style="
    padding-left: 17px;
" >
                
                <!-- Facebook -->
                <a href="#" id ="fshare" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                </a>

               <!-- Twitter -->
                <a href="#" id="tshare" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                </a>

              <!-- LinkedIn -->
                <a href="#" id="lshare" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                </a>

              <!-- Email -->
                <a id="eshare" href="#">
                    <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                </a>
                
                <!-- Print -->
                <a href="javascript:;" onclick="window.print()">
                    <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
                </a>  


    <a href="https://www.roznama92news.com/" style="
    /* float: right; */
    position: absolute;
    right: 50%;
    top: 20px;
    /* height: 75px; */
"><img src="/images/logo.png" alt="92 News" style="
    width: 56px;
"></a>

            </div>


          </div>
          <span class=""> <!-- left-ads -->

            
          </span>
          
          <span class=""> <!-- middle-img -->
            <img src="" id="nr-img">
          </span>
          
          <span class=""> <!-- right-ads -->
            
          </span>
          <div class="clearfix"></div>
        </div>


      <div class="dis-cont" style="width: 50%; margin:0px auto;" >
        <?php
        $share_url = $image;
        echo  $this->render('/items/share.php', ['url' => $share_url]) ?>
      </div>
      <div class="cls">
        <a href="javascript:void(0)" onclick="close_popup()"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
      </div>

  </div>
</div>
<style>
.cls{position: absolute;
    font-size: 40px;
    right: 12px;
    top: 5px;
    z-index: 999999999;
    
  }
.cls a {color:#ccc;}    
#nr-img-preview{
  background: rgba(0,0,0,0.7) ;
  height: 100%;
  position:fixed;
  width:100%;
  top:0px;
  left:0px;
  z-index: 9999;
  overflow:scroll;
  padding-top:50px;
  padding-bottom: 50px;

}
ul.list-group:after {
  clear: both;
  display: block;
  content: "";
}

.list-group-item {
    display: inline-block;
}

.lt-479 div.aw-widget-current-inner div.aw-widget-content a.aw-current-weather p{
  position: relative!important;
    width: 100%!important;
    padding-left: 0%!important;
    z-index: 11!important;
}
</style>
<script type="text/javascript">
   /* $(function(){

        $('img[usemap]').maphilight()

        $('area').click(function(e){

           e.preventDefault()
           
          $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',$(this).attr('href'))
           $('body').css('overflow','hidden')
        })
    })
    function close_popup(){
      $('#nr-img').attr('src','')
      $('#nr-img-preview').hide();
      $('body').css('overflow','scroll')
    }*/
</script> 
<?php
    $protocol = 'http';
     $protocol = Yii::$app->urlManager->createUrl('/site/index') . '?station_id=' . $station_id . '&page_id=' . $page_id . '&is_common=' . $is_common .  '&xdate=' . $xdate ; 

?>
<script type="text/javascript">


  
$(function(){

  $('#xdate').change(function(){
    xdate = $(this).val();
    var d = new Date(xdate);
    month = d.getMonth() + 1;

    day = '' + d.getDate(),
    year = d.getFullYear();
    newDate = year + "-" + month + "-" + day;

    url = "<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=0&is_common=<?php echo $is_common;?>&n=<?php echo $n?>&xdate=" + newDate;
    document.location.href = url;

  });

  $('#xdate-mob').change(function(){
    xdate = $(this).val();
    var d = new Date(xdate);
    month = d.getMonth() + 1;

    day = '' + d.getDate(),
    year = d.getFullYear();
    newDate = year + "-" + month + "-" + day;

    url = "<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=0&is_common=<?php echo $is_common;?>&n=<?php echo $n?>&xdate=" + newDate;
    document.location.href = url;

  });

        <?php

          if($n != '1000'){
             
          
        ?>
            load_popup('<?php echo $n?>');
        <?php }?>
        $('img[usemap]').maphilight()
var ratio= 1503 / 899;

var newHeight= $(".ximg").width() * ratio;
       newHeight = Math.abs(newHeight);
      //$('.ximg').width(768);
       $('.ximg').height(newHeight);

$('img[usemap]').maphilight()
        $('area').click(function(e){

           e.preventDefault()
           image_url = $(this).attr('href');
           $('#fshare').attr('href','http://www.facebook.com/sharer.php?u=' + image_url );
           $('#tshare').attr('href','https://twitter.com/share?url=' + image_url);
           $('#lshare').attr('href',' http://www.linkedin.com/shareArticle?mini=true&amp;url=' + image_url);

           $('#eshare').attr('href',' mailto:?Subject=Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 ' + image_url);



         


          $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',$(this).attr('href'))
           $('body').css('overflow','hidden');
           id = '&n=' + $(this).attr('id');
           $page_url = '';//'&page_id=' + '<?php echo $page_id;?>'
           url = '<?php echo $protocol?>'  + $page_url + id;
           window.history.pushState("string", "Title", url);
        })
    })

    function close_popup(){
      $('#nr-img').attr('src','')
      $('#nr-img-preview').hide();
      $('body').css('overflow','scroll');
      url = document.location.href;
     
      url = removeURLParameter(url,'n');
       window.history.pushState("string", "Title", url);
      
    }

function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0]+'?'+pars.join('&');
        return url;
    } else {
        return url;
    }
}

    function load_popup(para){
     
         $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',$('#' + para).attr('href'))
           $('body').css('overflow','hidden')

     // alert(para)
      //$('#' + para).trigger('click');
    }

    function load_popup_col(img){
    image_url  = img;
    $('#fshare').attr('href','http://www.facebook.com/sharer.php?u=' + image_url );
           $('#tshare').attr('href','https://twitter.com/share?url=' + image_url);
           $('#lshare').attr('href',' http://www.linkedin.com/shareArticle?mini=true&amp;url=' + image_url);

           $('#eshare').attr('href',' mailto:?Subject=Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 ' + image_url);  
         $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',img)
           $('body').css('overflow','hidden')

     // alert(para)
      //$('#' + para).trigger('click');
    }

</script>                                       