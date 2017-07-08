<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Audiobook */

$this->title = 'Create Audiobook';
$this->params['breadcrumbs'][] = ['label' => 'Audiobooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audiobook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
