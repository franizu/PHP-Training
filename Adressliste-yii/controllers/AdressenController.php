<?php

namespace app\controllers;

use maxh\Nominatim\Nominatim;
use Yii;
use app\models\Adressen;
use app\models\AdressenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        if ($model->load(Yii::$app->request->post()) && ($model = $this->get_geocode($model)) && $model->save()) {
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

    private function get_geocode($model){

        $url = "http://nominatim.openstreetmap.org/";
        $o_nominatim = new Nominatim($url);
        $search = $o_nominatim->newSearch()
            //->country('Germany')
            ->city($model->ort)
            ->postalCode($model->plz)
            ->polygon('geojson')    //or 'kml', 'svg' and 'text'
            ->street($model->strasse)
            ->addressDetails();

        $a_search_result = $o_nominatim->find($search);
        $a_geocode = $a_search_result[0];
        $model->longitude = $a_geocode['lon'];
        $model->latitude = $a_geocode['lat'];

        return $model;
    }
}
