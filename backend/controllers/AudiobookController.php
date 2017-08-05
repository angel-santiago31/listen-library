<?php

namespace backend\controllers;

use Yii;
use backend\models\Audiobook;
use backend\models\AudiobookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AudiobookController implements the CRUD actions for Audiobook model.
 */
class AudiobookController extends Controller
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
     * Lists all Audiobook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AudiobookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `audiobook`";
        Yii::$app->getSession()->setFlash('audiobook_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Audiobook Index',
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
     * Displays a single Audiobook model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = "SELECT * FROM `audiobook` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('audiobook_view', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Audiobook Info',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Audiobook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Audiobook();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO audiobook VALUES($model->title, $model->genre, $model->is_fiction, $model->author_id, $model->narrator_id, $model->length, $model->release_date, $model->publisher_id, $model->price, $model->cost, $model->picture, $model->picture2, $model->summary, $model->active)";
            Yii::$app->getSession()->setFlash('audiobook_info_create', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Audiobook Create',
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
     * Updates an existing Audiobook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $query = "INSERT INTO audiobook VALUES($model->title, $model->genre, $model->is_fiction, $model->author_id, $model->narrator_id, $model->length, $model->release_date, $model->publisher_id, $model->price, $model->cost, $model->picture, $model->picture2, $model->summary, $model->active)";
            Yii::$app->getSession()->setFlash('audiobook_info_update', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Audiobook Update',
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
     * Deletes an existing Audiobook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionDelete($id)
     {
         // $this->findModel($id)->delete();
         $model = $this->findModel($id);
         $model->active = 0;
         $model->save(false);

         $query = "INSERT INTO audiobook (status) VALUES(0)";
         Yii::$app->getSession()->setFlash('audiobook_deactivate', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Audiobook Deactivate',
                    'message' => $query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                   ]);

         return $this->redirect(['index']);
     }

     public function actionRestore($id)
     {
         $model = $this->findModel($id);
         $model->active = 10;
         $model->save(false);

         $query = "INSERT INTO audiobook (status) VALUES(10)";
         Yii::$app->getSession()->setFlash('audiobook_activate', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Audiobook Activate',
                    'message' => $query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                   ]);

         return $this->render('view', [
             'model' => $model,
         ]);
     }

    /**
     * Finds the Audiobook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Audiobook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Audiobook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
