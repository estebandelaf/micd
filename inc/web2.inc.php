<?php

 /*************************************************/
 /* ARCHIVO DE ESTRUCTURA DEL SITIO POSTERIOR     */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 22/02/08                      */
 /*************************************************/

?>
		</div>
		<div id="content_right">
			<div class="title"><?php echo $micd['site']['lang']['busqueda']['titulo']; ?></div>
			<form action="<?php echo $micd['site']['url']; ?>/buscar.php" method="post">
				<p class="center"><?php echo $micd['site']['lang']['busqueda']['ingresar_texto']; ?><input type="text" name="palabra_clave" /></p>
			</form>
			<?php include($micd['site']['dir']."/publicidad/publicidad.php"); ?>
			<div class="title"><?php echo $micd['site']['lang']['estadisticas']['titulo']; ?></div>
				<p class="center">
					<?php echo $micd['site']['lang']['estadisticas']['tiendas'].$micd['site']['numero_tiendas']; ?><br />
				</p>
			<div class="linea"><span></span></div>
			<p class="center"><?php echo $micd['site']['lang']['ayuda']['menu']; ?></p>
		</div>
		<div id="footer">
			<div id="copyright">
				<a href="./">MiCD 2008 vBeta</a>
				by <a href="http://www.delaf.tk">DeLaF</a> &amp; Design by <a href="http://arcsin.se">Arcsin</a> - 
				Powered by <a href="http://www.sasco.cl">SASCO</a> - 
				<a href="http://validator.w3.org/check?uri=referer">xhtml</a> &amp; <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $micd['site']['url']; ?>">css</a>
			</div>
		</div>
	</body>
</html>
<?php $consultasSql->cerrar() or $consultasSql->error(); ob_end_flush(); ?>
