<?php

	/*************************************************/
	/* MODULO PARA LOS COMENTARIOS DE LOS DISCOS     */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 13-02-08                      */
	/*************************************************/

	if((!isset($_GET['eliminar']) && !isset($_POST['submit']) && !isset($micd)) || (isset($_GET['micd']) || isset($_POST['micd'])))
		header("location: ./../errno.php?errno=2&file=".$_SERVER['PHP_SELF']);

	if(!isset($_GET['eliminar'])) {
		if(isset($_POST['submit'])) {
			require_once("./inc/config.inc.php");
			$consultasSql->consulta("INSERT INTO ".$micd['mysql']['prefix']."comentarios (disco_id,publicacion,usuario,comentario) VALUES (".$_POST['disco_id'].",".$micd['tiempo_real'].",'".$consultasSql->proteger($_POST['usuario'])."','".$consultasSql->proteger($_POST['comentario'])."')");
			$consultasSql->cerrar();
			setcookie('micd_usuario',$_POST['usuario']);
			header("location: ./discos.php?shop=".$_GET['shop']."&disco_id=".$_POST['disco_id']);
		} else {
			echo"
				<div class=\"title\" style=\"margin: 10px 0px 10px 0px;\">Comentarios</div>
			";
			$sql_com = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."comentarios WHERE disco_id = ".$consultasSql->proteger($_GET['disco_id']));
			if(mysql_num_rows($sql_com)>0) {
				while($row_com = mysql_fetch_array($sql_com)) {
					$usuario = formatear_txt($row_com['usuario'],"");
					$comentario = formatear_txt($row_com['comentario'],"br");
					echo"
						<p>
							<strong>$usuario</strong> el <em>".date("d/m/y H:i",$row_com['publicacion'])."</em> dijo: $comentario
					";
					if($login) echo" <a href=\"./comentarios.php?shop=".$_GET['shop']."&amp;eliminar=".$row_com['id']."&amp;disco_id=".$_GET['disco_id']."\">[Eliminar]</a>";
					echo"
						</p>
						<div class=\"linea\"><span></span></div>
					";
				}
			} else {
				echo"
					<p>No hay comentarios publicados para este disco.</p>
					<div class=\"linea\"><span></span></div>
				";
			}
			echo"
				<form action=\"./comentarios.php?shop=".$_GET['shop']."\" method=\"post\" onsubmit=\"return validar_comentarios(this);\">
					<p class=\"center\">
						Nombre: <input type=\"text\" name=\"usuario\" maxlength=\"30\" size=\"57\" value=\""; if(isset($_COOKIE['micd_usuario'])) echo $_COOKIE['micd_usuario']; echo"\" /><br />
						<textarea name=\"comentario\" rows=\"4\" cols=\"50\"></textarea><br />
						<input type=\"hidden\" name=\"disco_id\" value=\"".$_GET['disco_id']."\" />
						<input type=\"submit\" name=\"submit\" value=\"Enviar comentario\" />
					</p>
				</form>
				<p class=\"center\"><strong>No se permite código HTML.</strong><br />Por favor solo indicar comentarios respecto al disco, consultas hechas aquí no serán respondidas.</p>
			";
		}
	} else {
		require_once("./inc/config.inc.php");
		if(!$login) {
			header("location: ./errno.php?shop=".$_GET['shop']."errno=4");
		} else {
			$consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."comentarios WHERE id = ".$consultasSql->proteger($_GET['eliminar']));
			$consultasSql->cerrar();
			header("location: ./discos.php?shop=".$_GET['shop']."&disco_id=".$_GET['disco_id']);
		}
	}

?>