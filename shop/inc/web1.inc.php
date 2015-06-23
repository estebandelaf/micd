<?php

 /*************************************************/
 /* ARCHIVO DE ESTRUCTURA DEL SITIO PREVIO        */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 22/02/08                      */
 /*************************************************/
 ob_start();
 require_once("config.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<!--
 Sitio web desarrollado por:
 Esteban De La Fuente, DeLaF
 www.delaf.tk esteban.delaf[at]gmail.com
 Este sitio esta optimizado para Mozilla Firefox.
 Use Software Libre, cámbiese ya!
-->
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo $micd['desc']; ?>" />
		<meta name="keywords" content="<?php echo $micd['desc']; ?>, micd.sytes.net, micd" />
		<meta name="author" content="<?php echo $micd['shop']; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $micd['url']; ?>/../skin/<?php echo $micd['skin']; ?>/skin.css"/>
		<link rel="icon" href="<?php echo $micd['url']; ?>/../favicon.ico" type="image/ico" />
		<link rel="shortcut icon" href="<?php echo $micd['url']; ?>/../favicon.ico" />
		<script type="text/javascript" language="javascript" src="<?php echo $micd['url']; ?>/ajax.js"></script>
		<title><?php echo $micd['website']." - ".$micd['desc']; ?></title>
	</head>
	<body>
		<div id="top">
			<h1>
				<a href="<?php echo $micd['url']."/?shop=".$_GET['shop']; ?>"><?php echo $micd['website']; ?></a>
				<span style="text-align:right;"><?php echo $micd['desc']; ?></span>
			</h1>
		</div>
		<div id="header">
			<div id="menu">
				<ul>
				<?php
					$h=0;
					$sql = $consultasSql->consulta("SELECT id,nombre FROM ".$micd['mysql']['prefix']."categorias ORDER BY nombre ASC");
					while($row = mysql_fetch_array($sql)) {
						$ndiscos = $consultasSql->contar($micd['mysql']['prefix']."discos","cat_id",$row['id']);
						if(isset($_GET['disco_id'])) {
							$sql2 = $consultasSql->consulta("SELECT cat_id FROM ".$micd['mysql']['prefix']."discos WHERE id = '".$consultasSql->proteger($_GET['disco_id'])."'");
							$row2 = mysql_fetch_array($sql2);
							if($row2['cat_id']==$row['id']) $cat_on = 1;
							else $cat_on = 0;
						} else $cat_on = 0;
						echo"\n<li><div><a href=\"".$micd['url']."/categorias.php?shop=".$_GET['shop']."&amp;cat_id=".$row['id']."\""; if(isset($_GET['cat_id']) && $_GET['cat_id']==$row['id'] || $cat_on) echo" id=\"current\""; echo">".$row['nombre']." (".$ndiscos.")</a></div></li>";
						$h++;
						if(!($h%4)) echo"\n</ul><ul>";
					}
				?>
				</ul>
			</div>
		</div>
		<div id="content_left">
