<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\User;
use app\models\AccessHelpers;

class SiteController extends Controller
{
    public function behaviors()
    {
		
		/*
		 * ******************************
		 * 'only' => ... significa que las reglas se aplicarán solo a las acciones logout, sigoout y about
		 * ******************************
		 * Esto significa que para las acciones 
		 * ‘login’, ‘signup’, ‘error’, 
		 * se permitirá el acceso para los usuarios que no están autenticados 
		 * (representados por ‘?’); en tanto que las acciones ‘about’, ‘logout’, e ‘index’ 
		 * serán accesibles para los usuarios autenticados (representados por ‘@’).
		 */
		return [
            'access' => [
                'class' => AccessControl::className(),
				'only' => ['logout', 'signup', 'about'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup', 'error'],
                        'allow' => true,
						'roles' => ['?'],
                    ],
                    [
                        'actions' => ['about', 'logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

	/*
	 * Este método se ejecuta antes que cualquier acción del controlador, 
	 * a continuación de todos los filtros existentes 
	 * (como los que se encuentran en el método behaviors).
	 */
	public function beforeAction($action) {
		if (!parent::beforeAction($action)) {
			return false;
		}
	 
		$operacion = str_replace("/", "-", Yii::$app->controller->route);
	 
		$permitirSiempre = ['site-captcha', 'site-signup', 
			'site-index', 'site-error', 'site-contact', 'site-login', 'site-logout'];
	 
		if (in_array($operacion, $permitirSiempre)) {
			return true;
		}
	 
		if (!AccessHelpers::getAcceso($operacion)) {
			echo $this->render('nopermitido');
			return false;
		}
	 
		return true;
	}

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
