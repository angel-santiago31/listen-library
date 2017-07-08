<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CreditCard */

$this->title = 'Update Credit Card: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Credit Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'card_last_digits' => $model->card_last_digits]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="credit-card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
