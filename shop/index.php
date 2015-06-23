<?php

	require("./inc/web1.inc.php");

	echo"<div id=\"titulo\">Bienvenid@, los siguientes son nuestros ".$micd['discos_nuevos']." discos más recientes:</div>";

	if(isset($micd['faltan_datos']))
		echo"<div id=\"box_importante\">Falta completar la información obligatoria de la tienda/usuario. Por favor <a href=\"./admin/config.php?shop=".$_GET['shop']."\">entra a la configuración</a> y completa los campos obligatorios.</div>";

	if($micd['texto_index']) {
		$texto_index = formatear_txt($micd['texto_index'],"p",1);
		echo"<p>$texto_index</p>";
	}

	echo"
		<table width=\"100%\">
			<tr>
				<th class=\"center\">Categoría</th>
				<th>Nombre</th>
				<th></th>
	";
	if($micd['mod_precios'])
		echo"<th class=\"center\">Precio</th>";
	echo"</tr>";
	$sql = $consultasSql->consulta("SELECT id,nombre,caratula,cat_id,cantidad,precio,tipo_disco,clasificacion,publicacion FROM ".$micd['mysql']['prefix']."discos ORDER BY publicacion DESC LIMIT 0,".$micd['discos_nuevos']);
	while($row = mysql_fetch_array($sql)) {
		$sql2 = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."categorias WHERE id = ".$row['cat_id']);
		$row2 = mysql_fetch_array($sql2);
		if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
		else $precio = $row['precio'];
		echo"
			<tr>
				<td class=\"center\"><img src=\"".$row2['img']."\" alt=\"".$row2['nombre']."\" /></td>
				<td><a href=\"./discos.php?shop=".$_GET['shop']."&amp;disco_id=".$row['id']."\">"; if($row['clasificacion']) echo"[".$row['clasificacion']."] "; echo $row['nombre']."</a> "; if($row['publicacion']>($micd['tiempo_real']-$micd['tiempo_nuevo'])) echo"<img src=\"./images/new.gif\" alt=\"Disco nuevo\" />"; echo"</td>
				<td class=\"center\">"; if($row['caratula']) echo"<img src=\"".$row['caratula']."\" alt=\"Imágen del disco\" style=\"max-height: 36px;\" />"; echo"</td>
		";
		if($micd['mod_precios'])
			echo"<td class=\"center\">$$precio</td>";
		echo"</tr>";
	}

	echo"</table>";

	require("./inc/web2.inc.php");

?>