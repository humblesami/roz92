<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<!-- start: PAGE CONTENT -->



<!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-default">
            
  
            <div class="top-content">
        <div class="row">
        	<div class="col-sm-10" >
	           <h3><?= Html::encode($this->title) ?></h3>
            </div>

        </div>
        <div class="border-btm"></div>
        </div>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
					<?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
							'username',
                            [
                                'attribute' => 'full_name',
                                'format' => 'raw',
                                'value' => function ($model, $key, $index) {
                                    return Html::a($model->full_name, ['update', 'id' => $model->id]);
                                },
                            ],
							'email',
							'role.name',
							'login_type',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>                 
                
      
        </div>
<!-- end: DYNAMIC TABLE PANEL -->
 

<!-- end: PAGE CONTENT-->

