<?php

use backend\modules\paper\models\TblPapStation;
use backend\modules\paper\models\TblPapEpaperMst;
use yii\jui\DatePicker;
use yeesoft\post\models\Post;
use yeesoft\post\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

//$paper_data = TblPapEpaperMst::find()->where(['station_id' => $station_id])->orderBy(['issue_date' =>SORT_DESC])->one();

$paper_data = TblPapEpaperMst::find()->where(['station_id' => $station_id,'paper_status' => 'P'])->orderBy(['issue_date' =>SORT_DESC])->one();

if($xdate != ""){

  $paper_data = TblPapEpaperMst::find()->where(['station_id' => $station_id,'issue_date' => $xdate,'paper_status' => 'P'])->orderBy(['issue_date' =>SORT_DESC])->one();

}else{

    $xdate = $paper_data['issue_date'];

}

$query = Post::find()->joinWith('cats')->where([

            'status' => Post::STATUS_PUBLISHED,

            Category::tableName() . '.slug' => 'taz-tryn-khbr',

        ])->orderBy('published_at DESC')->limit(10)->all();





?>

    <header>

             <!-- mobile header -->

   <div class="head-mobile">

        <div class="nav-brk">

            <script>

                (function($) {    

                    $(document).ready(function() {

                        $('#newsticker_1').newsticker({
                            'tickerTitle' : "تازہ ترین خبر",
                            'style' : "scroll",
                            'pauseOnHover' : true,
                            'showControls' : true,
                            'autoStart' : true,
                            'scrollSpeed' : "50",
                            'slideSpeed' : "1000",
                            'slideEasing' : "swing",
                        });

                    });    

                })( jQuery );

            </script>

            <ul class="newsticker" id="newsticker_1">
                <?php foreach ($query as $row) { ?>  
                    <li>
                        <?= Html::a($row->title, ["/site/{$row->slug}"]) ?>
                    </li>
                <?php }?>
            </ul>

        </div>

        <div class="row brand">
            <div class="col-xs-3 text-center">
                <div class="mobile-nav dropdown">
                        <a href="javascript:;;" class="dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="icon-dot">ای پیپر</span></a>
                        <?php 

                        $menu_id = "14";

                        echo \app\components\LeftBar::widget(array('menu_ids' =>  $menu_id,'position' => 'top','xclass' => 'dropdown-menu dropdown-menu-right')) ?>

                </div>

            </div>

            <div class="col-xs-6 text-center">

                <a href="<?php echo Yii::$app->urlManagerFrontEnd->baseUrl;?>">

                    <img src="<?php echo \Yii::$app->request->BaseUrl?>/images/logo.png" alt="Roznama">

                </a>

            </div>

            <div class="col-xs-3">

                <nav class="navbar navbar-default ">

                    <div class="container-fluid">

                      <div class="navbar-header mob-navbar-header">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                          <span class="sr-only">Toggle navigation</span>

                          صفحات

                        </button>

                      </div>

                          <div id="navbar" class="navbar-collapse collapse xtop-menu">

                                <ul class="nav navbar-nav">

                                    <?php

                                    if($paper_data){

                                        $page_detail = $paper_data['page_detail'];

                                        $page_detail = json_decode($page_detail);

                                        $aa = 0;

                                        foreach ($page_detail as $key => $p_data) {

                                            $aa++;

                                            $value = $p_data->name;

                                            $is_common = $p_data->is_common;

                                            # code...

                                            if($aa == 13){

                                                break;

                                            }

                                        ?>

                                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=<?php echo $key?>&is_common=<?php echo $is_common;?>&n=1000&xdate=<?php echo $xdate;?>"><?php echo $value;?></a></li>

                                    <?php }?>

                                    <?php }?>

                                    <li><a href="javascript:void(0)"   class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">مزید<i class="fa fa-angle-down"></i></a>

                                           <ul class="dropdown-menu">

                                      <?php

                                    if($paper_data){

                                        $page_detail = $paper_data['page_detail'];

                                        $page_detail = json_decode($page_detail);

                                        $aa = 0;

                                        foreach ($page_detail as $key => $p_data) {

                                            $aa++;

                                            $value = $p_data->name;

                                            $is_common = $p_data->is_common;

                                            # code...

                                            if($aa >= 13){ 

                                    ?>

                                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=<?php echo $key?>&is_common=<?php echo $is_common;?>&n=1000&xdate=<?php echo $xdate;?>"><?php echo $value;?></a></li>

                                    <?php }?>

                                    <?php }?>

                                    <?php }?>                                     

                                        </ul>

                                    </li>

                                </ul>

                          </div><!--/.nav-collapse -->

                        </div><!--/.container-fluid -->

                      </nav>


                </div>

            </div>

        </div> 

     <!-- mobile header end -->



                <div class="header-top hidden-xs">

                    <div class="container" st,yle="padding-top: 32px">

                      

                        <div class="row">

                            <div class="col-sm-12 pull-left">

                                <div class="right-sec">

                                    <div class="date">

                                        

                                        <?php echo $urdu_date;?>



                                    </div>



                                <div class="logo text-right">

                                    <a href="<?php echo Yii::$app->urlManagerFrontEnd->baseUrl;?>"><img src="<?php echo \Yii::$app->request->BaseUrl?>/images/logo.png" alt=""></a>

                                </div>



                                    <div class="nav ">

                                        <ul>

                                            <?php

                                                $station_list = TblPapStation::find()->innerJoinWith('paper')->all();

                                                foreach($station_list as $row){

                                            ?>

                                            <li <?php if($row['id'] == $station_id){?>class="active"<?php }?>><a href="<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $row->id?>"><?php echo $row['urdu_name']?></a></li>

                                            <?php }?>

                                            

                                        </ul>

                                    </div>

