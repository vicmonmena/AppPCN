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
use app\models\CodeForm;
use app\models\AccionForm;
use app\models\User;
use app\models\Ubicacion;
use app\models\Notificacion;
use app\controllers\BaseController;
use app\models\PersonalCriticoForm;
use app\models\ProfileForm;

/**
 * Controlador inicial.
 */
class SiteController extends BaseController {
    
	/**
	 * Define los comportamientos para el acceso a las partes de la web. 
	 */
	public function behaviors() {
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
					[
						'actions' => ['actions'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							$valid_roles = [self::ROLE_DIRECTIVO];
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

	/**
	 * Atiende las peticiones genéricas no definidas en ningún otro método.
	 */
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

	/**
	 * Atiende la petición para cargar la página HOME.
	 */
    public function actionIndex() {
        $model = new CodeForm();
		return $this->render('index', ['model' => $model,]);
    }

	/**
	 * Identifica el usuario en el sistema.
	 */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			// Redireccionamos en función del ROL
			if (self::isAdmin()) {
				///Redirecciona a la administración de notificaciones
				return Yii::$app->runAction('notificacion/index');
			} else if (self::isRol(self::ROLE_NOTIFICADOR)) {
				///Redirecciona al formulario de notificación de incidencias
				return  self::actionNotify();
			} else {
				 //Redirecciona a la HOME
				return $this->goHome();
			}
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

	/**
	 * Atiende la petición para salir de la sesión del usuario.
	 */
    public function actionLogout() {
        Yii::$app->user->logout();
		return self::actionLogin();
    }
	
	/**
	 * Atiende la petición para dar de alta un usuario
	 * en el sistema desde el formulario de registro.
	 */
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

    /**
	 * Atiende la petición para modificar el password del usuario.
	 */
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

	/**
	 * Modifica el password del usuario.
	 */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) 
				&& $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	
	/**
	 * Recoge los datos para notificar una incidencia y 
	 * envía un email con al información.
	 */
	public function actionNotify() {
		$model = new NotifyForm();

		if ($model->load(Yii::$app->request->post())) {
			$alert = 'danger'; //danger, success, info
			$msg = 'Se ha producido un error al generar la notificación';
			if ($model->validate()) {
				$msg = 'Error creando la notificación';
				if ($model->createNotification(Yii::$app->user->identity)) {
					$msg = 'No se ha enviado el email';
					
					// TODO Enviar email por cada userNotificacion creada
					
					if ($model->sendNotification()) {
						$alert = 'success';
						$msg = 'Se ha notificado a los directivos';
					}
				}
			}
			Yii::$app->getSession()->setFlash($alert, $msg);
		}
		
		return $this->render('notify', [
			'model' => $model,
		]);
	}

	/*
	 * Recoge el código pasado como parámetro en la url,
	 * lo valida y devuelve una respuesta.
	 */
	public function actionCodelogin($code) {

		$model = new CodeForm();
		if (isset($code)) {
			$model->code = $code;
			return $this->loadNotificacion($model);
		}
	}
	
	/* 
	 * Recoge el código introducido en el formulario, 
	 * lo valida y devuelve una respuesta.
	 */
	public function actionCode() {
		$model = new CodeForm();
		if ($model->load(Yii::$app->request->post())) {
			return $this->loadNotificacion($model);
		}
	}
	
	/**
	 * Comprueba el código de notificación y carga la información si existe. 
	 */
	private function loadNotificacion($model) {
		Yii::trace('Codigo: ' . $model->code);
		$userNotif = $model->loginByCode($model->code);
		if ($userNotif != null) {
			$notificacion = Notificacion::findByID($userNotif->notificacion_id);
			if ($notificacion != null) {
				
				$modelAction = new AccionForm();
				$modelAction->subject = $notificacion->subject;
				$modelAction->location = Ubicacion::findByID($notificacion->ubicacion_id)->name;
				
				$personalDisponible = User::findByRol(self::ROLE_PERSONAL_CRITICO);
				
				return $this->render('actions', 
					[
						'model' => $modelAction,
						'personalDisponible' => $personalDisponible,
					]);
			} else {
				$msg = 'Se ha producido un error.';
			}
		} else {
			$msg = 'No se localizan notificaciones con ese código.';
		}
		Yii::$app->getSession()->setFlash('danger', $msg);
		return $this->render('index', ['model' => $model]);
	}
	
	/**
	 * Envía las notificaciones al personal crítico para 
	 * que procedan en base a las indicaciones descritas.
	 */
	public function actionSend() {
		$model = new AccionForm();
		$personalDisponible = User::findByRol(self::ROLE_PERSONAL_CRITICO);
		if ($model->load(Yii::$app->request->post())) {
			$alert = 'danger';
			$msg = 'Error notificando al personal crítico';
			$userAccion = $model->createAccion(Yii::$app->user->identity);
			if ($userAccion != null) {
				$alert = 'success';
				$msg = 'El personal seleccionado ha sido notificado.';
				
				// TODO Enviar email por cada userAccion creada
				$this->sendEmail(
					Yii::$app->params['adminEmail'],
					Yii::$app->params['toEmail'],
					$model->subject,
					$model->description
				);

				
			}
			Yii::$app->getSession()->setFlash($alert, $msg);
		}
		return $this->render('actions', 
			[
				'model' => $model,
				'personalDisponible' => $personalDisponible,
			]);
	}

	private function sendEmail($from, $to, $subject, $msg) {
		Yii::$app->mailer->compose()
		    ->setFrom($from)
		    ->setTo($to)
		    ->setSubject($subject)
		    ->setTextBody($msg)
		    ->setHtmlBody('<b>' . $msg . '</b>')
		    ->send();
	}
	// ****************************************************
	
	/**
	 * Redirecciona a la página 'contact'.
	 */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) 
				&& $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

	/**
	 * Redirecciona a la página 'about'.
	 */
    public function actionProfile() {
		$model = Yii::$app->user->identity;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::trace('Ahora si');
			Yii::$app->getSession()->setFlash('Datos guardados correctamente');
        } else {
			Yii::trace('Ni de coña');
			Yii::$app->getSession()->setFlash('Se ha producido un error');
		}
		return $this->render('profile',['model' => $model]);
    }
	
	/**
	 * Redirecciona a la página 'about'.
	 */
    public function actionAbout() {
		
		/* ContactForm model:
		 * integer $id
		 * string $username
		 * email $username
		 */
	
		$model = new PersonalCriticoForm();
        return $this->render('about', [
                'model' => $model,
            ]);
    }
}
