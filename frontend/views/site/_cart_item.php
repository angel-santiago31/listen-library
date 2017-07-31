<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Cart Items';
?>
<div class="site-about">
    <div class"container">
    <div class="row">
            <div class"col-sm-12">
                <div class="col-sm-2">
                    <img src="<?= $position->picture ?>" class="audiobookImg">
                </div>
                <br>
                <div class="col-sm-6">
                    <h5>
                        <?= $position->title ?>
                    </h5>
                </div>
                <div class="col-sm-2">
                    <h5>$ <?= $position->price ?> </h5>
                </div>
                <div class="col-sm-2">
                    <?= Html::a('<span style="color: white">Remove</span>', ['site/cart-remove', 'id'=>$position->id], ['class' => 'btn btn-default btn-gray']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
