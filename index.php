<?php
if(!file_exists("./inc/config.inc.php")) header("location: ./instalar");
require("./inc/web1.inc.php");
?>

<div id="titulo">Bienvenid@ a MiCD</div>
<div id="box_importante"><strong>SITIO EN DESARROLLO, NO USAR PARA TIENDAS REALES</strong></div>
<p>MiCD es un sistema multiusuario para la venta de CD, cada usuario tiene su propia tienda y la puede activar mediante un simple <a href="./registro.php">registro</a>. Puedes ver más detalles en la sección de <a href="./servicio.php">características</a> de MiCD.</p>
<p><strong>Estoy programando... PazYCiencia...</strong></p>
<p>Puedes visitar una <a href="./demo">Tienda Demo</a> para conocer el sistema, si quieres puedes entrar a la administracion con la clave <em>micd</em>.</p>
<p>Temporalmente, mientras desarrollo, el sitio esta alojado en este servidor. La idea es que después lo moveré a otra ubicación y url. Para acceder puedes utilizar también la url http://micd.sytes.net</p>

<p><strong>El sitio puede tener bugs de SQL injection u otros, si detectas alguno por favor notifícalo a esteban.delaf[at]gmail.com Y si tienes cualquier comentario y/o sugerencia que pueda hacer mejor la web también indícamelo, gracias!!</strong></p>

<p>Temas pendientes:</p>
<ul class="lista">
	<li>Validación XHTML y CSS.</li>
	<li>Aplicación multilenguaje.</li>
</ul>

<div class="title">Noticias &amp; Change Log</div>
<p><strong>22/02/08</strong>: finalizada segunda etapa, oficialmente esta será la versión beta. Aún pueden existir errores o cosas que modificar así que no dudes en indicármelo.</p>
<p><strong>18/02/08</strong>: se cambio a sesiones de php para la autentificación. Además cambie el manejo antiguo de MySQL y ahora lo hago con una clase destinada a la base de datos.</p>
<p><strong>16/02/08</strong>: Se ha añadido la posibilidad de colocar un texto encima de los últimos discos en la portada y otro texto en el menú derecho. También he agregado la posibilidad de ocultar los precios.</p>
<p><strong>15/02/08</strong>: se ha arreglado el problema de usar $variable[campo] en vez de $variable['campo'].</p>
<p><strong>14/02/08</strong>: listo sistema de registro. Se pasa a 2da etapa de desarrollo que consiste en manejo de errores y seguridad de la aplicación.</p>
<p><strong>13/02/08</strong>: listo sistema multiusuario.</p>
<p><strong>10/02/08</strong>: listo sistema monousuario.</p>
<p><strong>04/02/08</strong>: se inicia el proyecto, comenzando con la 1era etapa que es estructurar el sitio y la programación orientada a lo ideal.</p>

<?php require("./inc/web2.inc.php"); ?>
