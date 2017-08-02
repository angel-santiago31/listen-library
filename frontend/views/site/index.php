<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AudiobookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Welcome to our catalog!';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Here you can search for any audiobook. Just type in the field. </p>
        </div>
        <div class="col-sm-6">
            <?php $form = ActiveForm::begin(['action' =>['index'], 'method' => 'post',]); ?>
                <br><br>
                <div class="col-sm-7">
                    <?= $form->field($model, 'title', ['inputOptions' => ['placeholder' => 'Audiobook Title', 'class' => 'form-control']])->label(false) ?>
                </div>
                <div class="col-sm-5 btn-group">
                    <?= Html::submitButton('<span style="color: white">Search</span>', ['class' => 'btn btn-gray']) ?>
                    <?= Html::a('Refresh', ['site/index'], ['class' => 'btn btn-default',  'style' => 'background-color: white']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row">
          <br><br><br>
          <?php  if ($audiobookList == NULL): ?>
            <div class="container text-left">
                  <label>Oops! There are no results for your search. Please try again.</label>
            </div>
          <?php  endif ?>
          <ul class="list-group">
            <?php foreach($audiobookList as $audiobook): ?>
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <img src="<?= $audiobook->picture ?>" class="audiobookImg">
                    </div>
                    <div class="col-sm-6">
                        <div class="panel-heading text-center">
                            <br><br>
                            <label><?= Html::encode($audiobook->title)?></label>
                            <br><br>
                            $ <?= Html::encode($audiobook->price) ?>
                            <br><br>
                            <div class="btn-group">
                                <?= Html::a('<span style="color: white">Add to Cart</span>', ['site/add-to-cart', 'id' => $audiobook->id], ['class' => 'btn btn-gray']) ?>
                                <?= Html::a('View details', ['site/view-item-details', 'id' => $audiobook->id], ['class' => 'btn btn-default']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
          </ul>
    </div>
</div>
