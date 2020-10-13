<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */

$this->title = 'Create Master Setup';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Master Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
<div class="top-content">
        <div class="row">
        	<div class="col-sm-10">
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

