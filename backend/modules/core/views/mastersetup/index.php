<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Setups';
$this->params['breadcrumbs'][] = $this->title;
?>

        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-default">
        <div class="top-content">
        <div class="row">
        	<div class="col-sm-10">
	            <h3><?= Html::encode($this->title) ?></h3>
            </div>
            
            
        </div>
        <div class="border-btm"></div>
        </div>


        	<div>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'master_setup_id',
            'module_id',
                            [
                                'attribute' => 'master_setup_name',
                                'format' => 'raw',
                                'value' => function ($model, $key, $index) {
                                    return Html::a($model->master_setup_name, ['update', 'id' => $model->master_setup_id]);
                                },
                            ],			
            'tbl_name',
            'created_by',
            // 'status_id',
            // 'master_setup_value:ntext',

           [
				'class' => 'yii\grid\ActionColumn',
				'header'=>'Action', 
				'headerOptions' => ['width' => '800'],
				'template' => '{add} {delete}',
				'buttons' => [
					'delete' => function ($url,$model,$key) {
							
								return Html::a('delete', $url);
							
					},
					'add' => function ($url,$model,$key) {
							$url = Yii::$app->urlManager->createUrl('/core/mastersetupentry/datalist') . '?master_setup_id=' . $key;
							return   Html::a('Add Entry', $url);
							
					},
				],				
				
			],	
        ],
    ]); ?>                
                
        	</div>
        </div>
    	<!-- end: DYNAMIC TABLE PANEL -->


