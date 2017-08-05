<?php

namespace backend\controllers;

use Yii;
use backend\models\Publisher;
use backend\models\PublisherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PublisherController implements the CRUD actions for Publisher model.
 */
class PublisherController extends Controller
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
     * Lists all Publisher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublisherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `publisher`";
        Yii::$app->getSession()->setFlash('publisher_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Publisher Index',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publisher model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = "SELECT * FROM `publisher` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('publisher_view', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Publisher Info',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Publisher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publisher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO publisher VALUES($model->name)";
            Yii::$app->getSession()->setFlash('publisher_info_create', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Publisher Create',
                         'message' => $query,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Publisher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO publisher VALUES($model->name)";
            Yii::$app->getSession()->setFlash('publisher_info_update', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Publisher Update',
                         'message' => $query,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Publisher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->getSession()->setFlash('publisher_deactivate', [
                   'type' => 'warning',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Publisher Deactivate',
                   'message' => 'This function is currently not available.',
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Publisher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publisher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publisher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
