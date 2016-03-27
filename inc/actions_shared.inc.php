<?php

	// conexion a mysql
	require_once($micd['site']['dir']."/inc/class.inc.php");
	$consultasSql = new mysql(); // crea objeto para trabajar con la base de datos
	$consultasSql->conectar($micd['mysql']['server'],$micd['mysql']['dataBase'],$micd['mysql']['user'],$micd['mysql']['password']);

	// idioma del navegador del usuario
	$idioma_loaded = 0;
	$idiomas = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	foreach($idiomas as $lg) {
		if(file_exists($micd['site']['dir']."/lang/".substr($lg,0,2).".php")) {
			require_once($micd['site']['dir']."/lang/".substr($lg,0,2).".php");
			$idioma_loaded = 1;
			break;
		}
	}
	if(!$idioma_loaded) {
		if(file_exists($micd['site']['dir']."/lang/".$micd['site']['lang']['default'].".php"))
			require_once($micd['site']['dir']."/lang/".$micd['site']['lang']['default'].".php");
		else
			exit("Lo sentimos pero no se ha encontrado ninguna definición de idiomas y la página no puede seguir siendo mostrada.");
	}

	require_once($micd['site']['dir']."/lang/es.php");

	// datos del usuario cliente ip y host
	if($_SERVER) {
		$realip = $_SERVER['REMOTE_ADDR'];
	} else {
		if(getenv('HTTP_X_FORWARDED_FOR')) {
			$realip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('HTTP_CLIENT_IP')) {
			$realip = getenv('HTTP_CLIENT_IP' );
		} else {
			$realip = getenv('REMOTE_ADDR');
		}
	}
	$ip = $realip; // establecer IP del visitante
	$host = gethostbyaddr($realip); // establecer host del visitante

	$micd['site']['pagina_actual'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>
