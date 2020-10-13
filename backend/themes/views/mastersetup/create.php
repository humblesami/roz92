<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreMasterSetup */

$this->title = 'Create Tbl Core Master Setup';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Master Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-master-setup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