<div class="eng-date">

                                           <?php



                                               $value = date('d M Y',strtotime($xdate));

echo DatePicker::widget([

    'name'  => 'from_date',

    'value'  => $value,

    'options' => ['style' => 'border:0px;display:inline','id' => 'xdate'],

    'clientOptions' =>[

                        'dateFormat' => 'd-m-yy',

                    ],

    //'language' => 'ru',

   // 'dateFormat' => 'yyyy-MM-dd',



]);                                          ?>

                                            

                                           <label>گزشتہ شمارے </label>



                                        </div>





                                    <div class="clearfix"></div>

                                   

                                    

                                </div> <!-- right section -->

                                

                            </div>

                         

                        </div>

                    </div>



                </div>

                

                <div class="header-bottom hidden-xs">

                    <div class="container">




<!-- brk news -->
 <div class="nav-brk">





  

<script>

(function($) {    

    $(document).ready(function() {

        $('#newsticker_0').newsticker({

                            'tickerTitle' : "تازہ ترین خبر",

                            'style' : "scroll",

                            'pauseOnHover' : true,

                            'showControls' : true,

                            'autoStart' : true,

                            'scrollSpeed' : "50",

                            'slideSpeed' : "1000",

                            'slideEasing' : "swing",

                                               

        });

    });    

})( jQuery );

</script>



<ul class="newsticker" id="newsticker_0">



<?php

foreach ($query as $row) {

?>  

<li>

    <?= Html::a($row->title, ["/site/{$row->slug}"]) ?>



  </li>

<?php }?>

</ul>









                                    </div>
<!-- brk news end -->




















                        

                       <nav class="navbar navbar-expand-lg navbar-light bg-light">

                            <ul>

                                <?php

                                if($paper_data){

                                    $page_detail = $paper_data['page_detail'];

                                    $page_detail = json_decode($page_detail);

                                    $aa = 0;

                                    foreach ($page_detail as $key => $p_data) {



                                        $aa++;



                                        $value = $p_data->name;

                                        $is_common = $p_data->is_common;



                                        # code...

                                        if($aa == 13){

                                            break;

                                        }

                                    

                                ?>

                                <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=<?php echo $key?>&is_common=<?php echo $is_common;?>&n=1000&xdate=<?php echo $xdate;?>"><?php echo $value;?></a></li>

                                <?php }?>

                                <?php }?>



                                <li><a href="javascript:void(0)"   class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">مزید<i class="fa fa-angle-down"></i></a>



                                       <ul class="dropdown-menu">



                                  <?php

                                if($paper_data){

                                    $page_detail = $paper_data['page_detail'];

                                    $page_detail = json_decode($page_detail);

                                    $aa = 0;

                                    foreach ($page_detail as $key => $p_data) {



                                        $aa++;



                                        $value = $p_data->name;

                                        $is_common = $p_data->is_common;



                                        # code...

                                        if($aa >= 13){

                                            

                                    

                                ?>

                                <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/index2');?>?station_id=<?php echo $station_id?>&page_id=<?php echo $key?>&is_common=<?php echo $is_common;?>&n=1000&xdate=<?php echo $xdate;?>"><?php echo $value;?></a></li>

                                <?php }?>

                                <?php }?>

                                <?php }?>                                     







                                    </ul>

                                </li>

                               



                            </ul>

                        </nav>

                    </div>

                </div>


                

            </header>

            <div class="search-container">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-4">
                            <!-- mobile datepicker -->

                            <div class="eng-date mob-eng-date">

                                <?php
                                $value = date('d M Y',strtotime($xdate));

                                echo DatePicker::widget([
                                    'name'  => 'from_date',
                                    'value'  => $value,
                                    'options' => ['style' => 'border:0px;display:inline','id' => 'xdate-mob'],
                                    'clientOptions' =>[
                                        'dateFormat' => 'd-m-yy',
                                    ],
                                    //'language' => 'ru',
                                    // 'dateFormat' => 'yyyy-MM-dd',

                                ]);?>

                            </div>


                            <!-- mobile datepicker -->
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-8">
                            <!-- search -->

                           

                            <div class="bg">
                                <input type="text" class="form-control search-input" name="transliterateTextField" id="transliterateTextField" placeholder="یہاں ٹائپ کریں..." />
                               
                            </div>

                            <!-- search -->
                        </div>
                    </div>
                    
                </div>
                
            </div>


<script language="javascript">

    function me(text){
    
            url = 'https://www.google.com/inputtools/request?text=' + text + '&ime=transliteration_en_ur';
            
            $.getJSON(url, function( data ) {
            uval = data[1][0][1][0];
            
            $('#transliterateTextField').val(uval);
            
            send_search();
});
    }
    
$("input").on("keypress",function search(e) {
    if(e.keyCode == 13) {
         val = $(this).val();
                me(val);
        
    }
   
});
 function send_search(){
        
       para = $('#transliterateTextField').val();
        if(para != ""){
            $("#page_loading").show();
           
            url  = "<?php echo Url::toRoute(['/search','q' => '_para'])?>";
            url = url.replace('_para', para);
            document.location.href = url;

            $("#page_loading").hide();
        }        
    }

</script>





