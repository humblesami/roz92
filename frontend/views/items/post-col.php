<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $post yeesoft\post\models\Post */

$page = (isset($page)) ? $page : 'post';
$murl = '';
if(isset($post->profile->categoryx['slug'])){
    $murl = '/category/' . $post->profile->categoryx['slug']; 
}
?>

<div class="post clearfix">
   
    <div class="row">
        <div class="col-sm-12">
            


   <p class="text-justify">
       
         <h2><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></h2>
        <span class="pull-right date"><b><?php echo frontend\models\common::urdu_date($post->publishedDate);?></b></span><br>
        <span class="pull-right xname"><b><?php echo Html::a($post->profile['name'], [$murl]);?></b></span><br>
<?php

    $words = explode(" ",$post->content);
    $word_limit = 100;
    $content =  implode(" ",array_splice($words,0,$word_limit));
?>        
        <div class="post-content"><?= ($page === 'post') ? $post->content : $content; ?>
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

