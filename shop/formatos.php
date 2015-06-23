<?php

 /*************************************************/
 /* ARCHIVO QUE LISTA LOS FORMATOS DISPONIBLES    */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 10-02-08                      */
 /*************************************************/

 require("./inc/web1.inc.php");

?>

<div id="titulo">Formatos</div>
<p>A continuación se describen los formatos de disco que hay disponibles en esta tienda.</p>

<ul class="lista">

<?php

	$sql = $consultasSql->consulta("SELECT id,formato,descripcion FROM ".$micd['mysql']['prefix']."formatos ORDER BY formato ASC");
	while($row = mysql_fetch_array($sql)) {
		echo"
			<li id=\"formato".$row['id']."\"><strong>".$row['formato']."</strong>: ".$row['descripcion']."</li>
		";
	}

?>

</ul>

<?php require("./inc/web2.inc.php"); ?>