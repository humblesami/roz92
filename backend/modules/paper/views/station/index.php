<?php
use yeesoft\grid\GridPageSize;
use yii\helpers\Html;
use yeesoft\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\modules\paper\models\TblPapStation;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-pap-station-index">
    <div class="panel panel-default">


        <div class="panel-heading">
            
             <div class="row">
                <div class="col-sm-12 page-heading">
                    <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
                    <div class="pull-right">
                    <?= Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
                    
                </div>
                </div>
            </div>


        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'page-grid-pjax']) ?>
                </div>
            </div>

            <?php Pjax::begin(['id' => 'station-grid-pjax']) ?>

             <?= GridView::widget([
                'id' => 'post-tag-grid',
                'dataProvider' => $dataProvider,
               // 'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'post-tag-grid',
                    'actions' => [Url::to(['bulk-delete']) => Yii::t('yee', 'Delete')]
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => '/paper/station',
                        'title' => function (TblPapStation $model) {
                            return Html::a($model->name, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                    'urdu_name',
                ],
            ]); ?>

            <?php Pjax::end() ?>
        </div>
    </div>


    
</div>
