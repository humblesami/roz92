<?php
/* @var $this yii\web\View */

use yeesoft\comments\widgets\Comments;
use yeesoft\page\models\Page;
use yii\helpers\Html;
use app\components\PostWidget as p;
use backend\modules\paper\models\TblPapEmagzineMst;

$this->title = $page->title;
$this->params['breadcrumbs'][] = $page->title;

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


<div class="row">
	<div class="col-sm-3 e-paper">
	    <a href="<?php echo SITEURL;?>/epaper" target="_blank"><img src="images/lbanner.png" class ="img-responsive" alt=""></a>

	<!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->	
		<?php
        echo P::widget(['heading' => 'آج کا اخبار','category_id' => '23', 'view_post' => 'border']);
        ?>

	    
<!-- channel 92 -->


<!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->

<br>

<!-- magzine -->

<div class="recent-post-slider design-44" style="width:93%;margin: 0px auto;">
 
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
        jQuery('.recent-post-slider.design-44').slick({
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

<!-- 92 news -->



<!-- adds code -->
<?php echo $this->render('@frontend/views/site/add_col_small') ?>
<!-- adds code -->


<!-- slider -->

<div class="recent-post-slider design-4" style="width:93%;margin: 0px auto;padding-top: 15px;">


                <?php
$i = 0;
while($i<8){
  $i = $i + 1;
?>

            <div class="post-slides">
                <div class="post-overlay left-right-pad-0">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/<?php echo $i;?>.png?a=1" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
<?php }?>
    <!--<div class="post-slides">
        <div class="post-overlay">
            <div class="post-image-bg">
                <a href="#">
                	<img src="images/banner/Andher-Nagri-92-News.png" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </div>-->
    
</div>

<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery('.recent-post-slider.design-4').slick({
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

	</div>
	<div class="col-sm-9">
	    <div class="page">
	    	<?php if($page->title != 'Front Page'){?>
	        <h1><?= Html::encode($page->title) ?></h1>
            <?php echo $this->render('add_col') ?>
	        <?php  }?>
	        <div><?= $page->content ?></div>


	        <!-- channel 92 -->



<!-- adds code -->
<?php if($page->title != 'Front Page'){?>
<?php echo $this->render('add_col') ?>
<?php  }?>
<!-- adds code -->

	    </div>
	</div>
</div>

