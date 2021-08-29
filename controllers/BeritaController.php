<?php

namespace app\controllers;

use app\models\Berita;
use app\models\BeritaSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use yii\filters\AccessControl;

/**
 * BeritaController implements the CRUD actions for Berita model.
 */
class BeritaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => 'true',
                            'roles' => ['@']
                        ],
                    ],
                ],
            ],
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Berita models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BeritaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Berita model.
     * @param int $id_berita Id Berita
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_berita)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_berita),
        ]);
    }

    /**
     * Creates a new Berita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Berita(['scenario' => 'create']);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->user->identity->username;
            $model->date = date('Y-m-d H:i:s');
            
            $picture =  UploadedFile::getInstance($model, 'gambar');
            // store the source file name
            $model->gambar = $picture->extension;
            
            if ($model->save()) {
                $picture->saveAs('img_berita/' .$model->id_berita. '.' .$picture->extension);
                Yii::$app->getSession()->setFlash('success', 'Data Saved!');
                return $this->redirect(['view', 'id_berita' => $model->id_berita]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Data Not Saved!');
                $model->loadDefaultValues();
            }            
        }
        return $this->render('create', ['model'=>$model,]);
    }


    /**
     * Updates an existing Berita model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_berita Id Berita
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_berita)
    {
        $model = $this->findModel($id_berita);

        if (isset($_POST['Berita'])) {
            $picture =  UploadedFile::getInstance($model, 'gambar');
            // store the source file name
            $model->gambar = $picture->extension;

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                if (!empty($picture)) {
                    $picture->saveAs('img_berita/' .$model->id_berita. '.' .$picture->extension);                
                }
                return $this->redirect(['view', 'id_berita' => $model->id_berita]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Berita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_berita Id Berita
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_berita)
    {
        $model = $this->findModel($id_berita);

        if(Yii::$app->request->get('id_berita')){
            unlink(getcwd().'/img_berita/'. $model->id_berita.'.'.$model->gambar);
            $this->findModel($id_berita)->delete();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Finds the Berita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_berita Id Berita
     * @return Berita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_berita)
    {
        if (($model = Berita::findOne($id_berita)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
