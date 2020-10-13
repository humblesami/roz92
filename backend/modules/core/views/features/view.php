<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModuleFeatures */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Module Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-module-features-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'module_id',
            'feature_parent_id',
            'name',
            'menu_name',
            'desc:ntext',
            'url:url',
            'controller_param',
            'javascript_base',
            'javascript_function',
            'menu_icon',
            'menu_order',
            'created_by',
            'type',
            'datetime',
            'status',
            'feature_for',
            'repeat_function',
            'feature_display',
        ],
    ]) ?>

</div>
