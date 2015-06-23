<?php

	/*************************************************/
	/* MODULO PARA CALIFICAR O VOTAR POR LOS DISCOS  */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 12-02-08                      */
	/*************************************************/

	if((!isset($_GET['voto']) && !isset($_POST['disco_id']) && !isset($micd)) || (isset($_GET['micd']) || isset($_POST['micd'])))
		header("location: ./../errno.php?errno=2&file=".$_SERVER['PHP_SELF']);

	if(isset($_POST['voto']) && isset($_POST['disco_id'])) {
		require_once("./inc/config.inc.php");
		$sql_votos = $consultasSql->consulta("SELECT calificacion,nvotos FROM ".$micd['mysql']['prefix']."discos WHERE id = ".$consultasSql->proteger($_POST['disco_id']));
		$row_votos = mysql_fetch_array($sql_votos);
		$calificacion = (($row_votos['nvotos']*$row_votos['calificacion']) + $consultasSql->proteger($_POST['voto'])) / ($row_votos['nvotos'] + 1);
		$nvotos = $row_votos['nvotos'] + 1;
		for($i=10;$i<=50;$i+=5) {
			if($calificacion>=($i-2.5) && $calificacion<($i+2.5))
				$calificacion = $i;
		}
		$consultasSql->consulta("UPDATE ".$micd['mysql']['prefix']."discos SET calificacion = $calificacion, nvotos = $nvotos WHERE id = ".$consultasSql->proteger($_POST['disco_id']));
		setcookie('micd_calif_voto',TRUE,$micd['tiempo_real']+$micd['tiempo_votos']);
		$consultasSql->cerrar();
		header("location: ./discos.php?shop=".$_GET['shop']."&disco_id=".$_POST['disco_id']);
	} else {
		$sql_votos = $consultasSql->consulta("SELECT calificacion,nvotos FROM ".$micd['mysql']['prefix']."discos WHERE id = ".$consultasSql->proteger($_GET['disco_id']));
		$row_votos = mysql_fetch_array($sql_votos);
		echo"Calificación: ";
		if($row_votos['calificacion'] && $row_votos['nvotos']) {
			echo"<img src=\"./images/star_".$row_votos['calificacion'].".gif\" alt=\"\" /> ".$row_votos['nvotos']." voto"; if($row_votos['nvotos']>1) echo"s";
		} else echo"aún sin calificar. ";
		if(!isset($_COOKIE['micd_calif_voto']))
			echo"
				<form action=\"./calificacion.php?shop=".$_GET['shop']."\" method=\"post\">
					<div>Ingresa tu voto para este disco: 
					<input type=\"hidden\" name=\"disco_id\" value=\"".$_GET['disco_id']."\" />
					<input type=\"radio\" name=\"voto\" value=\"10\" onclick=\"this.form.submit()\" />muy malo
					<input type=\"radio\" name=\"voto\" value=\"20\" onclick=\"this.form.submit()\" />malo
					<input type=\"radio\" name=\"voto\" value=\"30\" onclick=\"this.form.submit()\" />regular
					<input type=\"radio\" name=\"voto\" value=\"40\" onclick=\"this.form.submit()\" />bueno
					<input type=\"radio\" name=\"voto\" value=\"50\" onclick=\"this.form.submit()\" />muy bueno</div>
				</form>
			";
		else
			echo"<div>Debes esperar ".$micd['tiempo_votos']." segundos antes de poder volver a votar por un disco.</div>";
		echo"<br />";
	}

?>