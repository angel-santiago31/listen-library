<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Author;
use backend\models\Narrator;
use backend\models\Publisher;
use backend\models\Genre;
use yii\widgets\MaskedInput;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Audiobook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audiobook-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genre')->dropDownList(ArrayHelper::map(Genre::find()
                                             ->select(['id', 'genre'])->asArray()->all(),'id','genre'), ['prompt'=>'--Select--']);?>

    <?= $form->field($model, 'is_fiction')->dropDownList([0 => 'No',
                                                          1 => 'Yes']) ?>

    <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(Author::find()
                                             ->select(['id', 'name'])->asArray()->all(),'id','name'), ['prompt'=>'--Select--']);?>

    <?= $form->field($model, 'narrator_id')->dropDownList(ArrayHelper::map(Narrator::find()
                                             ->select(['id', 'name'])->asArray()->all(),'id','name'), ['prompt'=>'--Select--']);?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_date')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => true,
         // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'M-dd-yyyy'
        ]
]);?>

    <?= $form->field($model, 'publisher_id')->dropDownList(ArrayHelper::map(Publisher::find()
                                             ->select(['id', 'name'])->asArray()->all(),'id','name'), ['prompt'=>'--Select--']);?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label("Sales Price") ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true])->label("Production Cost") ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
