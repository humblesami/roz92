<?php
namespace efrontend\controllers;

use Yii;
use common\models\LoginForm;
use efrontend\models\PasswordResetRequestForm;
use efrontend\models\ResetPasswordForm;
use efrontend\models\SignupForm;
use efrontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yeesoft\post\models\Post;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $station_id;
    public $xdate;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            
            
            /*[
                'class' => 'yii\filters\PageCache',
                'only' => ['index','index2'],
                'duration' => 0,
                'variations' => [
                    \Yii::$app->language,
                    Yii::$app->request->get('station_id'),
                    Yii::$app->request->get('page_id'),
                    Yii::$app->request->get('is_common'),
                    Yii::$app->request->get('n'),
                    Yii::$app->request->get('xdate'),
                    
                ],
                             
              
            ],        */        
        ];
    }

    public $is_mobile = false;
 
    public function init()
    {
        parent::init();
        // access from mobile browser?

        $this->is_mobile = $this->checkMobileAccess();
       
        
    }


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


     private function checkMobileAccess()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $is_mobile = (
            (strpos($ua, 'iPhone') !== false) // iPhone
            || ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false)) // Android Mobile
            || (strpos($ua, 'Windows Phone') !== false) // Windows Phone
            || (strpos($ua, 'BlackBerry') !== false) // BlackBerry
        );
        return $is_mobile;
    }   

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($station_id=2,$page_id=0,$is_common='N',$n=1000,$xdate="")
    {
        $this->station_id = $station_id;

        $this->xdate = $xdate;

       if (!$this->is_mobile) {
     
            return $this->render('index2',['page_id' => $page_id,'station_id' => $station_id,'is_common' => $is_common,'n' => $n,'xdate' => $xdate]);
        }else{
            return $this->render('index3',['page_id' => $page_id,'station_id' => $station_id,'is_common' => $is_common,'n' => $n,'xdate' => $xdate]);
        }
    }

        

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex2($station_id=2,$page_id=0,$is_common='N',$n=1000,$xdate="")
    {
        $this->station_id = $station_id;

        $this->xdate = $xdate;


       if (!$this->is_mobile) {
     
            return $this->render('index2',['page_id' => $page_id,'station_id' => $station_id,'is_common' => $is_common,'n' => $n,'xdate' => $xdate]);
        }else{
            return $this->render('index3',['page_id' => $page_id,'station_id' => $station_id,'is_common' => $is_common,'n' => $n,'xdate' => $xdate]);
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionMagzine($type,$issue_date="")
    {
       


    
        return $this->renderPartial('magzine',['type' => $type,'issue_date' => $issue_date]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * search
     *
     * @return mixed
     */
    public function actionSearch($q="")
    {
        $query = Post::find()->joinWith('translations')->where(['like', 'title', $q])->orderBy('id DESC')->limit(24)->all();

        return $this->render('search', [
                'result' => $query,
                'q' => $q,
        ]);
    }


    /**
     * search
     *
     * @return mixed
     */
    public function actionSearchmore($q,$last_id)
    {
        $query = Post::find()->joinWith('translations')->where(['<','post_id',$last_id])->andWhere(['like', 'title', $q])->orderBy('id DESC')->limit(24)->all();

        return $this->renderAjax('searchresult', [
                'result' => $query,
                'q' => $q,
        ]);
    }
}
