<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\user */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="panel panel-default">
    
    <div class="panel-body">
    <div class="top-content">
        <div class="row">
        	<div class="col-sm-10" >
	           <h3><?= Html::encode($this->title) ?></h3>
            </div>

        </div>
        <div class="border-btm"></div>
        </div>
        <div class="row">
            <div class="col-md-6">
        <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

            </div>
        </div>
    </div>
</div>
