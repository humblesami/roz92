<?php
use yii\helpers\Url;
?>
<?php  echo \kato\DropZone::widget([
       'options' => [
           'maxFilesize' => '1',

           'id' => 'up-' .  $page_detail_id,
           'pcontainer' => 'prv-' . $page_detail_id,
         //  'dictDefaultMessage' =>  ($image_preview != "") ? '<img src=' . $image_preview . ' class="dz-image" alt="logo" width="100">' : 'Upload Paper',
           'url' => Url::toRoute(['/paper/epaper/upload','id' => $paper_id,'page_id' => $page_detail_id]),
           'addRemoveLinks' => true,
       ],
       'clientEvents' => [
           'complete' => "function(file){

                
                 var json =  $.parseJSON(file.xhr.responseText);
                $('#img_" . $paper_id . "_" . $page_detail_id . "').attr('src', '/manage/' + json.name);
            }",
           'removedfile' => "function(file){alert(file.name + ' is removed')}",



       ], 'files' => 'getFiles(this)',//getFiles func call
   ]); ?>