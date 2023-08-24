<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
//    public $enableCsrfValidation = false;
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
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
//        ];
//    }

public function actionTest(){
    return 'aaaa';
}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        phpinfo();exit;
        $session = Yii::$app->session;
        $session->open();
//        $_SESSION = ['asd','ddddd'];
//
//// 如下代码会生效：
//        $session['captcha'] = [
//            'number' => 5,
//            'lifetime' => 3600,
//        ];
//
//// 如下代码也会生效：
//        echo $session['captcha']['lifetime'];
        print_r($_SESSION);
        exit;

// 如下代码会生效：
        $session['captcha'] = [
            'number' => 5,
            'lifetime' => 3600,
        ];

// 如下代码也会生效：
        echo $session['captcha']['lifetime'];
        exit;
        return;

// 开启session


// 关闭session
$session->close();

// 销毁session中所有已注册的数据
$session->destroy();
        $status = '1 or number <> 1';
        $sql = (new \yii\db\Query())
            ->select('*')
            ->from('hero')
            ->where('number=:status', [':status' => $status]);
        $re = $sql->all();
        print_r($re);exit;
        print_r($sql);exit;
        $username = "sddd<h1>eee</h1><script >alert('Hello!');</ script>";
        $a = \yii\helpers\Html::encode($username);
        $b = \yii\helpers\HtmlPurifier::process($username);
//        print_r($a);
        print_r($b);
//        var_dump($b);
        exit;
//        return 123;
//        return 1;
//        echo Yii::$app->request->csrfParam;
//        echo Yii::$app->request->csrfToken;
//        exit;
//        $request = Yii::$app->request;
//        return 1;
//        print_r($request);exit;
//        $request->referrer;
//        Yii::$app->getResponse()->content = 'kkk';
//        Yii::$app->getResponse()->send();
//        echo 'ssssssssss';
//        return;
//        header("Location: http://www.baidu.com/");
//        return;
//        \Yii::$app->getResponse()->setStatusCode(200);
//        echo 'kkkk';
//        \Yii::$app->getResponse()->content = 'jjjss';
////        \Yii::$app->getResponse()->send();
//        return;
//        header("HTTP/1.1 301 Not sssFound");
//        return;
//        return '<html><form action="http://192.168.200.132/" method="post" enctype="multipart/form-data">
//  <input type="text" name="myTextField">
//  <input type="checkbox" name="myCheckBox">Check</input>
//  <input type="file" name="myFile">
//  <button>Send the file</button>
//</form><html/>';
//        echo 'ddd';exit;
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
        echo 'sss';exit;
        return $this->render('about');
    }
}
