<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Audiobook */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Audiobooks', 'url' => ['index']];
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
                'picture2',
                'summary',
                'active',
            ],
        ]) ?>
    </div>
</div>
