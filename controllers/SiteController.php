<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\user;
use app\models\project;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }  

    /**
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
        $user = Yii::$app->user->identity;
        if($user == null){
            
            $model = new LoginForm();
            return $this->render('login', ['model' => $model]);
        }
        if ($user->role === 1) {
            // Admin
            $dataProvider = new ActiveDataProvider([
                'query' => User::find(),
            ]);

            return $this->render('admin-home', ['dataProvider' => $dataProvider]);
        } elseif ($user->role === 2) {
            // Manager
            $dataProvider = new ActiveDataProvider([
                'query' => Project::find(),
            ]);

            return $this->render('manager-home', ['dataProvider' => $dataProvider]);
        } else {
            // Default (User)
            return $this->render('user-home', ['user' => $user]);
        }
    }
    

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
    //    dd('hello');
    
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $this->layout = 'main2';
        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        // dd("hello");
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Signup successful. You can now log in.');
            return $this->redirect(['login']);
        }

        return $this->render('signup', ['model' => $model]);
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    // private function redirectAfterLogin()
    // {
    //     if (Yii::$app->user->identity->role === 1) {
    //         return $this->redirect(['user/index']); // Admin
    //     } elseif (Yii::$app->user->identity->role === 2) {
    //         return $this->redirect(['project/index']); // Manager
    //     } else {
    //         return $this->redirect(['site/index']); // Default (User)
    //     }
    // }
}
