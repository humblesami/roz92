<?php

use yeesoft\helpers\Html;
use yeesoft\media\widgets\TinyMce;
use yeesoft\models\User;
use yeesoft\post\models\Category;
use yeesoft\post\models\Post;
use yeesoft\widgets\ActiveForm;
use yeesoft\widgets\LanguagePills;
use yii\jui\DatePicker;
use yeesoft\post\widgets\MagicSuggest;
use yeesoft\post\models\Tag;
use yii\helpers\ArrayHelper;
use backend\modules\paper\models\TblProfile;
/* @var $this yii\web\View */
/* @var $model yeesoft\post\models\Post */
/* @var $form yeesoft\widgets\ActiveForm */
?>

    <div class="post-form">

        <?php
     
        $form = ActiveForm::begin([
            'id' => 'post-form',
            'validateOnBlur' => false,
        ])
        ?>
<input type="hidden" id="post-type" class="form-control" value="2" name="Post[post_type]" aria-required="true">
        <div class="row">
            <div class="col-md-9">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <?php if ($model->isMultilingual()): ?>
                            <?= LanguagePills::widget() ?>
                        <?php endif; ?>

                        <?= $form->field($model, 'title',['enableLabel' => false])->textInput(['placeholder' => 'ENTER NEWS HEADLINE HERE','onBlur' => 'change_slug()']);?>

                       
                        <div class="slug-link">Link: http://roznama92news.com/<span id="slug_value"><?php echo $model->slug?></span></div>
                         <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                       

                        <?= $form->field($model, 'content')->widget(TinyMce::className()); ?>


                        <h3>SEO</h3>

                        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'description')->textarea(['rows' => '6','maxlength' => true]) ?>

    
                    </div>
                </div>
            </div>

            <div class="col-md-3">



 

                
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="record-info">
                            <?php if (!$model->isNewRecord): ?>

                                <div class="form-group clearfix">
                                    <label class="control-label" style="float: left; padding-right: 5px;">
                                        <?= $model->attributeLabels()['created_at'] ?> :
                                    </label>
                                    <span><?= $model->createdDatetime ?></span>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="control-label" style="float: left; padding-right: 5px;">
                                        <?= $model->attributeLabels()['updated_at'] ?> :
                                    </label>
                                    <span><?= $model->updatedDatetime ?></span>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="control-label" style="float: left; padding-right: 5px;">
                                        <?= $model->attributeLabels()['updated_by'] ?> :
                                    </label>
                                    <span><?= $model->updatedBy->username ?></span>
                                </div>

                            <?php endif; ?>

                            <div class="form-group">
                                <?php if ($model->isNewRecord): ?>
                                    <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a(Yii::t('yee', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                                <?php else: ?>
                                    <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a(Yii::t('yee', 'Delete'), ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-default',
                                        'data' => [
                                            'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="record-info">
                            <?php

                            ?>
                            <?= $form->field($model, 'thumbnail')->widget(yeesoft\media\widgets\FileInput::className(), [
                                'name' => 'image',
                                'buttonTag' => 'button',
                                'buttonName' => Yii::t('yee', 'Browse'),
                                'buttonOptions' => ['class' => 'btn btn-default btn-file-input'],
                                'options' => ['class' => 'form-control'],
                                'template' => '<div class="post-thumbnail thumbnail"></div><div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                'thumb' => $this->context->module->thumbnailSize,
                                'imageContainer' => '.post-thumbnail',
                                'pasteData' => yeesoft\media\widgets\FileInput::DATA_URL,
                                'callbackBeforeInsert' => 'function(e, data) {
                                $(".post-thumbnail").show();
                            }',
                            ]) ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="record-info">
                                <?php

                                    $profile_list = TblProfile::find()->where(['status_id' => 1])->all();
                                    $profile_list = ArrayHelper::map($profile_list, 'id', 'name');
                                echo  $form->field($model, 'profile_id')->dropDownList($profile_list) ?>

                        </div>
                    </div>
                </div>

 <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="record-info">


    <?php

                          
$cc =  ArrayHelper::map(Category::getCats(), 'id', 'name');
$sel_val = json_decode($model->catValues,true);


                  /*          echo $form->field($model, 'catValues')->checkboxList($cc,


 ['item' => function ($index, $label, $name, $checked, $value) {
     $checked = $checked ? 'checked' : '';
        return '<div>'
                . '<label>'
                . '<input type="checkbox" '. $checked. '  name="' . $name . '" value="' . $value . '"> '
                . '<span class="route-text">' . $label . '</span>'
                . '</label>'
                . '</div>';
    }]

                            );*/


                             ?>

<div style="height: 200px; overflow-y: scroll">                             

<div class="form-group field-post-catvalues">
    <label class="control-label">Category</label>
</div>


    <input type="hidden" name="Post[catValues]" value="">
<?php foreach($cc as $key => $value){
    $check = "";
    if(in_array($key, $sel_val)){
        $check = "checked";
    }
?>
<div id="post-catvalues"><div>
<label><input type="checkbox" name="Post[catValues][]" data-cvalue="<?php echo $value;?>" onclick="get_cat(this)" class="chk-cat" <?php echo $check;?> value="<?php echo $key;?>"> 
<span class="route-text"><?php echo $value;?></span></label>
</div></div>
<?php }?>
</div>




                        </div>
                    </div>
                </div>

                
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="record-info">
                          

                      
                              <?= $form->field($model, 'tagValues')->widget(MagicSuggest::className(), ['items' => Tag::getTags()]); ?>


                            
                           
  <?//= $form->field($model, 'catValues')->widget(MagicSuggest::className(), ['items' => Category::getCats()]); ?>


                            <?php


/*
                          
$cc =  ArrayHelper::map(Category::getCats(), 'id', 'name');
$sel_val = json_decode($model->catValues,true);


                            echo $form->field($model, 'catValues')->checkboxList($cc,


 ['item' => function ($index, $label, $name, $checked, $value) {
        return '<div>'
                . '<label>'
                . '<input type="checkbox" {$checked}  name="' . $name . '" value="' . $value . '"> '
                . '<span class="route-text">' . $label . '</span>'
                . '</label>'
                . '</div>';
    }]

                            );

*/
                             ?>






                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="record-info">
                           

                            <?= $form->field($model, 'published_at')
                                ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]); ?>

                            <?= $form->field($model, 'status')->dropDownList(Post::getStatusList()) ?>

                            <?php if (!$model->isNewRecord): ?>
                                <?= $form->field($model, 'created_by')->dropDownList(User::getUsersList()) ?>
                            <?php endif; ?>

                            <?= $form->field($model, 'comment_status')->dropDownList(Post::getCommentStatusList()) ?>
                            <?= $form->field($model, 'view')->hiddenInput(['value'=> 'post'])->label(false);?>
                            <?//= $form->field($model, 'view')->dropDownList($this->context->module->viewList) ?>
                            <?= $form->field($model, 'layout')->hiddenInput(['value'=> 'main'])->label(false);?>
                            <?//= $form->field($model, 'layout')->dropDownList($this->context->module->layoutList) ?>

                        </div>
                    </div>
                </div>

               

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$css = <<<CSS
.ms-ctn .ms-sel-ctn {
    margin-left: -6px;
    margin-top: -2px;
}
.ms-ctn .ms-sel-item {
    color: #666;
    font-size: 14px;
    cursor: default;
    border: 1px solid #ccc;
}
CSS;

$js = <<<JS
    var thumbnail = $("#post-thumbnail").val();
    if(thumbnail.length == 0){
        $('.post-thumbnail').hide();
    } else {
        $('.post-thumbnail').html('<img src="' + thumbnail + '" />');
    }
JS;

$this->registerCss($css);
$this->registerJs($js, yii\web\View::POS_READY);
?>


<?php
$js = <<<JS

var routeCheckboxes = $('.route-checkbox');
var routeText = $('.route-text');

// For checked routes
var backgroundColor = '#D6FFDE';

function showAllRoutesBack() {
    $('#routes-list').find('.hide').each(function(){
        $(this).removeClass('hide');
    });
}

//Make tree-like structure by padding controllers and actions
routeText.each(function(){
    var _t = $(this);

    var chunks = _t.html().split('/').reverse();
    var margin = chunks.length * 30 - 30;

    if ( chunks[0] == '*' )
    {
        margin -= 30;
    }

    _t.closest('label').closest('div.checkbox').css('margin-left', margin);

});

// Highlight selected checkboxes
routeCheckboxes.each(function(){
    var _t = $(this);

    if ( _t.is(':checked') )
    {
        _t.closest('label').css('background', backgroundColor);
    }
});

// Change background on check/uncheck
routeCheckboxes.on('change', function(){
    var _t = $(this);

    if ( _t.is(':checked') )
    {
        _t.closest('label').css('background', backgroundColor);
    }
    else
    {
        _t.closest('label').css('background', 'none');
    }
});


// Hide on not selected routes
$('#show-only-selected-routes').on('click', function(){
    $(this).addClass('hide');
    $('#show-all-routes').removeClass('hide');

    routeCheckboxes.each(function(){
        var _t = $(this);

        if ( ! _t.is(':checked') )
        {
            _t.closest('label').addClass('hide');
            _t.closest('div.separator').addClass('hide');
        }
    });
});

// Show all routes back
$('#show-all-routes').on('click', function(){
    $(this).addClass('hide');
    $('#show-only-selected-routes').removeClass('hide');

    showAllRoutesBack();
});

// Search in routes and hide not matched
$('#search-in-routes').on('change keyup', function(){
    var input = $(this);

    if ( input.val() == '' )
    {
        showAllRoutesBack();
        return;
    }

    routeText.each(function(){
        var _t = $(this);

        if ( _t.html().indexOf(input.val()) > -1 )
        {
            _t.closest('label').removeClass('hide');
            _t.closest('div.separator').removeClass('hide');
        }
        else
        {
            _t.closest('label').addClass('hide');
            _t.closest('div.separator').addClass('hide');
        }
    });
});

JS;

$this->registerJs($js);
?>
<script type="text/javascript">
    
   function change_slug(){
        slug = $('#post-title').val();
        $('#post-seo_title').val(slug);
       slug = removeSpeicalChar(slug);

        $('#slug_value').text(slug)
        $('#post-slug').val(slug);
    }
    function change_content(){
        alert('test');
    }
    function get_cat(para){
        cat_value = '';
        $('.chk-cat').each(function( index, value ) {
            if($(this).prop( "checked" )){
                if($(this).val() != 24 && $(this).val() != 1){
                    console.log($(this).val())
                    cat_value = cat_value + ', ' + $(this).data('cvalue');
                }
                 
             }
        });
        cat_value = cat_value.substring(1);
        $('#post-keyword').val(cat_value);
        
    }

   $(function(){
        $('#post-fodrm').submit(function(e){
          
            e.preventDefault();
        })

$( "#post-form" ).on( "submit", function( event ) {
    tinyMCE.triggerSave()
      content = $('#post-content').val();
      content = stripHtml(content);
      content = content.substring(0,100)
      $('#post-description').val(content);
  //event.preventDefault();
});

function stripHtml(html){
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}

   })

</script>