 <?php

use yii\helpers\Url;
use yii\helpers\Html;


?> 


  <div class="panel panel-default">
                    
                    <div class="panel-body news-sbox">
                        
                        <div class="ajj-col-page">
                            <ul>
                            	<?php foreach ($posts as $post) :


                                 ?>
                                <li>
                                    <div class="row">
                                        
                                       
                                        <div class="col-sm-4 col-xs-6">
                                          
                                        
                                            
                                            <img src="<?= $post->profile_image; ?>" alt="" class="img-responsive">
                                                                                    
                                            </div> 



 <div class="col-sm-8 col-xs-6">
                                            <?php
                                            $limit = 65;
                                            if (strlen($post->title) > $limit){
                                                $post->title = substr($post->title, 0, strrpos(substr($post->title, 0, $limit), ' ')) . '...';
                                            }
                                            ?>
                                            <div class="xtitle"><?= Html::a($post->title, ["/site/{$post->slug}"]) ?></div>
                                            <div class="xname"><b>
                                                 <?php

                                                 $category_id = $post->category_id;
                                                 if($category_id){
                                                    
                                                    $murl = $post->cat_url;                                                 

                                                 echo  Html::a($post->profile_name, [$murl]);

                                             }else{

                                                echo $post->profile_name;
                                               
                                             }

 //echo date('Y-m-d',$post->published_at);
                                                 ?>   
                                               </b></div>
                                           
                                        </div>

                                            
                                    </div>
                                </li>

                              <?php endforeach; ?>  
                               
                                
                               

                                
                                                                                                                                                                                                
                            </ul>
                        </div>
                    </div>
                </div>

<div>

</div>
<br>
