<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AudiobookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Audiobooks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) . ":" ?> <?= Html::a('Add Audiobook', ['create'], ['class' => 'btn btn-link']) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'genre',
                //'is_fiction',
                'author_id',
                // 'narrator_id',
                // 'length',
                // 'release_date',
                // 'publisher_id',
                // 'price',
                // 'cost',
                // 'picture',
                // 'summary',
                'active',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
