<?php

namespace frontend\controllers;

use Yii;
use common\models\Readings;
use common\models\ReadingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReadingsController implements the CRUD actions for Readings model.
 */
class ReadingsController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Readings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReadingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Readings model.
     * @param string $type
     * @param string $make
     * @return mixed
     */
    public function actionView($type, $make)
    {
        return $this->render('view', [
            'model' => $this->findModel($type, $make),
        ]);
    }

    /**
     * Creates a new Readings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Readings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type' => $model->type, 'make' => $model->make]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Readings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $type
     * @param string $make
     * @return mixed
     */
    public function actionUpdate($type, $make)
    {
        $model = $this->findModel($type, $make);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type' => $model->type, 'make' => $model->make]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Readings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $type
     * @param string $make
     * @return mixed
     */
    public function actionDelete($type, $make)
    {
        $this->findModel($type, $make)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Readings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $type
     * @param string $make
     * @return Readings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($type, $make)
    {
        if (($model = Readings::findOne(['type' => $type, 'make' => $make])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
