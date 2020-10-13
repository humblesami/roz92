 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 
  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $heading;?></div>
                    <div class="panel-body news-box">
                        
                        <div class="ajj-col">
                            <ul>
                            	<?php foreach ($posts as $post) : ?>
                                <li>
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></div>
                                             <div class="post-date"><?php echo frontend\models\common::urdu_date($post->publishedDate);?></div>
                                           
                                        </div>
                                        <!-- <div class="col-sm-4">
                                                                                    <?= $post->getThumbnail(['class' => 'img-responsive', 'style' => '']) ?>
                                            </div> -->
                                    </div>
                                </li>

                              <?php endforeach; ?>  
                               
                                
                               

                                
                                                                                                                                                                                                
                            </ul>
                        </div>
                    </div>
                </div>