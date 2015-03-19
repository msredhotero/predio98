<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');

$serviciosUsuario = new ServiciosUsuarios();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);

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

 
<div id="navigation" >
	<div class="todoMenu">
        <!--<div id="mobile-header">
            Menu
            <p>Usuario: <span style="color: #333; font-weight:900;"><?php //echo $_SESSION['nombre_cv']; ?></span></p>
        </div>-->
    
        <nav class="nav">
            <ul>
                <li class="arriba"><div class="icodashboard"></div><a href="index.php">Dashboard</a></li>
                <li><div class="icoventas"></div><a href="pedidos/">Pedidos</a></li>
                <li><div class="icousuarios"></div><a href="clientes/">Clientes</a></li>
                <li><div class="icoproductos"></div><a href="productos/">Productos</a></li>
                <li><div class="icosalir"></div><a href="../index.php">Salir</a></li>
            </ul>
        </nav>
        
      
     </div>
     
</div>

<div id="content">

<h3>Dashboard</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">asdasdas</p>
        	
        </div>
    	<div class="cuerpoBox">
    		
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
