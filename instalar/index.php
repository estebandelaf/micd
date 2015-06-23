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
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="MiCD: instalador del sistema de administracion de discos" />
		<meta name="keywords" content="MiCD" />
		<meta name="author" content="DeLaF" />
		<link rel="stylesheet" type="text/css" href="./skin.css"/>
		<link rel="icon" href="./../favicon.ico" type="image/ico" />
		<link rel="shortcut icon" href="./../favicon.ico" />
		<title>&laquo;&laquo;&laquo; MiCD Instalador &raquo;&raquo;&raquo;</title>
	</head>
	<body>
		<h1>&laquo;&laquo;&laquo; MiCD Instalador &raquo;&raquo;&raquo;</h1>
		<p>
			<a href="http://mi.delaf.cl/micd"><img src="./../images/micd.png" alt="Logo MiCD" style="float: right; margin-left: 10px; border: 0px;" /></a>
			Bienvenid@, este asistente le ayudará a dejar funcionando el sistema de administración de discos MiCD en su sitio web.
			Por favor complete todos los campos marcados con un asterisco, estos son obligatorios para el correcto funcionamiento del sistema.
		</p>
		<p>Una vez haga click en instalar se generará un archivo <em>config.inc.php</em> que deberá copiar dentro de la carpeta ./inc de la aplicación. Una vez instalado el sistema NO utilice nuevamente este asistente y borre la carpeta ./instalar de su sitio web.</p>
		<p>Si desea información de la aplicación, alguna aclaración de como funciona o que es cada elemento por favor revisar el archivo <em>README</em>.</p>
		<form action="./instalar.php" method="post">
			<table>
				<tr><th style="width: 140px;"></th><th>Información general del sitio</th></tr>
				<tr><td>Nombre del sitio *</td><td><input type="text" name="website" size="53"/></td></tr>
				<tr><td>Descripción</td><td><input type="text" name="desc" size="53"/></td></tr>
				<tr><td>Skin *</td><td><input type="text" name="skin" size="53" value="gemstone" /></td><td>skin o style para el sitio, nombre de la carpeta dentro de <em>skin</em></td></tr>
				<tr><td>URL *</td><td><input type="text" name="url" size="53" value="<?php echo str_replace("/instalar/","","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>"/></td><td>dirección real donde se encuntra el sitio web</td></tr>
				<tr><th></th><th>Administrador y contacto</th></tr>
				<tr><td>Usuario *</td><td><input type="text" name="admin" size="53"/></td><td>usuario que sera usado para el ingreso a opciones de administracion</td></tr>
				<tr><td>Contraseña *</td><td><input type="password" name="clave" size="53"/></td></tr>
				<tr><td>Email *</td><td><input type="text" name="email" size="53"/></td></tr>
				<tr><td>Teléfono</td><td><input type="text" name="telefono" size="53"/></td></tr>
				<tr><td>Dirección</td><td><input type="text" name="direccion" size="53"/></td></tr>
				<tr><th></th><th>Base de datos MySQL en localhost</th></tr>
				<tr><td>Nombre *</td><td><input type="text" name="db_name" size="53"/></td></tr>
				<tr><td>Usuario *</td><td><input type="text" name="db_user" size="53"/></td></tr>
				<tr><td>Contraseña *</td><td><input type="password" name="db_password" size="53"/></td></tr>
				<tr><td>Prefijo *</td><td><input type="text" name="db_prefix" size="53" value="micd_" /></td><td>ayuda a mantener un orden en la base de datos si comparte con otras aplicaciones</td></tr>
				<tr><th></th><th>Otras definiciones</th></tr>
				<tr><td>Tiempo real *</td><td><input type="text" name="tiempo_real" size="53" value="date('U')"/></td><td>calculo de la hora a partir de la funcion date, agregar modificacion si es necesaria</td></tr>
				<tr><td>Tiempo nuevo *</td><td><input type="text" name="tiempo_nuevo" size="53" value="3600*72" /></td><td>tiempo en segundos para ser considerado como nuevo un disco</td></tr>
				<tr><td>Links</td><td><textarea name="links" rows="4" cols="40"></textarea></td><td>agregar links usando HTML, solo etiqueta <em>a</em> y comillas simples</td></tr>
				<tr><th></th><th>Precio de los discos</th></tr>
				<tr><td>CD *</td><td><input type="text" name="precio_cd0" size="53"/></td><td>precio si se vende un cd</td></tr>
				<tr><td>CD extra *</td><td><input type="text" name="precio_cd1" size="53"/></td><td>precio por cada cd extra que se venda (usado por ejemplo si un programa viene en 2 CD)</td></tr>
				<tr><td>DVD *</td><td><input type="text" name="precio_dvd0" size="53"/></td><td>idem que los cd</td></tr>
				<tr><td>DVD extra *</td><td><input type="text" name="precio_dvd1" size="53"/></td><td>idem que los cd</td></tr>
				<tr><td></td><td><input type="submit" name="instalar" value="Instalar" /></td></tr>
			</table>
		</form>
		<hr />
		<p>
			<a href="http://micd.sytes.net">MiCD 2008 vBeta</a>:
			Programmed by <a href="http://www.delaf.tk">DeLaF</a> -
			<a href="http://validator.w3.org/check?uri=referer">xhtml</a> &amp; <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">css</a>
		</p>
	</body>
</html>
