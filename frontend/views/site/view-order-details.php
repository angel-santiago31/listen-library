<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'Order Receipt' . ': #' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 style="color: white"><?= Html::encode($this->title) ?></h1>
                <label style="color: white">Order items are shown below:</label>
            </div>
            <div class="panel-body">
                <div class="row">
                    <ul class="list-group text-center">
                          <?php foreach($items_in_order as $audiobook): ?>
                              <div class="panel col-sm-2">
                                  <div class="panel-body">
                                      <?= Html::a(Html::img($audiobook->audiobookPicture2), ['site/view-item-details', 'id' => $audiobook->audiobook_id], ['class' => 'btn btn-default']) ?>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-right">
                <h4>Purchase date: <?= Yii::$app->formatter->asDate($model->purchase_date, 'php:m-d-Y') ?></h4>
                <h3>Total: <?= $model->price_total ?></h3>
            </div>
        </div>
    </div>
</div>
