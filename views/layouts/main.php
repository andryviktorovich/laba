<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        'brandLabel' => 'Производство',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        'innerContainerOptions' => [
                'class' => "container-fluid",
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Работы', 'url' => ['/work']],
            ['label' => 'Партии', 'url' => ['/batch']],
            ['label' => 'Марки', 'url' => ['/mark']],
            ['label' => 'Сырье', 'items' => [
                ['label' => 'Список сырья', 'url' => '/material'],
                ['label' => 'Поставки сырья', 'url' => '/material-coming'],
                ['label' => 'Расход сырья', 'url' => '/material-consumption'],
                ['label' => 'Остаток на складе', 'url' => '/material-consumption/in-stock'],
                ['label' => 'Поставщики', 'url' => '/provider'],
            ]],
            ['label' => 'Списки', 'items' => [
                ['label' => 'Список цветов', 'url' => '/list-color'],
                ['label' => 'Список добавок', 'url' => '/list-additive'],
                ['label' => 'Список полимеров', 'url' => '/list-polymer'],
                ['label' => 'Список добавок', 'url' => '/list-additive'],
                ['label' => 'Список типов продукции', 'url' => '/list-type-product'],
                ['label' => 'Сотрудники', 'url' => ['/employees']],
            ]],
            ['label' => 'Разное', 'items' => [
                ['label' => 'Формулы', 'url' => ['/formula']],
                ['label' => 'Сотрудники', 'url' => ['/employees']],
                ['label' => 'Машины', 'url' => ['/machine']],
                ['label' => 'Должности', 'url' => ['/position']],
                ['label' => 'Готовая продукция', 'url' => ['/product']],
                ['label' => 'Табель', 'url' => ['/timetable']],
            ]],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
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
