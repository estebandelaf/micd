<?php

 /*************************************************/
 /* ARCHIVO DE DESCRIPCION DE ERRORES             */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 10-02-08                      */
 /*************************************************/

 require_once("./inc/web1.inc.php");

 echo"<div id=\"titulo\">Error</div>";

 switch($_GET['errno']) {
  case 1: {
   echo"<p>La tienda/usuario <em>".$_GET['shop']."</em> es incorrecta.</p>";
   break;
  }
  case 2: {
   echo"<p>Usted no esta autorizado para acceder al archivo <em>".$_GET['file']."</em> de la forma que lo hizo.</p>";
   break;
  }
  default:
   echo"<p>Errno ".$_GET['errno']." no encontrado dentro de nuestras descripciones de errores.</p>";
 }

 require_once("./inc/web2.inc.php");

?>