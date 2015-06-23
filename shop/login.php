<?php

	/*************************************************/
	/* ARCHIVO DE INGRESO A LA ADMINISTRACION        */
	/* Desarrollador: DeLaF www.delaf.tk             */
	/* Mail: esteban.delaf@gmail.com                 */
	/* Ultima version: 18-02-08                      */
	/*************************************************/
		
	require_once("./inc/config.inc.php");

	if(empty($_POST['user']) || empty($_POST['clave'])) {
		// redirecciona a index.php Se envia la variable de tipo GET "errno" con valor 1.
		$consultasSql->cerrar();
		header("Location: ./errno.php?shop=".$_GET['shop']."&errno=1") ; //errno 1 = No se han rellenado todos los datos
	} else {
		if(strtolower($_POST['user'])!=strtolower($micd['shop'])) {
			// redirecciona a index.php Se envia la variable de tipo GET "errno" con valor 2.
			$consultasSql->cerrar();
			header("Location: ./errno.php?shop=".$_GET['shop']."&errno=2") ; //errno 2 = Nombre incorrecto
		} else {
			if($micd['clave'] != md5($_POST['clave'])) {
				// redirecciona a index.php Se envia la variable de tipo GET "errno" con valor 3.
				$consultasSql->cerrar();
				header("Location: ./errno.php?shop=".$_GET['shop']."&errno=3") ; //errno 3 = Clave incorrecta
			} else {
				$consultasSql->consulta("UPDATE ".$micd['site']['mysql']['prefix']."usuarios SET ult_login = '".$micd['tiempo_real']."' WHERE usuario = '".$consultasSql->proteger($_POST['user'])."'");
				$_SESSION['login'] = 1;
				$_SESSION['shop'] = $_GET['shop'];
				$consultasSql->cerrar();
				header("Location: ./admin/?shop=".$_GET['shop']); // Ahora nos vamos a un archivo, pero ya con la cookie
			}
		}
	}

?>
