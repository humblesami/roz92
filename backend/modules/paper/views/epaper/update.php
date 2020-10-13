<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapEpaperMst */

$this->title = 'ePaper';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Pap Epaper Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-pap-epaper-mst-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
