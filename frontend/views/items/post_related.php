<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $post yeesoft\post\models\Post */

$page = (isset($page)) ? $page : 'post';
?>

<div class="row">
                                    
    <div class="col-sm-12">
        <?php
        $limit = 120;
        if (strlen($post->title) > $limit){
            $post->title = substr($post->title, 0, strrpos(substr($post->title, 0, $limit), ' ')) . '...';
        }
        ?>
        <div class="xtitle"><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></div>
            <div class="xname"><b>
                <?php
                $category_id = $post->profile['category_id'];
                if($category_id){
                    $cat = \yeesoft\post\models\Category::findOne($category_id);
                    $murl = '/category/' . $cat->slug;                                                 
                    echo  Html::a($post->profile['name'], [$murl]);
                }else{
                    echo $post->profile['name'];
                }
                ?>   
            </b></div>

        </div>

    </div>