<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\growl\Growl;

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
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="glyphicon glyphicon-headphones"></i> Listen Library',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my-navbar navbar-fixed-top navbar-default',
            'style' => 'color: white'
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="glyphicon glyphicon-log-in"></i> Login', 'url' => ['/site/login'], 'linkOptions' => ['style' => 'color: white']];
    } else {
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index'], 'linkOptions' => ['style' => 'color: white']],
        ];
        $menuItems[] = ['label' => 'Accounts',
                        'items' => [
                            ['label' => 'Cutomers', 'url' => ['/customer/index'], 'linkOptions' => ['style' => 'color: black']],
                            '<li class="divider"></li>',
                            ['label' => 'Admins', 'url' => ['/admin/index'], 'linkOptions' => ['style' => 'color: black']],
                        ],
                        'linkOptions' => ['style' => 'color: white']
                  ];
        $menuItems[] = ['label' => 'Audiobooks',
                        'items' => [
                            ['label' => 'Titles', 'url' => ['/audiobook/index'], 'linkOptions' => ['style' => 'color: black']],
                            '<li class="divider"></li>',
                            ['label' => 'Authors', 'url' => ['/author/index'], 'linkOptions' => ['style' => 'color: black']],
                            '<li class="divider"></li>',
                            ['label' => 'Narrators', 'url' => ['/narrator/index'], 'linkOptions' => ['style' => 'color: black']],
                            '<li class="divider"></li>',
                            ['label' => 'Publishers', 'url' => ['/publisher/index'], 'linkOptions' => ['style' => 'color: black']],
                        ],
                        'linkOptions' => ['style' => 'color: white']
                  ];
        $menuItems[] = ['label' => 'Orders', 'url' => ['/order/index'], 'linkOptions' => ['style' => 'color: white']];
        //$menuItems[] = ['label' => 'Reports', 'url' => ['/report/index'], 'linkOptions' => ['style' => 'color: white']];
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
        <p class="pull-left" style="color:white">&copy; Listen Library <?= date('Y') ?></p>

        <p class="pull-right" style="color:white"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
