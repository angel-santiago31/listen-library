<?php

namespace frontend\controllers;

use Yii;
use common\models\Customer;
use common\models\CustomerSearch;
use backend\models\CreditCard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Order;
use backend\models\OrderSearch;
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
        Yii::$app->getSession()->setFlash('customer_main_info_query', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Account Details 1',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        $query = "SELECT * FROM `credit_card` WHERE `customer_id`= $id";
        Yii::$app->getSession()->setFlash('customer_sub_info_query', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Account Details 2',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'card' => $this->findCreditCard($id)
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $card = $this->findCreditCard($id);

        if (($model->load(Yii::$app->request->post()) && $model->save()) && ($card->load(Yii::$app->request->post()) && $card->save())) {
            $query = "INSERT INTO customer VALUES($model->first_name, $model->last_name, $model->initial,
            $model->age, $model->email, $model->phone_number_1, $model->phone_number_2)";
            Yii::$app->getSession()->setFlash('customer_info_update_1', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Customer Account Details Update 1',
                         'message' => $query,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);

            $query = "INSERT INTO credit_card VALUES($card->card_last_digits, $card->expiration_date, $card->card_type)";
            Yii::$app->getSession()->setFlash('customer_info_update_2', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Customer Account Details Update 2',
                         'message' => $query,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'card' => $card
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPurchases($id)
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchCustom(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `orders` WHERE `customer_id`= $id";
        Yii::$app->getSession()->setFlash('customer_purchases', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Customer Purchases',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->render('purchases', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    protected function findCreditCard($id)
    {
        if (($model = CreditCard::find()->where(['customer_id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
