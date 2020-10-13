<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class Footer extends Widget{
    public function init(){
            // add your logic here
    }
    public function run(){
            return $this->render('footer');
    }
}
?>