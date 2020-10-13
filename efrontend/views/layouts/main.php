<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use efrontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$station_id = Yii::$app->controller->station_id;
$xdate = Yii::$app->controller->xdate;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Daily 92 Roznama ePaper | Urdu Newspaper | Pakistan News | روزنامہ ٩٢ نیوز</title>

<meta name="keywords" content="92 Roznama news,  newspaper, urdu news paper, Daily Karachi Newspaper, Daily Lahore Newspaper, Daily Islamabad Newspaper, Daily Peshawar Newspaper,  Daily Quetta Newspaper, Daily Faisalabad Newspaper, Daily Sargodha Newspaper, Daily Multan Newspaper, Sunday Magazine, Columns, Pakistan News, International News, Business News, Technology News, Entertainment News, Sports News, Health News">
<meta name="description" content="Daily Roznama 92 News ePaper. Daily urdu newspaper with current affairs, business news, political news and Pakistan news.">
    <meta name="google-site-verification" content="zX9YDyyET8qjofvL_37VbTTcsp--ZLHh-LZBBOfCbLY" />
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

        
<?php 

echo \app\components\Header::widget(array('station_id' =>   $station_id,'xdate' => $xdate)) ?>

<div class="fcontent">            
            <div class="container">
                <div class="content">
                    <?php echo $content;?>   
                    
                </div>
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
