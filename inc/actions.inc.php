<?php

	/*************************************************/
	/* ARCHIVO DE ACCIONES ANTES DE MOSTRAR LA WEB   */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 15-02-08                      */
	/*************************************************/

	// requerir acciones compartidas
	require_once($micd['site']['dir']."/inc/actions_shared.inc.php");

	// REDIRECCIONAR A LA TIENDA DE UN USUARIO SI ES NECESARIO
	$parametros=recoger_parametros_url(); // recibir usuario pasado por la url, se debe validar
	// verificar que no sea un archivo navegable el pasado por la url
	$redireccionar=1;
	for($i=0;$i<count($micd['site']['archivos_navegables']);$i++)
		if($micd['site']['archivos_navegables'][$i].".php"==$parametros)
			$redireccionar = 0;
	// si no es un archivo navegable verificar que el usuario/tienda exista y redireccionar
	if($redireccionar && $parametros) {
		$usuario_correcto = $consultasSql->contar($micd['site']['mysql']['prefix']."usuarios","usuario",$parametros);
		//$consultasSql->cerrar(); // si no esta comentado no redirecciona :s BUG!
		if($usuario_correcto==1)
			header("location: ".$micd['site']['url']."/shop/?shop=$parametros");
		else
			header("location: ".$micd['site']['url']."/errno.php?errno=1&shop=$parametros");
	}

	// contar cuantas tiendas hay en la base de datos
	$micd['site']['numero_tiendas'] = $consultasSql->contar($micd['site']['mysql']['prefix']."usuarios") - 1;

?>
