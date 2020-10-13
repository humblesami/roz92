<?php
/* @var $this yii\web\View */


use yeesoft\post\models\Post;
use app\components\PostWidget as p;
use backend\modules\paper\models\TblPapEmagzineMst;

/* @var $post yeesoft\post\models\Post */

$this->title = $post->title;
$this->params['breadcrumbs'][] = $post->title;

$mid = TblPapEmagzineMst::find()->where(['type' => 1])->orderBy(['issue_date' =>SORT_DESC])->one();
                    $issue_date = $mid['issue_date'];
                    $strdate = strtotime($issue_date);
                    $year = date('Y',$strdate);
                    $month = date('m',$strdate);
                    $iDate = date('dmY',$strdate);
                    $image_mid = SITEURL . '/backend/web/uploads/emagzine/1/' . $year . "/" . $month . "/" . $iDate . "/1.jpg";


$sunday = TblPapEmagzineMst::find()->where(['type' => 2])->orderBy(['issue_date' =>SORT_DESC])->one();
                    $issue_date = $sunday['issue_date'];
                    $strdate = strtotime($issue_date);
                    $year = date('Y',$strdate);
                    $month = date('m',$strdate);
                    $iDate = date('dmY',$strdate);
                    $image_sunday = SITEURL . '/backend/web/uploads/emagzine/2/' . $year . "/" . $month . "/" . $iDate . "/1.jpg";
                    
?>

<?php
$image_url = '';
$head_e = '';
$post_map = \backend\modules\paper\models\TblMapPost::find()->where(['post_id' => $post->id])->one();
if($post_map){
  $map_data   =  $post_map->paperdetail->map_data_raw;
  $publish_date = frontend\models\common::urdu_date(Yii::$app->formatter->asDate($post->publishedDate));


  $station    =  $post_map->paperdetail->mst->station['urdu_name'];   
  $map_id     = $post_map->map_id;
  $map_data   = json_decode($map_data,true);
  $image_url  =  $map_data[$map_id]['href'];  
  $ck = 'خبر';
  $gi = 'کی گی';

  if($post->post_type == 2){
    $ck = 'کالم';
    $gi = 'کیا گیا';
  }
  $head_e     = 'یہ ' . $ck . ' روزنامہ ٩٢نیوز ' . $station . ' میں ' . $publish_date. ' کو شایع ' . $gi . ' ';
}


?>


        <div class="row rowrtl">

            <div class="col-sm-9">
               
                
                   <?= $this->render('/items/postdetail.php', ['post' => $post,'image_url' => $image_url]) ?>

                
                
            </div>          
            <div class="col-sm-3">
                
                
                
              <?php if($image_url != ""){ ?>
               <div class="ehead"><?php echo $head_e;?></div>
                <img src="<?php echo $image_url;?>" style=" cursor: pointer;" class="img-responsive xarea">
                <br>
                <?php }?>
                
                <!-- adds code -->
<?php echo $this->render('../items/add_detail') ?>
<!-- adds code -->
<br>
                
                <?php



echo P::widget(['heading' => 'آج کا اخبار','category_id' => '23', 'view_post' => 'border']);
?>
<?php echo $this->render('../items/add_detail') ?>
<br>
                <!-- magzine -->
                <div class="recent-post-slider design-8" style="width:93%;margin: 0px auto;">
             
                  <div class="post-slides">
                      <div class="post-overlay">
                          <div class="post-image-bg">
                        
                              <a href="<?php echo Yii::$app->urlManager->createUrl('/efrontend/web/magzine');?>?type=1"><img src="<?php echo $image_mid;?>" class="img-responsive" alt=""></a>
                          </div>
                  
                      </div>


                  </div>

                  <div class="post-slides">
                      <div class="post-overlay">
                          <div class="post-image-bg">
                        
                              <a href="<?php echo Yii::$app->urlManager->createUrl('/efrontend/web/magzine');?>?type=1"><img src="<?php echo $image_sunday;?>" class="img-responsive" alt=""></a>
                          </div>
                  
                      </div>


                  </div>
                  
              </div>
              <script type="text/javascript">
                      jQuery(document).ready(function(){
                      jQuery('.recent-post-slider.design-8').slick({
                           rtl:true,
                          dots: false,
                          infinite: true,
                          arrows: false,
                          speed: 300,
                          autoplay: true,                     
                          autoplaySpeed: 3000,
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          responsive: [
                  {
                    breakpoint: 768,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      infinite: true,
                      dots: true
                    }
                  },
                  {
                    breakpoint: 640,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                ]
                      });
                  });
                  </script>
              <!-- magzine -->
                <br>

<?php
echo P::widget(['heading' => 'اہم خبریں','category_id' => '14', 'view_post' => 'border']);
                ?>

        <div>
<!-- adds code -->
<?php echo \frontend\components\Adds::widget() ?>
<!-- adds code -->
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

<div id="nr-img-preview" style="display: none;">
  <div class="text-center">
    <div>
      <div align="left" class="social-icons" style="width: 56%;margin: 0px auto;">
        <?= $this->render('/items/share.php', ['share_url' => $image_url]) ?>
      </div>
      <img src="<?php echo $image_url;?>" id="nr-img">

    </div>
    <div class="cls">
      <a href="javascript:void(0)" onclick="close_popup()"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
    </div>
  </div>
</div>

<script language="javascript">
    $(function(){
     
       
        <?php if($p == 1){?>
          load_popup()
        <?php }?>

        $('.xarea').click(function(e){

           e.preventDefault()
           
          $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',$(this).attr('href'))
           $('body').css('overflow','hidden');
           id = '&n=' + $(this).attr('id');


         // var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?p=1';
         // window.history.pushState({path:newurl},'',newurl);

         
        })
    })

    function load_popup(){
     
         $('#nr-img-preview').show();
         
          
         
           $('body').css('overflow','hidden')


    }
    function close_popup(){
  
      $('#nr-img-preview').hide();
      $('body').css('overflow','scroll')
    }
  
</script>