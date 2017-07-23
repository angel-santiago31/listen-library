<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
//print_r($model->errors);
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'first_name')->textInput() ?>

                <?= $form->field($model, 'last_name')->textInput() ?>

                <?= $form->field($model, 'initial')->textInput() ?>

                <?= $form->field($model, 'age')->dropDownList(['18-25' => '18-25',
                                                                '26-30' => '26-30',
                                                                '31-64' => '31-64',
                                                                '65+' => '65+']) ?>

                <?= $form->field($model, 'phone_number_1')->widget(MaskedInput::className(),['mask' => '999-999-9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "999-999-9999"]) ?>

                <?= $form->field($model, 'phone_number_2')->widget(MaskedInput::className(),['mask' => '999-999-9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "999-999-9999"]) ?>

                <?= $form->field($model, 'card_last_digits')->widget(MaskedInput::className(),['mask' => '9999', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "9999"]) ?>

                <?= $form->field($model, 'expiration_date')->widget(MaskedInput::className(),['mask' => '99/99', 'clientOptions' =>['removeMaskOnSubmit'=> true]])->textInput(['placeholder' => "99/99"]) ?>

                <?= $form->field($model, 'card_type')->dropDownList(['Master Card' => 'Master Card',
                                                                           'Visa' => 'Visa',
                                                                           'American Express' => 'American Express',
                                                                           'Chase' => 'Chase']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
