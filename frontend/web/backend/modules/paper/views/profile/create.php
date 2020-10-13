<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\paper\models\TblProfile */

$this->title = 'Create Tbl Profile';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
