<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Order;

$this->title = 'Shopping Cart';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container col-sm-8 col-sm-offset-2">
      <div class="panel panel-default">
          <div class="panel-heading">
                <h1><i class="glyphicon glyphicon-shopping-cart"></i> <?= Html::encode($this->title) ?></h1>
                <?= Html::a('Proceed to checkout [' . $total . ']'  , ['site/checkout'], ['class' => Order::isCartEmpty()]) ?>
          </div>
          <div class="panel-body">
            <div class="col-sm-12">
                <?php if (Yii::$app->user->isGuest): ?>
                        <h4>You currently have <?= $itemsCount ?> item(s) in your cart.</h4>
                    <?php endif ?>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <h4><?= Yii::$app->user->identity->first_name ?>, you currently have <?= $itemsCount ?> item(s) in your cart.</h4>
                    <?php endif ?>
                    <br>
                    <hr>
                    <?php
                        $positions = \Yii::$app->cart->positions;
                        //var_dump($positions);
                        foreach($positions as $position) {
                            //echo "hello";
                            echo $this->render('_cart_item',['position' => $position]);
                            //var_dump($position);
                        }
                    ?>
                    <br>
                    <br>
                    <hr>
              </div>
          </div>
      </div>
</div>
