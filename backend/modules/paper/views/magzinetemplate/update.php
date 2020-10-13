<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblPapPageTemplate */

$this->title = 'Update Tbl Pap Page Template: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Pap Page Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default">
           
            <div class="panel-body" >
				<div class="row">
					<div class="col-sm-4 ">


							<div class="tbl-pap-page-template-create">

							   

							    <?= $this->render('_form', [
							        'model' => $model,
							    ]) ?>

							</div>



					</div>
				</div>

            </div>
</div>
