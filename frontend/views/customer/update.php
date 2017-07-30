<?php

use yii\helpers\Html;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->first_name . " " . $model->initial . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => $model->first_name . " " . $model->initial . " " . $model->last_name, 'url' => ['customer/view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'card' => $card
    ]) ?>

</div>
