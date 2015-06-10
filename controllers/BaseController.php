<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AccessHelpers;

/**
 * BaseController implements common operations Controllers.
 */
class BaseController extends Controller {
	
	// Constantes que definen los roles de un usuario
	const ROLE_USER = 1;
	const ROLE_ADMIN = 2;
	const ROLE_SUPERUSER = 3;
	
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
	 
		$permitirSiempre = ['site-captcha', 'site-signup','site-index', 
			'site-about', 'site-error', 'site-contact', 'site-login', 'site-logout'];
	 
		if (in_array($operacion, $permitirSiempre)) {
			return true;
		}
	 
		$operacion = str_replace("-index", "", $operacion);
		
		Yii::trace('SiteController::behaviors - ' . $operacion);
		if (!AccessHelpers::getAcceso($operacion)) {
			echo $this->render('/site/nopermitido');
			return false;
		}
	 
		return true;
	}
	
	/**
	 * Comprueba si un usuario tiene el rol $role.
	 */
	public function isRol($role) {
		// return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
		return Yii::$app->user->identity->rol_id == $role;
	}
	
	/**
	 * Comprueba si un usuario es Administrador.
	 */
	public static function isAdmin() {
		return Yii::$app->user->identity->rol_id == self::ROLE_ADMIN;
	}
}
