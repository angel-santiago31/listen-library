<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CreditCard */

$this->title = 'Create Credit Card';
$this->params['breadcrumbs'][] = ['label' => 'Credit Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
