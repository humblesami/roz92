<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModuleFeatures */

$this->title = 'Create Tbl Core Module Features';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Module Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="subheader HtZero border-box clearfix">
  <h3><i class="icon-settings-big icon-settings-pos"></i>Features</h3>
</div>
<div class="userForm clearfix contentscroll">
  <div class="row">
    <div class="col-lg-6">
      <div class="tbl-core-modules-create">
        <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
      </div>
    </div>
  </div>
</div>
