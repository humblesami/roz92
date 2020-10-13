<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
/* @var $post yeesoft\post\models\Post */

$page = (isset($page)) ? $page : 'post';


        Yii::$app->seo->loadMetaTags($this->preferUrlWithParams);

        $request = Yii::$app->getRequest();
        $path    = $request->getPathInfo();
        $url_og     =  'https://www.roznama92news.com' . $request->getUrl();
        
        Yii::$app->opengraph->set([
  'title' => 'Daily 92 Roznama ePaper - ' . $post->seo_title,
  'description' => $post->content,
  'image' => $image_url,
]);    
        
?>
        
          
<div class="post clearfix">
   
    <div class="row">
        <div class="col-sm-12">
             <h2><?= $post->title ?></h2>
<?= $post->getThumbnail(['class' => 'img-responsive', 'style' => 'width:838px; margin: 0 7px 7px 0']) ?>

   <p class="text-justify">
        <span class="pull-right" ><b><?php echo frontend\models\common::urdu_date($post->publishedDate);?></b></span>
         


        
        <div class="post-content"><?//= ($page === 'post') ? $post->content : $post->shortContent ?>
            
        <br>

        <div>
 <!-- adds code -->
          <?php echo $this->render('add_detail') ?>
          <!-- adds code -->
        </div>

        <br>


            <?php

              if($page === 'post'){

$paragraph = explode("</p>", $post->content);
$count = count($paragraph) / 2;
$count  = floor($count);
//echo $count;
$aa = 0;
foreach ($paragraph as $key => $value) {

   echo $value;
   if($aa == $count){
 ?>

<br>



 <?php
   }
   $aa = $aa + 1;
}

              }else{
                $post->shortContent;
              }
            ?>


        </div>
    </p>

        </div>
      
    </div>

</div>



<?php
$share_url  = SITEURL .  $post->slug;
?>
        
 <?= $this->render('/items/share.php', ['post' => $post, 'page' => 'category','share_url' => $share_url]) ?>


<div class="related post">
  <h2>آپ کیلئے تجویز کردہ خبریں</h2>
  <?php $cats = $post->catValues; ?>
  <?php if (!empty($cats)): 

    $cats = str_replace('[', '', $cats);
    $cats = str_replace(']', '', $cats);

    $query = Post::find()->joinWith('cats')->where([
      'status' => Post::STATUS_PUBLISHED,
    ])
    ->andWhere(['in', Category::tableName() . '.id', $cats])
    ->orderBy('published_at DESC');
    $pc = $query->limit(9)
    ->all();
    ?>
    <div class="news-sbox">
      <div class="ajj-col-page">
        <ul>
          <?php foreach ($pc as $post) :
          ?>
            <li>
              <?= $this->render('/items/post_related.php', ['post' => $post, 'page' => 'category']) ?>
            </li>
          <?php endforeach; ?> 
        </ul>
      </div>
    </div>         
  <?php endif; ?>

</div>



<div class="aajkacolumn">
  <h2>آج کے کالم </h2>
  <p>[post heading='آج کا اخبار' type='column' category_id='23' view_post='pagecolumn']<//p>
</div>


 <!-- adds code -->
          <?php echo $this->render('add_detail') ?>
          <!-- adds code -->
