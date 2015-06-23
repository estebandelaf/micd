<?php

	require("./inc/web1.inc.php");

	echo"<div id=\"titulo\">Registro de nuevos usuarios/tiendas</div>";
	echo"<p><strong>Registro solo para usuarios que deseen probar el sistema, todavía no esta listo para un uso masivo ni comercial.</strong></p>";

	if(isset($_POST['registrar'])) {
		if($micd['site']['numero_tiendas']==$micd['site']['max_users'] && $micd['site']['max_users']) {
			echo"
				<p>Lo sentimos pero ya se ha alcanzado el máximo de tiendas permitido, o sea ".$micd['site']['numero_tiendas']." tiendas.</p>
				<p>Tienes dos opciones: esperar a que se elimine alguna tienda o esperar a que se aumenten los cupos.</p>
			";
		} else {
			if($_COOKIE['micd_user_reg_ver']==md5($_POST['reg_ver'])) {
				if($_POST['acepto']=="on") {
					if($_POST['email1']==$_POST['email2'] && $_POST['email1']!="" && $_POST['email2']!="" && validar_email($_POST['email1'])) {
						if($_POST['clave1']==$_POST['clave2'] && $_POST['clave1']!="" && $_POST['clave2']!="" && strlen($_POST['clave1'])>=6) {
							if($_POST['usuario']!="" && validar_usuario($_POST['usuario']) && strlen($_POST['usuario'])>=4 && strlen($_POST['usuario'])<=30) {
								// verificar que el el usuario no exista ya en la base de datos
								$usuario = strtolower(proteger_sql($_POST['usuario']));
								$usuario_correcto = $consultasSql->contar($micd['site']['mysql']['prefix']."usuarios","usuario",$usuario);
								if($usuario_correcto!=1) {
									// CREAR TABLAS PARA EL SISTEMA
									$consultasSql->consulta("CREATE TABLE ".$usuario."_categorias (
										id int(11) NOT NULL auto_increment,
										nombre varchar(50) NOT NULL default '',
										img varchar(250) NOT NULL default '',
										PRIMARY KEY  (id)
									) TYPE=MyISAM");
									$consultasSql->consulta("CREATE TABLE ".$usuario."_discos (
										id int(11) NOT NULL auto_increment,
										publicacion int(11) NOT NULL default '0',
										modificacion int(11) NOT NULL default '0',
										tipo_disco char(3) NOT NULL default '0',
										formato int(11) NOT NULL default '0',
										cantidad int(11) NOT NULL default '0',
										caratula blob NOT NULL,
										clasificacion varchar(20) NOT NULL default '',
										nombre varchar(255) NOT NULL default '',
										descripcion text NOT NULL,
										calificacion int(11) NOT NULL default '0',
										nvotos int(11) NOT NULL default '0',
										cat_id int(11) NOT NULL default '0',
										precio int(11) NOT NULL default '0',
										mas_info text NOT NULL,
										PRIMARY KEY  (id),
										FULLTEXT KEY nombre (nombre)
									) TYPE=MyISAM");
									$consultasSql->consulta("CREATE TABLE ".$usuario."_formatos (
										id int(11) NOT NULL auto_increment,
										formato varchar(30) NOT NULL default '',
										descripcion text NOT NULL,
										PRIMARY KEY  (id)
									) TYPE=MyISAM");
									$consultasSql->consulta("CREATE TABLE ".$usuario."_online (
										id int(11) NOT NULL auto_increment,
										sesion_id varchar(32) NOT NULL default '',
										date int(11) NOT NULL default '0',
										ip varchar(15) NOT NULL default '',
										host varchar(250) NOT NULL default '',
										pagina varchar(250) NOT NULL default '',
										PRIMARY KEY  (id)
									) TYPE=MyISAM");
									$consultasSql->consulta("CREATE TABLE ".$usuario."_comentarios (
										id int(11) NOT NULL auto_increment,
										disco_id int(11) NOT NULL default '0',
										publicacion int(11) NOT NULL default '0',
										usuario varchar(30) NOT NULL default '',
										comentario text NOT NULL,
										PRIMARY KEY  (id)
									) TYPE=MyISAM");
									// REGISTRAR NUEVO USUARIO EN EL SISTEMA
									$consultasSql->consulta("INSERT INTO ".$micd['site']['mysql']['prefix']."usuarios (usuario,clave,fecha_registro,email,skin,tiempo_nuevo,tiempo_votos,discos_por_pag,discos_nuevos,p_cd,p_cde,p_dvd,p_dvde,mod_precios,mod_publicidad) VALUES ('$usuario','".md5($_POST['clave1'])."',".$micd['site']['tiempo_real'].",'".proteger_sql($_POST['email1'])."','gemstone',3,60,20,20,1000,500,1200,600,1,1)");
									echo"
										<p>Se ha registrado su tienda <em>$usuario</em> satisfactoriamente, puede acceder a ella mediante la dirección web <a href=\"".$micd['site']['url']."/$usuario\">".$micd['site']['url']."/$usuario</a>.</p>
										<p>Debe acceder al menos antes de una semana desde la fecha de registro al <a href=\"".$micd['site']['url']."/shop/admin/?shop=$usuario\">panel de administración de su tienda</a> para que su cuenta no sea eliminada, una vez en ella podrá realizar el resto de las configuraciones.</p>
									";
								} else echo"<p>El usuario <em>$usuario</em> ya se encuentra registrado, por favor vuelva atrás e inténtelo denuevo.</p>";
							} else echo"<p>El usuario ingresado es incorrecto o bien no se ha ingresado. Solo utilizar letras (a-z, sin ñ ni acentos), números (0-9), guiones (-) y guiones bajos (_), cualquier otro caracter no está permitido. Además debe tener entre 4 y 30 caracteres. Por favor vuelva atrás e inténtelo denuevo, si el problema persiste intente con otro nombre de usuario.</p>";
						} else echo"<p>Las contraseñas no han sido ingresadas correctamente, por favor vuelva atrás e inténtelo denuevo. </p>";
					} else echo"<p>Los email no han sido ingresados correctamente, por favor vuelva atrás e inténtelo denuevo. </p>";
				} else echo"<p>Se deben aceptar los <a href=\"./terminos.php\">términos y condiciones de uso</a> para poder realizar el registro, por favor vuelva atrás e inténtelo denuevo.</p>";
			} else echo"<p>El código de verificación ingresado es incorrecto, por favor vuelva atrás e inténtelo denuevo.</p>";
		}
	} else {
		if($micd['site']['numero_tiendas']<$micd['site']['max_users'] || !$micd['site']['max_users']) {
			echo"
				<p>Bienveni@, gracias por registrarse. Si tiene alguna duda revise los signos de pregunta de cada item.</p>
				<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" onsubmit=\"return validar_registro(this);\">
					<table>
						<tr><td>Usuario ",helpBox("usuario","Este será el nombre de la tienda, su dirección web para ingresar tendrá la forma ".$micd['site']['url']."/usuario Solo utilizar letras (a-z, sin ñ ni acentos), números (0-9), guiones (-) y guiones bajos (_), cualquier otro caracter no está permitido. Además debe tener entre 4 y 30 caracteres."),"</td><td><input type=\"text\" name=\"usuario\" maxlength=\"30\" /></td></tr>
						<tr><td>Email ",helpBox("email","Utilizado como forma de contacto en su tienda, el email se adjunta en la web y en los PDF que se generen. Además será utilizado en caso de requerir restaurar la contraseña. Por esto debe ser un email válido."),"</td><td><input type=\"text\" name=\"email1\" /></td></tr>
						<tr><td>Repetir email</td><td><input type=\"text\" name=\"email2\" /></td></tr>
						<tr><td>Contraseña ",helpBox("clave","Utilizada para acceder a la administración de su tienda, esta debe ser de al menos 6 caracteres."),"</td><td><input type=\"password\" name=\"clave1\" /></td></tr>
						<tr><td>Repetir contraseña</td><td><input type=\"password\" name=\"clave2\" /></td></tr>
						<tr><td>Verificador <img src=\"./reg_ver.php\" alt=\"Código de verificación\" /></td><td><input type=\"text\" name=\"reg_ver\" maxlength=\"4\" /></td></tr>
						<tr><td></td><td><input type=\"checkbox\" name=\"acepto\" /> Acepto los <a href=\"./terminos.php\">términos y condiciones de uso de MiCD</a>.</td></tr>
						<tr><td></td><td><input type=\"submit\" name=\"registrar\" value=\"Registrar\" /></td></tr>
					</table>
				</form>
			";
		} else
			echo"
				<p>Lo sentimos pero ya se ha alcanzado el máximo de tiendas permitido, o sea ".$micd['site']['numero_tiendas']." tiendas.</p>
				<p>Tienes dos opciones: esperar a que se elimine alguna tienda o esperar a que se aumenten los cupos.</p>
			";
	}

	require("./inc/web2.inc.php");

?>
