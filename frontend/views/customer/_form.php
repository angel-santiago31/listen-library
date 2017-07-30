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
            <?php $form = ActiveForm::begin(); ?>

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

        </div>
        <div class="col-lg-5">
                <?= $form->field($card, 'card_last_digits')->widget(MaskedInput::className(),['mask' => '9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "9999"]) ?>

                <?= $form->field($card, 'expiration_date')->widget(MaskedInput::className(),['mask' => '99/99', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "99/99"]) ?>

                <?= $form->field($card, 'card_type')->dropDownList(['Master Card' => 'Master Card',
                                                                           'Visa' => 'Visa',
                                                                           'American Express' => 'American Express',
                                                                           'Chase' => 'Chase']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
