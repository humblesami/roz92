 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 
  <div class="panel panel-default panel-border">
                    <div class="panel-heading"><?php echo $heading;?></div>
                    <div class="panel-body news-box">
                        
                        <div class="ajj-col">
                            <ul>
                            	<?php foreach ($posts as $post) : 
    $words = explode(" ",$post->title);
    $word_limit = 10;
    $title =  implode(" ",array_splice($words,0,$word_limit));


                                ?>
                                <li>
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div><?= Html::a($title, ["/site/{$post->slug}"]) ?></div>
                                            <div class="post-date"><?php echo frontend\models\common::urdu_date($post->publishedDate);?></div>
                                           
                                        </div>
                                        
                                    </div>
                                </li>

                              <?php endforeach; ?>  
                               
                                
                               

                                
                                                                                                                                                                                                
                            </ul>
                        </div>
                    </div>
                </div>