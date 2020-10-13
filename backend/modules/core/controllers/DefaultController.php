<?php

namespace backend\modules\core\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        echo 'Test';
		return $this->render('index');
    }
	

}
