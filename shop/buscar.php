<?php

 /*************************************************/
 /* ARCHIVO PARA REALIZAR LAS BUSQUEDAS           */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 16-02-08                      */
 /*************************************************/

 require("./inc/web1.inc.php");

?>

<div id="titulo">Búsqueda</div>
<?php
	if(isset($_POST['palabra_clave']) && strlen($_POST['palabra_clave'])>3) {
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
		$sql = $consultasSql->consulta("SELECT id,nombre,caratula,cat_id,cantidad,precio,tipo_disco,clasificacion,publicacion FROM ".$micd['mysql']['prefix']."discos WHERE MATCH(nombre) AGAINST ('".$consultasSql->proteger($_POST['palabra_clave'])."')");
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
	} else {
			echo"<p><strong>Error</strong>: Debe ingresar una palabra de más de 4 caracteres.</p>";
	}
?>

<?php require("./inc/web2.inc.php"); ?>