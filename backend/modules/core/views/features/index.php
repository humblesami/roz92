<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Core Module Features';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading top-heading">
                <h2><?= Html::encode($this->title) ?></h2>

            </div>
        	<div class="panel-body">

    <p>
        <?= Html::a('Create Tbl Core Module Features', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'module.name',
            'feature_parent_id',
            'name',
            'menu_name',
            // 'desc:ntext',
            // 'url:url',
            // 'controller_param',
            // 'javascript_base',
            // 'javascript_function',
            // 'menu_icon',
            // 'menu_order',
            // 'created_by',
            // 'type',
            // 'datetime',
            // 'status',
            // 'feature_for',
            // 'repeat_function',
            // 'feature_display',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>               
                
        	</div>
        </div>
    	<!-- end: DYNAMIC TABLE PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->



