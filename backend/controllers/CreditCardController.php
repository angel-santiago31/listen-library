<?php

namespace backend\controllers;

use Yii;
use backend\models\CreditCard;
use backend\models\CreditCardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CreditCardController implements the CRUD actions for CreditCard model.
 */
class CreditCardController extends Controller
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
     * Lists all CreditCard models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CreditCardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CreditCard model.
     * @param integer $id
     * @param integer $card_last_digits
     * @return mixed
     */
    public function actionView($id, $card_last_digits)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $card_last_digits),
        ]);
    }

    /**
     * Creates a new CreditCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreditCard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'card_last_digits' => $model->card_last_digits]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CreditCard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $card_last_digits
     * @return mixed
     */
    public function actionUpdate($id, $card_last_digits)
    {
        $model = $this->findModel($id, $card_last_digits);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'card_last_digits' => $model->card_last_digits]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CreditCard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $card_last_digits
     * @return mixed
     */
    public function actionDelete($id, $card_last_digits)
    {
        return $this->redirect(['index']);
    }

    /**
     * Finds the CreditCard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $card_last_digits
     * @return CreditCard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $card_last_digits)
    {
        if (($model = CreditCard::findOne(['id' => $id, 'card_last_digits' => $card_last_digits])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
