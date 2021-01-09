<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\bootstrap4\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use \yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
$cartItemsCount = $this->params["cartItemsCount"];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md navbar-light bg-light fixed-top shadow-sm',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Cart<span id="cartItemCount" class="badge badge-success m-1">' . $cartItemsCount . '</span> ',
            'url' => ['/cart/index'],
            'encode' => false,
            'linkOptions' => [
                "class" => 'd-flex justify-content-center align-items-center'
            ]
        ]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => 'profile', 'url' => ['/profile/index']],
                ['label' => 'logout', 'url' => ['/site/logout'], 'linkOptions' => [
                    'data-method' => 'post',
                ]
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

<!--        --><?php //if (Yii::$app->session->hasFlash("success") || Yii::$app->session->hasFlash("fail")) { ?>
<!--        --><?//= Alert::widget([
//                'options' => ['class' => 'alert-info', 'style' => 'top:200px; z-index :10000'],
//                'body' => Yii::$app->session->getFlash($cartItemsCount)
//            ]
//        )
//
//                <?php }   ?>


        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
