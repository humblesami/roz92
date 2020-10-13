<?php



/* @var $this yii\web\View */



use yii\helpers\Html;



?>

<style type="text/css">

        .ajax-load{

            background: #e1e1e1;

            padding: 10px 0px;

            width: 100%;

        }

    </style>

<h1><?php echo '"' . $q . '"'; ?></h1>



<br>

<div>



</div>

  <br>

<div id="post-data">

     <?= $this->render('searchresult', ['result' => $result]); ?>

</div>



<div class="ajax-load text-center" style="display:none">

    <p><img src="<?php echo \Yii::$app->request->BaseUrl?>/images/loader.gif">Loading More post</p>
<!-- adds code -->
<?php echo \efrontend\components\Adds::widget() ?>
<!-- adds code -->
</div>





<script type="text/javascript">

    $(window).scroll(function() {

        if($(window).scrollTop() + $(window).height() >= $(document).height()) {

            var last_id = $(".post-id:last").attr("id");

            loadMoreData(last_id);

        }

    });





    function loadMoreData(last_id){

      $.ajax(

            {

                url: "<?php echo Yii::$app->urlManager->createUrl('searchmore');?>?q=<?php echo $q?>&last_id=" + last_id,

                type: "get",

                beforeSend: function()

                {

                    $('.ajax-load').show();

                }

            })

            .done(function(data)

            {

                $('.ajax-load').hide();

                $("#post-data").append(data);

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                  //alert('server not responding...');

            });

    }

</script>

<div id="nr-img-preview" style="display: none;">

  <div class="text-center">



        <div class="contnr-column">

          <div align="left" class="social-icons">

            <style type="text/css">



            .bg-light{display: none;}

            header{height: 72px;}

           .footer {margin-top: 0px;}

            .eng-date{display: none;}

 

            #share-buttons img {

            width: 35px;

            padding: 5px;

            border: 0;

            box-shadow: 0;

            display: inline;

            border-radius: 5px !important;

                box-sizing: border-box

            }

             

            </style>

            <!-- I got these buttons from simplesharebuttons.com -->

            <div id="share-buttons" >

                

                <!-- Facebook -->

                <a href="#" id ="fshare" target="_blank">

                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />

                </a>



               <!-- Twitter -->

                <a href="#" id="tshare" target="_blank">

                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />

                </a>



              <!-- LinkedIn -->

                <a href="#" id="lshare" target="_blank">

                    <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />

                </a>



              <!-- Email -->

                <a id="eshare" href="#">

                    <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />

                </a>

                

                <!-- Print -->

                <a href="javascript:;" onclick="window.print()">

                    <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />

                </a>  



            </div>





          </div>

          <span class="left-ads">


          </span>

          

          <span class="middle-img">

            <img src="" id="nr-img">

          </span>

          

          <span class="right-ads">

            

          </span>

          <div class="clearfix"></div>

        </div>





      <div class="dis-cont" style="width: 50%; margin:0px auto;" >

        <?php

        $share_url = '';

        echo  $this->render('/items/share.php', ['url' => $share_url]) ?>

      </div>

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



.lt-479 div.aw-widget-current-inner div.aw-widget-content a.aw-current-weather p{

  position: relative!important;

    width: 100%!important;

    padding-left: 0%!important;

    z-index: 11!important;

}

@media (max-width: 768px){



  .mob-eng-date {

      display: none;

  }

  header{height: 120px;}

  .content h1{

    text-align: center;

  }

  /*.search-container {

    top: 15px;

  }*/

  .search-input{

    width: 100%;

    margin-top: 0px;

  }



}



</style>   



<script language="javascript">

      

  function close_popup(){

    $('#nr-img').attr('src','')

    $('#nr-img-preview').hide();

    $('body').css('overflow','scroll');

    url = document.location.href;

   

    url = removeURLParameter(url,'n');

     window.history.pushState("string", "Title", url);

    

  }



  function load_popup_col(img){

    image_url  = img;

    $('#fshare').attr('href','http://www.facebook.com/sharer.php?u=' + image_url );

    $('#tshare').attr('href','https://twitter.com/share?url=' + image_url);

    $('#lshare').attr('href',' http://www.linkedin.com/shareArticle?mini=true&amp;url=' + image_url);



    $('#eshare').attr('href',' mailto:?Subject=Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 ' + image_url);  

    $('#nr-img-preview').show();





    $('#nr-img').attr('src',img)

    $('body').css('overflow','hidden')



    // alert(para)

    //$('#' + para).trigger('click');

  }

  

</script>





