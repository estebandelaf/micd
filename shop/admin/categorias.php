<?php

 /*************************************************/
 /* ARCHIVO DE CONFIGURACION DE CATEGORIAS        */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

 require_once("./../inc/web1.inc.php");

 if(!$login) {
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./../errno.php?shop=".$_GET['shop']."&amp;errno=4'>";
 } else {

  $texto = "
	<p>Las categorías corresponden a las secciones de discos disponibles en el sitio, con el actual diseño (gemstone) no pueden ser más de 14.</p>
	<p>El campo imágen corresponde al nombre de la foto que representará a la categoría, se debe ingresar la url donde se encuentra este icono. MiCD tiene a disposición de los usuarios algunos iconos en el <a href=\"./../images/categorias\">siguiente link</a>. Además se puede buscar la foto en otra web o subirla a <a href=\"http://imageshack.us/\">ImageShack</a>.</p>
  ";

  if(!isset($_GET['editar']) && !isset($_GET['eliminar'])) {
   if(isset($_POST['agregar'])) {
    $consultasSql->consulta("INSERT INTO ".$micd['mysql']['prefix']."categorias (nombre,img) VALUES ('".$consultasSql->proteger($_POST['categoria'])."','".$consultasSql->proteger($_POST['img'])."')");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   } else {
    echo"
     <div id=\"titulo\">Agregar categoría</div>
     $texto
     <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_categorias(this);\">
      <table>
       <tr><td>Categoría</td><td><input type='text' name='categoria' size='66' maxlength='50' /></td></tr>
       <tr><td>Imágen</td><td><input type='text' name='img' size='66' maxlength='250' /></td></tr>
       <tr><td></td><td><input type='submit' name='agregar' value='Agregar'></td></tr>
      </table>
     </form>
     <div class=\"title\">Editar/eliminar categoría</div>
     <p>Para poder eliminar una categoría no puede haber disco alguno asociado a ella.</p>
     <script type='text/javascript'>
       function eliminar(id,are) {
        if(confirm('Confirmar el borrado de la categoría ' + are)) {
         document.location.href= '".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&eliminar=' + id;
        }
       }
      </script>
    ";
    $sql = $consultasSql->consulta("SELECT id,nombre FROM ".$micd['mysql']['prefix']."categorias ORDER BY nombre ASC");
    echo"<table class=\"table\"><tr><th>Categoría</th><td></td><td></td></tr>";
    while ($row = mysql_fetch_array($sql)) {
     echo"
      <tr>
       <td>".$row['nombre']."</td>
       <td><a href=\"".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;editar=1&amp;cat_id=".$row['id']."\">[Editar]</a></td>
       <td>
     ";
     $ndiscos = $consultasSql->contar($micd['mysql']['prefix']."discos","cat_id",$row['id']);
     if(!$ndiscos) echo"<a href='#' onclick=\"eliminar('".$row['id']."','".$row['nombre']."');\">[Eliminar]</a>";
     else echo"$ndiscos discos en esta categoría";
     echo"</td></tr>";
    }
    echo"</table>";
   }
  } else {
   if(isset($_GET['editar'])) {
    if(isset($_POST['edit'])) {
     $consultasSql->consulta("UPDATE ".$micd['mysql']['prefix']."categorias SET nombre = '".$consultasSql->proteger($_POST['categoria'])."', img = '".$consultasSql->proteger($_POST['img'])."' WHERE id = '".$consultasSql->proteger($_POST['cat_id'])."'");
     echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
    } else {
     $sql = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."categorias WHERE id='".$consultasSql->proteger($_GET['cat_id'])."'");
     $row = mysql_fetch_array($sql);
     echo"
      <div id=\"titulo\">Editar categoría &quot;".$row['nombre']."&quot;</div>
      $texto
      <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;editar=1' method='post' onsubmit=\"return validar_categorias(this);\">
       <table>
        <tr><td>Categoría</td><td><input type='text' name='categoria' size='66' maxlength='50' value='".$row['nombre']."' /></td></tr>
        <tr><td>Imágen</td><td><input type='text' name='img' size='66' value='".$row['img']."' maxlength='250' /></td></tr>
        <input type='hidden' name='cat_id' value='".$_GET['cat_id']."'>
        <tr><td></td><td><input type='submit' name='edit' value='Editar'></td></tr>
       </table>
      </form>
     ";
    }
   }
   if(isset($_GET['eliminar'])) {
    $consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."categorias WHERE id='".$consultasSql->proteger($_GET['eliminar'])."'");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   }
  }
 }

 require_once("./../inc/web2.inc.php");

?>
