<?php

	/*************************************************/
	/* ARCHIVO QUE MUESTRA LA INFO DE LOS DISCOS     */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 16-02-08                      */
	/*************************************************/

	require("./inc/web1.inc.php");

	$sql = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."discos WHERE id = ".$consultasSql->proteger($_GET['disco_id']));
	$row = mysql_fetch_array($sql);
	$sql2 = $consultasSql->consulta("SELECT nombre FROM ".$micd['mysql']['prefix']."categorias WHERE id = ".$row['cat_id']);
	$row2 = mysql_fetch_array($sql2);
	$sql3 = $consultasSql->consulta("SELECT formato FROM ".$micd['mysql']['prefix']."formatos WHERE id = ".$row['formato']);
	$row3 = mysql_fetch_array($sql3);
	if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
	else $precio = $row['precio'];
	$descripcion = formatear_txt($row['descripcion'],"p",1);
	echo"
		<div id=\"titulo\">".$row2['nombre'].": &quot;".$row['nombre']."&quot;"; if($micd['mod_precios']) echo" - $$precio"; echo"</div>
		<p>
	";
	if($row['caratula']) echo"<a href=\"".$row['caratula']."\"><img src=\"".$row['caratula']."\" alt=\"Imágen del disco\" class=\"caratula\"/></a>";
	echo"
			".$descripcion."
		</p>
		<div id=\"newsitem\">
	";
	if($micd['mod_calificar']) include("./calificacion.php");
	echo"
			<div id=\"title\">Características:</div>
			<div id=\"body\">
				<ul>
	";
	if($row['clasificacion']) echo"<li>Clasificación: ".$row['clasificacion']."</li>";
	echo"
					<li>Tipo de disco: ".$row['tipo_disco']."</li>
					<li>Formato: <a href=\"./formatos.php?shop=".$_GET['shop']."#formato".$row['formato']."\">".$row3['formato']."</a></li>
					<li>Cantidad de discos: ".$row['cantidad']."</li>
	";
	if($micd['mod_precios'])
		echo"<li>Precio: $$precio</li>";
	if($row['mas_info']) echo"<li><a href=\"".$row['mas_info']."\">Información extra</a></li>";
	echo"
					<li>Links: <a href=\"http://www.youtube.com/results?search_query=".$row['nombre']."\">Videos</a> - <a href=\"http://images.google.cl/images?hl=es&amp;q=".$row['nombre']."\">Imágenes</a> - <a href=\"http://www.google.cl/search?hl=es&amp;q=".$row['nombre']."\">Información</a></li>
				</ul>
			</div>
		</div>
	";
	echo"
		<div id=\"clearer\"><span></span></div>
	";
	if($micd['mod_comentar']) include("./comentarios.php");

 require("./inc/web2.inc.php");

?>