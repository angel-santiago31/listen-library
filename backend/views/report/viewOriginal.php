<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */

$this->title = $report->title;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) . ":" ?> <?= Html::a('Update', ['update', 'id' => $report->id], ['class' => 'btn btn-link']) ?></h1>
    </div>
    <div class="row">
        <?= DetailView::widget([
            'model' => $report,
            'attributes' => [
                'id',
                'title',
                'description:ntext',
                'type',
                'from_date:date',
                'to_date:date',
                'refers_to',
                'item_selected',
            ],
        ]) ?>
    </div>
</div>
