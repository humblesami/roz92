<?php
/* @var $this yii\web\View */

use yeesoft\comments\widgets\Comments;
use yeesoft\page\models\Page;
use yii\helpers\Html;

$this->title = $page->title;
$this->params['breadcrumbs'][] = $page->title;
?>

    <div class="page">
    	<?php if($page->title != 'Front Page'){?>
        <h1><?= Html::encode($page->title) ?></h1>
        <?php  }?>
        <div><?= $page->content ?></div>
    </div>
<?php if ($page->comment_status == Page::COMMENT_STATUS_OPEN): ?>
    <?php // echo Comments::widget(['model' => Page::className(), 'model_id' => $page->id]); ?>
<?php endif; ?>