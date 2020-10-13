<?php
use backend\modules\paper\models\TblMapPost;

?>
<div id="columns">

  <!-- adds code -->
<?php echo \efrontend\components\Adds::widget() ?>
<!-- adds code -->
    <?php foreach ($result as $row) :

      $p_img = str_replace('efrontend','backend',Yii::getAlias('@web')) . '/' . $row->profile['image'];

      $map_post = TblMapPost::find()->where(['post_id' => $row['id']])->one();
      if($map_post){
        $map_data = $map_post->paperdetail['map_data_raw'];
        $map_id     = $map_post->map_id;
        $map_data   = json_decode($map_data,true);
        $image_url  =  $map_data[$map_id]['href']; 
        ?>

      <?php
      $image_url = '';
      $head_e = '';
      $post_map = \backend\modules\paper\models\TblMapPost::find()->where(['post_id' => $row->id])->one();
      if($post_map){
        $map_data1   =  $post_map->paperdetail->map_data_raw;
        $publish_date = frontend\models\common::urdu_date($row->publishedDate);
        $station = '';
        if(isset($post_map->paperdetail->mst->station['urdu_name'])){
          $station    =  $post_map->paperdetail->mst->station['urdu_name']; 
        }
       
        $map_id     = $post_map->map_id;
        $map_data1   = json_decode($map_data1,true);
        $image_url  =  $map_data1[$map_id]['href'];  
        $ck = 'خبر';
        $gi = 'کی گی';

        if($row->post_type == 2){
          $ck = 'کالم';
          $gi = 'کیا گیا';
        }
        $head_e     = 'یہ ' . $ck . ' روزنامہ ٩٢نیوز ' . $station . ' میں ' . $publish_date. ' کو شایع ' . $gi . ' ';
      }

      if($image_url != 'https://www.roznama92news.com/backend/web/1'){
      ?>

      <div class="post-id" id="<?php echo $row->id; ?>">
        <a href="javascript:void(0)" onclick="load_popup_col('<?php echo $image_url;?>')">
      
          <figure>
            <figcaption><?php echo $head_e; ?></figcaption>
            <img src="<?php echo $image_url; ?>">
          </figure>

        </a>
            </div>
        
      <?php
    }
      }
    endforeach; ?> 

</div>