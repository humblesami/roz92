<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
//use frontend\assets\ThemeAsset;
use yeesoft\models\Menu;
use yeesoft\widgets\LanguageSelector;
use yeesoft\widgets\Nav as Navigation;
use yii\widgets\Menu as MM;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yeesoft\comment\widgets\RecentComments;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;

Yii::$app->assetManager->forceCopy = false;
AppAsset::register($this);
//ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="zX9YDyyET8qjofvL_37VbTTcsp--ZLHh-LZBBOfCbLY" />
    <?= Html::csrfMetaTags() ?>
    <?= $this->renderMetaTags() ?>
    <?php $this->head() ?>
    
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8733222334142179",
    enable_page_level_ads: true
  });
</script>    
    
  </head>
<body dir="rtl">
<?php $this->beginBody() ?>
<header>
    <div class="header-top hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-1 col-md-1"></div>
                <div class="col-sm-9 col-md-9 text-left">
                    
         <?php
                                                                    $menu_id = "14";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top','xclass' => 'nav navbar-nav city-nav')) ?>

                </div>
                <div class="col-sm-2 col-md-2"><?php echo frontend\models\common::urdu_date(date('Y-m-d'));?></div>

            </div>
        </div>
    </div>

    <?php
//to be changed
$query = Post::find()->where([
            'status' => Post::STATUS_PUBLISHED,
            
        ])->orderBy('published_at DESC')->limit(10)->all();


 

?>
    <div class="header-brk">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
<h4 class="newsmob">BN</h4>
<script>
(function($) {    
    $(document).ready(function() {
        $('#newsticker_0').newsticker({
                            'tickerTitle' : "تازہ ترین خبر",
                            'style' : "scroll",
                            'pauseOnHover' : true,
                            'showControls' : true,
                            'autoStart' : true,
                            'scrollSpeed' : "50",
                            'slideSpeed' : "1000",
                            'slideEasing' : "swing",
                                               
        });
    });    
})( jQuery );
</script>

<ul class="newsticker" id="newsticker_0">

<?php
foreach ($query as $row) {
?>  
<li>
    <?= Html::a($row->title, ["/site/{$row->slug}"]) ?>

  </li>
<?php }?>
</ul>

                    </div>         
                </div>
            </div></div><div class="header-nav">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

<nav class="navbar navbar-default ">
        <div class="container-fluid">
          <div class="navbar-header">

<div class="mobile-nav dropdown">
<a href="javascript:;;" class="dropdown-toggle" type="button" data-toggle="dropdown">

  <span class="icon-dot">ای پیپر</span></a>

<?php
                                                                    $menu_id = "14";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top','xclass' => 'dropdown-menu dropdown-menu-right')) ?>
</div>

<!--            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>-->
            
         <a href="javascript:;;" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
             
              </a>   
            
            <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl;?>"><img src="/images/logo.png" alt="92 News"></a>



          </div>
          <div id="navbar" class="navbar-collapse collapse xtop-menu">

         <?php
                                                                    $menu_id = "11";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top')) ?>



            
            
          </div><!--/.nav-collapse -->







        </div><!--/.container-fluid -->
      </nav>




                </div>
                
                
            </div>
        </div>


    </div>
    <div class="header-bottom hidden-xs">
            <div class="container">
                <div class="head-trending">
                    <span class="trends">رجحان</span>

<?php
                                                                    $menu_id = "12";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top','xclass' => '')); ?>

                   <!--  <ul>
                       <li><a href="#">رجحان</a></li>
                       <li><a href="#">رد الفساد</a></li>
                       <li><a href="#">پی ایس ایل</a></li>
                       <li><a href="#">پاناما لیکس</a></li>
                     
                   </ul> -->
                </div>
            </div>

    </div>



</header>






<div class="container">
<div class="content">


                 <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
                <?= Alert::widget() ?>  

     <?= $content ?>
</div>
</div>


<?php echo \frontend\components\Footer::widget() ?> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-97109882-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-97109882-1');
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
