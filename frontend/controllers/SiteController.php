<?php

namespace frontend\controllers;

use frontend\actions\PageAction;
use frontend\actions\PostAction;
use frontend\models\ContactForm;
use yeesoft\page\models\Page;
use yeesoft\post\models\Post;
use Yii;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends \yeesoft\controllers\BaseController
{
    public $freeAccess = true;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

public function behaviors()
{
    return [
        [
            'class' => 'yii\filters\PageCache',
            'only' => ['index','home'],
            'duration' => 0,
            'variations' => [
                \Yii::$app->language,
                Yii::$app->request->get('slug'),
                Yii::$app->request->get('page'),
            ],
           /* 'dependency' => [
                'class' => 'yii\caching\DbDependency',
                'sql' => 'SELECT COUNT(*) FROM post',
            ], */           
          
        ],
    ];
}



    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionHome($slug = 'index',$p=0)
    {
         return $this->render('index'); 
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($slug = 'index',$p=0)
    {
        // display home page
        if (empty($slug) || $slug == 'index') {

            $query = Post::find()->where(['status' => Post::STATUS_PUBLISHED]);
            $countQuery = clone $query;

            $pagination = new Pagination([
                'totalCount' => $countQuery->count(),
                'defaultPageSize' => Yii::$app->settings->get('reading.page_size', 10),
            ]);

            $posts = $query->orderBy('published_at DESC')->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('index', [
                'posts' => $posts,
                'pagination' => $pagination,
            ]);
        }

        //try to display action from controller
        try {
            return $this->runAction($slug);
        } catch (\yii\base\InvalidRouteException $ex) {

        }

        //try to display static page from datebase
       /* $page = Page::getDb()->cache(function ($db) use ($slug) {
            return Page::findOne(['slug' => $slug, 'status' => Page::STATUS_PUBLISHED]);
        }, 3600);*/

        $page = Page::findOne(['slug' => $slug, 'status' => Page::STATUS_PUBLISHED]);

        if ($page) {
            $pageAction = new PageAction($slug, $this, [
                'slug'   => $slug,
                'page'   => $page,
                'view'   => $page->view,
                'layout' => $page->layout,
            ]);

            return $pageAction->run();
        }

        //try to display post from datebase
        $post = Post::getDb()->cache(function ($db) use ($slug) {
            return Post::findOne(['slug' => $slug, 'status' => Post::STATUS_PUBLISHED]);
        }, 3600);

        if ($post) {
            $postAction = new PostAction($slug, $this, [
                'slug'   => $slug,
                'post'   => $post,
                'p' => $p,
                'view'   => $post->view,
                'layout' => $post->layout,
            ]);

            return $postAction->run();
        }

        //if nothing suitable was found then throw 404 error
        throw new \yii\web\NotFoundHttpException('Page not found.');
    }

   public function actionFlush(){
      Yii::$app->cache->flush();
      die();
   }
 
}