<?php

namespace frontend\controllers;

use yeesoft\post\models\Post;
use Yii;
use yeesoft\post\models\Category;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class CategoryController extends \yeesoft\controllers\BaseController
{
    public $freeAccess = true;


public function behaviors()
{
    return [
        [
            'class' => 'yii\filters\PageCache',
            'only' => ['index'],
            'duration' => 3600,
            'variations' => [
                //\Yii::$app->language,
                 Yii::$app->request->get('slug'),
                 Yii::$app->request->get('page'),
            ],

            'dependency' => [
                'class' => 'yii\caching\DbDependency',
                'sql' => 'SELECT COUNT(*) FROM post',
            ],            
          
        ],
    ];
}

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($slug = 'index')
    {
        if (empty($slug) || $slug == 'index') {
            throw new NotFoundHttpException('Page not found.');
        } else {
            $category = Category::find()->where(['slug' => $slug]);
            $categoryCount = clone $category;
            if (!$categoryCount->count()) {
                throw new NotFoundHttpException('Page not found.');
            }
        }

        $query = Post::find()->joinWith('cats')->where([
            'status' => Post::STATUS_PUBLISHED,
            Category::tableName() . '.slug' => $slug,
        ])->orderBy('published_at DESC');
        $countQuery = clone $query;

        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => Yii::$app->settings->get('reading.page_size', 10),
        ]);

        $posts = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
                'posts' => $posts,
                'category' => $category->one(),
                'pagination' => $pagination,
        ]);
    }
}