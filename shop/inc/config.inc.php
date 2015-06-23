<?php

	/*************************************************/
	/* ARCHIVO DE CONFIGURACION MICD                 */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 15-02-08                      */
	/*************************************************/

	if(!isset($_GET['shop']))
		header("location: ./../");

	date_default_timezone_set('America/Santiago');

	// obtencion del prefijo a usar mediante la tienda/usuario pasada por get
	$micd['mysql']['prefix']= $_GET['shop']."_";

	// ubicacion del sitio web
	$micd['dir']	  	= dirname(dirname(__FILE__)); // directorio del sitio
	$micd['url']		= "http://mi.delaf.cl/micd/shop"; // url del sitio

	// obtener configuraciones compartidas
	require_once($micd['dir']."/../inc/config_shared.inc.php");

	// otros archivos a incluir
	require_once($micd['site']['dir']."/inc/class.inc.php");
	require_once($micd['site']['dir']."/inc/functions.inc.php");
	require_once($micd['dir']."/inc/actions.inc.php");

?>
