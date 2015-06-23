<?php

	/*************************************************/
	/* ARCHIVO DE DESCONECCION                       */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 18-02-08                      */
	/*************************************************/

	if(isset($_GET['shop'])) {
		require_once("./inc/config.inc.php");
		$consultasSql->cerrar();
		$_SESSION['login'] = false;
		$_SESSION['shop'] = false;
		header("location: ./?shop=".$_GET['shop']);
	} else {
		header("location: ./../errno.php?errno=2&file=".$_SERVER['PHP_SELF']);
	}

?>
