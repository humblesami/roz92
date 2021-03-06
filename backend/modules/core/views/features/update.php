<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModuleFeatures */

$this->title = 'Update Tbl Core Module Features: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Module Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-core-module-features-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
