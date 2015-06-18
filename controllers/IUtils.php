<?php

namespace app\controllers;

interface IUtils {
	
	// Constantes que definen los estados de un usuario
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
	// Constantes que definen los roles de un usuario
	const ROLE_USER = 1;
	const ROLE_ADMIN = 2;
	const ROLE_SUPERUSER = 3;
	const ROLE_NOTIFICADOR = 4;
	const ROLE_DIRECTIVO = 5;
	const ROLE_PERSONAL_CRITICO = 6;
}