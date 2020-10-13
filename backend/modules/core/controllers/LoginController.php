<?php
namespace backend\modules\core\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

class LoginController extends Controller
{



	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		

		  return $this->renderPartial('index');
	}
	
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
			return $this->redirect(['core/dashboard/batch']);
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }	
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
