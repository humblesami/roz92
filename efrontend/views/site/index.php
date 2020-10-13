<?php

/* @var $this yii\web\View */
use backend\modules\paper\models\TblPapEpaperMst;
use backend\modules\paper\models\TblPapEpaperDtl;

$this->title = 'Roznama';

?>

<div class="container">
<?php
$issue_date = '2017-11-20';
$paper_mst = TblPapEpaperMst::find()->where(['issue_date' => $issue_date])->one();
$paper_id = $paper_mst->id;

$paperList = TblPapEpaperDtl::find()->where(['epaper_id' => $paper_id])->all();


?>    

<ul class="list-group text-center">
    <?php foreach($paperList as $row){


         $image = str_replace('frontend','backend',Yii::getAlias('@web')) . '/' . $row['path'];

         $pdata['image'][$row['page_id']] = str_replace('frontend','backend',Yii::getAlias('@web')) . '/' . $row['path'];

          $pdata['map_data'][$row['page_id']] = $row['map_data'];
        
    ?>
        <li class="list-group-item">
<a href="<?php echo Yii::$app->urlManager->createUrl('/site/index');?>?page_id=<?php echo $row['page_id'];?>">
            <img src="<?php echo $image;?>" width="175" alt="">
</a>
        </li>
    <?php }?>
</ul>
</div>
<div class="container text-center">
  <div class="row">
    <div class="col-sm-8">
<img src="<?php echo $pdata['image'][$page_id];?>" width="899" alt="" usemap="#image-map">
<?php echo $pdata['map_data'][$page_id];?>
</div>
</div>
</div>
<div id="nr-img-preview" style="display: none;">
  <div class="text-center">
    <img src="" id="nr-img">
    <div class="cls">
    <a href="javascript:void(0)" onclick="close_popup()"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
</div>
  </div>
</div>
<style>
.cls{position: absolute;
    font-size: 40px;
    right: 12px;
    top: 5px;
    z-index: 999999999;
    
  }
.cls a {color:#ccc;}    
#nr-img-preview{
  background: rgba(0,0,0,0.7) ;
  height: 100%;
  position:fixed;
  width:100%;
  top:0px;
  left:0px;
  z-index: 9999;
  overflow:scroll;
  padding-top:50px;
  padding-bottom: 50px;

}
ul.list-group:after {
  clear: both;
  display: block;
  content: "";
}

.list-group-item {
    display: inline-block;
}


</style>
<script type="text/javascript">
    $(function(){

        $('img[usemap]').maphilight()

        $('area').click(function(e){

           e.preventDefault()
           
          $('#nr-img-preview').show();
         
          
           $('#nr-img').attr('src',$(this).attr('href'))
           $('body').css('overflow','hidden')
        })
    })
    function close_popup(){
      $('#nr-img').attr('src','')
      $('#nr-img-preview').hide();
      $('body').css('overflow','scroll')
    }
</script>