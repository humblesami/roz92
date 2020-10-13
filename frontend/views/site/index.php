<?php

use yii\widgets\LinkPager;


/* @var $this yii\web\View */

$this->title = 'Homepage';
use backend\modules\paper\models\TblPapEmagzineMst;

$mid = TblPapEmagzineMst::find()->where(['type' => 1])->orderBy(['issue_date' =>SORT_DESC])->one();
                    $issue_date = $mid['issue_date'];
                    $strdate = strtotime($issue_date);
                    $year = date('Y',$strdate);
                    $month = date('m',$strdate);
                    $iDate = date('dmY',$strdate);
                    $image_mid = 'backend/web/uploads/emagzine/1/' . $year . "/" . $month . "/" . $iDate . "/1.jpg";


$sunday = TblPapEmagzineMst::find()->where(['type' => 2])->orderBy(['issue_date' =>SORT_DESC])->one();
                    $issue_date = $sunday['issue_date'];
                    $strdate = strtotime($issue_date);
                    $year = date('Y',$strdate);
                    $month = date('m',$strdate);
                    $iDate = date('dmY',$strdate);
                    $image_sunday = 'backend/web/uploads/emagzine/2/' . $year . "/" . $month . "/" . $iDate . "/1.jpg";                    
?>
<style>
@media (max-width: 767px){

.rowrtl [class*="col-"] {
   float:none;
   margin-top: 20px;
}	
}
</style>

<div class="site-index">
    <?php if (Yii::$app->getRequest()->getQueryParam('page') <= 1) : ?>
        
    <?php endif; ?>


<div class="body-content">

<!--<div class="row rowrtl">
    <div class="col-xs-12">
        <a href="https://www.facebook.com/116921273046352/posts/251929196212225/" target="_blank">
            <img src="/images/sngpl/970x250.gif" style="width: 100%; margin: 30px 0; box-shadow: 0 0 6px #33333382;" />
        </a>
    </div>
</div>-->


<div class="row rowrtl">
<div class="col-sm-9">
  <div class="row">
      <div class="col-sm-8">
          [post heading='اہم خبریں' category_id='24' view_post='sliderpost']
      </div>

    <div class="col-sm-4" >

                [post heading='اہم خبریں' category_id='21' limit="4" view_post='border']

    </div>
   

  </div>


<!-- adds code -->
<?php  echo $this->render('add_home') ?>
<!-- adds code -->

</div>

        <div class="col-sm-3 hidden-xs text-center"><a href="<?php echo SITEURL;?>efrontend/web/index" target="_blank"><img src="images/lbanner.png" class ="img-responsive" alt=""></a>
<br>
<div class="recent-post-slider design-2" style="width:94%">
 
  <!--   <div class="post-slides">
      <div class="post-overlay">
          <div class="post-image-bg">
        
              <a href="<?php echo Yii::$app->urlManager->createUrl('/efrontend/web/magzine');?>?type=1"><img src="<?php echo $image_mid;?>" class="img-responsive" alt=""></a>
          </div>
  
      </div>
  
  
  </div> -->

    <div class="post-slides">
        <div class="post-overlay">
            <div class="post-image-bg">
          
                <a href="<?php echo Yii::$app->urlManager->createUrl('/efrontend/web/magzine');?>?type=2"><img src="<?php echo $image_sunday;?>" class="img-responsive" alt=""></a>
            </div>
    
        </div>


    </div>



    
