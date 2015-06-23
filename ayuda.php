<?php

	require("./inc/web1.inc.php");

	echo $tab3,'<div id="titulo">Ayuda: preguntas y respuestas frecuentes</div>',$eol;
	echo $tab3,'<p>Las siguientes son las preguntas más frecuentes que pueden surgir:</p>',$eol;

	echo $tab3,'<ul class="lista">',$eol;
	echo $tab4,'<li>',$eol;
	echo $tab5,'<strong>¿Por qué a veces ingreso algunas palabras en los formularios y no aparecen correctamente o me dan error?</strong><br />',$eol;
	echo $tab5,'Esto es porque las siguientes palabras, o string, son reservadas y no se permite su uso en formularios: ',showArray($micd['site']['proteger_sql']),$eol;
	echo $tab4,'</li>',$eol;
	echo $tab4,'<li>',$eol;
	echo $tab5,'<strong>Utilizo el buscador de la tienda o el buscador global y no funcionan, ¿por qué pasa esto?</strong><br />',$eol;
	echo $tab5,'Ambos buscadores solo funcionarán si en la tienda hay más de 4 discos, o sea, 5 o más.',$eol;
	echo $tab4,'</li>',$eol;
	echo $tab3,'</ul>',$eol;

	require("./inc/web2.inc.php");

?>