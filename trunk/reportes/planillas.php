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


$pdf->AddPage();

$pdf->Rect(10,10,190,270,'');
$pdf->Image('../imagenes/logo4.png',84.5,20,0);
$pdf->Rect(10,50,190,230,'');
$pdf->SetFont('Arial','U',15);
$pdf->Cell(180,7,'PREDIO 98',0,0,'C',false);
$pdf->Ln();
$pdf->SetXY(10,50);
$pdf->Cell(180,7,'PLANILLA DE INCRIPCIÓN - BUENA FE',0,0,'C',false);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190,4,'IMPORTANTE:  El "Predio 98” canchas de fútbol, denominado también “La Organización” no se responsabiliza por lesiones ocasionadas en uso de las instalaciones, prácticas de juego, y/o hechos de fuerza mayor y/o caso fortuito, agresiones personales u otros hechos que causen perjuicios material y/o lesiones corporales, como asimismo tampoco se responsabiliza por extravío y/o pérdida de objetos personales, reservándose el derecho de admisión a la totalidad de canchas y/o establecimiento.',1,'L',false);
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(190,4,'Con la firma del presente, expresamente desiste de cualquier reclamo y acción al respecto. Los DNI y firmas pueden ser completados en la 1º fecha en el Predio.',1,'L',false);

$pdf->SetFillColor(255,10,12);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'COMPLETAR TODOS LOS DATOS CON MAYUSCULAS',1,0,'C',true);
//120 x 109


$pdf->SetFont('Arial','',10);


$nombreTurno = "Planillas-".$fecha.".pdf";

$pdf->Output($nombreTurno,'I');


?>

