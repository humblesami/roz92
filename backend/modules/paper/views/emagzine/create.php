<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapEpaperMst */

$this->title = 'Create eMagzine';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Pap Epaper Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-pap-epaper-mst-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
