<?php

	/*************************************************/
	/* LEER CONFIGURACION DEL USUARIO DESDE MYSQL    */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 15-02-08                      */
	/*************************************************/

	$sql = $consultasSql->consulta("SELECT * FROM ".$micd['site']['mysql']['prefix']."usuarios WHERE usuario = '".$consultasSql->proteger($_GET['shop'])."'");
	$row = mysql_fetch_array($sql);

	// configuracion general del sitio web
	$micd['website']	= $row['tienda']; // nombre del sitio web
	$micd['desc']		= $row['descripcion']; // descripcion del sitio web
	$micd['skin']		= $row['skin']; // skin o style para el sitio, nombre de la carpeta dentro de skin

	// configuracion del administrador y contacto
	$micd['shop']		= $_GET['shop']; // usuario/tienda que sera usado para el ingreso a opciones de administracion, ademas se usa siempre que se necesite el nombre de la tienda
	$micd['clave']		= $row['clave']; // clave del administrador del sitio encriptada con md5
	$micd['email']		= $row['email']; // correo electronico del administrador
	$micd['telefono']	= $row['telefono']; // telefono de contacto del administrador
	$micd['direccion']	= $row['direccion']; // direccion fisica o ubicacion
	$micd['ciudad']	= $row['ciudad']; // ciudad
	$micd['region']	= $row['region']; // region

	// otras definiciones
	$micd['offset_hora']		= $row['offset_hora'];
	$micd['tiempo_real']		= date("U") + $micd['offset_hora']*60; // tiempo con los debidos ajustes en caso de ser necesarios
	$micd['tiempo_nuevo_dias']	= $row['tiempo_nuevo']; // tiempo en dias para ser considerado como nuevo un disco
	$micd['tiempo_nuevo']	= $micd['tiempo_nuevo_dias']*3600*24; // tiempo en segundos para ser considerado como nuevo un disco
	$micd['tiempo_votos']	= $row['tiempo_votos']; // segundos que se debera esperar para poder volver a votar por un disco
	$micd['discos_por_pag']	= $row['discos_por_pag']; // cantidad de discos que se mostraran por pagina en las categorias
	$micd['discos_nuevos']	= $row['discos_nuevos']; // los ultimos discos agregados que seran mostrados en la pagina web principal
	$micd['links']		= $row['links'];	// links a otras webs

	// textos para agregar en el sitio
	$micd['texto_index']		= $row['texto_index'];
	$micd['texto_menu_titulo']	= $row['texto_menu_titulo'];
	$micd['texto_menu']		= $row['texto_menu'];

	// valores con los que se calcula el precio si no esta definico
	// precio = precio de 1 disco + precio de cada disco extra * (cantidad - 1)
	$micd['precio']['CD'][0]	= $row['p_cd'];
	$micd['precio']['CD'][1]	= $row['p_cde'];
	$micd['precio']['DVD'][0]	= $row['p_dvd'];
	$micd['precio']['DVD'][1]	= $row['p_dvde'];

	// modulos activos
	$micd['mod_calificar']	= $row['mod_calificar'];
	$micd['mod_comentar']	= $row['mod_comentar'];
	$micd['mod_precios']		= $row['mod_precios'];
	$micd['mod_publicidad']	= $row['mod_publicidad'];

	// si los datos obligatorios no estan completos mostrar un mensaje de advertencia
	if( (!$micd['website'] || !$micd['desc'] || !$micd['skin'] || !$micd['email'] || !$micd['region'] || !$micd['tiempo_nuevo'] || !$micd['tiempo_votos'] || !$micd['discos_por_pag'] || !$micd['discos_nuevos'] || !$micd['precio']['CD'][0] || !$micd['precio']['CD'][1] || !$micd['precio']['DVD'][0] || !$micd['precio']['DVD'][1]))
		$micd['faltan_datos'] = 1;

?>