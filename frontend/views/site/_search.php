<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Genre;
use yii\helpers\ArrayHelper;
use backend\models\Author;

/* @var $this yii\web\View */
/* @var $model backend\models\AudiobookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiobook-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="col-sm-8">
        <?= $form->field($model, 'title')->label(false) ?>

        <!-- <?= $form->field($model, 'genre')->dropDownList(ArrayHelper::map(Genre::find()
                                         ->select(['id', 'genre'])
                                         ->asArray()->all(),'id','genre'), ['prompt'=>'--Select--']);?> -->
    </div>
    <!-- <div class="col-sm-4">
        <?= $form->field($model, 'is_fiction')->dropDownList([0 => 'No', 1 => 'Yes'], ['prompt'=>'--Select--'])->label('Fiction?') ?>

        <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(Author::find()
                                             ->select(['id', 'name'])->asArray()->all(),'id','name'), ['prompt'=>'--Select--'])->label('Author') ?>
    </div> -->
    <div class="col-sm-4">
        <!-- <br><br><br> -->
        <div class="form-group btn-group">
            <?= Html::submitButton('<span style="color:white">Search</span>', ['class' => 'btn btn-default', 'style' => 'background-color: #8c8c8c']) ?>
            <?= Html::a('Reset', ['site/index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'narrator_id') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'publisher_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php ActiveForm::end(); ?>

</div>
