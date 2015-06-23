<?php require("./inc/web1.inc.php"); ?>

<div id="titulo">Características del servicio</div>
<p>Algunas de las principales características:</p>
<ul class="lista">
	<li>Servicio multiusuario, cada usuario registrado dispone de su propia tienda independiente de las demás. El link de acceso a las tiendas será:<br /><em><?php echo $micd['site']['url']; ?>/nombre_tienda</em></li>
	<li>Panel de configuración de la tienda muy sencillo y de simple uso. Además el resto de la administración también es intuitiva.</li>
	<li>Activación y desactivación de algunos módulos desde la administración.</li>
	<li>Definir las categorías de los discos, así como también los formatos de estos.</li>
	<li>Además de las categorías añadir clasificaciones como una forma de subcategoría.</li>
	<li>Exportar lista de discos completa, o por categoría, a PDF (usando clase <a href="http://www.fpdf.org/">fpdf</a>).</li>
	<li>Listado de los últimos discos en la portada y en cada categoría destacados los discos nuevos.</li>
	<li>Tener los últimos discos en formato RSS para que puedan ser leídos fácilmente con un lector de noticias.</li>
	<li>Calificación de discos.</li>
	<li>Agregar comentarios a los discos.</li>
	<li>Ocultar precios de los discos si se desea.</li>
	<li>Buscador global y un buscador interno en cada tienda (solo si hay más de 4 discos en la tienda).</li>
	<li>Links a sitios de interés.</li>
	<li>Estadísticas indicando número total de discos a la venta, el número de discos por categorías y los usuarios online.</li>
	<li>Información de contacto generada automáticamente según datos entregados en la configuración de la tienda.</li>
	<li>Paginación de discos según cantidad establecida por el usuario.</li>
	<li>En cada disco se ofrecen links de búsqueda en <a href="http://www.google.cl">Google</a> y <a href="http://www.youtube.com">YouTube</a>.</li>
	<li>Página con la descripción de los formatos utilizados.</li>
	<li>Añadir imágenes a la información de los discos.</li>
	<li>Colocar un texto con información sobre los últimos discos en la portada, además se puede agregar texto en el menú derecho sobre el formulario de búsqueda.</li>
	<li>XHTML y CSS válidos.</li>
</ul>

<?php require("./inc/web2.inc.php"); ?>