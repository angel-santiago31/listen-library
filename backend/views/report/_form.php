<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Audiobook;
use backend\models\Genre;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">
    <div class="row">
        <div class="col-lg-7">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'type')->dropDownList(['Sales' => 'Sales', 'Revenue' => 'Revenue'], ['prompt'=>'--Select--']); ?>

            <?= $form->field($model, 'from_date')->widget(
                                                      DatePicker::className(), [
                                                          // inline too, not bad
                                                           'inline' => true,
                                                           // modify template for custom rendering
                                                          'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                                          'clientOptions' => [
                                                              'autoclose' => true,
                                                              'format' => 'dd-M-yyyy'
                                                          ]
                                                  ]);?>

            <?= $form->field($model, 'to_date')->widget(
                                                          DatePicker::className(), [
                                                          // inline too, not bad
                                                          'inline' => true,
                                                           // modify template for custom rendering
                                                          'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                                          'clientOptions' => [
                                                              'autoclose' => true,
                                                              'format' => 'dd-M-yyyy'
                                                          ]
                                                ]);?>

            <?= $form->field($model, 'refers_to')->dropDownList(ArrayHelper::map(Genre::find()
                                                     ->select(['id','genre'])->asArray()->all(),'id','genre'), ['prompt'=>'--Select--', 'id' => 'refers_to']);?>

            <div id="itemIdField">
                  <?= $form->field($model, 'item_selected')->dropDownList(ArrayHelper::map(Audiobook::find()
                                                           ->select(['id','title'])->asArray()->all(),'id','title'), ['prompt'=>'--Select--']);?>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'File Report' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
