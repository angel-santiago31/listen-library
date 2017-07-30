<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

 $this->title = 'Update';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password_hash')->passwordInput(['value'=>''])->label("Password") ?>

                <?= $form->field($model, 'first_name')->textInput() ?>

                <?= $form->field($model, 'last_name')->textInput() ?>

                <?= $form->field($model, 'initial')->textInput() ?>

                <?= $form->field($model, 'age')->dropDownList(['18-25' => '18-25',
                                                                '26-30' => '26-30',
                                                                '31-64' => '31-64',
                                                                '65+' => '65+']) ?>

                <?= $form->field($model, 'phone_number_1')->widget(MaskedInput::className(),['mask' => '999-999-9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "999-999-9999"]) ?>

                <?= $form->field($model, 'phone_number_2')->widget(MaskedInput::className(),['mask' => '999-999-9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "999-999-9999"]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
