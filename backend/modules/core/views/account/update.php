<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblAccount */

$this->title = 'Update API Account: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'API Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
