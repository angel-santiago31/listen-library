<?php

namespace backend\controllers;

use Yii;
use common\models\Admin;
use common\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `admin`";
        Yii::$app->getSession()->setFlash('admin_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Admin Index',
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
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = "SELECT * FROM `admin` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('admin_view', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Admin Info',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            $model->generatePasswordResetToken();

            if ($model->save()) {
                $query = "INSERT INTO admin VALUES($model->email, $model->password_hash)";
                Yii::$app->getSession()->setFlash('admin_info_create', [
                             'type' => 'success',
                             'duration' => 5000,
                             'icon' => 'glyphicon glyphicon-ok-sign',
                             'title' => 'Admin Account Create',
                             'message' => $query,
                             'positonY' => 'top',
                             'positonX' => 'right'
                            ]);

                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $query = "INSERT INTO admin VALUES($model->email, $model->password_hash)";
          Yii::$app->getSession()->setFlash('admin_info_update', [
                       'type' => 'success',
                       'duration' => 5000,
                       'icon' => 'glyphicon glyphicon-ok-sign',
                       'title' => 'Admin Account Update',
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
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionDelete($id)
     {
         // $this->findModel($id)->delete();
         $model = $this->findModel($id);
         $model->status = 0;
         $model->save(false);

         $query = "INSERT INTO admin (status) VALUES(0)";
         Yii::$app->getSession()->setFlash('admin_deactivate', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Admin Deactivate',
                    'message' => $query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                   ]);

         return $this->redirect(['index']);
     }

     public function actionRestore($id)
     {
         $model = $this->findModel($id);
         $model->status = 10;
         $model->save(false);

         $query = "INSERT INTO admin (status) VALUES(10)";
         Yii::$app->getSession()->setFlash('admin_activate', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Admin Activate',
                    'message' => $query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                   ]);

         return $this->render('view', [
             'model' => $model,
         ]);
     }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
