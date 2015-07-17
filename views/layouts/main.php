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
				['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
			];
			if (Yii::$app->user->isGuest) {
				array_push($items,
				array 
					(
						['label' => Yii::t('app','Login'), 'url' => ['/site/login']],
						['label' => Yii::t('app','About'), 'url' => ['/site/about']],
						['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']]
					)
				);
			} else {
				if (BaseController::isAdmin()) {
					array_push($items, 
						['label' => Yii::t('app','Users', 2), 'url' => ['/user']],
						['label' => Yii::t('app','Roles'), 'url' => ['/rol']],
						['label' => Yii::t('app','Operaciones'), 'url' => ['/operacion']],
						['label' => Yii::t('app','Ubicaciones'), 'url' => ['/ubicacion']],
						['label' => Yii::t('app','Procesos'), 'url' => ['/proceso']],
						['label' => Yii::t('app','Empresas'), 'url' => ['/empresa']],
						['label' => Yii::t('app','Notificaciones'), 'url' => ['/notificacion']],
						['label' => Yii::t('app','Acciones'), 'url' => ['/accion']]
					);
				} else if (BaseController::isRol(BaseController::ROLE_NOTIFICADOR)) {
					array_push($items, ['label' => 'Notificar', 'url' => ['/site/notify']]);
				}
					
				array_push($items, 
					array(
						'label' => Yii::$app->user->identity->username, 
						'items' => array(
							array ('label' => Yii::t('app','Profile'),'url' => ['/site/profile'], 'linkOptions' => ['data-method' => 'post']),
							array ('label' => Yii::t('app','Logout'),'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']),
							['label' => Yii::t('app','About'), 'url' => ['/site/about']],
							['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']]
						)
					)
				);
			}
            NavBar::begin([
                'brandLabel' => Yii::t('app','PCN'),
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
            <p class="pull-left">&copy; <?= Yii::t('app','right') ?> <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
