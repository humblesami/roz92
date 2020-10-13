<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Core Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-core-company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Core Company', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_id',
            'company_name',
            'country_id',
            'state',
            'city',
            // 'address',
            // 'postal_code',
            // 'email_address:email',
            // 'phone_number',
            // 'fax_number',
            // 'website',
            // 'tax_number',
            // 'logo_file',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
