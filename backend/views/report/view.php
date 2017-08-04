<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Report;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $report->title;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($data_to_show2);
?>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body btn-gray text-center">
                <h1 style="color: white"><i class="glyphicon glyphicon-headphones" style="color: #f4511e"></i> Listen Library Official <?= $report->type[0] . strtolower(substr($report->type, 1)); ?> Report </h1>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                  <div class="panel-body col-sm-4 text-center">
                      <h3>Report #: <?= Html::encode($report->id) ?></h3>
                      <h4>Type: <?= Html::encode($report->type) ?></h4>
                      <h4>Product: <?= Html::encode($report->item_selected) ?></h4>
                      <h4>Title: <?= Html::encode($report->title) ?></h4>
                      <h4>Description: <?= Html::encode($report->description) ?></h4>
                      <h4>From: <?= Html::encode($report->fromDate) ?></h4>
                      <h4>To: <?= Html::encode($report->toDate) ?></h4>
                  </div>
                  <div class="panel-body col-sm-8">
                      <hr>
                      <label>Order # &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             Genre   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             Price   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             Cost    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             Item    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             Purchase Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </label><br>
                      <?php foreach($data_to_show as $rows): ?>
                        <?php
                            $order_id = $rows['order_id'];
                            $genre = $rows['genre'];
                            $price = $rows['price'];
                            $cost = $rows['cost'];
                            $item = $rows['audiobook_id'];
                            $purchase_date = Yii::$app->formatter->asDate($rows['purchase_date'], 'php:m-d-Y');
                            echo '&nbsp;&nbsp;&nbsp;' . $order_id .
                                 '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;' . $genre .
                                 '&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;' . $price .
                                 '&emsp;&emsp;&emsp;&nbsp;' . $cost .
                                 '&emsp;&emsp;&emsp;&nbsp;&nbsp&nbsp;' . $item .
                                 '&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;' . $purchase_date . '<br>';
                         ?>
                      <?php endforeach; ?>
                      <br><hr>
                      <label>
                          <?php
                              if ($report->type == Report::REVENUE) {
                                  foreach ($data_to_show3 as $rows) {
                                      $report->total_cost = $rows['total_cost'];
                                  }
                              }
                          ?>
                          <?php foreach($data_to_show2 as $rows): ?>
                              <?php $report->total_sale = $rows['total_sale']; ?>
                          <?php endforeach; ?>

                          <?= '<span style="color: #f4511e">TOTAL IN ' . $report->type . ': </span>&emsp;&emsp;&emsp;&emsp;&nbsp;'. $report->space . $report->total; ?>
                      </label>
                  </div>
            </div>
        </div>
    </div>
</div>
