<?php
use backend\modules\paper\models\TblPapEpaperDtl;
use backend\modules\paper\models\TblPapEpaperMst;

$row = TblPapEpaperMst::findOne($epaper_id);
?>
<td colspan="7">


                                <h3>Pages</h3>
                                <div class="row">
                                    <?php 
                                         $page_detail= $row['page_detail'];
                                         $page_detail = json_decode($page_detail);
                                        $pDetail = TblPapEpaperDtl::find()->where(['epaper_id' => $epaper_id])->all();
                                        foreach ($pDetail as $prow) {
                                            # code...
                                            $image = Yii::getAlias('@web') . '/' . $prow['path'];



                                        
                                    ?>
                                    <div class="col-lg-2">
                                        <div class="paper-div">
                                            <div class="panel panel-default">
                                                <div class="panel-heading text-center">
                                                    <?php echo $page_detail[$prow['page_id']]->name;?>
                                                </div>
                                                <div class="panel-body">
                                                     <img src="<?php echo $image;?>" height="210" width="100%" id="img_<?php echo $row['id'] ."_" . $prow['page_id'];?>" cladss="img-responsive"> 
                                                </div>
                                                <div class="panel-footer">

                                                    <ul>
                                                        <li><a href="<?php echo Yii::$app->urlManager->createUrl('/paper/epaper/mapping');?>?id=<?php echo $prow['id']?>">Image Map</a></li>
                                                        <li><a href="javascript:void(0)" onclick="replace_image('<?php echo $row['id'];?>','<?php echo $prow['page_id'];?>','<?php echo $image?>')">Delete All & Upload New Page</a></li>
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>






                            </td>