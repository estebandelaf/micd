<?php

	require_once("./inc/functions.inc.php");

	$reg_ver = rand(1000,9999);
	setcookie('micd_user_reg_ver',md5($reg_ver));
	to_image($reg_ver);

?>