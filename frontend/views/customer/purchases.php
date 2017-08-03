<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                //'id',
                'purchase_date:date',
                //'status',
                //'customer_id',
                // 'card_last_digits',
                'item_quantity',
                'price_total',
                [
                  'label' => 'More',
                  'format' => 'html',
                  'value' => function ($model) {
                      return Html::a('<span style="color: white">Receipt</span>', ['site/view-order-details', 'id' => $model->id], ['class' => 'btn btn-xs btn-gray']);
                  }
                ],

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
