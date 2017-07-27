<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?> <?= Html::a('Activate', ['restore', 'id' => $model->id], ['class' => 'btn btn-link']) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
