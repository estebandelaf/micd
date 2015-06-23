<?php

	if((!isset($_GET['shop']) && !isset($_POST['clave']) && !isset($micd)) || (isset($_GET['micd']) || isset($_POST['micd'])))
		header("location: ./errno.php?errno=2&file=".$_SERVER['PHP_SELF']);

	require("./inc/web1.inc.php");

	if($_GET['shop']==$micd['site']['demo']) {
		echo"<div id=\"titulo\">Eliminar tienda/usuario ".$_GET['shop']."</div>";
		echo"<p>La tienda/usuario <em>".$micd['site']['demo']."</em> no se puede eliminar</p>";
	} else {
		$sql = $consultasSql->consulta("SELECT clave FROM ".$micd['site']['mysql']['prefix']."usuarios WHERE usuario = '".$consultasSql-proteger($_GET['shop'])."'");
		if(mysql_num_rows($sql)==1) {
			$row = mysql_fetch_array($sql);
			if($row['clave']==md5($_POST['clave'])) {
				$consultasSql->consulta("DROP TABLE IF EXISTS `".$consultasSql-proteger($_GET['shop'])."_discos`, `".$consultasSql-proteger($_GET['shop'])."_categorias`, `".$consultasSql-proteger($_GET['shop'])."_formatos`, `".$consultasSql-proteger($_GET['shop'])."_online`, `".$consultasSql-proteger($_GET['shop'])."_comentarios`");
				$consultasSql->consulta("DELETE FROM ".$micd['site']['mysql']['prefix']."usuarios WHERE usuario = '".$consultasSql-proteger($_GET['shop'])."'");
				echo"<div id=\"titulo\">Eliminar tienda/usuario ".$_GET['shop']."</div>";
				echo"<p>Su tienda/usuario <em>".$_GET['shop']."</em> ha sido eliminada de nuestra base de datos.</p>";
			} else {
				echo"<div id=\"titulo\">Eliminar tienda/usuario ".$_GET['shop']."</div>";
				echo"<p>La contraseña ingresada es incorrecta, no se eliminó la tienda.</p>";
			}
		} else {
			echo"<div id=\"titulo\">Eliminar tienda/usuario ".$_GET['shop']."</div>";
			echo"<p>La tienda ".$_GET['shop']." no existe.</p>";
		}
	}

	require("./inc/web2.inc.php");

?>
