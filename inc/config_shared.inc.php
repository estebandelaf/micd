<?php

	/*************************************************/
	/* CONFIGURACIONES COMPARTIDAS CON LA TIENDA     */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 15/02/08                      */
	/*************************************************/

	// muestra/oculta errores PHP
	ini_set("display_errors", FALSE); // TRUE=mostrar o FALSE=ocultar
	error_reporting(0); // E_ALL=mostrar o 0=ocultar

	// datos de conexion a la base de datos
	$micd['mysql']['dataBase']		= "micd"; // nombre de la base de datos mysql
	$micd['mysql']['user']			= "micd"; // usuario de la base de datos mysql
	$micd['mysql']['password']		= "micd"; // contrasenia para la base de datos mysql
	$micd['mysql']['server']		= "localhost"; // servidor de la base de datos mysql
	$micd['site']['mysql']['prefix']	= ""; // prefijo para campos de la base de datos

	// archivos navegables
	$micd['site']['archivos_navegables']    = ['buscar', 'ayuda', 'registro', 'terminos', 'legal', 'sobre', 'servicio', 'publicidad', 'tiendas', 'mas_buscado'];
	$micd['site']['max_users']              = 2;

	// ubicacion del sitio web
	$micd['site']['dir']	 		= dirname(dirname(__FILE__)); // directorio del sitio
	$micd['site']['url']			= "http://mi.delaf.cl/micd"; // url del sitio

	// otras variables
	$micd['site']['demo']			= "demo"; // nombre de la tienda de pruebas
	$micd['site']['lang']['default']	= "es"; // idioma por defecto para el sitio
	$micd['site']['tiempo_real']            = $micd['tiempo_real'];

	// string no permitidos en variables que van a la base de datos mysql
	$micd['site']['proteger_sql'] = array("--",";","SELECT","OR","AND","LIKE","DROP","USE","TABLE","UNION","FROM","WHERE","LIMIT","MIN");

	// regiones de chile
	$micd['regiones_chile'] = array(
		array(15,"Arica y Parinacota"),
		array(1,"Tarapacá"),
		array(2,"Antofagasta"),
		array(3,"Atacama"),
		array(4,"Coquimbo"),
		array(5,"Valparaíso"),
		array(6,"El Libertador General Bernardo O'Higgins"),
		array(7,"El Maule"),
		array(8,"El Bio bío"),
		array(9,"La Araucanía"),
		array(14,"Los Ríos"),
		array(10,"Los Lagos"),
		array(11,"Aisén del General Carlos Ibáñez del Campo"),
		array(12,"Magallanes y la Antártica Chilena"),
		array(13,"Metropolitana de Santiago")
	);

	// salto de linea
	$eol = "\n\r";

	// tabulaciones
	$tab2 = "\t\t";
	$tab3 = "\t\t\t";
	$tab4 = "\t\t\t\t";
	$tab5 = "\t\t\t\t\t";
	$tab6 = "\t\t\t\t\t\t";
	$tab7 = "\t\t\t\t\t\t\t";
	$tab8 = "\t\t\t\t\t\t\t\t";

?>
