/*************************************************/
/* ARCHIVO CON CODIGO AJAX                       */
/* Desarrollador: DeLaF www.delaf.tk             */
/* Mail: esteban.delaf@gmail.com                 */
/* Ultima version: 10-02-08                      */
/*************************************************/

function mostrar_capa(capa) {
 document.getElementById(capa).style.visibility="visible";
}
function ocultar_capa(capa) {
 document.getElementById(capa).style.visibility="hidden";
}

function vacio(texto){  
	for(i=0;i<texto.length;i++){  
		if(texto.charAt(i)!=" ")
			return false;
	}
	return true;
}

function validar_registro(formulario){
	if(vacio(formulario.usuario.value) || vacio(formulario.clave1.value) || vacio(formulario.clave2.value) || vacio(formulario.email.value) || vacio(formulario.email2.value) || vacio(formulario.reg_ver.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	}
	return true;
}
