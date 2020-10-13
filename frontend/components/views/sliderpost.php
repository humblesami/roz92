 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 
<link rel='stylesheet' id='wprps_slick_style-css' href='css/slick.css?ver=ae9766a92f263af92cd2863224fd2535' type='text/css' media='all' />
<link rel='stylesheet' id='wprps_recent_post_style-css' href='css/recent-post-style.css?ver=ae9766a92f263af92cd2863224fd2535' type='text/css' media='all' />

<style>
    /* .recent-post-slider.design-3 .post-short-content{
        position: relative;
        background-color: #000;
    
    opacity: 0.5;
    filter: alpha(opacity=50); For IE8 and earlier
        
    } */
    .recent-post-slider .wp-post-date::after{background: none;}
    .recent-post-slider.design-3 .post-image-bg{height: 425px;}
    .recent-post-slider.design-3 .post-short-content{height: 23%}
    .recent-post-slider.design-3 .post-overlay:hover>.post-short-content{height: 23%}

    @media (max-width: 768px){
        .recent-post-slider h2.wp-post-title {
        line-height: 16px;
        }
        .recent-post-slider h2.wp-post-title a{
        font-size: 16px;
        line-height: 16px;
        }

    }

</style>

<div class="recent-post-slider design-3">
    <?php 

    foreach ($posts as $post) : ?>
    <div class="post-slides">
        <div class="post-overlay">
            <div class="post-image-bg">
          
                <?= $post->getThumbnail(['class' => 'img-responsive', 'style' => '']) ?>
            </div>
            <div class="post-short-content">
                <div class="item-meta bottom">
                    <h2 class="wp-post-title">
                        <?= Html::a($post->title, ["/site/{$post->slug}"]) ?>
                    </h2>
                        <div class="wp-post-date">
                             <?php echo frontend\models\common::urdu_date($post->publishedDate);?>
                        </div>
                       
                    
                </div>
            </div>
        </div>


    </div>

    <?php endforeach; ?> 
</div>
<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery('.recent-post-slider.design-3').slick({
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

<script type="text/javascript" src="js/slick.min.js?ver=1.2.7"></script>