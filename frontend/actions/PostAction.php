<?php

namespace frontend\actions;

/**
 * Description of PostAction
 */
class PostAction extends \yii\web\ViewAction
{
    public $slug;
    public $post;
    public $view = 'post';
    public $layout = 'main';
    public $p = 0;

    public function run()
    {
        $this->controller->action = $this;
        $this->controller->layout = "//{$this->layout}";
        return $this->controller->render($this->view, ['post' => $this->post,'p' => $this->p]);
    }
}