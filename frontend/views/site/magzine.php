<?php
use backend\assets\AppAsset;
use backend\modules\paper\models\TblPapEmagzineMst;
use backend\modules\paper\models\TblPapMagzineType;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


$assetBundle = AppAsset::register($this);

?>

<?php
$issue_list = TblPapEmagzineMst::find()->where(['type' => $type])->all();
$xDate = $issue_date;
if($issue_date == ""){
	$magazine = TblPapEmagzineMst::find()->where(['type' => $type])->orderBy(['issue_date' =>SORT_DESC])->one();
	$xDate = $magazine['issue_date'];
	$pageDetail = $magazine['page_detail'];

}else{
	$magazine = TblPapEmagzineMst::find()->where(['type' => $type,'issue_date' => $issue_date])->orderBy(['issue_date' =>SORT_DESC])->one();
	
	$pageDetail = $magazine['page_detail'];	
}
$xtype = TblPapMagzineType::findOne($type);
$image = 'uploads/type/92-Sunday-Magazine.png';
if($type ==  1){

	$image = 'uploads/type/92-Midweek-Magazine.png';
}
?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<title>Sunday Magazine - Roznama 92 News</title>
<meta name="viewport" content="width = 1050, user-scalable = no" />
<link rel="stylesheet" href="<?= $assetBundle->baseUrl; ?>/css/bootstrap.min.css">

