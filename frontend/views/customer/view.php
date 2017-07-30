<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->first_name . ' ' . $model->last_name;
// $this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) . ": " ?> <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'first_name',
                    'last_name',
                    'initial',
                    'age',
                    'email:email',
                    'phone_number_1',
                    'phone_number_2',
                    //'auth_key',
                    //'password_hash',
                    //'status',
                    //'created_at',
                    //'updated_at',
                ],
            ]) ?>
        </div>
        <div class="col-sm-5">
            <?= DetailView::widget([
                'model' => $card,
                'attributes' => [
                    //'id',
                    //'customer_id',
                    'card_last_digits',
                    'expiration_date',
                    'card_type'
                ],
            ]) ?>
        </div>
    </div>
</div>
