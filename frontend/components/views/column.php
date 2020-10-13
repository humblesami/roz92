 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 

  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $heading;?></div>
                    <div class="panel-body news-box">
                        
                        <div class="ajj-col news-scroll">
                            <ul>
                            	<?php foreach ($posts as $post) :


                                 ?>
                                <li>
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></div>

                                            <div class="xname"><b>
                                                 <?php

                                                 $category_id = $post->category_id;
                                                 if($category_id){
                                                    
                                                    $murl = $post->cat_url;                                                 

                                                 echo  Html::a($post->profile_name, [$murl]);

                                             }else{

                                                echo $post->profile_name;
                                             }


                                                 ?>   
                                               </b></div>
                                               <div class="post-date"><?php echo  frontend\models\common::urdu_date(date('Y-m-d',$post->publish_date));?></div>
                                           
                                        </div>
                                        <!-- <div class="col-sm-4">
                                          
                                        
                                            
                                            <img src="backend/web/<?//= $post->author->profile->image; ?>" alt="" class="img-responsive">
                                                                                    
                                            </div> -->
                                    </div>
                                </li>

                              <?php endforeach; ?>  
                               
                                
                               

                                
                                                                                                                                                                                                
                            </ul>
                        </div>
                    </div>
                </div>