<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Narrator */

$this->title = 'Create Narrator';
$this->params['breadcrumbs'][] = ['label' => 'Narrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="narrator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
