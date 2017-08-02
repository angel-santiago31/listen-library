<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Audiobook */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 style="color: white" class="text-center"><?= Html::encode($this->title) ?> </h1>
            </div>
            <div class="panel-body col-sm-offset-1">
                <div class="col-sm-4">
                    <img src="<?= $model->picture ?>" class="audiobookImg">
                </div>
                <div class="col-sm-8">
                    <div class="panel-heading text-center">
                        <h4><label>Written by:</label> <?= Html::encode($model->authorName)?></h4>
                        <br>
                        <h4><label>Narrated by:</label> <?= Html::encode($model->narratorName)?></h4>
                        <br>
                        <h4><label>Length:</label> <?= Html::encode($model->length)?></h4>
                        <br>
                        <h4><label>Release Date:</label> <?= Html::encode($model->release_date)?></h4>
                        <br>
                        <h4><label>Publisher:</label> <?= Html::encode($model->publisherName)?></h4>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <label>Summary: </label> <?= Html::encode($model->summary)?>
            </div>
        </div>
    </div>
</div>
