<?php

 /*************************************************/
 /* ARCHIVO PARA VER USUARIOS ONLINE              */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

 require_once("./../inc/web1.inc.php");

 if(!$login) {
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./../errno.php?shop=".$_GET['shop']."&amp;errno=4'>";
 }
 else {
  echo"<div id=\"titulo\">Usuarios OnLine</div>";
  $sql = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."online");
  echo"<table class=\"table\"><tr><th>IP</th><th>Host</th><th>Viendo</th><th><b>&Uacute;ltimo Click</th></tr>";
  while ($row = mysql_fetch_array($sql)) { 
   $fecha = date("H:i:s",$row['date']);
   echo"
    <tr>
     <td><a href=\"http://lacnic.net/cgi-bin/lacnic/whois?lg=SP&query=".$row['ip']."\">".$row['ip']."</a></td>
     <td>".$row['host']."</td>
     <td><a href=\"".$row['pagina']."\" title=\"".$row['pagina']."\">ir a...</a></td>
     <td>$fecha</td>
    </tr>
   ";
  }
  echo"</table>";
 }

 require_once("./../inc/web2.inc.php");

?>
