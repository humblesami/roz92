<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\core\models\TblCoreModules */

$this->title = 'Create Tbl Core Modules';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Core Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subheader HtZero border-box clearfix">
      <h3><i class="icon-settings-big icon-settings-pos"></i>Module</h3>
</div>


<div class="userForm clearfix">
         <div class="row">
          <div class="col-lg-6">
          
          <div class="tbl-core-modules-create">

    

			<?= $this->render('_form', [
                'model' => $model,
            ]) ?>

</div>
            
         </div>
         </div>
         
         
        </div>

