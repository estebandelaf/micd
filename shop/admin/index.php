<?php

 /*************************************************/
 /* ARCHIVO DE ADMINISTRACION                     */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 10-02-08                      */
 /*************************************************/

 require_once("./../inc/web1.inc.php");

 if(!$login)
 {
  echo"
   <div id=\"titulo\">Acceso a la administración</div>
   <p>Por favor ingresar usuario y contraseña para acceder a la cuenta:</p>
   <form action=\"./../login.php?shop=".$_GET['shop']."\" method=\"post\" onsubmit=\"return validar_login(this);\">
    <table>
     <tr>
      <td>Usuario</td>
      <td><input type=\"text\" name=\"user\" maxlength=\"30\" value=\"".$_GET['shop']."\" /></td>
     </tr>
     <tr>
      <td>Contrase&ntilde;a</td>
      <td><input type=\"password\" name=\"clave\" /></td>
     </tr>
     <tr>
      <td></td>
      <td>
       <input type=\"submit\" name=\"login\" value=\"Entrar\"></input>    
      </td>
     </tr>
    </table>
   </form>
  ";
 }
 else
 {
  echo"
   <div id=\"titulo\">Panel de administraci&oacute;n</div>
   <p>Por favor utilizar las opciones disponibles en el menú derecho.</p>
  ";
 }

 require_once("./../inc/web2.inc.php");

?>