<?php

namespace backend\controllers;

use Yii;
use backend\models\Report;
use backend\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = "SELECT * FROM `report`";
        Yii::$app->getSession()->setFlash('report_index', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Report Index',
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
     * Displays a single Report model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $report = $this->findModel($id);
        $connection = Yii::$app->getDb();
        $command3 = $result3 = null;
        $query_3 = null;

        if ($report->type == Report::SALES) {
            $query_1 = "SELECT order_id, genre, price, cost, audiobook_id, purchase_date
                                                   FROM audiobook INNER JOIN item_in_order INNER JOIN orders
                                                   ON audiobook.id = item_in_order.audiobook_id  AND orders.id = item_in_order.order_id AND genre = $report->refers_to AND audiobook_id = $report->item_selected
                                                   WHERE purchase_date >= $report->from_date AND purchase_date <= $report->to_date";
            $command = $connection->createCommand($query_1);

            $query_2 = "SELECT SUM(price) as total_sale
                                                   FROM audiobook INNER JOIN item_in_order INNER JOIN orders
                                                   ON audiobook.id = item_in_order.audiobook_id  AND orders.id = item_in_order.order_id AND genre = $report->refers_to AND audiobook_id = $report->item_selected
                                                   WHERE purchase_date >= $report->from_date AND purchase_date <= $report->to_date";
            $command2 = $connection->createCommand($query_2);
        } else {
            $query_1 = "SELECT order_id, genre, price, cost, audiobook_id, purchase_date
                                                   FROM audiobook INNER JOIN item_in_order INNER JOIN orders
                                                   ON audiobook.id = item_in_order.audiobook_id  AND orders.id = item_in_order.order_id AND audiobook.genre = $report->refers_to AND audiobook_id = $report->item_selected
                                                   WHERE purchase_date >= $report->from_date AND purchase_date <= $report->to_date";
            $command = $connection->createCommand($query_1);

            $query_2 = "SELECT SUM(price) as total_sale
                                                   FROM audiobook INNER JOIN item_in_order INNER JOIN orders
                                                   ON audiobook.id = item_in_order.audiobook_id  AND orders.id = item_in_order.order_id AND audiobook.genre = $report->refers_to AND audiobook_id = $report->item_selected
                                                   WHERE purchase_date >= $report->from_date AND purchase_date <= $report->to_date";
            $command2 = $connection->createCommand($query_2);

            $query_3 = "SELECT SUM(cost) as total_cost
                                                    FROM audiobook INNER JOIN item_in_order INNER JOIN orders
                                                    ON audiobook.id = item_in_order.audiobook_id  AND orders.id = item_in_order.order_id AND audiobook.genre = $report->refers_to AND audiobook_id = $report->item_selected
                                                    WHERE purchase_date >= $report->from_date AND purchase_date <= $report->to_date";
            $command3 = $connection->createCommand($query_3);
        }

        $result = $command->queryAll();
        $result2 = $command2->queryAll();
        if ($command3 != null) {
            $result3 = $command3->queryAll();
        }

        Yii::$app->getSession()->setFlash('report_view_1', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Report Info 1',
                   'message' => $query_1,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        Yii::$app->getSession()->setFlash('report_view_2', [
                     'type' => 'success',
                     'duration' => 5000,
                     'icon' => 'glyphicon glyphicon-ok-sign',
                     'title' => 'Report Info 2',
                     'message' => $query_2,
                     'positonY' => 'top',
                     'positonX' => 'right'
                    ]);
        if ($query_3 != null) {
            Yii::$app->getSession()->setFlash('report_view_3', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok-sign',
                         'title' => 'Report Info 3',
                         'message' => $query_3,
                         'positonY' => 'top',
                         'positonX' => 'right'
                        ]);
        }


        return $this->render('view', [
            'report' => $report,
            'data_to_show' => $result,
            'data_to_show2' => $result2,
            'data_to_show3' => $result3,
        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post())) {
            $model->from_date = Yii::$app->formatter->asDate($model->from_date, 'php:U');
            $model->to_date = Yii::$app->formatter->asDate($model->to_date, 'php:U');

            if ($model->save()) {
                $query = "INSERT INTO report VALUES($model->title, $model->description, $model->type, $model->from_date, $model->to_date, $model->refers_to, $model->item_selected)";
                Yii::$app->getSession()->setFlash('report_view_3', [
                             'type' => 'success',
                             'duration' => 5000,
                             'icon' => 'glyphicon glyphicon-ok-sign',
                             'title' => 'Report Info',
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
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->redirect(['index']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
