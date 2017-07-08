<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NarratorrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Narrators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="narrator-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Narrator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'initial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
