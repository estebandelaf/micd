<?php

	require("./inc/web1.inc.php");

	echo $tab3,'<div id="titulo">Búsqueda en todas las tiendas</div>',$eol;
	
	if(isset($_POST['palabra_clave']) && strlen($_POST['palabra_clave'])>3) {
		echo"
			<table width=\"100%\">
				<tr>
					<th class=\"center\">Tienda</th>
					<th>Disco</th>
					<th></th>
					<th class=\"center\">Precio</th>
				</tr>
		";
		$sql2 = $consultasSql->consulta("SELECT usuario,p_cd,p_cde,p_dvd,p_dvde,tiempo_nuevo,mod_precios,region FROM ".$micd['site']['mysql']['prefix']."usuarios ORDER BY ult_login DESC");
		while($row2 = mysql_fetch_array($sql2)) {
			$sql = $consultasSql->consulta("SELECT id,nombre,caratula,cantidad,precio,tipo_disco,clasificacion,publicacion FROM ".$row2['usuario']."_discos WHERE MATCH(nombre) AGAINST ('".$consultasSql->proteger($_POST['palabra_clave'])."')");
			while($row = mysql_fetch_array($sql)) {
				$micd['precio']['CD'][0]	= $row2['p_cd'];
				$micd['precio']['CD'][1]	= $row2['p_cde'];
				$micd['precio']['DVD'][0]	= $row2['p_dvd'];
				$micd['precio']['DVD'][1]	= $row2['p_dvde'];
				if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
				else $precio = $row['precio'];
				echo"
					<tr>
						<td class=\"center\"><a href=\"./".$row2['usuario']."\">".$row2['usuario']."</a></td>
						<td><a href=\"./shop/discos.php?shop=".$row2['usuario']."&amp;disco_id=".$row['id']."\">"; if($row['clasificacion']) echo"[".$row['clasificacion']."] "; echo $row['nombre']."</a> "; if($row['publicacion']>($micd['site']['tiempo_real']-($row2['tiempo_nuevo']*3600*24))) echo"<img src=\"./shop/images/new.gif\" alt=\"Disco nuevo\" />"; echo"<br />Región: ".obtener_region($row2['region'])."</td>
						<td class=\"center\">"; if($row['caratula']) echo"<img src=\"".$row['caratula']."\" alt=\"Imágen del disco\" style=\"max-height: 36px;\" />"; echo"</td>
						<td class=\"center\">
				";
				if($row2['mod_precios']) echo"$$precio";
				else echo"oculto";
				echo"
						</td>
					</tr>
				";
			}
		}
		echo"</table>";
	} else {
			echo"<p><strong>Error</strong>: Debes ingresar una palabra de más de 4 caracteres.</p>";
	}

	require("./inc/web2.inc.php");

?>