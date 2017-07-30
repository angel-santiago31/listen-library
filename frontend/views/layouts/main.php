<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="glyphicon glyphicon-headphones"></i> Listen Library',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my-navbar navbar-fixed-top navbar-default',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index'], 'linkOptions' => ['style' => 'color: white']],
        ['label' => 'About', 'url' => ['/site/about'], 'linkOptions' => ['style' => 'color: white']],
        ['label' => 'Contact', 'url' => ['/site/contact'], 'linkOptions' => ['style' => 'color: white']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'linkOptions' => ['style' => 'color: white']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'linkOptions' => ['style' => 'color: white']];
    } else {
        $menuItems[] = ['label' => 'My Account', 'url' => ['/customer/view', 'id' => Yii::$app->user->identity->id], 'linkOptions' => ['style' => 'color: white']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="glyphicon glyphicon-off"></i>',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
