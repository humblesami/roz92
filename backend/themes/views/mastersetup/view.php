<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */

$this->title = $model->master_setup_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Master Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-master-setup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->master_setup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->master_setup_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'master_setup_id',
            'module_id',
            'master_setup_name',
            'tbl_name',
            'created_by',
            'status_id',
            'master_setup_value:ntext',
        ],
    ]) ?>

</div>
