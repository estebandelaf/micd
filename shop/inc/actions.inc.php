<?php

 /*************************************************/
 /* ARCHIVO DE ACCIONES ANTES DE MOSTRAR LA WEB   */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

	// requerir acciones compartidas
	require_once($micd['site']['dir']."/inc/actions_shared.inc.php");

	// verificar que el parametro de shop sea una tienda correcta
	$usuario_correcto = $consultasSql->contar($micd['site']['mysql']['prefix']."usuarios","usuario",$consultasSql->proteger($_GET['shop']));
	if($usuario_correcto!=1) {
		$consultasSql->cerrar();
		header("location: ".$micd['site']['url']."/errno.php?errno=1&shop=".$_GET['shop']);
	}

	// leer datos de la tienda/usuario
	require_once($micd['dir']."/inc/read_config.inc.php");

	// si la categoria solicitada no existe se redirecciona
	if(isset($_GET['cat_id'])) {
		$categoria_correcta = $consultasSql->contar($micd['mysql']['prefix']."categorias","id",$consultasSql->proteger($_GET['cat_id']));
		if($categoria_correcta!=1) {
			$consultasSql->cerrar();
			header("location: ".$micd['url']."/errno.php?errno=7&shop=".$_GET['shop']);
		}
	}

	// contar cuantos discos hay en la base de datos
	$micd['numero_discos'] = $consultasSql->contar($micd['mysql']['prefix']."discos");

	// iniciar sesion de usuario
	session_name($micd['shop']); 
	session_start();
	header("cache-control: private");  // IE 6 Fix
	$micd['sesion_id'] = session_id();
	// verificar si el administrador esta logueado
	$login = (isset($_SESSION['login']) && isset($_SESSION['shop']) && $_SESSION['shop']==$micd['shop'] && session_name()==$micd['shop']) ? $_SESSION['login'] : 0;

	$micd['pagina_actual'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>