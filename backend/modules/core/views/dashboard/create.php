<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreDashboards */

$this->title = 'Create Tbl Core Dashboards';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Dashboards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-dashboards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
