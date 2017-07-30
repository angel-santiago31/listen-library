<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NarratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Narrators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) . ":" ?> <?= Html::a('Add Narrator', ['create'], ['class' => 'btn btn-link']) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
