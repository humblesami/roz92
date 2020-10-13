<?php
/* @var $this \yii\web\View */
/* @var $content string */

//use backend\assets\AppAsset;
use backend\assets\PdcsAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


pdcsAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title>ePaper</title>
<?php $this->head() ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<?php if(isset($this->params['left_menu'])){ ?>
<body class='page-full-width setting-panel'>
<?php }else{?>
<body class='page-full-width generic-content'>
<?php }?>
<?php $this->beginBody() ?>
<?php echo \app\components\Header::widget() ?>
<?php
$menu_id = "";
if(isset($this->params['menu_id'])){
	$menu_id = $this->params['menu_id'];	
}
?>
<?php //echo \app\components\LeftBar::widget(array('menu_ids' =>	$menu_id)) ?>
<div class="main-container" >
  <div class="container">
    <?php if(isset($this->params['left_menu'])){ ?>
    <div class="cms-wrap panel panel-default">
      <div class="panel-body wrapper-panel autoheight">
        <div class="panel panel-default">
          <div class="panel-heading top-heading">
            <h2>Setting</h2>
          </div>
          <div class="panel-body">
          <div class="row">
            <div class="col-sm-2 no-padding-right">
              <div class="left-nav ht-auto-child panel-scroll">
                <?php
                                                                    $menu_id = "10";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>	$menu_id,'position' => 'left')) ?> </div>
            </div>
            
            <div class="col-sm-10 setting-data-wrapper ht-auto-child panel-scroll">
              <div class=""> <?php echo $content;?> </div>
            </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <?php }else{?>
    <div class="cms-wsrap paneld-scroll panel panel-default" style="min-height: 500px">
      <div class="panel-body wrapper-panel asutoheight"> 
	  <?php echo $content;?>
        <div class="clear"></div>
      </div>
    </div>
    <?php }?>
    <footer class="clearfix">
      <p class="float-left">Copyright © <?php echo date('Y');?> ePaper.</p>
      <p class="float-right">Powered by <a href="#">92newsHD</a></p>
    </footer>
  </div>
</div>



<?php echo \app\components\Footer::widget() ?>
<? //= Footer::widget() ?>
<?php $this->endBody() ?>
<script>

var inrwrpH = ($(window).outerHeight() - $('.navbar.navbar-inverse.navbar-fixed-top').outerHeight() - $('.contentwrap > .subheader').outerHeight() - 50	);
$('.panel-body.autoheight, .cms-wrap, .setting-data-wrapper').height(inrwrpH);

var inrwrpH = ($(window).outerHeight() - $('.navbar.navbar-inverse.navbar-fixed-top').outerHeight() - $('.contentwrap > .subheader').outerHeight() - 130	);
$('.border-line-vertical').height(inrwrpH);

var inrwrpH = $('.autoheight').height()- 68;
$('.ht-auto-child').height(inrwrpH);

var inrwrpH = $('.autoheight').outerHeight() - $('.ht-auto-child .top-content').height()- 15;
$('.ht-auto-roles').height(inrwrpH);	

$(window).resize(function() {
    var inrwrpH = ($(window).outerHeight() - $('.navbar.navbar-inverse.navbar-fixed-top').outerHeight() - $('.contentwrap > .subheader').outerHeight() - 50    );
    $('.panel-body.autoheight, .cms-wrap, .setting-data-wrapper').height(inrwrpH);

    var inrwrpH = ($(window).outerHeight() - $('.navbar.navbar-inverse.navbar-fixed-top').outerHeight() - $('.contentwrap > .subheader').outerHeight() - 130    );
    $('.border-line-vertical').height(inrwrpH);
	
	var inrwrpH = $('.autoheight').height()- 68;
	$('.ht-auto-child').height(inrwrpH);
	
		var inrwrpH = $('.autoheight').outerHeight() - $('.ht-auto-child .top-content').height()- 15;
	$('.ht-auto-roles').height(inrwrpH);
});

$('#summernote').summernote({
  callbacks: {
    onChange: function(contents, $editable) {
      console.log('onChange:', contents, $editable);
    }
  }
});
</script>


</body>
<?php $this->endPage() ?>
</html>
