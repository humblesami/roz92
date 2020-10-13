<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\paper\models\TblPapEmagzineMst;
use backend\modules\paper\models\TblPapEmagzineDtl;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'eMagzine';
$this->params['breadcrumbs'][] = $this->title;
?>

 

<div class="panel panel-default">
 <div class="panel-heading">
            
             <div class="row">
                <div class="col-sm-12 page-heading">
                    <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
                    <div class="pull-right">
                    <?= Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
                    
                </div>
                </div>
            </div>


        </div>    
    <div class="panel-body">

        <table class="table table-bordered" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th></th>
                    <th>Magazine Name</th>
                    <th>Magazine Type</th>
                    <th>Issue Date</th>
                    <th>Uploaded By</th>
                    <th>Status</th>
                   
                    <th>Action</th>
                </tr>
            </thead>




   

            <tbody >
                <?php
                    $paper_list = TblPapEmagzineMst::find()->orderBy('issue_date desc')->limit(10)->all();
                    foreach ($paper_list as $row) {
                        # code...

                        $short_name =  $row->xtype['name'];
                        $paper_name = $short_name . " - " . date('dmY',strtotime($row['issue_date']));
                        $paper_status = '';
                        if($row['paper_status'] == 'D'){

                            $paper_status  = '<span class="text-danger"><b>Draft</b></span>';
                        }else if($row['paper_status'] == 'P'){
                            $paper_status = '<span class="text-success"><b>Publish</b></span>';
                        }
                        

                       
                    
                ?>
                 <tr>
                    <td class="text-center"><a data-toggle="collapse" href="#detailsRow_<?php echo $row['id'];?>" aria-expanded="false" class="yt-toggle collapsed" aria-controls="detailsRow_120">

 <i class="fa fa-plus pm"></i>
        <i class="fa fa-minus pm"></i>


                        </a></td>
                    <td><?php echo $paper_name;?></td>
                    <td><?php echo $row->xtype['name'];?></td>
                    <td><?php echo Yii::$app->formatter->format($row['issue_date'], 'date');;?></td>
                    <td><?php echo $row->user['full_name'];?></td>
                    <td><?php echo $paper_status;?></td>
                    
                    <td>


<div class="btn-group pull-right custom_gp manage-emp-btn">
                <a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn-sm over_dlt_btn">
                            &nbsp;Action&nbsp;
                            <span class="caret"></span>
                        </a>
                <ul class="dropdown-menu pull-right new_link">
                   
                        <?php if($row['paper_status'] == 'D'){?>
                         <li>
                            <a href="<?php echo Yii::$app->urlManager->createUrl('/paper/emagzine/publish');?>?id=<?php echo $row['id']?>&status=P">Publish</a>
                        </li>




                    <li>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('/paper/emagzine/update');?>?id=<?php echo $row['id']?>">Bulk Upload</a>
                    </li>

 <li>
                        <a href="javascript:void(0)" onclick="del_paper('<?php echo $row['id'];?>')">Delete</a>
                    </li>


                        <?php }else{?>
                        <li>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('/paper/emagzine/publish');?>?id=<?php echo $row['id']?>&status=D">Un Publish</a>
                        </li>
                        <?php }?>
                    
                    
                   
                    <li></li>
                </ul>
            </div>                        


                        



                    </td>
                </tr>

                <tr id="detailsRow_<?php echo $row['id'];?>" class="collapse">
                            <td colspan="7">


                                <h3>Pages</h3>
                                <div class="row">
                                    <?php 
                                         $page_detail= $row['page_detail'];
                                         $page_detail = json_decode($page_detail);
                                        $pDetail = TblPapEmagzineDtl::find()->where(['emagzine_id' => $row['id']])->all();
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
                                                        
                                                        <li><a href="javascript:void(0)" onclick="replace_image('<?php echo $row['id'];?>','<?php echo $prow['page_id'];?>','<?php echo $image?>')">Delete All & Upload New Page</a></li>
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>

<style type="text/css">
    .paper-div .panel-heading{border:1px solid #000; border-radius: 0px}
    .paper-div .panel-body{border-right:1px solid #000;border-left:1px solid #000; border-radius: 0px; height: 210px; padding:0px;}
    .paper-div .panel-footer{border:1px solid #000; border-radius: 0px; background: #fff}

    .paper-div ul {list-style:  none; text-align: center; padding:0px; margin:0px;}
   .paper-div ul li{display: inline-block; font-size: 10px; color:#1e00d3;}
    .paper-div ul li a{ font-size: 10px;color:#1e00d3;}
    .paper-div ul li a:after {
        content: "      |      ";
    }
    .paper-div ul li:last-child a:after{  content: "";}
    .pm{color:#000000;}
    .btn-heading{padding:10px;margin-top: -60px;}

.yt-toggle.collapsed .fa-minus {
  display: none;
}

.yt-toggle.collapsed .fa-plus {
  display: inline-block;
}

.yt-toggle .fa-plus {
  display: none;
}

</style>




                            </td>
                </tr>


                <?php 
                    }
                ?>

               

            </tbody>




 




        </table>

      

    </div>
</div>
<script language="javascript">

function del_paper(id){

        swal({
          title: 'Are you sure delete this paper',
          text: "",
          width: 600,
          type: 'warning',

          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: true,
          reverseButtons: false
        }).then((result) => {
          if (result.value) {
           $('#page_loading').show();

                url = "<?php echo Yii::$app->urlManager->createUrl('/paper/emagzine/delete');?>?id=" + id

               
                    //Logic to delete the item
                    document.location.href = url;
               

 
          } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
          ) {
            swal(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })





}
function replace_image(paper_id,page_detail_id,image_url){

        swal({
          title: 'Are you sure',
          text: "This will delete the Page Image, Image Maps, News Images & News Post. This action cannot be undone.",
           width: 600,
          type: 'warning',
          imageUrl: image_url,
          imageWidth: 400,
          imageHeight: 200, 
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: true,
          reverseButtons: false
        }).then((result) => {
          if (result.value) {
           $('#page_loading').show();
          url = "<?php echo Yii::$app->urlManager->createUrl('/paper/emagzine/replace_image');?>?paper_id=" + paper_id + "&page_detail_id=" + page_detail_id;
            load_popup2(url,'Replace Image')  
          } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
          ) {
            swal(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })








   
}
</script>

