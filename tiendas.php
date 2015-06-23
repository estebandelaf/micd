<?php

	require("./inc/web1.inc.php");

	echo"<div id=\"titulo\">Tiendas</div>";

	$sql = $consultasSql->consulta("SELECT usuario,fecha_registro,tienda,descripcion FROM ".$micd['site']['mysql']['prefix']."usuarios ORDER BY fecha_registro DESC");
	if(mysql_num_rows($sql)>1) {
		echo"
			<p>Tiendas en nuestra base de datos:</p>
			<ul class=\"lista\"
		";
		while($row = mysql_fetch_array($sql)) {
			if($row['usuario']!=$micd['site']['demo'] && $row['tienda']!="" && $row['descripcion']!="")
			echo"
				<li><strong><a href=\"./".$row['usuario']."\">".$row['tienda']."</a></strong>: ".$row['descripcion'].".</li>
			";
		}
		echo"
			</ul>
			<p>Puedes visitar la tienda <a href=\"./".$micd['site']['demo']."\">".$micd['site']['demo']."</a>, con ella apreciarás como funciona el sistema, la clave de acceso para la administración es micd.</p>
		";
	} else echo"<p>No hay tiendas registradas, solo tenemos la tienda <a href=\"./".$micd['site']['demo']."\">".$micd['site']['demo']."</a>, con ella apreciarás como funciona el sistema, la clave de acceso para la administración es micd.</p>";


	require("./inc/web2.inc.php");

?>