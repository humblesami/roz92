<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */

$this->title = 'Update Tbl Core Master Setup: ' . ' ' . $model->master_setup_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Master Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->master_setup_id, 'url' => ['view', 'id' => $model->master_setup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-core-master-setup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
