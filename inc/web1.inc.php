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
		<meta name="description" content="<?php echo $micd['site']['lang']['descripcion']; ?>" />
		<meta name="keywords" content="cd, dvd, micd, <?php echo str_replace(".php","",$parametros); ?>" />
		<meta name="author" content="DeLaF" />
		<link rel="stylesheet" type="text/css" href="<?php echo $micd['site']['url']; ?>/skin/gemstone/skin.css"/>
		<link rel="icon" href="<?php echo $micd['site']['url']; ?>/favicon.ico" type="image/ico" />
		<link rel="shortcut icon" href="<?php echo $micd['site']['url']; ?>/favicon.ico" />
		<script type="text/javascript" language="javascript" src="<?php echo $micd['site']['url']; ?>/ajax.js"></script>
		<title>&laquo;&laquo;&laquo; MiCD &raquo;&raquo;&raquo;</title>
	</head>
	<body>
		<div id="top">
			<h1>
				<a href="<?php echo $micd['site']['url']; ?>/">&laquo;&laquo;&laquo; MiCD &raquo;&raquo;&raquo;</a>
				<span style="text-align:right;"><?php echo $micd['site']['lang']['descripcion']; ?></span>
			</h1>
		</div>
		<div id="header">
			<div id="menu">
				<?php
					echo '<ul>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/"'; if(!$parametros) echo ' id="current"'; echo '>',$micd['site']['lang']['menu']['index'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/registro.php"'; if($parametros=="registro.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['registro'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/sobre.php"'; if($parametros=="sobre.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['sobre'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/tiendas.php"'; if($parametros=="tiendas.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['tiendas'],'</a></div></li>',$eol;
					echo $tab4,'</ul>',$eol;
					echo $tab4,'<ul>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/buscar.php"'; if($parametros=="buscar.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['buscar'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/terminos.php"'; if($parametros=="terminos.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['terminos'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/servicio.php"'; if($parametros=="servicio.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['servicio'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/mas_buscado.php"'; if($parametros=="mas_buscado.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['mas_buscado'],'</a></div></li>',$eol;
					echo $tab4,'</ul>',$eol;
					echo $tab4,'<ul>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/ayuda.php"'; if($parametros=="ayuda.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['ayuda'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/legal.php"'; if($parametros=="legal.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['legal'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="',$micd['site']['url'],'/publicidad.php"'; if($parametros=="publicidad.php" && $parametros) echo 'id="current"'; echo'>',$micd['site']['lang']['menu']['publicidad'],'</a></div></li>',$eol;
					echo $tab5,'<li><div><a href="http://www.sasco.cl">Powered by SASCO</a></div></li>',$eol;
					echo $tab4,'</ul>',$eol;
				?>
			</div>
		</div>
		<div id="content_left">
