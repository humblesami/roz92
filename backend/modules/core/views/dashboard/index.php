<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\core\models\TblCoreDashboardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Core Dashboards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-dashboards-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Core Dashboards', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'desc:ntext',
            'url:url',
            'dashboard_data:ntext',
            // 'created_by',
            // 'datetime',
            // 'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
