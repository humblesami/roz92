<?php

namespace yeesoft\post\controllers;
use yii;
use yeesoft\controllers\admin\BaseController;
Yii::$app->view->params['left_menu'] = true;

/**
 * TagController implements the CRUD actions for yeesoft\post\models\Tag model.
 */
class TagController extends BaseController
{

    public $disabledActions = ['view', 'bulk-activate', 'bulk-deactivate'];
    public $layout = '@backend/views/layouts/main.php';
    public function init()
    {
        $this->modelClass = $this->module->tagModelClass;
        $this->modelSearchClass = $this->module->tagModelSearchClass;

        $this->indexView = $this->module->tagIndexView;
        $this->viewView = $this->module->tagViewView;
        $this->createView = $this->module->tagCreateView;
        $this->updateView = $this->module->tagUpdateView;

        parent::init();
    }

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }

}
