<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $post yeesoft\post\models\Post */

$page = (isset($page)) ? $page : 'post';

$murl = '';
if(isset($post->profile->categoryx['slug'])){
    $murl = '/category/' . $post->profile->categoryx['slug']; 
}

$check_category = \backend\modules\paper\models\TblProfile::find()->where(['category_id' => $cat_id])->one();

?>

<?php
if($counter == 1 and $check_category){
   
    ?>

        <div class="post box-shadow clearfix">
            <div class="row">
                <div class="col-sm-12">
                   <p class="text-justify">
                        <h2 align="center" class="border-bot"><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></h2>
                        <br>
                        
                        <?php
                        $words = explode(" ",$post->content);
                        $word_limit = 100;
                        $content =  implode(" ",array_splice($words,0,$word_limit));
                        ?>  

                        <div align="center" class="post-content">
                            <?= ($page === 'post') ? $post->content : $content; ?>

                            <br>
                            <span class="date">
                                <b><?php echo frontend\models\common::urdu_date($post->publishedDate);?></b>
                            </span>

                        </div>
                    </p>

                </div>
            </div>
        </div>

    <?php 
   
}else{ 
    ?>

    <div class="post clearfix">
        <div class="row">
            <div class="col-sm-12">
               <p class="text-justify">
                    <h2><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></h2>
                    <span class="pull-right date">
                        <b><?php echo frontend\models\common::urdu_date($post->publishedDate);?></b>
                    </span>
                    <br>
                    <?php if($post->post_type == 2){?>
                        <span class="pull-right xname">
                            <b><?php echo Html::a($post->profile['name'], [$murl]);?></b>
                        </span>
                        <br>
                     <?php } ?>
            
                    <?php
                    $words = explode(" ",$post->content);
                    $word_limit = 100;
                    $content =  implode(" ",array_splice($words,0,$word_limit));
                    ?>  

                    <div class="post-content">
                        <?= ($page === 'post') ? $post->content : $content; ?>

                        <br>

                        <span class="continue-reading"> 
                            <?= Html::a('مزید پڑھیے', ["/site/{$post->slug}"]) ?>
                        </span>
                    </div>
                </p>

                <hr>

            </div>
        </div>
    </div>

<?php } ?>

