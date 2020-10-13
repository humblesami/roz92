<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblProfile */

$this->title = 'Update Tbl Profile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
