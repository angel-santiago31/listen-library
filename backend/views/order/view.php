<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) . ":" ?> <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?></h1>

    </div>
    <div class="row">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'item_quantity',
                'date',
                'status',
                'customer_id',
                'card_last_digits',
                'price_total',
            ],
        ]) ?>
    </div>
</div>
