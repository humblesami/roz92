<?php

use backend\assets\PdcsAsset;
use yeesoft\assets\MetisMenuAsset;
use yeesoft\assets\YeeAsset;
use yeesoft\models\Menu;
use yeesoft\widgets\LanguageSelector;
//use yeesoft\widgets\Nav;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu as MM;

/* @var $this \yii\web\View */
/* @var $content string */

PdcsAsset::register($this);
$assetBundle = YeeAsset::register($this);
MetisMenuAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <header>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php
        $logo = Yii::getAlias('@web') . '/themes/basic/images/logo.png';
        NavBar::begin([
            'brandLabel' => Html::img($logo, ['class' => 'yee-logo', 'alt' => 'YeeCMS']) ,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-static-top',
                'style' => 'margin-bottom: 0'
            ],
            'innerContainerOptions' => [
                'class' => 'container-fluid'
            ]
        ]);

       

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => Yii::t('yee', 'Login'), 'url' => ['/auth/login']];
        } else {
            $menuItems[] = [
                'label' => Yii::t('yee', 'Hello {username} | Logout', ['username' => Yii::$app->user->identity->username]),
                'url' => Yii::$app->urlManager->hostInfo . '/auth/logout',
                'linkOptions' => ['data-method' => 'post']
            ];
        }

        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);

        echo LanguageSelector::widget(['display' => 'label', 'view' => 'pills']);

        NavBar::end();
        ?>
            
        <!-- SIDEBAR NAV -->
       
        <div class="navbar-default sidebar metismenu" role="navigation">
             <div class="container">
            

<?php
                                                                    $menu_id = "1";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top')) ?>
            
        </div>
    </div>
        <!-- !SIDEBAR NAV -->
    </nav>
    </header>

    <div id="page-wrapper">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="bread-area">
                        <div class="container">
                            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
                        </div>
                    </div>
                    <div class="container page-content">
                        <?php if (Yii::$app->session->hasFlash('crudMessage')): ?>
                            <div class="alert alert-info alert-dismissible alert-crud" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= Yii::$app->session->getFlash('crudMessage') ?>
                            </div>
                        <?php endif; ?>




                        <div class="row">
                            <div class="col-sm-3">

<div class="left-nav ht-auto-child panel-scroll">

<?php
                                                                    $menu_id = "10";
                                                                    ?>
                <?php echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'left')) ?>                                
           </div>

                            </div>
                            <div class="col-sm-9">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
<style>

</style>
</div>

<?php echo \app\components\Footer::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
