<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
// $this->params['breadcrumbs'][] = $this->title;
//print_r($dataProvider);
?>
<div class="report-index">
    <div class="row">
        <h1><?= Html::encode($this->title) . ":" ?> <?= Html::a('File a Report', ['create'], ['class' => 'btn btn-link']) ?></h1>
    </div>
    <div class="row">
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                  //['class' => 'yii\grid\SerialColumn'],

                  //'id',
                  'title',
                  //'description:ntext',
                  'type',
                  'from_date:date',
                  'to_date:date',
                  // 'refers_to',
                  // 'item_selected',
                  [
                      'label' => 'More',
                      'format' => 'html',
                      'value' => function ($model) {
                          return Html::a('<span style="color: white">View More</span>', ['report/view', 'id' => $model->id], ['class' => 'btn btn-xs btn-gray']);
                      }
                  ],

                  //['class' => 'yii\grid\ActionColumn'],
              ],
          ]); ?>
    </div>
</div>
