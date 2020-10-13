<?php
namespace backend\modules\core\controllers;
use Yii;
use backend\modules\core\models\TblCoreModuleFeatures;
use backend\modules\core\models\TblCoreModules;
use backend\modules\core\models\TblCoreRoles;
use backend\modules\core\models\TblCoreMenus;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
Yii::$app->view->params['left_menu'] = true;
use backend\components\BaseController;

/**
 * DashboardController implements the CRUD actions for TblCoreDashboards model.
 */
class SettingsController extends BaseController
{
    

    /**
     * Lists all TblCoreDashboards models.
     * @return mixed
     */
   
    public function actionIndex()
    {
        return $this->render('index');
    }


}
