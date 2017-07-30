<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->first_name . " " . $model->initial . ". " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) ?> <?= Html::a('Activate', ['restore', 'id' => $model->id], ['class' => 'btn btn-link']) ?></h1>
    </div>
    <div class="row">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'initial',
                'age',
                'email:email',
                'phone_number_1',
                'phone_number_2',
                'auth_key',
                'password_hash',
                'status',
                'created_at:date',
                'updated_at:date',
            ],
        ]) ?>
    </div>
</div>
