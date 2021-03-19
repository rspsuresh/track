<?php

namespace app\controllers;

use app\models\TUser;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        Yii::$app->controller->enableCsrfValidation = false;
        $this->layout=false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if(Yii::$app->request->isAjax && !empty($_POST)){
             $UserReturn=TUser::loginCheck($_POST);
             return json_encode($UserReturn);
        }else{
            return $this->render('login');
        }
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        session_destroy();
        unset($_SESSION);
        return $this->redirect(['/site/home']);
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

    public function actionCheckunique(){
        $type=$_REQUEST['type'];
        $error=['username is already taken'];
        switch ($type){
            case "U":
               $userModel=User::find()->where('username=:usrname',[':usrname'=>$_REQUEST['username']])->one();
               echo !empty($userModel)?true:false;
               break;
            case "M":
                $userModel=User::find()->where('mobile=:mobile',[':mobile'=>$_REQUEST['mobile']])->one();
                return !empty($userModel)?true:false;
                break;
            case "E":
                $userModel=User::find()->where('email=:email',[':email'=>$_REQUEST['email']])->one();
                echo  !empty($userModel)?true:false;
                break;
        }
    }
}
