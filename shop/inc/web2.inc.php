<?php

 /*************************************************/
 /* ARCHIVO DE ESTRUCTURA DEL SITIO POSTERIOR     */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

?>
		</div>
		<div id="content_right">
			<?php
				if($login) {
					echo"
						<div class=\"title\">Administración</div>
						<div class=\"admin\">
					";
					if(isset($_GET['disco_id']))
						echo"
							<a href=\"".$micd['url']."/admin/discos.php?shop=".$_GET['shop']."&amp;editar=1&disco_id=".$_GET['disco_id']."\"><img src=\"".$micd['url']."/images/icono_editar.png\" alt=\"Editar disco\"  onmouseout=\"ocultar_capa('admin_editar')\" onmouseover=\"mostrar_capa('admin_editar')\" /></a>
							<div id=\"admin_editar\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_editar')\" onmouseover=\"mostrar_capa('admin_editar')\">Editar disco</div>
							<a href=\"".$micd['url']."/admin/discos.php?shop=".$_GET['shop']."&amp;eliminar=".$_GET['disco_id']."\"><img src=\"".$micd['url']."/images/icono_borrar.gif\" alt=\"Borrar disco\" onmouseout=\"ocultar_capa('admin_borrar')\" onmouseover=\"mostrar_capa('admin_borrar')\" /></a>
							<div id=\"admin_borrar\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_borrar')\" onmouseover=\"mostrar_capa('admin_borrar')\">Borrar disco</div>
						";
					echo"
							<a href=\"".$micd['url']."/admin/discos.php?shop=".$_GET['shop']."\"><img src=\"".$micd['url']."/images/icono_agregar.png\" alt=\"Agregar discos\" onmouseout=\"ocultar_capa('admin_agregar')\" onmouseover=\"mostrar_capa('admin_agregar')\" /></a>
							<div id=\"admin_agregar\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_agregar')\" onmouseover=\"mostrar_capa('admin_agregar')\">Agregar disco</div>
							<a href=\"".$micd['url']."/admin/categorias.php?shop=".$_GET['shop']."\"><img src=\"".$micd['url']."/images/icono_categorias.png\" alt=\"Agregar categorías\" onmouseout=\"ocultar_capa('admin_cat')\" onmouseover=\"mostrar_capa('admin_cat')\" /></a>
							<div id=\"admin_cat\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_cat')\" onmouseover=\"mostrar_capa('admin_cat')\">Agregar/editar categorías</div>
							<a href=\"".$micd['url']."/admin/formatos.php?shop=".$_GET['shop']."\"><img src=\"".$micd['url']."/images/icono_formato.png\" alt=\"Agregar formato\" onmouseout=\"ocultar_capa('admin_formato')\" onmouseover=\"mostrar_capa('admin_formato')\" /></a>
							<div id=\"admin_formato\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_formato')\" onmouseover=\"mostrar_capa('admin_formato')\">Agregar/editar formato</div>
							<a href=\"".$micd['url']."/admin/config.php?shop=".$_GET['shop']."\"><img src=\"".$micd['url']."/images/icono_config.png\" alt=\"Modificar configuración\" onmouseout=\"ocultar_capa('admin_config')\" onmouseover=\"mostrar_capa('admin_config')\" /></a>
							<div id=\"admin_config\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_config')\" onmouseover=\"mostrar_capa('admin_config')\">Editar configuración</div>
							<a href=\"".$micd['url']."/logout.php?shop=".$_GET['shop']."\"><img src=\"".$micd['url']."/images/icono_salir.png\" alt=\"Salir\" onmouseout=\"ocultar_capa('admin_salir')\" onmouseover=\"mostrar_capa('admin_salir')\" /></a>
							<div id=\"admin_salir\" class=\"help_box\" onmouseout=\"ocultar_capa('admin_salir')\" onmouseover=\"mostrar_capa('admin_salir')\">Salir</div>
						</div>
					";
				}
				if($micd['texto_menu_titulo'] && $micd['texto_menu']) {
					$texto_menu = formatear_txt($micd['texto_menu'],"br",1);
					$texto_menu_titulo = formatear_txt($micd['texto_menu_titulo'],"",0);
					echo"
						<div class=\"title\">$texto_menu_titulo</div>
						<p>$texto_menu</p>
					";
				}
			?>
			<div class="title">Formulario de búsqueda</div>
			<form action="<?php  echo $micd['url']."/buscar.php?shop=".$_GET['shop']; ?>" method="post">
				<p class="center">Ingrese palabra clave: <input type="text" name="palabra_clave" /></p>
			</form>
			<div class="title">Listado en PDF</div>
			<p class="center">Bajar listado de discos en PDF <a href="<?php echo $micd['url']."/pdf/discos.php?shop=".$_GET['shop']; ?>">aquí</a><?php if(isset($_GET['cat_id']) && !isset($_GET['editar'])) echo" o bajar un PDF con la <a href=\"".$micd['url']."/pdf/discos.php?shop=".$_GET['shop']."&amp;cat_id=".$_GET['cat_id']."\">categoría $categoria</a>"; ?>.</p>
			<div class="title">¿Cómo comprar?</div>
			<p class="center">
				<?php
					echo "Enviar un email a ".str_replace("@","[at]",$micd['email']);
					if($micd['telefono']) echo" o llamar al teléfono ".$micd['telefono'];
					echo" para coordinar la entrega de los discos de su interés.";
					if($micd['ciudad']) echo"<br />Discos disponibles en ".$micd['ciudad'].".";
				?>
			</p>
			<?php include($micd['dir']."/../publicidad/publicidad.php"); ?>
			<?php
				if($micd['links']!="")
					echo"
						<div id=\"links\">
							<div class=\"title\">Links</div>
							".$micd['links']."
						</div>
					";
			?>
			<div class="title">Estadísticas</div>
				<p class="center">
					Actualmente existen <?php echo $micd['numero_discos']; ?> discos a la venta<br />
					<?php include($micd['dir']."/inc/online.inc.php"); ?>
				</p>
			<div class="linea"><span></span></div>
			<p class="center">Las imágenes de los discos son referenciales</p>
		</div>
		<div id="footer">
			<div id="copyright">
				<a href="<?php echo $micd['site']['url']; ?>">MiCD 2008 vBeta</a>
				by <a href="http://www.delaf.tk">DeLaF</a> &amp; Design by <a href="http://arcsin.se">Arcsin</a> - 
				<a href="<?php echo $micd['url']."/admin/?shop=".$_GET['shop']; ?>">admin</a> - 
				<a href="<?php echo $micd['url']."/rss.php?shop=".$_GET['shop']; ?>">rss</a> - 
				<a href="http://validator.w3.org/check?uri=referer">xhtml</a> &amp; <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $micd['url']."?shop=".$_GET['shop']; ?>">css</a>
			</div>
		</div>
	</body>
</html>
<?php $consultasSql->cerrar(); ob_end_flush(); ?>
