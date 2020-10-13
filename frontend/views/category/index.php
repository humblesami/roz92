<?php

use yii\widgets\LinkPager;
use app\components\PostWidget as p;
use backend\modules\paper\models\TblPapEmagzineMst;

/* @var $this yii\web\View */

$this->title = $category->title;
$this->params['breadcrumbs'][] = $this->title;

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


<div class="category-index">
    <div class="body-content">
        <h1 class="cat-head"><?= $category->title ?></h1>



        <?php $cat_id = $category->id; ?>

        <?php /* @var $post yeesoft\post\models\Post */ ?>
        <div class="row rowrtl">


            <div class="col-sm-9">


<!-- adds code -->
<?php echo $this->render('add_cat') ?>
<!-- adds code -->              
              <?php $aa = 0; ?>
              <?php foreach ($posts as $post) : ?>
                  <?php $aa = $aa + 1; ?>
                    
                  <?= $this->render('/items/post.php', ['post' => $post, 'page' => 'category', 'counter' => $aa, 'cat_id' => $cat_id]) ?>

                  <?php if($aa == 5){?>
<!-- adds code -->
<?php echo $this->render('add_cat') ?>
<!-- adds code -->
                    
                  <?php }?>
                  
              <?php endforeach; ?>

        <?php echo $this->render('add_cat') ?>
        <!-- adds code -->
              <div class="text-center">
                  <?= LinkPager::widget(['pagination' => $pagination]) ?>
              </div>

        <div>
          <!-- 92 news -->

        <!-- adds code -->

        </div>





            </div>

            <div class="col-sm-3 e-paper">

              <a href="<?php echo SITEURL;?>efrontend/web/index" target="_blank"><img src="/images/lbanner.png" class ="img-responsive" alt=""></a>

                <?php
                echo P::widget(['heading' => 'آج کا اخبار','category_id' => '23', 'view_post' => 'border']);
                ?>

                <br>
                <!-- magzine -->
                <div class="recent-post-slider design-55" style="width:93%;margin: 0px auto;">
             
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
                      jQuery('.recent-post-slider.design-55').slick({
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

<!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->

                <br>

                <?php
                echo P::widget(['heading' => 'اہم خبریں','category_id' => '14', 'view_post' => 'border']);
                ?>

<!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->
                <!-- slider -->
    
                <div class="recent-post-slider design-7" style="width:93%;margin: 0px auto;padding-top: 15px;">


                  
                <?php
$i = 0;
while($i<9){
  $i = $i + 1;
?>

            <div class="post-slides">
                <div class="post-overlay left-right-pad-0">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="<?php echo SITEURL;?>/images/banner/<?php echo $i;?>.png" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
<?php }?>
                    
                </div>

                <script type="text/javascript">
                        jQuery(document).ready(function(){
                        jQuery('.recent-post-slider.design-7').slick({
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
                
                <!-- slider -->

         <div>
          <br>
          <!-- 92 news -->


        </div>
            </div>

        </div>
    </div>
</div>
