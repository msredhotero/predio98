<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');

$serviciosFunciones = new Servicios();
$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Amonestados",$_SESSION['refroll_predio']);



/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbtorneos";

$lblCambio[] 	= "reftipotorneo";
$lblreemplazo[] = "Tipo Torneo";

$resTipoTorneo 	= $serviciosFunciones->traerTipoTorneo();

$cadRef = '';
while ($rowTT = mysql_fetch_array($resTipoTorneo)) {
	$cadRef = $cadRef.'<option value="'.$rowTT[0].'">'.utf8_encode($rowTT[1]).'</option>';
	
}

$refdescripcion = array(0 => $cadRef);
$refCampo[] 	= "reftipotorneo"; 
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




/////////////////////// Opciones para la creacion del view  /////////////////////
$cabeceras 		= "	<th>Nombre</th>
				<th>Fecha Creación</th>
				<th>Activo</th>
				<th>Tipo Torneo</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$formulario 	= $serviciosFunciones->camposTabla("insertarTorneo",$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosFunciones->TraerTorneos());



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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    

    
   
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

<h3>Torneos</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de Torneos</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $formulario; ?>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Guardar</button>
                    </li>
                </ul>
                </div>
            </div>
    	</div>
    </div>
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Torneos Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
    	</div>
    </div>
    
    

    
    
   
</div>


</div>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>


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
	
	
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>

});
</script>

<script type="text/javascript">
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
</script>


<?php } ?>
</body>
</html>
