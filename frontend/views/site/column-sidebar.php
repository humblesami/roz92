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

333333333333
<div class="row col-list rowrtl">

	<div class="col-sm-9">
	    <div class="page">
	    	<?php if($page->title != 'Front Page'){?>
	        <h1><?= Html::encode($page->title) ?></h1>
	        		<!-- adds code -->
	    <?php echo $this->render('add_col') ?>
	    <!-- adds code -->
	        <?php  }?>
	        <div><?= $page->content ?></div>
	        		<!-- adds code -->
	    <?php echo $this->render('add_col') ?>
	    <!-- adds code -->
	    </div>
	</div>


	<div class="col-sm-3 e-paper">
		<a href="<?php echo SITEURL;?>/epaper" target="_blank"><img src="images/lbanner.png" class ="img-responsive" alt=""></a>
				<!-- adds code -->
	    <?php echo $this->render('@frontend/views/site/add_col_small') ?>
	    <!-- adds code -->
		<h2>کالم نگار</h2>
		<div class="news-scroll">
			<?php

			$col_list = \backend\modules\paper\models\TblProfile::find()->where(['status_id' => 1])->orderBy('sort_order')->all();
			$aa = 0;
			foreach ($col_list as $row) {
				# code...
			//$category_id = $post->profile['category_id'];
			 	$murl = '/category/' . $row->categoryx['slug']; 
			 	$aa = $aa + 1;
				?>
	   			<div class="row">
			
					<div class="col-sm-4 col-xs-4"> <img src="backend/web/<?= $row['image']; ?>" alt="" class="img-responsive"></div>

					<div class="col-sm-8 col-xs-8"><span class="xname"><?php echo Html::a($row['name'], [$murl]);?></span><br><?php echo $row['pen_name']?></div>
	   			</div>
	   			<?php if($aa == 6){?>

	   				<!-- 92 news -->

		<!-- adds code -->
		<hr>
	    <?php echo $this->render('@frontend/views/site/add_col_small') ?>
	    <!-- adds code -->


		<!-- slider -->
	   			<?php }?>
	   			<hr>
			<?php }?>

		</div>

		<br>


		
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
		

		
		
		<div class="recent-post-slider design-5" style="width:93%;margin: 0px auto;padding-top: 15px;">


			<?php
$i = 0;
while($i<8){
  $i = $i + 1;
?>

            <div class="post-slides">
                <div class="post-overlay left-right-pad-10">
                    <div class="post-image-bg">
                        <a href="#">
                          <img src="images/banner/<?php echo $i;?>.png?1=1" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
            </div>
<?php }?>
		  <!--  <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Andher-Nagri-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>-->
		    <!-- <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Breaking-Views-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>  
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Ho-Kya-Raha-Hai-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Jawab-Chahyei-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Muqabil-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/News-Room-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Night-Edition-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Rai-Apni-Apni-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div>
		    <div class="post-slides">
		        <div class="post-overlay">
		            <div class="post-image-bg">
		                <a href="#">
		                	<img src="images/banner/Subh-e-Noor-92-News.png" class="img-responsive" alt="">
		                </a>
		            </div>
		        </div>
		    </div> -->
		</div>

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


</div>
<!-- <script type="text/javascript">
	  jQuery(document).ready(function ($) {
	    $('.news-scroll').slimScroll({
	      height: '453px',
	      position: 'left',
	       wheelStep: 10,
	       railVisible: true,
	    });

  });
</script> -->