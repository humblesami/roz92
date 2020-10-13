 <?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;


?> 
 <?php echo $this->render('@frontend/views/site/add_col'); ?>
                            	<?php foreach ($posts as $post) :


                                 ?>

                                 <?= $this->render('/items/post-col.php', ['post' => $post, 'page' => 'category']) ?>
                                

                              <?php endforeach; ?>  
                               
                                


     <div class="text-center">
                    <?= LinkPager::widget(['pagination' => $pagination]) ?>
                </div>                           
                               
<div>

     
</div>                        
                             