<?php

namespace app\controllers;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\adapter\ImportAdapter;
use Yii;
use app\models\Adressen;
use app\models\AdressenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\adapter\GeocodeAdapter;

/**
 * AdressenController implements the CRUD actions for Adressen model.
 */
class AdressenController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Adressen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdressenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {

                $target_file = __DIR__ .'/../uploads/' . $model->file->baseName . '.' . $model->file->extension;
                $model->file->saveAs($target_file);


                $o_importAdapter = new ImportAdapter();
                $arr_o_address = $o_importAdapter->get_addresses($target_file);
                foreach ($arr_o_address as $o_address ){

                    $o_address->save(false);
                }

                return $this->redirect(['adressen/index']);

            }
        }







        return $this->render('import', ['model' => $model]);
    }

    /**
     * Displays a single Adressen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionShowMap()
    {   $model = Adressen::find()->all();
        return $this->render('map', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new Adressen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Adressen();
        $o_geocode = new GeocodeAdapter();

        if ($model->load(Yii::$app->request->post()) && ($model = $o_geocode->get_geocode($model)) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Adressen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Adressen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adressen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adressen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adressen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
