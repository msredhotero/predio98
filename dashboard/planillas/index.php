<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesEquipos.php');

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosEquipos 	= new ServiciosE();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Planillas",$_SESSION['refroll_predio'],utf8_encode($_SESSION['torneo_predio']));


$resFechas 	= $serviciosFunciones->TraerFecha();

$cadFecha = '';
while ($rowFF = mysql_fetch_array($resFechas)) {
	$cadFecha = $cadFecha.'<option value="'.$rowFF[0].'">'.utf8_encode($rowFF[1]).'</option>';
	
}
/////////////////////// Opciones para la creacion del formulario  /////////////////////

//////////////////////////////////////////////  FIN de los opciones //////////////////////////



if ($_SESSION['refroll_predio'] != 1) {

} else {

	
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gestión: Predio 98</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
  
		
	</style>
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Equipos</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de Equipos</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
            
            <div class="row" style="margin-left:15px;" align="center">
            	<div class="form-group col-md-4">
                    <label class="control-label" style="text-align:left" for="idequipo">Fecha</label>
                    <div class="input-group col-md-12">
                        <select id="reffecha" class="form-control" name="reffecha">
                            <?php echo $cadFecha; ?>
                        </select>
                    </div>
                </div>
            </div>
                    
        	<div class="row" style="margin-left:15px;" align="center">
                <ul class="list-inline">
                    <li>
                        <button type="button" class="btn-lg btn-success" id="cargar" style="margin-left:0px;">Planillas Fútbol 11</button>
                    </li>
                    <li>
                        <button type="button" class="btn-lg btn-info" id="guardar" style="margin-left:0px;">Planillas Fútbol 7</button>
                    </li>
                </ul>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
           
            </form>
    	</div>
    </div>
    
 
   
</div>


</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#cargar').click(function(event){
		
		url = "../../reportes/planillasf11.php?reffecha="+$('#reffecha').val();
		//$(location).attr('href',url);
		window.open(url, '_blank');
      	return false;
	});//fin del boton eliminar
	
	$('#guardar').click(function(event){

		url = "../../reportes/planillasf7.php?reffecha="+$('#reffecha').val();
		//$(location).attr('href',url);
		window.open(url, '_blank');
      	return false;
	});//fin del boton eliminar

});
</script>
<?php } ?>
</body>
</html>