<script type="text/javascript" src="<?= $assetBundle->baseUrl; ?>/js/jquery.min.1.7.js"></script>
<script type="text/javascript" src="<?= $assetBundle->baseUrl; ?>/js/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="<?= $assetBundle->baseUrl; ?>/js/hash.js"></script>
<style type="text/css">
.page {cursor:pointer;}
.archivewrap { position:fixed; top:20%; right:0; padding:25px 15px; z-index:99999; background:#c60001; border-radius:10px 0 0 10px;}
.archivewrap select {padding:5px; font-size:18px;}

.header-top{background: #252525; height: 60px; line-height: 60px}
body{margin: 0px; overflow: scroll;}
.container{width: 80%; margin: 0px auto;}

.header-top{color:#fff; font-size:14px; font-weight: bold;}
.header-top select{border-color:#fff; font-color:#fff; background: #252525; border:1px solid #fff;color:#fff; line-height: 25px; padding-left:3px;}
footer{background: #252525; height: 40px; line-height: 40px; color:#fff; margin-top:20px;}
.web-link a{color:#cb2a2f; font-size:14px; font-weight: bold}
</style>
</head>
<body>
<div class="header-top">
	<div class="container">
	<div class="row">
		<div class="col-sm-4">
			
<div>





<?php
$droptions = TblPapEmagzineMst::find()->where(['type' => $type])->orderBy(['issue_date' =>SORT_DESC])->all();
    $cc =  ArrayHelper::map($droptions, 'issue_date', function($model) {
        return date("M-d-Y", strtotime($model['issue_date']));
    });

?>
<?= Html::dropDownList('issue_date', '', $cc) ?>
<!-- <input type="text" value="20-02-2018"> --> گزشتہ اشاعت 
</div>			


		</div>
		<div class="col-sm-4 text-center"><a href="#"><img src="/backend/web/<?php echo $image;?>" alt=""></a></div>
		<div class="col-sm-4"></div>
	</div>
</div>
</div>
<div class="container text-right web-link"><a href="<?php echo SITEURL;?>%D9%85%DB%8C%DA%AF%D8%B2%DB%8C%D9%86">روزنامہ 92 نیوز کی ویب سائٹ  </a></div>	



<!-- adds code -->
<?php echo $this->render('add_col') ?>
<!-- adds code -->

<div >




<div id="canvas">

<div class="zoom-icon zoom-icon-in"></div>

<div class="magazine-viewport">
	<div class="container">
		<div class="magazine">
			<div ignore="1" class="next-button"></div>
			<div ignore="1" class="previous-button"></div>
		</div>
	</div>
</div>
</div>





</div>


<!-- adds code -->
<?php echo $this->render('add_col') ?>
<!-- adds code -->

<footer>
	
	<div class="text-center">
			© 2017 روزنامہ 92 نیوز حقوق محفوظ ہیں
	</div>
</footer>



<?php



$pageDetail = json_decode($pageDetail,true);
$page_count  = count($pageDetail);

$iDate = date('dmY',strtotime($xDate));
$year = date('Y',strtotime($xDate));
$month = date('m',strtotime($xDate));
$iPath  = '/backend/web/uploads/emagzine/'. $type . '/' . $year. '/' . $month . '/';
?>
<input type="hidden" id="ipath" value="<?php echo $iPath;?>" />
<input type="hidden" id="issue_date" value="<?php echo $iDate;?>" />
<script type="text/javascript">

function loadApp() {
 	$('#canvas').fadeIn(1000);
 	var flipbook = $('.magazine');
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}
	flipbook.turn({
			width: 2040,
			height: 1272,
			duration: 1000,
			acceleration: !isChrome(),
			gradients: true,
			autoCenter: true,
			elevation: 50,
			pages: '<?php echo $page_count?>',
			
			direction: "rtl",
			when: {
				turning: function(event, page, view) {
					var book = $(this),
					currentPage = book.turn('page'),
					pages = book.turn('pages');
					Hash.go('page/' + page).update();
					disableControls(page);
				},
				turned: function(event, page, view) {
					disableControls(page);
					$(this).turn('center');
					if (page==1) { 
						$(this).turn('peel', 'br');
					}
				},
				missing: function (event, pages) {
					for (var i = 0; i < pages.length; i++)
						addPage(pages[i], $(this));
				}
			}
	});
	$('.magazine-viewport').zoom({
		flipbook: $('.magazine'),
		max: function() { 
			return largeMagazineWidth()/$('.magazine').width();
		}, 
		when: {
			swipeLeft: function() {
				$(this).zoom('flipbook').turn('next');
			},
			swipeRight: function() {
				$(this).zoom('flipbook').turn('previous');
			},
			resize: function(event, scale, page, pageElement) {
				if (scale==1)
					loadSmallPage(page, pageElement);
				else
					loadLargePage(page, pageElement);
			},
			zoomIn: function () {
				$('.made').hide();
				$('.magazine').removeClass('animated').addClass('zoom-in');
				$('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');
				
				if (!window.escTip && !$.isTouch) {
					escTip = true;

					$('<div />', {'class': 'exit-message'}).
						html('<div>Press ESC to exit</div>').
							appendTo($('body')).
							delay(2000).
							animate({opacity:0}, 500, function() {
								$(this).remove();
							});
				}
			},

			zoomOut: function () {

				$('.exit-message').hide();
				$('.made').fadeIn();
				$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

				setTimeout(function(){
					$('.magazine').addClass('animated').removeClass('zoom-in');
					resizeViewport();
				}, 0);

			}
		}
	});

	// Zoom event

	if ($.isTouch)
		$('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
	else
		$('.magazine-viewport').bind('zoom.tap', zoomTo);


	// Using arrow keys to turn the page

	$(document).keydown(function(e){

		var previous = 37, next = 39, esc = 27;

		switch (e.keyCode) {
			case previous:

				// left arrow
				$('.magazine').turn('previous');
				e.preventDefault();

			break;
			case next:

				//right arrow
				$('.magazine').turn('next');
				e.preventDefault();

			break;
			case esc:
				
				$('.magazine-viewport').zoom('zoomOut');	
				e.preventDefault();

			break;
		}
	});

	// URIs - Format #/page/1 

	Hash.on('^page\/([0-9]*)$', {
		yep: function(path, parts) {
			var page = parts[1];

			if (page!==undefined) {
				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.magazine').turn('is'))
				$('.magazine').turn('page', 1);
		}
	});


	$(window).resize(function() {
		resizeViewport();
	}).bind('orientationchange', function() {
		resizeViewport();
	});

	// Events for thumbnails

	$('.thumbnails').click(function(event) {
		
		var page;

		if (event.target && (page=/page-([0-9]+)/.exec($(event.target).attr('class'))) ) {
		
			$('.magazine').turn('page', page[1]);
		}
	});

	$('.thumbnails li').
		bind($.mouseEvents.over, function() {
			
			$(this).addClass('thumb-hover');

		}).bind($.mouseEvents.out, function() {
			
			$(this).removeClass('thumb-hover');

		});

	if ($.isTouch) {
	
		$('.thumbnails').
			addClass('thumbanils-touch').
			bind($.mouseEvents.move, function(event) {
				event.preventDefault();
			});

	} else {

		$('.thumbnails ul').mouseover(function() {

			$('.thumbnails').addClass('thumbnails-hover');

		}).mousedown(function() {

			return false;

		}).mouseout(function() {

			$('.thumbnails').removeClass('thumbnails-hover');

		});

	}


	// Regions

	if ($.isTouch) {
		$('.magazine').bind('touchstart', regionClick);
	} else {
		$('.magazine').click(regionClick);
	}

	// Events for the next button

	$('.next-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('next-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('next-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('next-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('next-button-down');

	}).click(function() {
		
		$('.magazine').turn('next');

	});

	// Events for the next button
	
	$('.previous-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('previous-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('previous-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('previous-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('previous-button-down');

	}).click(function() {
		
		$('.magazine').turn('previous');

	});


	resizeViewport();

	$('.magazine').addClass('animated');

}

// Zoom icon

 $('.zoom-icon').bind('mouseover', function() { 
 	
 	if ($(this).hasClass('zoom-icon-in'))
 		$(this).addClass('zoom-icon-in-hover');

 	if ($(this).hasClass('zoom-icon-out'))
 		$(this).addClass('zoom-icon-out-hover');
 
 }).bind('mouseout', function() { 
 	
 	 if ($(this).hasClass('zoom-icon-in'))
 		$(this).removeClass('zoom-icon-in-hover');
 	
 	if ($(this).hasClass('zoom-icon-out'))
 		$(this).removeClass('zoom-icon-out-hover');

 }).bind('click', function() {

 	if ($(this).hasClass('zoom-icon-in'))
 		$('.magazine-viewport').zoom('zoomIn');
 	else if ($(this).hasClass('zoom-icon-out'))	
		$('.magazine-viewport').zoom('zoomOut');

 });

 $('#canvas').hide();
yepnope({
	test : Modernizr.csstransforms,
	yep: ['<?= $assetBundle->baseUrl; ?>/js/turn.js'],
	nope: ['<?= $assetBundle->baseUrl; ?>/js/turn.html4.min.js'],
	both: ['<?= $assetBundle->baseUrl; ?>/js/zoom.min.js',  '<?= $assetBundle->baseUrl; ?>/js/magazine-ar.js?vs=<?php echo time(); ?>', '<?= $assetBundle->baseUrl; ?>/css/magazine.css'],
	complete: loadApp
});

$(document).ready(function() {
    $('.header-top select').change(function() {
        var issue = $(this).val();
		window.location = "<?php echo Yii::$app->urlManager->createUrl('/magzine');?>?type=<?php echo $type;?>&issue_date=" + issue;
    });
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-97109882-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-97109882-1');
</script>
</body>
</html>