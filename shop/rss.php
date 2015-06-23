<?php

 /*************************************************/
 /* ARCHIVO PARA CREAR FEED DE SINDICACION        */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 16-02-08                      */
 /*************************************************/

	require "./inc/config.inc.php";
	header('Content-Type: text/xml');

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
	echo"
	<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">
		<channel>
			<title>".$micd['website']."</title>
			<link>".$micd['url']."/rss/discos.php</link>
			<description>".$micd['desc']."</description>
			<language>es-CL</language>
			<image>
				<url>".$micd['url']."/images/micd.jpg</url>
				<title>".$micd['desc']."</title>
				<link>".$micd['url']."</link>
			</image>
		</channel>
	";

	$sql = $consultasSql->consulta("SELECT id,nombre,caratula,cat_id,cantidad,precio,tipo_disco,clasificacion,publicacion FROM ".$micd['mysql']['prefix']."discos ORDER BY publicacion DESC LIMIT 0,".$micd['discos_nuevos']);
	while ($row = mysql_fetch_array($sql)) {
		$sql2 = $consultasSql->consulta("SELECT nombre FROM ".$micd['mysql']['prefix']."categorias WHERE id = ".$row['cat_id']);
		$row2 = mysql_fetch_array($sql2);
		$fecha = date("d-m-Y",$row['publicacion']);
		if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
		else $precio = $row['precio'];
		echo"
		<item>
			<title>".$row2['nombre'].": "; if($row['clasificacion']) echo"[".$row['clasificacion']."] "; echo $row['nombre']; if($micd['mod_precios']) echo" - $$precio"; echo"</title>
			<link>".$micd['url']."/discos.php?disco_id=".$row['id']."</link>
			<description>
				&lt;img src=&quot;".$row['caratula']."&quot; alt=&quot;".$row['nombre']."&quot; width=&quot;115px&quot; /&gt;
				&lt;br /&gt; Agregado el $fecha
				&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;
			</description>
		</item>
		";
	}

	echo"
	</rss>
	";
 
  $consultasSql->cerrar();
 
?>