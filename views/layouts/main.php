<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
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
            'class' => 'bg-dark navbar-dark navbar-expand-lg',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'ml-auto navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Catalogs', 'url' => ['/catalog/index']],
            ['label' => 'Authors', 'url' => ['/author/index']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container pt-3">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container d-flex justify-content-between">
        <p class="">
            &copy; CatalogPro <?= date('Y') ?>
        </p>
            <p class="d-flex">
                <?= Html::a('About', '/site/about', ['class' => 'mr-3  text-decoration-none text-dark']) ?>
                <?= Html::a('Contacts', '/site/contact', ['class' => ' text-decoration-none text-dark']) ?>
            </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
