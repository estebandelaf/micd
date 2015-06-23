<?php

 /*************************************************/
 /* ARCHIVO QUE LISTA LOS DISCOS POR CATEGORIAS   */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 16-02-08                      */
 /*************************************************/

	require("./inc/web1.inc.php");

	$sql = $consultasSql->consulta("SELECT nombre FROM ".$micd['mysql']['prefix']."categorias WHERE id = ".$consultasSql->proteger($_GET['cat_id']));
	$row = mysql_fetch_array($sql);
	echo"<div id=\"titulo\">Listado de CD/DVD en la categoría ".$row['nombre']."</div>";
	$categoria = $row['nombre'];

	if(!isset($_GET['pag'])) $pag = 1;
	else $pag = $_GET['pag'];
	$ndiscos = $consultasSql->contar($micd['mysql']['prefix']."discos","cat_id",$consultasSql->proteger($_GET['cat_id']));
	$npag = ceil($ndiscos/$micd['discos_por_pag']); // redondea siempre hacia arriba
	echo"<p>pág: ";
	for($i=1;$i<=$npag;$i++)
		if($pag!=$i) echo"<a href=\"".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;cat_id=".$_GET['cat_id']."&amp;pag=$i\">$i</a> ";
		else echo"$i ";
	echo"
		</p>
		<table width=\"100%\">
			<tr>
				<th class=\"center\">Categoría</th>
				<th>Nombre</th>
				<th></th>
	";
	if($micd['mod_precios'])
		echo"<th class=\"center\">Precio</th>";
	echo"</tr>";
	$contador=1;
	$sql = $consultasSql->consulta("SELECT id,nombre,caratula,cat_id,cantidad,precio,tipo_disco,clasificacion,publicacion FROM ".$micd['mysql']['prefix']."discos WHERE cat_id = ".$consultasSql->proteger($_GET['cat_id'])." ORDER BY publicacion DESC LIMIT ".($pag * $micd['discos_por_pag'] - $micd['discos_por_pag']).",".$micd['discos_por_pag']);
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
	echo"</table><p>pág: ";
	for($i=1;$i<=$npag;$i++)
		if($pag!=$i) echo"<a href=\"".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;cat_id=".$_GET['cat_id']."&amp;pag=$i\">$i</a> ";
		else echo"$i ";
	echo"</p>";

	require("./inc/web2.inc.php");

?>