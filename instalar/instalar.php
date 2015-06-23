<?php

 /*************************************************/
 /* ARCHIVO DE INSTALACION MICD                   */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 10-02-08                      */
 /*************************************************/

 date_default_timezone_set('America/Santiago');

 $micd['db_conexion']= mysqli_connect("localhost",$_POST['db_user'],$_POST['db_password']); // realizar conexion a la base de datos mysql
 mysqli_select_db($micd['db_conexion'], $_POST['db_name']) OR die(mysqli_error($micd['db_conexion']));

 // BORRAR POSIBLE CONFIGURACION ANTIGUA DE LA BASE DE DATOS
 mysqli_query($micd['db_conexion'], "DROP TABLE IF EXISTS `".$_POST['db_prefix']."discos`, `".$_POST['db_prefix']."categorias`, `".$_POST['db_prefix']."formatos`, `".$_POST['db_prefix']."online`, `".$_POST['db_prefix']."comentarios`") OR die(mysqli_error($micd['db_conexion']));

 // CREAR TABLAS PARA EL SISTEMA
 mysqli_query($micd['db_conexion'], "CREATE TABLE ".$_POST['db_prefix']."categorias (
   id int(11) NOT NULL auto_increment,
   nombre varchar(50) NOT NULL default '',
   img varchar(30) NOT NULL default '',
   PRIMARY KEY  (id)
  )") OR die(mysqli_error($micd['db_conexion']));
 mysqli_query($micd['db_conexion'], "CREATE TABLE ".$_POST['db_prefix']."discos (
   id int(11) NOT NULL auto_increment,
   publicacion int(11) NOT NULL default '0',
   modificacion int(11) NOT NULL default '0',
   tipo_disco char(3) NOT NULL default '0',
   formato int(11) NOT NULL default '0',
   cantidad int(11) NOT NULL default '0',
   caratula blob NOT NULL,
   clasificacion varchar(20) NOT NULL default '',
   nombre varchar(255) NOT NULL default '',
   descripcion text NOT NULL,
   calificacion int(11) NOT NULL default '0',
   nvotos int(11) NOT NULL default '0',
   cat_id int(11) NOT NULL default '0',
   precio int(11) NOT NULL default '0',
   mas_info text NOT NULL,
   PRIMARY KEY  (id),
   FULLTEXT KEY nombre (nombre)
  )") OR die(mysqli_error($micd['db_conexion']));
 mysqli_query($micd['db_conexion'], "CREATE TABLE ".$_POST['db_prefix']."formatos (
   id int(11) NOT NULL auto_increment,
   formato varchar(30) NOT NULL default '',
   descripcion text NOT NULL,
   PRIMARY KEY  (id)
  )") OR die(mysqli_error($micd['db_conexion']));
 mysqli_query($micd['db_conexion'], "CREATE TABLE ".$_POST['db_prefix']."online (
  id int(11) NOT NULL auto_increment,
  sesion_id varchar(32) NOT NULL default '',
  date int(11) NOT NULL default '0',
  ip varchar(15) NOT NULL default '',
  host varchar(250) NOT NULL default '',
  pagina varchar(250) NOT NULL default '',
  PRIMARY KEY  (id)
 )") OR die(mysqli_error($micd['db_conexion']));
 mysqli_query($micd['db_conexion'], "CREATE TABLE ".$_POST['db_prefix']."comentarios (
  id int(11) NOT NULL auto_increment,
  disco_id int(11) NOT NULL default '0',
  publicacion int(11) NOT NULL default '0',
  usuario varchar(30) NOT NULL default '',
  comentario text NOT NULL,
  PRIMARY KEY  (id)
 )") OR die(mysqli_error($micd['db_conexion']));

 mysqli_close($micd['db_conexion']); // cierra conexion con el servidor mysql

 // GENERAR ARCHIVO config.inc.php
 $tiempo_real	= date("U");
 $filename	= "config.inc.php";
 $crlf		= "\n";
 $eol		= "\r\n";
 $mime_type	= "application/octet-stream";
 $nop		= "";

 $buffer	= "<?php

	/*************************************************/
	/* ARCHIVO DE CONFIGURACION MICD                 */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 10-02-08                      */
	/*************************************************/

	// configuracion general del sitio web
	$".$nop."micd['website']	= \"".$_POST['website']."\"; // nombre del sitio web
	$".$nop."micd['desc']		= \"".$_POST['desc']."\"; // descripcion del sitio web
	$".$nop."micd['skin']		= \"".$_POST['skin']."\"; // skin o style para el sitio, nombre de la carpeta dentro de skin

	// configuracion del administrador y contacto
	$".$nop."micd['admin']		= \"".$_POST['admin']."\"; // usuario que sera usado para el ingreso a opciones de administracion
	$".$nop."micd['clave']		= \"".md5($_POST['clave'])."\"; // clave del administrador del sitio encriptada con md5
	$".$nop."micd['email']		= \"".$_POST['email']."\"; // correo electronico del administrador
	$".$nop."micd['telefono']	= \"".$_POST['telefono']."\"; // telefono de contacto del administrador
	$".$nop."micd['direccion']	= \"".$_POST['direccion']."\"; // direccion fisica o ubicacion

	// configuracion de la base de datos mysql
	$".$nop."micd['db_name']	= \"".$_POST['db_name']."\"; // nombre de la base de datos mysql
	$".$nop."micd['db_user']	= \"".$_POST['db_user']."\"; // usuario de la base de datos mysql
	$".$nop."micd['db_password']	= \"".$_POST['db_password']."\"; // contrasenia para la base de datos mysql
	$".$nop."micd['db_prefix']	= \"".$_POST['db_prefix']."\"; // prefijo para campos de la base de datos

	// ubicacion del sitio web
	$".$nop."micd['dir']	  	= dirname(dirname(__FILE__)); // directorio del sitio
	$".$nop."micd['url']		= \"".$_POST['url']."\"; // url del sitio

	// links a otras webs
	$".$nop."micd['links']		= \"".stripslashes($_POST['links'])."\";

	// otras definiciones
	$".$nop."micd['tiempo_real']	= ".stripslashes($_POST['tiempo_real']).";
	$".$nop."micd['tiempo_nuevo']	= ".$_POST['tiempo_nuevo']."; // tiempo en segundos para ser considerado como nuevo un disco

	// valores con los que se calcula el precio si no esta definico
	// precio = precio de 1 disco + precio de cada disco extra * (cantidad - 1)
	$".$nop."micd['precio']['CD'][0] = ".$_POST['precio_cd0'].";
	$".$nop."micd['precio']['CD'][1] = ".$_POST['precio_cd1'].";
	$".$nop."micd['precio']['DVD'][0]= ".$_POST['precio_dvd0'].";
	$".$nop."micd['precio']['DVD'][1]= ".$_POST['precio_dvd1'].";

	// otras definiciones menos relevantes
	$".$nop."micd['tiempo_votos']	= 60; // segundos que se debera esperar para poder volver a votar por un disco
	$".$nop."micd['discos_por_pag'] = 20; // cantidad de discos que se mostraran por pagina en las categorias
	$".$nop."micd['discos_nuevos']	= 20; // los ultimos discos agregados que seran mostrados en la pagina web principal

	// otros archivos a incluir
	require_once($".$nop."micd['dir'].\"/inc/functions.inc.php\");
	require_once($".$nop."micd['dir'].\"/inc/actions.inc.php\");

?>";

 ob_clean();
 header("Content-Type: " . $mime_type);
 header("Content-Disposition: attachment; filename=" . $filename);
 print($buffer);
