 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 

  <div class="panel panel-default">
                    
                    <div class="panel-body">
                        
                        <div class="comp-newsd">
                            <div class="row">
                            <?php 
                            $aa = 0;
                            $bb = 0;
                            foreach ($posts as $post) : 
                                $aa++;
                                $bb++;
                            ?>
                                <div class="col-sm-4 col-xs-12 xkhabarcol" >
                                    <div class="row">
                                        <div class="col-sm-12 txt-box">
                                            <?= Html::a($post->title, ["/site/{$post->slug}"]) ?>
                                         </div>
                                       <!--  <div class="col-sm-5 text-right img-box"><?= $post->getThumbnail(['class' => 'img-responsive', 'style' => '']) ?></div> -->
                                    </div>

                                </div>
                                <?php if($aa == 3 and $bb < 10){
                                    $aa = 0;
                                ?>
                                    </div><div class="row">
                                <?php }?>
                             <?php endforeach; ?>  
                                

                            </div>

                           

                            


                        </div>
                    </div>
                </div>