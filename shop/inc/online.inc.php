<?php

 /*************************************************/
 /* ARCHIVO QUE ACTUALIZA/MUESTRA USUARIOS ONLINE */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

 // ACTUALIZAMOS LISTA DE USUARIOS ONLINE
 $time = 5; // Tiempo máximo de espera
 $date = $micd['tiempo_real']; // Momento que entra en línea
 $limite = $date - $time * 60; // tiempo Limite de espera 
 $consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."online where date < $limite"); // si se supera el tiempo limite (5 minutos) lo borramos
 $resp = $consultasSql->consulta("SELECT * from ".$micd['mysql']['prefix']."online where sesion_id='".$micd['sesion_id']."'"); // tomamos todos los usuarios en linea
 if(mysql_num_rows($resp) != 0) // Si son los mismo actualizamos la tabla gente_online
 	$consultasSql->consulta("UPDATE ".$micd['mysql']['prefix']."online SET date = '$date', pagina = '".$consultasSql->proteger($micd['pagina_actual'])."' WHERE sesion_id = '".$micd['sesion_id']."'");
 else // de lo contrario insertamos los nuevos
	$consultasSql->consulta("insert into ".$micd['mysql']['prefix']."online (date,ip,host,pagina,sesion_id) values ('$date','$ip','$host','".$consultasSql->proteger($micd['pagina_actual'])."','".$micd['sesion_id']."')");
 
 // sacar cuantos son los usuarios online
 $usuarios = $consultasSql->contar($micd['mysql']['prefix']."online");
 // Si hay 1 usuarios se muestra en singular; si hay mas de uno, en plural
 if($login) echo"<a href=\"".$micd['url']."/admin/online.php?shop=".$_GET['shop']."\">";
 if($usuarios > 1)
  echo($usuarios." usuarios online ");
 else
  echo($usuarios." usuario online ");
 if($login) echo"</a>"; echo" - su ip es $ip";

?>