<?php

namespace backend\controllers;

use Yii;
use common\models\Customer;
use common\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use kartik\growl\Growl;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `customer`";
        Yii::$app->getSession()->setFlash('customer_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Index',
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
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = "SELECT * FROM `customer` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('customer_info', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Info',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            $query = "INSERT INTO customer VALUES($model->first_name, $model->last_name, $model->initial,
            $model->age, $model->email, $model->phone_number_1, $model->phone_number_2)";
            Yii::$app->getSession()->setFlash('customer_info_create', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Customer Account Create',
                         'message' => $query,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);

            return $this->redirect(['customer/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_hash);

            if ($model->save()) {
                $query = "INSERT INTO customer VALUES($model->first_name, $model->last_name, $model->initial,
                $model->age, $model->email, $model->phone_number_1, $model->phone_number_2)";
                Yii::$app->getSession()->setFlash('customer_info_update', [
                             'type' => 'success',
                             'duration' => 5000,
                             'icon' => 'glyphicon glyphicon-ok-sign',
                             'title' => 'Customer Account Details Update',
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
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
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

        $query = "INSERT INTO customer (status) VALUES(0)";
        Yii::$app->getSession()->setFlash('customer_deactivate', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Deactivate',
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

        $query = "INSERT INTO customer (status) VALUES(10)";
        Yii::$app->getSession()->setFlash('customer_activate', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Activate',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