</div>
<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery('.recent-post-slider.design-2').slick({
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
    
 <br>
    </div>
</div>

        <div class="row news-col">
            <div class="col-sm-4">

              

              [post heading='آج کے کالم' type="column" category_id='22' view_post ="column" ]
              

            </div>
            <div class="col-sm-8">
                
                [post heading='آج کے اخبار میں شامل' category_id='23' limit="12" view_post='khabarpost']

            </div>

        </div>

<!-- adds code -->
<?php echo $this->render('add_home') ?>
<!-- adds code -->
        <!-- End Column Row -->
        <div><h1>کالم نگار</h1></div>
        <div class="row program">
            <?php
                $col_list = \backend\modules\paper\models\TblProfile::find()->where(['status_id' => 1])->orderBy('sort_order')->all();
                $aa = 0;
                $bb =0;
                foreach($col_list as $cRow){
                    $aa++;
                    $bb++;
                    $category_id = $cRow['category_id'];
                    $cat = \yeesoft\post\models\Category::findOne($category_id);
                    $murl = '/category/' . $cat->slug; 


            ?>
            <div class="col-sm-2 col-xs-6 pull-right" style="margin-bottom: 10px"  dir="ltr">
                <a href="<?php echo $murl;?>">
                    <img src="backend\web\<?php echo $cRow->image;?>" class="img-responsive" alt="">
                </a>
            </div>
             <?php if($bb == 8){?>
                    </div><div class="row program">
             <?php }?>
 
            <?php if($bb == 16){
                break;
            }
            ?>


            <?php }?>

                                  
        </div>
        <br>
        <!-- End Program Row -->
        <div>
          <!-- 92 news -->

          <!-- adds code -->
          <?php echo $this->render('add_home') ?>
          <!-- adds code -->

        </div>
        <br>

        <div class="row">
            <div class="col-sm-4">
              [post heading='کھیلوں کی خبریں' category_id='9' ]

             
                              

            </div>


            <div class="col-sm-4">
              [post heading='بین الاقوامی خبریں' category_id='45']
             
                             

            </div>

            <div class="col-sm-4">
              [post heading='قومی خبریں' category_id='46']
             
                              

            </div>                        
        </div>
        <!-- End News Widget 1 -->

        


<!-- channel 92 -->


<!-- adds code -->
<?php echo $this->render('add_home') ?>
<!-- adds code -->

<!-- Start News Widget 2 -->  
        <div class="row news-widget-2">
            <div class="col-sm-4">
                [post heading='صحت و سائنس' category_id='13' ]
                               

            </div>


            <div class="col-sm-4">
              [post heading='تجارتی خبریں' category_id='11' ]
                         

            </div>

            <div class="col-sm-4">
                    [post heading='انٹرٹینمنٹ کی خبریں' category_id='10' ]         

            </div>                        
        </div>
        <!-- New Widget 2 -->    

<!-- 92 news -->

<!-- slider -->
      <br>
      <div class="row">
        <div class="col-sm-12">
          <div class="recent-post-slider design-5" style="width:94%;">
            
<?php
$i = 0;
while($i<8){
  $i = $i + 1;
?>

            <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/<?php echo $i;?>.png?1=5" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
<?php }?>

            <!--<div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Andher-Nagri-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>-->
        <!--
            <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Breaking-Views-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>  -->
            <!-- <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Ho-Kya-Raha-Hai-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div> -->
            <!--
            <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Jawab-Chahyei-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
            -->
            <!--
            <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Muqabil-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
            -->
            <!--<div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/News-Room-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>-->
         <!--    <div class="post-slides">
             <div class="post-overlay left-right-pad-10">
                 <div class="post-image-bg">
                     <a href="#">
                       <img src="images/banner/Night-Edition-92-News.png" class="img-responsive" alt="">
                     </a>
                 </div>
             </div>
         </div> -->
           <!-- <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/Rai-Apni-Apni-92-News.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>-->
         <!--    <div class="post-slides">
             <div class="post-overlay left-right-pad-10">
                 <div class="post-image-bg">
                     <a href="#">
                       <img src="images/banner/Subh-e-Noor-92-News.png" class="img-responsive" alt="">
                     </a>
                 </div>
             </div>
         </div> -->


        </div>
      </div>
    </div>

    <br>
    
    <script type="text/javascript">
            jQuery(document).ready(function(){
            jQuery('.recent-post-slider.design-5').slick({
                 rtl:true,
                dots: false,
                infinite: true,
                arrows: false,
                speed: 300,
                autoplay: true,                     
                autoplaySpeed: 3000,
                slidesToShow: 5,
                slidesToScroll: 5,
                responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 640,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5
          }
        }
      ]
            });
        });
    </script>

    

<!-- slider -->



<!-- adds code -->
<?php echo $this->render('add_home') ?>
<!-- adds code -->
            



    </div>
</div>
<script type="text/javascript">

if( (self.parent && !(self.parent===self))
    &&(self.parent.frames.length!=0)){
    self.parent.location=document.location
}

  jQuery(document).ready(function ($) {
    $('.news-scroll').slimScroll({
      height: '453px',
      position: 'left',
       wheelStep: 10,
       railVisible: true,
    });
 // $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 5000);
  //});
  
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 500, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 500, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    

</script>