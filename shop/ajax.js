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

function validar_formatos(formulario){
	if(vacio(formulario.formato.value) || vacio(formulario.descripcion.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	}
	return true;
}

function validar_categorias(formulario){
	if(vacio(formulario.categoria.value) || vacio(formulario.img.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	}
	return true;
}

function validar_discos(formulario){
	if(vacio(formulario.cat_id.value) || vacio(formulario.tipo_disco.value) || vacio(formulario.formato.value) || vacio(formulario.cantidad.value) || vacio(formulario.caratula.value) || vacio(formulario.nombre.value)){
		alert('Los campos con asterisco son obligatorios!');
		return false;
	}
	return true;
}

function validar_comentarios(formulario){
	if(vacio(formulario.usuario.value) || vacio(formulario.comentario.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	}
	return true;
}

function validar_login(formulario){
	if(vacio(formulario.user.value) || vacio(formulario.clave.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	}
	return true;
}

function validar_config(formulario){
	if(vacio(formulario.website.value) || vacio(formulario.desc.value) || vacio(formulario.skin.value) || vacio(formulario.email.value) || vacio(formulario.region.value) || vacio(formulario.tiempo_nuevo.value) || vacio(formulario.tiempo_votos.value) || vacio(formulario.discos_por_pag.value) || vacio(formulario.discos_nuevos.value) || vacio(formulario.p_cd.value) || vacio(formulario.p_cde.value) || vacio(formulario.p_dvd.value) || vacio(formulario.p_dvde.value) || vacio(formulario.clave.value)){
		alert('Los campos con asterisco son obligatorios!');
		return false;
	}
	return true;
}

function validar_cambiar_clave(formulario){
	if(vacio(formulario.clave.value) || vacio(formulario.clave1.value) || vacio(formulario.clave2.value)){
		alert('Todos los campos son obligatorios!');
		return false;
	} else {
		if(formulario.clave1.value != formulario.clave2.value) {
			alert('Las contraseñas no coinciden!');
			return false;
		} else
			return true;
	}
}

function validar_eliminar_tienda(formulario){
	if(vacio(formulario.clave.value)){
		alert('Debes ingresar la clave!');
		return false;
	} else {
		if(confirm('Confirmar el borrado de la tienda/usuario ' + formulario.shop.value))
			return true;
		else
			return false;			
	}
}