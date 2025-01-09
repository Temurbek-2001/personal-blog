<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);

    // Define URLs
    $loginUrl = Url::to(['/site/login']);
    $signupUrl = Url::to(['/site/signup']);

    // Register custom JavaScript for long press functionality
    $this->registerJs(<<<JS
    let timer;
    const loginUrl = '$loginUrl';
    const signupUrl = '$signupUrl';

    document.getElementById('login-signup-link').addEventListener('mousedown', function() {
        timer = setTimeout(function() {
            // Redirect to the signup page after 3 seconds
            window.location.href = signupUrl;
        }, 3000);
    });

    document.getElementById('login-signup-link').addEventListener('mouseup', function() {
        clearTimeout(timer); // Clear timer if the mouse is released before 3 seconds
    });

    document.getElementById('login-signup-link').addEventListener('click', function(e) {
        clearTimeout(timer);
        // Redirect to the login page for a normal click
        window.location.href = loginUrl;
    });
    JS
    );

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            !Yii::$app->user->isGuest ? ['label' => 'Posts', 'url' => ['/posts']] : '',
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Create', 'url' => ['/posts/create']],
            Yii::$app->user->isGuest
                ? Html::a('Login', '#', [
                'id' => 'login-signup-link',
                'class' => 'nav-link'
            ])
                : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
        ]
    ]);

    NavBar::end();
    ?>
</header>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Temur Mirzaliyev <?= date('Y') ?></div>

        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
