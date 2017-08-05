<?php

namespace backend\controllers;

use Yii;
use backend\models\Narrator;
use backend\models\NarratorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NarratorController implements the CRUD actions for Narrator model.
 */
class NarratorController extends Controller
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
     * Lists all Narrator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NarratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `narrator`";
        Yii::$app->getSession()->setFlash('narrator_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Narrator Index',
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
     * Displays a single Narrator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = "SELECT * FROM `narrator` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('narrator_view', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Narrator Info',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Narrator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Narrator();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO narrator VALUES($model->name)";
            Yii::$app->getSession()->setFlash('narrator_info_create', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Narrator Create',
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
     * Updates an existing Narrator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO narrator VALUES($model->name)";
            Yii::$app->getSession()->setFlash('narrator_info_update', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Narrator Update',
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
     * Deletes an existing Narrator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->getSession()->setFlash('narrator_deactivate', [
                   'type' => 'warning',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Narrator Deactivate',
                   'message' => 'This function is currently not available.',
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Narrator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Narrator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Narrator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
