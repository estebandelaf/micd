<?php

 /*************************************************/
 /* ARCHIVO DE CONFIGURACION DE FORMATOS          */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 15-02-08                      */
 /*************************************************/

 require_once("./../inc/web1.inc.php");

 if(!$login) {
  echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./../errno.php?shop=".$_GET['shop']."&amp;errno=4'>";
 } else {

  $texto = "
	<p>Los formatos ayudan al usuario a saber que tipo de disco comprará. Las descripciones serán visualizadas en una página especial donde se podrán ver todos los formatos.</p>
  ";

  if(!isset($_GET['editar']) && !isset($_GET['eliminar'])) {
   if(isset($_POST['agregar'])) {
    $consultasSql->consulta("INSERT INTO ".$micd['mysql']['prefix']."formatos (formato,descripcion) VALUES ('".$consultasSql->proteger($_POST['formato'])."','".$consultasSql->proteger($_POST['descripcion'])."')");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   } else {
    echo"
     <div id=\"titulo\">Agregar formato</div>
     $texto
     <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."' method='post' onsubmit=\"return validar_formatos(this);\">
      <table>
       <tr><td>Formato</td><td><input type='text' name='formato' size='66' maxlength='30' /></td></tr>
	<tr><td>Descripci&oacute;n</td><td><textarea name='descripcion' rows='15' cols='50'></textarea></td></tr>
       <tr><td></td><td><input type='submit' name='agregar' value='Agregar'></td></tr>
      </table>
     </form>
     <div class=\"title\">Editar/eliminar formato</div>
     <p>Para poder eliminar un formato no puede haber disco alguno asociado a él.</p>
     <script type='text/javascript'>
       function eliminar(id,are) {
        if(confirm('Confirmar el borrado del formato ' + are)) {
         document.location.href= '".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&eliminar=' + id;
        }
       }
      </script>
    ";
    $sql = $consultasSql->consulta("SELECT id,formato FROM ".$micd['mysql']['prefix']."formatos ORDER BY formato ASC");
    echo"<table class=\"table\"><tr><th>Formato<td></td><td></td></tr>";
    while ($row = mysql_fetch_array($sql)) {
     echo"
      <tr>
       <td>".$row['formato']."</td>
       <td><a href='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;editar=1&amp;formato_id=".$row['id']."'>[Editar]</a></td>
       <td>
     ";
     $ndiscos = $consultasSql->contar($micd['mysql']['prefix']."discos","formato",$row['id']);
     if(!$ndiscos) echo"<a href='#' onclick=\"eliminar('".$row['id']."','".$row['formato']."');\">[Eliminar]</a>";
     else echo"$ndiscos discos con este formato";
     echo"
       </td>
      </tr>
     ";
    }
    echo"</table>";
   }
  } else {
   if(isset($_GET['editar'])) {
    if(isset($_POST['edit'])) {
     $consultasSql->consulta("UPDATE ".$micd['mysql']['prefix']."formatos SET formato = '".$consultasSql->proteger($_POST['formato'])."', descripcion = '".$consultasSql->proteger($_POST['descripcion'])."' WHERE id = '".$consultasSql->proteger($_POST['formato_id'])."'");
     echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
    } else {
     $sql = $consultasSql->consulta("SELECT * FROM ".$micd['mysql']['prefix']."formatos WHERE id='".$consultasSql->proteger($_GET['formato_id'])."'");
     $row = mysql_fetch_array($sql);
     echo"
      <div id=\"titulo\">Editar formato &quot;".$row['formato']."&quot;</div>
      $texto
      <form action='".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."&amp;editar=1' method='post' onsubmit=\"return validar_formatos(this);\">
       <table>
        <tr><td>Formato</td><td><input type='text' name='formato' size='66' maxlength='30' value='".$row['formato']."' /></td></tr>
        <tr><td>Descripci&oacute;n</td><td><textarea name='descripcion' rows='15' cols='50'>".$row['descripcion']."</textarea></td></tr>
        <input type='hidden' name='formato_id' value='".$_GET['formato_id']."'>
        <tr><td></td><td><input type='submit' name='edit' value='Editar'></td></tr>
       </table>
      </form>
     ";
    }
   }
   if(isset($_GET['eliminar'])) {
    $consultasSql->consulta("DELETE FROM ".$micd['mysql']['prefix']."formatos WHERE id='".$consultasSql->proteger($_GET['eliminar'])."'");
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$_SERVER['PHP_SELF']."?shop=".$_GET['shop']."'>";
   }
  }
 }

 require_once("./../inc/web2.inc.php");

?>
