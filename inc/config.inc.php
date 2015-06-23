<?php

	/*************************************************/
	/* ARCHIVO DE CONFIGURACION MICD                 */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 10-02-08                      */
	/*************************************************/

	date_default_timezone_set('America/Santiago');

	// configuracion general del sitio web
	$micd['website']	= "micd"; // nombre del sitio web
	$micd['desc']		= "demo micd"; // descripcion del sitio web
	$micd['skin']		= "gemstone"; // skin o style para el sitio, nombre de la carpeta dentro de skin

	// configuracion del administrador y contacto
	$micd['admin']		= "micd"; // usuario que sera usado para el ingreso a opciones de administracion
	$micd['clave']		= "1eee9ac3aabf2bebdf621b6b06173bc8"; // clave del administrador del sitio encriptada con md5
	$micd['email']		= "micd@example.com"; // correo electronico del administrador
	$micd['telefono']	= ""; // telefono de contacto del administrador
	$micd['direccion']	= ""; // direccion fisica o ubicacion

	// configuracion de la base de datos mysql
	$micd['db_name']	= "micd"; // nombre de la base de datos mysql
	$micd['db_user']	= "micd"; // usuario de la base de datos mysql
	$micd['db_password']	= "micd"; // contrasenia para la base de datos mysql
	$micd['db_prefix']	= ""; // prefijo para campos de la base de datos

	// ubicacion del sitio web
	$micd['dir']	  	= dirname(dirname(__FILE__)); // directorio del sitio
	$micd['url']		= "http://localhost/dev/pages/mi/micd"; // url del sitio

	// links a otras webs
	$micd['links']		= "";

	// otras definiciones
	$micd['tiempo_real']	= date('U');
	$micd['tiempo_nuevo']	= 3600*72; // tiempo en segundos para ser considerado como nuevo un disco

	// valores con los que se calcula el precio si no esta definico
	// precio = precio de 1 disco + precio de cada disco extra * (cantidad - 1)
	$micd['precio']['CD'][0] = 2000;
	$micd['precio']['CD'][1] = 1000;
	$micd['precio']['DVD'][0]= 3000;
	$micd['precio']['DVD'][1]= 1500;

	// otras definiciones menos relevantes
	$micd['tiempo_votos']	= 60; // segundos que se debera esperar para poder volver a votar por un disco
	$micd['discos_por_pag'] = 20; // cantidad de discos que se mostraran por pagina en las categorias
	$micd['discos_nuevos']	= 20; // los ultimos discos agregados que seran mostrados en la pagina web principal

	// otros archivos a incluir
	require_once($micd['dir']."/inc/config_shared.inc.php");
	require_once($micd['dir']."/inc/functions.inc.php");
	require_once($micd['dir']."/inc/actions.inc.php");

?>
