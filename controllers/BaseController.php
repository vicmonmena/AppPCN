<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\AccessHelpers;

/**
 * BaseController implements common operations Controllers.
 */
class BaseController extends Controller implements IUtils{
	
	public function behaviors() {
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'view','create', 'update', 'delete'],
				'rules' => [
					[
						'actions' => ['index', 'create', 'view', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							$valid_roles = [self::ROLE_ADMIN, self::ROLE_SUPERUSER];
							return self::roleInArray($valid_roles) && self::isActive();
						}
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}
	
	/**
	 * Comprueba si el rol del usuario logado está 
	 * entre los roles pasados por parámetro.
	 */
	public static function roleInArray($arr_role) {
		$isInArray =  in_array(Yii::$app->user->identity->rol_id, $arr_role);
		return in_array(Yii::$app->user->identity->rol_id, $arr_role);
	}
	
	/**
	 * Comprueba si el usuario logado tiene estado ACTIVO
	 */
	public static function isActive() {
		return Yii::$app->user->identity->status == self::STATUS_ACTIVE;
	}
	
	/**
	 * Comprueba si un usuario tiene el rol $role.
	 */
	public static function isRol($role) {
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
