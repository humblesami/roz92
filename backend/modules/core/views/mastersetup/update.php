<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */

$this->title = 'Update Master Setup: ' . ' ' . $model->master_setup_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Master Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->master_setup_id, 'url' => ['view', 'id' => $model->master_setup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default">
    <div class="panel-heading top-heading">
    	<h2><?= Html::encode($this->title) ?></h2>
        <div class="panel-tools">
        <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                      <?= $this->render('_form', [
                          'model' => $model,
                      ]) ?>

            </div>
        </div>
    </div>
</div>
