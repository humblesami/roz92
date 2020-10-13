<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapStation */

$this->title = 'Update Station: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Pap Stations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-pap-station-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
