<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesJugadores.php');
include ('../includes/funcionesEquipos.php');
include ('../includes/funcionesGrupos.php');
include ('../includes/funcionesZonasEquipos.php');
include ('../includes/funcionesNoticias.php');

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosFunciones = new Servicios();
$serviciosHTML		= new ServiciosHTML();
$serviciosJugadores = new ServiciosJ();
$serviciosEquipos	= new ServiciosE();
$serviciosGrupos	= new ServiciosG();
$serviciosZonasEquipos	= new ServiciosZonasEquipos();
$serviciosNoticias = new ServiciosNoticias();
$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$resEquipos = $serviciosFunciones->traerPlanillas();






$pdf = new FPDF();

while ($rowE = mysql_fetch_array($resEquipos)) {

	$pdf->AddPage();

	$pdf->Rect(10,10,190,270,'');
	$pdf->Image('../imagenes/logo4.png',84.5,20,0);
	$pdf->Rect(10,50,190,230,'');
	$pdf->SetFont('Arial','U',15);
	$pdf->Cell(180,7,'PREDIO 98',0,0,'C',false);
	$pdf->Ln();
	$pdf->SetXY(10,50);
	$pdf->Cell(180,7,'PLANILLA DE INCRIPCI�N - BUENA FE',0,0,'C',false);
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->MultiCell(190,4,'IMPORTANTE:  El "Predio 98� canchas de f�tbol, denominado tambi�n �La Organizaci�n� no se responsabiliza por lesiones ocasionadas en uso de las instalaciones, pr�cticas de juego, y/o hechos de fuerza mayor y/o caso fortuito, agresiones personales u otros hechos que causen perjuicios material y/o lesiones corporales, como asimismo tampoco se responsabiliza por extrav�o y/o p�rdida de objetos personales, reserv�ndose el derecho de admisi�n a la totalidad de canchas y/o establecimiento.',1,'L',false);
	$pdf->SetFont('Arial','B',8);
	$pdf->MultiCell(190,4,'Con la firma del presente, expresamente desiste de cualquier reclamo y acci�n al respecto. Los DNI y firmas pueden ser completados en la 1� fecha en el Predio.',1,'L',false);
	
	$pdf->SetFillColor(255,10,12);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(190,5,'COMPLETAR TODOS LOS DATOS CON MAYUSCULAS',1,0,'C',true);
	
	//////////////////// Aca arrancan a cargarse los datos de los equipos  /////////////////////////
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'NOMBRE DEL EQUIPO:',1,0,'C',false);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(142.5,5,strtoupper($rowE['nombre']),1,0,'C',false);
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->SetFillColor(155,155,155);
	$pdf->Cell(47.5,5,'Nombre capitan del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(47.5,5,strtoupper($rowE['nombrecapitan']),1,0,'L',false);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Nombre sub-cap. del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(47.5,5,strtoupper($rowE['nombresubcapitan']),1,0,'L',false);
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Tel�fono capitan del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(47.5,5,strtoupper($rowE['telefonocapitan']),1,0,'L',false);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Tel�fono sub-cap. del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(47.5,5,strtoupper($rowE['telefonosubcapitan']),1,0,'L',false);
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Email capitan del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(47.5,5,strtoupper($rowE['emailcapitan']),1,0,'L',false);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Email sub-cap. del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(47.5,5,strtoupper($rowE['emailsubcapitan']),1,0,'L',false);
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Facebook capitan del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(47.5,5,strtoupper($rowE['facebookcapitan']),1,0,'L',false);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(47.5,5,'Facebook sub-cap. del equipo:',1,0,'L',true);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(47.5,5,strtoupper($rowE['facebooksubcapitan']),1,0,'L',false);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln();
	$pdf->Cell(190,5,'JUGADORES',1,0,'C',false);
	$pdf->SetFont('Arial','',9);
	$resJugadores = $serviciosJugadores->TraerJugadoresPorEquipo($rowE['idequipo']);
	
	$pdf->Ln();
	$pdf->Cell(47.5,5,'APELLIDO Y NOMBRE',1,0,'C',true);
	$pdf->Cell(20,5,'DNI',1,0,'C',true);
	$pdf->Cell(25,5,'FIRMA',1,0,'C',true);
	$pdf->Cell(22.5,5,'N�CAMISETA',1,0,'C',true);
	$pdf->Cell(20,5,'GOLES',1,0,'C',true);
	$pdf->Cell(20,5,'AMARILLAS',1,0,'C',true);
	$pdf->Cell(20,5,'ROJAS',1,0,'C',true);
	$pdf->Cell(15,5,'JUGO',1,0,'C',true);
	
	$i = 0;
	while ($rowJ = mysql_fetch_array($resJugadores))
	{
		$i = $i+1;
		$pdf->Ln();
		$pdf->Cell(47.5,5,$rowJ['apyn'],1,0,'L',false);
		$pdf->Cell(20,5,$rowJ['dni'],1,0,'C',false);
		$pdf->Cell(25,5,'',1,0,'C',false);
		$pdf->Cell(22.5,5,'',1,0,'C',false);
		$pdf->Cell(20,5,'',1,0,'C',false);
		$pdf->Cell(20,5,'',1,0,'C',false);
		$pdf->Cell(20,5,'',1,0,'C',false);
		$pdf->Cell(15,5,'Si/No',1,0,'C',false);
		
	}
	
	if ($i < 32) {
		for ($j=$i+1;$j<32;$j++) {
			$pdf->Ln();
			$pdf->Cell(47.5,5,'',1,0,'C',false);
			$pdf->Cell(20,5,'',1,0,'C',false);
			$pdf->Cell(25,5,'',1,0,'C',false);
			$pdf->Cell(22.5,5,'',1,0,'C',false);
			$pdf->Cell(20,5,'',1,0,'C',false);
			$pdf->Cell(20,5,'',1,0,'C',false);
			$pdf->Cell(20,5,'',1,0,'C',false);
			$pdf->Cell(15,5,'',1,0,'C',false);
		}
	}
	
}
//120 x 109



$nombreTurno = "Planillas-".$fecha.".pdf";

$pdf->Output($nombreTurno,'I');


?>

