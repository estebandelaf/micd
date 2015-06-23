<?php

 /*************************************************/
 /* ARCHIVO DE CONFIGURACION DE DISCOS            */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

 require_once("./../inc/web1.inc.php");

 if(!$login) {
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./../errno.php?shop=".$_GET['shop']."&amp;errno=4'>";
 } else {

  $texto = "
	<p>Si no ingresas el precio este se calculará según la formula:</p>
	<p class=\"center\"><em>precio = precio_de_un_disco + precio_disco_extra * (numero de discos - 1)</em></p>
	<p>Para modificar los valores de los precios de discos unitarios y de los discos extras click <a href=\"./config.php?shop=".$_GET['shop']."\">aquí</a>.</p>
	<p>En el caso de la carátula debe ser una url con el link a la foto. Se puede buscar la foto en otra web o subirla a <a href=\"http://imageshack.us/\">ImageShack</a>.</p>
	<p>El campo clasificación corresponde a una subcategoría que se pondrá delante del nombre del disco para ayudar al usuario y en la búsqueda.</p>
  ";

  if(!isset($_GET['editar']) && !isset($_GET['eliminar'])) {
   if(isset($_POST['agregar'])) {
    $consultasSql->consulta("INSERT INTO ".$micd['mysql']['prefix']."discos (publicacion,tipo_disco,formato,cantidad,nombre,descripcion,cat_id,precio,mas_info,caratula,clasificacion) VALUES (".$micd['tiempo_real'].",'".$consultasSql->proteger($_POST['tipo_disco'])."','".$consultasSql->proteger($_POST['formato'])."','".$consultasSql->proteger($_POST['cantidad'])."','".$consultasSql->proteger($_POST['nombre'])."','".$consultasSql->proteger($_POST['descripcion'])."','".$consultasSql->proteger($_POST['cat_id'])."','".$consultasSql->proteger($_POST['precio'])."','".$consultasSql->proteger($_POST['mas_info'])."','".$consultasSql->proteger($_POST['caratula'])."','".$consultasSql->proteger($_POST['clasificacion'])."')");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   } else {
    echo"
     <div id=\"titulo\">Agregar disco</div>
     $texto
     <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_discos(this);\">
      <table>
       <tr><td>Categoría *</td><td>
        <select tabindex='1' name='cat_id' style='width: 423px;'>
         <option value=''>Seleccionar la categoría correspondiente</option>
    ";
    $sql = $consultasSql->consulta("SELECT id,nombre FROM ".$micd['mysql']['prefix']."categorias ORDER BY nombre ASC");
    while($row = mysql_fetch_array($sql)) {
     echo"<option value='".$row['id']."'>".$row['nombre']."</option>";
    }
    echo"
        </select>
       </td></tr>
       <tr><td>Tipo de disco *</td><td>
        <select tabindex='1' name='tipo_disco' style='width: 423px;'>
         <option value=''>Seleccionar CD o DVD</option>
         <option value='CD'>CD</option>
         <option value='DVD'>DVD</option>
        </select>
       </td></tr>
       <tr><td>Formato *</td><td>
        <select tabindex='1' name='formato' style='width: 423px;'>
         <option value=''>Seleccionar formato</option>
    ";
    $sql = $consultasSql->consulta("SELECT id,formato FROM ".$micd['mysql']['prefix']."formatos ORDER BY formato ASC");
    while($row = mysql_fetch_array($sql)) {
     echo"<option value='".$row['id']."'>".$row['formato']."</option>";
    }
    echo"
        </select>
       </td></tr>
       <tr><td>Cantidad de discos *</td><td><input type='text' name='cantidad' size='66' maxlength='2' value='1' /></td></tr>
       <tr><td>Carátula *</td><td><input type='text' name='caratula' size='66' /></td></tr>
       <tr><td>Clasificación</td><td><input type='text' name='clasificacion' size='66' maxlength='20' /></td></tr>
       <tr><td>Nombre *</td><td><input type='text' name='nombre' size='66' maxlength='255' /></td></tr>
	<tr><td>Descripci&oacute;n</td><td><textarea name='descripcion' rows='15' cols='50'></textarea></td></tr>
       <tr><td>Precio</td><td><input type='text' name='precio' size='66' maxlength='255' /></td></tr>
       <tr><td>Más Información</td><td><input type='text' name='mas_info' size='66' /></td></tr>
       <tr><td></td><td><input type='submit' name='agregar' value='Agregar'></td></tr>
      </table>
     </form>
    ";
   }
  } else {
   if(isset($_GET['editar'])) {
    if(isset($_POST['edit'])) {
     $consultasSql->consulta("UPDATE ".$micd['mysql']['prefix']."discos SET modificacion = '".$micd['tiempo_real']."', tipo_disco = '".$consultasSql->proteger($_POST['tipo_disco'])."', formato = '".$consultasSql->proteger($_POST['formato'])."', cantidad = '".$consultasSql->proteger($_POST['cantidad'])."', nombre = '".$consultasSql->proteger($_POST['nombre'])."', descripcion = '".$consultasSql->proteger($_POST['descripcion'])."', cat_id = '".$consultasSql->proteger($_POST['cat_id'])."', precio = '".$consultasSql->proteger($_POST['precio'])."', mas_info = '".$consultasSql->proteger($_POST['mas_info'])."', caratula = '".$consultasSql->proteger($_POST['caratula'])."', clasificacion = '".$consultasSql->proteger($_POST['clasificacion'])."' WHERE id = '".$consultasSql->proteger($_POST['disco_id'])."'");
     echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$micd['url']."/discos.php?shop=".$_GET['shop']."&amp;disco_id=".$_POST['disco_id']."'>";
    } else {
     $sql = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."discos WHERE id='".$consultasSql->proteger($_GET['disco_id'])."'");
     $row = mysql_fetch_array($sql);
     echo"
      <div id=\"titulo\">Editar disco &quot;".$row['nombre']."&quot;</div>
      $texto
      <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;editar=1' method='post' onsubmit=\"return validar_discos(this);\">
       <table>
        <tr><td>Categoría *</td><td>
        <select tabindex='1' name='cat_id' style='width: 423px;'>
         <option value=''>Seleccionar la categoría correspondiente</option>
    ";
    $sql2 = $consultasSql->consulta("SELECT id,nombre FROM ".$micd['mysql']['prefix']."categorias ORDER BY nombre ASC");
    while($row2 = mysql_fetch_array($sql2)) {
     echo"<option value='".$row2['id']."' "; if($row['cat_id']==$row2['id']) echo" selected='selected'"; echo">".$row2['nombre']."</option>";
    }
    echo"
        </select>
       </td></tr>
       <tr><td>Tipo de disco *</td><td>
        <select tabindex='1' name='tipo_disco' style='width: 423px;'>
         <option value=''>Seleccionar CD o DVD</option>
         <option value='CD' "; if($row['tipo_disco']=="CD") echo" selected='selected'"; echo">CD</option>
         <option value='DVD' "; if($row['tipo_disco']=="DVD") echo" selected='selected'"; echo">DVD</option>
        </select>
       </td></tr>
       <tr><td>Formato *</td><td>
        <select tabindex='1' name='formato' style='width: 423px;'>
         <option value=''>Seleccionar formato</option>
    ";
    $sql2 = $consultasSql->consulta("SELECT id,formato FROM ".$micd['mysql']['prefix']."formatos ORDER BY formato ASC");
    while($row2 = mysql_fetch_array($sql2)) {
     echo"<option value='".$row2['id']."' "; if($row2['id']==$row['formato']) echo" selected='selected'"; echo">".$row2['formato']."</option>";
    }
    echo"
        </select>
       </td></tr>
       <tr><td>Cantidad de discos *</td><td><input type='text' name='cantidad' size='66' maxlength='2' value='".$row['cantidad']."' /></td></tr>
       <tr><td>Carátula *</td><td><input type='text' name='caratula' size='66' value='".$row['caratula']."' /></td></tr>
       <tr><td>Clasificación</td><td><input type='text' name='clasificacion' size='66' maxlength='20' value='".$row['clasificacion']."' /></td></tr>
       <tr><td>Nombre *</td><td><input type='text' name='nombre' size='66' maxlength='255' value='".$row['nombre']."' /></td></tr>
	<tr><td>Descripci&oacute;n</td><td><textarea name='descripcion' rows='15' cols='50'>".$row['descripcion']."</textarea></td></tr>
       <tr><td>Precio</td><td><input type='text' name='precio' size='66' maxlength='255' value='".$row['precio']."' /></td></tr>
       <tr><td>Más Información</td><td><input type='text' name='mas_info' size='66' value='".$row['mas_info']."' /></td></tr>
        <input type='hidden' name='disco_id' value='".$_GET['disco_id']."'>
        <tr><td></td><td><input type='submit' name='edit' value='Editar'></td></tr>
       </table>
      </form>
     ";
    }
   }
   if(isset($_GET['eliminar'])) {
    $consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."discos WHERE id='".$consultasSql->proteger($_GET['eliminar'])."'");
    $consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."comentarios WHERE disco_id='".$consultasSql->proteger($_GET['eliminar'])."'");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   }
  }
 }

 require_once("./../inc/web2.inc.php");

?>
