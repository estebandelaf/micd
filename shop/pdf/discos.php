<?php

 /*************************************************/
 /* ARCHIVO QUE GENERA LOS PDF                    */
 /* Desarrollador: DeLaF www.delaf.tk             */
 /* Mail: esteban.delaf@gmail.com                 */
 /* Ultima version: 10-02-08                      */
 /*************************************************/

	require_once("./../inc/config.inc.php"); 
	require_once("./fpdf.php");

	define("TITULO", "Listado de Discos");
	define("FONT_TYPE", "Arial");

	class PDF extends FPDF {

		//Cabecera de pagina
		function Header() {
			global $micd;
			$fecha= date('d-m-Y',$micd['tiempo_real']); // definir fecha actual
			$hora=date('H:i',$micd['tiempo_real']); // definir hora actual
			$this->Image('./../images/micd.jpg',9,7,50); // membrete
			$this->SetFont(FONT_TYPE,'B',20);
			$this->SetTextColor(0,0,0); // color de la fuente en negro
			$this->Cell(80); // movernos a la derecha
			$this->Cell(0,28,TITULO,0,0,'L'); // titulo, el valor despues del contenido indica el borde: 0=sin borde, 1=con borde
			$this->SetFont(FONT_TYPE,'I',8);
			$this->Cell(0,0,'Documento generado el '.$fecha.' a las '.$hora,0,0,'R');
			$this->Ln(45); // salto de linea
		}

		//Pie de pagina
		function Footer() {
			$this->SetY(-20);
			$this->SetFont(FONT_TYPE,'I',10);
			$this->Cell(0,8,'p'.$this->PageNo().'/{nb}',0,0,'C');
		}

	}

	//Creacion del objeto de la clase heredada
	$pdf=new PDF('P','mm','a4'); // orientacion vertical, se mide en milimetros y que el formato es a4
	$pdf->AddFont('Arial','','arial.php');
	$pdf->AddFont('Arial','I','ariali.php');
	$pdf->AddFont('Arial','B','arialb.php');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFont(FONT_TYPE,'',12);
	if($micd['telefono']) $telefono = " o llamar al teléfono ".$micd['telefono'].".";
	else $telefono = ".";
	$pdf->MultiCell(0,4.5,"A continuación se listan los discos disponibles. En caso de querer solicitar alguno escribir un mail a ".$micd['email']."$telefono",0);
	$pdf->Ln(5);
	$pdf->MultiCell(0,4.5,"Si desea más detalles de cada disco puede visitar la web http://micd.sytes.net/".$_GET['shop'].", para facilitar la búsqueda puede utilizar el buscador del sitio con el nombre del disco que desee.",0);
	$pdf->Ln(10);

	if(!isset($_GET['cat_id'])){
		$sql2 = $consultasSql->consulta("SELECT id,nombre FROM ".$micd['mysql']['prefix']."categorias ORDER BY nombre ASC") or $consultasSql->error();
		while($row2 = mysql_fetch_array($sql2)) {
			$pdf->SetFont(FONT_TYPE,'B',16);
			$pdf->Cell(170,0,$row2['nombre']);
			$pdf->Ln(8);
			$pdf->SetFont(FONT_TYPE,'B',12);
			$pdf->Cell(170,0,"Nombre disco");
			if($micd['mod_precios']) $pdf->Cell(0,0,"Precio",0,1,'L');
			$pdf->Ln(5);
			$sql = $consultasSql->consulta("SELECT id,nombre,cantidad,precio,tipo_disco,clasificacion FROM ".$micd['mysql']['prefix']."discos WHERE cat_id = ".$row2['id']) or $consultasSql->error();
			while($row = mysql_fetch_array($sql)) {
				if($row['clasificacion']) $clasificacion = "[".$row['clasificacion']."] ";
				else $clasificacion = "";
				$pdf->SetFont(FONT_TYPE,'',12);
				$pdf->Cell(170,0,$clasificacion.$row['nombre']);
				if($micd['mod_precios']) {
					if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
					else $precio = $row['precio'];
					$pdf->Cell(0,0,"$".$precio,0,1,'L');
				}
				$pdf->Ln(5);
			}
			$pdf->Ln(10);
		}
	} else {
		$sql2 = $consultasSql->consulta("SELECT nombre FROM ".$micd['mysql']['prefix']."categorias WHERE id = ".$_GET['cat_id']) or $consultasSql->error();
		$row2 = mysql_fetch_array($sql2);
		$pdf->SetFont(FONT_TYPE,'B',16);
		$pdf->Cell(170,0,$row2['nombre']);
		$pdf->Ln(8);
		$pdf->SetFont(FONT_TYPE,'B',12);
		$pdf->Cell(170,0,"Nombre disco");
		if($micd['mod_precios']) $pdf->Cell(0,0,"Precio",0,1,'L');
		$pdf->Ln(5);
		$sql = $consultasSql->consulta("SELECT id,nombre,cantidad,precio,tipo_disco,clasificacion FROM ".$micd['mysql']['prefix']."discos WHERE cat_id = ".$_GET['cat_id']) or $consultasSql->error();
		while($row = mysql_fetch_array($sql)) {
			if($row['clasificacion']) $clasificacion = "[".$row['clasificacion']."] ";
			else $clasificacion = "";
			$pdf->SetFont(FONT_TYPE,'',12);
			$pdf->Cell(170,0,$clasificacion.$row['nombre']);
			if($micd['mod_precios']) {
				if(!$row['precio']) $precio = $micd['precio'][$row['tipo_disco']][0] + ($row['cantidad']-1) * $micd['precio'][$row['tipo_disco']][1];
				else $precio = $row['precio'];
				$pdf->Cell(0,0,"$".$precio,0,1,'L');
			}
			$pdf->Ln(5);
		}
		$pdf->Ln(10);
	}


	$pdf->SetTitle(TITULO);
	$pdf->SetAuthor('Mi CD vBetha');
	$pdf->Output("discos.pdf",'I'); // =I lo muestra, =D lo baja
   
	$consultasSql->cerrar();

?>
