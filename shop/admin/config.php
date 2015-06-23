<?php

	/*************************************************/
	/* ARCHIVO DE CONFIGURACION DE CONFIG            */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 16-02-08                      */
	/*************************************************/

	require_once("./../inc/web1.inc.php");

	if(!$login) {
		echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./../errno.php?shop=".$_GET['shop']."&amp;errno=4'>";
	} else {
		if(isset($_POST['editar'])) {
			if(($_GET['shop']==$_SESSION['shop'])&&($micd['clave']==md5($_POST['clave']))) {
				$mod_calificar = (isset($_POST['mod_calificar']) && $_POST['mod_calificar']=="on") ? 1 : 0;
				$mod_comentar = (isset($_POST['mod_comentar']) && $_POST['mod_comentar']=="on") ? 1 : 0;
				$mod_precios = (isset($_POST['mod_precios']) && $_POST['mod_precios']=="on") ? 1 : 0;
				$consultasSql->consulta("UPDATE ".$micd['site']['mysql']['prefix']."usuarios SET tienda = '".$consultasSql->proteger($_POST['website'])."', descripcion = '".$consultasSql->proteger($_POST['desc'])."', skin = '".$consultasSql->proteger($_POST['skin'])."', email = '".$consultasSql->proteger($_POST['email'])."', telefono = '".$consultasSql->proteger($_POST['telefono'])."', direccion = '".$consultasSql->proteger($_POST['direccion'])."', ciudad = '".$consultasSql->proteger($_POST['ciudad'])."', region = '".$consultasSql->proteger($_POST['region'])."', links = '".$consultasSql->proteger($_POST['links'])."', p_cd = '".$consultasSql->proteger($_POST['p_cd'])."', p_cde = '".$consultasSql->proteger($_POST['p_cde'])."', p_dvd = '".$consultasSql->proteger($_POST['p_dvd'])."', p_dvde = '".$consultasSql->proteger($_POST['p_dvde'])."', offset_hora = '".$consultasSql->proteger($_POST['offset_hora'])."', tiempo_nuevo = '".$consultasSql->proteger($_POST['tiempo_nuevo'])."', tiempo_votos = '".$consultasSql->proteger($_POST['tiempo_votos'])."', discos_por_pag = '".$consultasSql->proteger($_POST['discos_por_pag'])."', discos_nuevos = '".$consultasSql->proteger($_POST['discos_nuevos'])."', mod_calificar = '$mod_calificar', mod_comentar = '$mod_comentar', mod_precios = '$mod_precios', texto_index = '".$consultasSql->proteger($_POST['texto_index'])."', texto_menu_titulo = '".$consultasSql->proteger($_POST['texto_menu_titulo'])."', texto_menu = '".$consultasSql->proteger($_POST['texto_menu'])."' WHERE usuario = '".$consultasSql->proteger($_SESSION['shop'])."'");
				echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
			} else
				echo"
					<div id=\"titulo\">Modificar configuración para tienda/usuario ".$_GET['shop']." a tenido un error</div>
					<p>Se ha detectado un problema al editar su configuración, lo más seguro que corresponda a un error con su contraseña. Vuelva atrás e inténtelo denuevo.</p>
				";
		} else {
			if(isset($_POST['cambiar_clave'])) {
				if($_GET['shop']==$micd['site']['demo']) {
						echo"
							<div id=\"titulo\">Modificar clave para tienda/usuario ".$_GET['shop']." a tenido un error</div>
							<p>La contraseña para la tienda/usuario <em>".$micd['site']['demo']."</em> no se puede cambiar.</p>
						";
				} else {
					if($micd['clave']==md5($_POST['clave'])) {
						if($_POST['clave1']==$_POST['clave2'] && strlen($_POST['clave1'])>=6) {
							$consultasSql->consulta("UPDATE ".$micd['site']['mysql']['prefix']."usuarios SET clave = '".md5($_POST['clave1'])."' WHERE usuario = '".$consultasSql->proteger($_SESSION['shop'])."'");
							echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./?shop=".$_GET['shop']."'>";
						} else {
							echo"
								<div id=\"titulo\">Modificar clave para tienda/usuario ".$_GET['shop']." a tenido un error</div>
								<p>Las contraseñas nuevas no son iguales o bien tienen menos de 6 caracteres.</p>
							";
						}
					} else {
						echo"
							<div id=\"titulo\">Modificar clave para tienda/usuario ".$_GET['shop']." a tenido un error</div>
							<p>La contraseña actual ingresada es incorrecta. Vuelva atrás e inténtelo denuevo.</p>
						";
					}
				}
			} else {
				echo"
					<div id=\"titulo\">Modificar configuración para tienda/usuario ".$_GET['shop']."</div>
					<p>Los campos con asterisco son obligatorios.</p>
					<form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_config(this);\">
						<table>
							<tr><td>Nombre tienda *</td><td><input type=\"text\" name=\"website\" value=\"".$micd['website']."\" size=\"30\" maxlength=\"100\" /></td></tr>
							<tr><td>Descripción *</td><td><input type=\"text\" name=\"desc\" value=\"".$micd['desc']."\" size=\"30\" maxlength=\"250\" /></td></tr>
							<tr><td>Skin *</td><td><input type=\"text\" name=\"skin\" value=\"".$micd['skin']."\" size=\"30\" maxlength=\"10\" readonly/> único skin por el momento</td></tr>
							<tr><td>Email *</td><td><input type=\"text\" name=\"email\" value=\"".$micd['email']."\" size=\"30\" maxlength=\"250\" /></td></tr>
							<tr><td>Telefono</td><td><input type=\"text\" name=\"telefono\" value=\"".$micd['telefono']."\" size=\"30\" maxlength=\"30\" /></td></tr>
							<tr><td>Direccion</td><td><input type=\"text\" name=\"direccion\" value=\"".$micd['direccion']."\" size=\"30\" maxlength=\"250\" /></td></tr>
							<tr><td>Ciudad</td><td><input type=\"text\" name=\"ciudad\" value=\"".$micd['ciudad']."\" size=\"30\" maxlength=\"50\" /></td></tr>
							<tr><td>Región *</td><td>
								<select tabindex='1' name='region' style='width: 206px;'>
									<option value=''>Selecciona tu región</option>
							";
							for($i=0;$i<count($micd['regiones_chile']);$i++){
									echo"<option value='".$micd['regiones_chile'][$i][0]."' "; if($micd['regiones_chile'][$i][0]==$micd['region']) echo" selected='selected'"; echo">".$micd['regiones_chile'][$i][1]."</option>";
							}
							echo"
								</select>
							</td></tr>
							<tr><td>Offset hora ",helpBox("help_offset_hora","Minutos que se deben sumar o restar a la hora ".date("H:i")." para que sea correcta."),"</td><td><input type=\"text\" name=\"offset_hora\" value=\"".$micd['offset_hora']."\" size=\"30\" /> minutos</td></tr>
							<tr><td>Timeout discos nuevos *</td><td><input type=\"text\" name=\"tiempo_nuevo\" value=\"".$micd['tiempo_nuevo_dias']."\" size=\"30\" /> días</td></tr>
							<tr><td>Timeout para volver a votar *</td><td><input type=\"text\" name=\"tiempo_votos\" value=\"".$micd['tiempo_votos']."\" size=\"30\" /> segundos</td></tr>
							<tr><td>Discos por pág *</td><td><input type=\"text\" name=\"discos_por_pag\" value=\"".$micd['discos_por_pag']."\" size=\"30\" /></td></tr>
							<tr><td>Discos en portada *</td><td><input type=\"text\" name=\"discos_nuevos\" value=\"".$micd['discos_nuevos']."\" size=\"30\" /> últimos discos</td></tr>
							<tr><td>Precio CD unitario *</td><td><input type=\"text\" name=\"p_cd\" value=\"".$micd['precio']['CD'][0]."\" size=\"30\" /> pesos chilenos</td></tr>
							<tr><td>Precio CD extra *</td><td><input type=\"text\" name=\"p_cde\" value=\"".$micd['precio']['CD'][1]."\" size=\"30\" /> pesos chilenos</td></tr>
							<tr><td>Precio DVD unitario *</td><td><input type=\"text\" name=\"p_dvd\" value=\"".$micd['precio']['DVD'][0]."\" size=\"30\" /> pesos chilenos</td></tr>
							<tr><td>Precio DVD extra *</td><td><input type=\"text\" name=\"p_dvde\" value=\"".$micd['precio']['DVD'][1]."\" size=\"30\" /> pesos chilenos</td></tr>
							<tr><td>Módulo precios</td><td><input type=\"checkbox\" name=\"mod_precios\""; if($micd['mod_precios']) echo" checked"; echo" /> ¿mostrar precios de discos?</td></tr>
							<tr><td>Módulo calificaciones</td><td><input type=\"checkbox\" name=\"mod_calificar\""; if($micd['mod_calificar']) echo" checked"; echo" /> ¿activar calificaciones de discos?</td></tr>
							<tr><td>Módulo comentarios</td><td><input type=\"checkbox\" name=\"mod_comentar\""; if($micd['mod_comentar']) echo" checked"; echo" /> ¿activar comentarios de discos?</td></tr>
							<tr><td>Texto portada ",helpBox("help_texto_portada","Este texto aparecerá sobre los últimos discos en la portada.<br />Utilizar código HTML: saltos de línea automáticos."),"</td><td><textarea name=\"texto_index\" rows='5' cols='42'>".$micd['texto_index']."</textarea></td></tr>
							<tr><td>Título texto menú</td><td><input type=\"text\" name=\"texto_menu_titulo\" value=\"".$micd['texto_menu_titulo']."\" size=\"30\" maxlength=\"40\" /></td></tr>
							<tr><td>Texto menú ",helpBox("help_texto_menu_titulo","Este texto aparecerá sobre el formulario de búsqueda.<br />Utilizar código HTML: saltos de línea automáticos."),"</td><td><textarea name=\"texto_menu\" rows='5' cols='42'>".$micd['texto_menu']."</textarea></td></tr>
							<tr><td>Links ",helpBox("help_links","Utilizar código HTML."),"</td><td><textarea name=\"links\" rows='5' cols='42'>".$micd['links']."</textarea></td></tr>
							<tr><td>Contraseña *</td><td><input type=\"password\" name=\"clave\" /></td></tr>
							<tr><td></td><td><input type=\"submit\" name=\"editar\" value=\"Editar configuración\" /></td></tr>
						</table>
					</form>
					<div class=\"title\">Modificar contraseña</div>
					<form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_cambiar_clave(this);\">
						<table>
							<tr><td>Contraseña actual</td><td><input type=\"password\" name=\"clave\" /></td></tr>
							<tr><td>Contraseña nueva</td><td><input type=\"password\" name=\"clave1\" /></td></tr>
							<tr><td>Repetir contraseña</td><td><input type=\"password\" name=\"clave2\" /></td></tr>
							<tr><td></td><td><input type=\"submit\" name=\"cambiar_clave\" value=\"Cambiar contraseña\" /></td></tr>
						</table>
					</form>
					<div class=\"title\">Eliminar usuario/tienda</div>
					<form action='".$micd['site']['url']."/eliminar.php?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_eliminar_tienda(this);\">
						<p>
							Contraseña actual <input type=\"password\" name=\"clave\" />
							<input type=\"hidden\" name=\"shop\" value=\"".$_GET['shop']."\" />
							<input type=\"submit\" name=\"cambiar_clave\" value=\"Eliminar\" />
						</p>
					</form>
				";
			}
		}
	}

	require_once("./../inc/web2.inc.php");

?>
