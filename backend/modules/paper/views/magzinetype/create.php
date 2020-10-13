<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapMagzineType */

$this->title = 'Create Magazine Type';
$this->params['breadcrumbs'][] = ['label' => 'Magazine Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-pap-magzine-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
