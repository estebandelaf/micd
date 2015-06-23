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
   echo"<p>Debe ingresar el usuario y la contraseña. Vuelva atr&aacute;s a inténtelo denuevo.</p>";
   break;
  }
  case 2: {
   echo"<p>El usuario es incorrecto.</p>";
   break;
  }
  case 3: {
   echo"<p>Contrase&ntilde;a incorrecta. Vuelva atr&aacute;s y verifiquela por favor.</p>";
   break;
  }
  case 4: {
   echo"<p>Usted no esta autorizado para acceder a esta &aacute;rea.</p>";
   break;
  }
  case 5: {
   echo"<p>Las contrase&ntilde;as ingresadas no son iguales.</p>";
   break;
  }
  case 6: {
   echo"<p>Todos los campos son requeridos, vuelva atr&aacute;s y verif&iacute;quelos por favor.</p>";
   break;
  }
  case 7: {
   echo"<p>La categoría solicitada no existe.</p>";
   break;
  }
  default:
   echo"<p>Errno ".$_GET['errno']." no encontrado dentro de nuestras descripciones de Errores.</p>";
 }

 require_once("./inc/web2.inc.php");

?>