<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Audiobook */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Audiobooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiobook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'genre',
            'is_fiction',
            'author_id',
            'narrator_id',
            'length',
            'release_date',
            'publisher_id',
            'price',
            'cost',
            'picture',
            'summary',
            'active',
        ],
    ]) ?>

</div>
