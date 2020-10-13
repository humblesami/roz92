<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
           

            
            'name',
            'pen_name',
            'categoryx.title',
            

[
    'attribute' => 'image',
    'format' => 'html',
    'value' => function($data) { return Html::img('/backend/web/' .$data->image, ['width'=>'50']); },
],

            
           
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
