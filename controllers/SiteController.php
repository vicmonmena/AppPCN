<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\NotifyForm;
use app\models\User;
use app\controllers\BaseController;

class SiteController extends BaseController {
    
	public function behaviors(){
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
					[
						'actions' => ['notify'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							$valid_roles = [self::ROLE_NOTIFICADOR];
							return self::roleInArray($valid_roles) && self::isActive();
						}
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

    public function actions() {
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

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			// Redireccionamos a una u otra página en función del ROL
			if (self::isAdmin()) {
				return Yii::$app->runAction('user/index');
			} else if (self::isRol(self::ROLE_NOTIFICADOR)) {
				return  self::actionNotify();
			} else {
				return self::actionLogin();
			}
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
		return self::actionLogin();
    }

    public function actionContact() {
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

    public function actionAbout() {
        return $this->render('about');
    }
	
	public function actionSignup() {
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

    public function actionRequestPasswordReset() {
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

    public function actionResetPassword($token) {
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
	
	public function actionNotify() {
		$model = new NotifyForm();

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				if ($model->sendNotification()) {
					Yii::$app->getSession()->setFlash('success', 'Se ha enviado un email a ' . $model->email);
					// return $this->goHome();
				} else {
					Yii::$app->getSession()->setFlash('success', 'No se ha enviado el email ');
					return $this->actionNotify();
				}
			}
		}

		return $this->render('notify', [
			'model' => $model,
		]);
	}

}
