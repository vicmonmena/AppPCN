<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\controllers\BaseController;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
			
			$items = [
				['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']]
			];
			if (Yii::$app->user->isGuest) {
				array_push($items,['label' => 'Login', 'url' => ['/site/login']]);
			} else {
				if (BaseController::isAdmin()) {
					array_push($items, 
						['label' => 'Usuarios', 'url' => ['/user']],
						['label' => 'Roles', 'url' => ['/rol']],
						['label' => 'Operaciones', 'url' => ['/operacion']]
					);
				} else if (BaseController::isRol(BaseController::ROLE_NOTIFICADOR)) {
					array_push($items, ['label' => 'Notificar', 'url' => ['/site/notify']]);
				}
				
				array_push($items, ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
				);
			}
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items
            ]);
            NavBar::end();
        ?>

        <div class="container">
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
