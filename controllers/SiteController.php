<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\web\Response;
use app\models\Berita;
use yii\web\Controller;
use app\models\Kategori;
use app\models\LoginForm;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        $query = Berita::find()->where(['and', "headline='Y'"])->orderBy(['id_berita' => SORT_DESC])->limit(2)->all();
        $query2 = Berita::find()->where(['and', "headline='N'"])->orderBy(['id_berita' => SORT_DESC])->limit(4)->all();

        $kategori = Kategori::find()->where(['and', "active='Y'"])->all();

        $penulis = Users::find()->all();

        return $this->render('index', [
            'berita' => $query,
            'berita2' => $query2,
            'kategori' => $kategori,
            'users' => $penulis,
        ]);
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
        return $this->render('about');
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            
            if ($model->upload()) {
                print_r($model->imageFile->extension);
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionView()
    {
        $tampilin = Berita::find()->where(['id_berita'=>$_GET['id_berita']])->all();
        $kategori = Kategori::find()->where(['and', "active='Y'"])->all();
        $penulis = Users::find()->all();

        return $this->render('view', [
            'berita2' => $tampilin,
            'kategori' => $kategori,
            'users' => $penulis,
        ]);


    }

    public function actionViewkategori()
    {
        $tampil = Berita::find()->where(['id_category'=>$_GET['id_category']])->all();
        $kategori = Kategori::find()->where(['and', "active='Y'"])->all();
        $penulis = Users::find()->all();

        return $this->render('viewkategori', [
            'kategori' => $kategori,
            'berita' => $tampil,
            'users' => $penulis,
        ]);

    }
}
