<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesFUNC.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFUNC = new ServiciosFUNC();



$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Dashboard",$_SESSION['refroll_predio'],utf8_encode($_SESSION['torneo_predio']));


$resFechas = $serviciosFUNC->TraerProgramaPorFecha(3,21,'Fecha 6');


$torneo11ca = $serviciosFUNC->TraerFixturePorZonaTorneo(1,19);
$torneo11cb = $serviciosFUNC->TraerFixturePorZonaTorneo(1,20);

$torneo11sa = $serviciosFUNC->TraerFixturePorZonaTorneo(2,19);
$torneo11sb = $serviciosFUNC->TraerFixturePorZonaTorneo(2,20);
$torneo11sc = $serviciosFUNC->TraerFixturePorZonaTorneo(2,21);

$torneo7a = $serviciosFUNC->TraerFixturePorZonaTorneo(3,19);
$torneo7b = $serviciosFUNC->TraerFixturePorZonaTorneo(3,20);
$torneo7c = $serviciosFUNC->TraerFixturePorZonaTorneo(3,21);



///////////////// goleadores  ////////////////////////////
$goleadores11ca = $serviciosFUNC->Goleadores(1,19);
$goleadores11cb = $serviciosFUNC->Goleadores(1,20);

$goleadores11sa = $serviciosFUNC->Goleadores(2,19);
$goleadores11sb = $serviciosFUNC->Goleadores(2,20);
$goleadores11sc = $serviciosFUNC->Goleadores(2,21);

$goleadores7a = $serviciosFUNC->Goleadores(3,19);
$goleadores7b = $serviciosFUNC->Goleadores(3,20);
$goleadores7c = $serviciosFUNC->Goleadores(3,21);

/////////////////////////////////////////////////////////
?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gestión: Predio 98</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
  
		
	</style>
    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">

<h3>Dashboard</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Fechas</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<form class="form-inline formulario" role="form">
            	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:750px; margin-left:20px; font-weight:bold;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="5" align="center" style="font-size:1.9em;">RESULTADOS ZONA C</td>
                        </tr>
                        <?php while ($row = mysql_fetch_array($resFechas)) { ?>
                        <tr style="font-size:1.5em;">
                        	<td align="center" bgcolor="#bfbfbf" width="40px" style="padding:1px 6px;"><?php echo $row['resultadoa']; ?></td>
                            <td align="center" style="padding:1px 6px;"><?php echo $row['equipo1']; ?></td>
                            <td align="center" style="padding:1px 6px;" bgcolor="#bfbfbf">Horario <?php echo $row['hora']; ?></td>
                            <td align="center" style="padding:1px 6px;"><?php echo (utf8_encode($row['equipo2']) == 'GUARDA LA JARRA QUE VIENE LUIS' ? 'GUARDA LA JARRA' : utf8_encode($row['equipo2'])); ?></td>
                            <td align="center" style="padding:1px 6px;" bgcolor="#bfbfbf" width="40px"><?php echo $row['resultadob']; ?></td>
                        </tr>
                    	<?php } ?>
                    </table>
                
                </div>
            
            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Torneo Futbol 11 Con Off-Side</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<form class="form-inline formulario" role="form">
            	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo11ca)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo11cb)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores11ca)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores11cb)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
            
            </form>
    	</div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Torneo Futbol 11 Sin Off-Side</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<form class="form-inline formulario" role="form">
            	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo11sa)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo11sb)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA C</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo11sc)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
            	
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores11sa)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores11sb)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA C</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores11sc)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
            </form>
    	</div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Torneo Futbol 7</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<form class="form-inline formulario" role="form">
            	<div class="row">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo7a)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo7b)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="11" align="center" style="font-size:1.9em;">RESULTADOS ZONA C</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">POSICION</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">PTS</td>
                            <td align="center" style="padding:1px 6px;">PJ</td>
                            <td align="center" style="padding:1px 6px;">PG</td>
                            <td align="center" style="padding:1px 6px;">PE</td>
                            <td align="center" style="padding:1px 6px;">PP</td>
                            <td align="center" style="padding:1px 6px;">GF</td>
                            <td align="center" style="padding:1px 6px;">GC</td>
                            <td align="center" style="padding:1px 6px;">DIF</td>
                            <td align="center" style="padding:1px 6px;">F.P.</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($torneo7c)) { ?>
                        <tr style="font-size:1.5em;">
							<td align="right" style="padding:1px 6px;"><?php echo $i; ?></td>
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['pts']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['partidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['ganados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['empatados']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['perdidos']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesafavor']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['golesencontra']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['diferencia']; ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['puntos']; ?></td>
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
            
            
            	<div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA A</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores7a)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA B</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores7b)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                	<table cellpadding="0" cellspacing="0" border="2" bordercolor="#FF0000" style="width:auto; margin-left:20px; font-weight:bold; margin-right:20px;">
                    	<tr bgcolor="#bfbfbf">
                        	<td colspan="3" align="center" style="font-size:1.9em;">GOLEADORES ZONA C</td>
                        </tr>
                        <tr style="font-size:1.5em;">
                        	<td align="center" style="padding:1px 6px;">NOMBRE Y APELLIDO</td>
                            <td align="center" style="padding:1px 6px;">EQUIPO</td>
                            <td align="center" style="padding:1px 6px;">CANTIDAD</td>
                        </tr>
                        <?php 
						$i =1;
						while ($row1 = mysql_fetch_array($goleadores7c)) { ?>
                        <tr style="font-size:1.5em;">
                            <td align="left" style="padding:1px 6px;"><?php echo utf8_encode($row1['apyn']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo utf8_encode($row1['nombre']); ?></td>
                            <td align="right" style="padding:1px 6px;"><?php echo $row1['cantidad']; ?></td>
                            
                        </tr>
                    	<?php 
						$i = $i + 1;
						} ?>
                    </table>
                
                </div>
            </form>
    	</div>
    </div>

    
    
   
</div>


</div>




<script type="text/javascript">
$(document).ready(function(){
	
	 $( '#dialogDetalle' ).dialog({
		autoOpen: false,
		resizable: false,
		width:800,
		height:740,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			}
		}
	});

	 $( '#dialog2' ).dialog({
		autoOpen: false,
		resizable: false,
		width:800,
		height:740,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	

});
</script>
<?php } ?>
</body>
</html>
