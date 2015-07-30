<?php


include ('includes/funcionesUsuarios.php');
include ('includes/funcionesHTML.php');
include ('includes/funcionesFUNC.php');
include ('includes/funciones.php');
include ('includes/funcionesGrupos.php');
include ('includes/funcionesDATOS.php');
include ('includes/funcionesNoticias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFUNC = new ServiciosFUNC();
$serviciosFunciones = new Servicios();
$serviciosZonas = new ServiciosG();
$serviciosDatos = new ServiciosDatos();
$serviciosNoticias = new ServiciosNoticias();

$fecha = date('Y-m-d');



?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Predio 98' />

<meta name='description' content='Canchas de Fútbol 11, Canchas de Fútbol 7, Torneos de Fútbol' />

<meta name='keywords' content='Fútbol, Torneos, Canchas, Fútbol 11, Fútbol 7' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.predio98.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />

<link rel="predio98" href="imagenes/predio98icon.ico" />


<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Predio 98 | Fúlbol 11 | Fútbol 7</title>



<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

 <link rel="stylesheet" href="css/jquery-ui.css">

<script src="js/jquery-ui.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
     
<link rel="stylesheet" href="css/normalize.min.css">   

<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>     

<style>
    label {
        padding-bottom:6px;
		padding-top:6px;
    }
</style>

<link rel="stylesheet" href="css/responsiveslides.css">
<script src="js/responsiveslides.min.js"></script>

  <script>
    // You can also use "$(window).load(function() {"
    $(function () {


      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events2').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events2').append("<li>after event fired.</li>");
        }
      });

    });
  </script>
     
     
     
<script type="text/javascript">
	$(document).ready(function(){
		
		
	
	});
</script> 
</head>



<body>
<div style="background-color:#000; height:auto; margin-top:-20px; padding-top:20px;">
    <div class="clearfix content">
    	<div class="row">
        
        </div>
    	<div class="header-container">
            <header class="wrapper clearfix">
                <div align="center" style="margin-bottom:-55px; margin-left:-25px;">
                <a href="index.php"><img src="imagenes/logo2.png"></a>
                </div>
               
                
                <nav id="menu">
                    <ul class="clearfix contenedorMenu">
                        <li class="menuA"><a href="#">Inicio</a></li>
                        <li class="torneoMenu"><a href="#">Torneos</a></li>
                        <li class="menuA"><a href="reglamento.html">Reglamento</a></li>
                        <li class="menuA"><a href="#">Premios</a></li>
                        <li id="separar" style="margin-right:60px; padding-right:60px; display:block;"> </li>
                        <li class="menuA"><a href="#">Desarrollo</a></li>
                        <li class="menuA"><a href="#">Servicios</a></li>
                        <li class="menuA"><a href="#">Fotos</a></li>
                        <li class="menuA"><a href="#">Contacto</a></li>
                    </ul>
                    <a href="#" id="pull">Menú</a>
                </nav>
            </header>
        </div>
    	
        <div class="row" style=" background-color:#dadada; z-index:9999999px; display:block; margin-left:10px; margin-right:10px;">
        	<div id="submenu" style="display:none; z-index:9999999px;">
            <div style="height:auto; position:relative; ">
            	<div class="col-md-4" style="padding-top:10px;">
                	<div class="alert alert-predio alert-dismissible submenu" id="futbolco">
                    	<p style="font-size:1.3em;"> Torneo de Fútbol 11 con Off-side</p> 
                    </div>
                    <div class="alert alert-predio alert-dismissible submenu" id="futbolso">
                    	<p style="font-size:1.3em;"> Torneo de Fútbol 11 sin Off-side</p> 
                    </div>
                    <div class="alert alert-predio alert-dismissible submenu" id="futbol">
                    	<p style="font-size:1.3em;"> Torneo de Fútbol 7</p> 
                    </div>
                </div>
                <div class="col-md-4 foncecoE" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Estadísticas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Posiciones</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Resultados</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Goleadores</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Fair Play</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Suspendidos</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Amonestados</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 foncesoE" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Estadísticas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Posiciones</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Resultados</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Goleadores</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Fair Play</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Suspendidos</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Amonestados</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 fsieteE" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Estadísticas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Posiciones</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Resultados</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Goleadores</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Fair Play</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Suspendidos</a></li>
                            <li><span class="glyphicon glyphicon-plus-sign"></span> <a href="">Amonestados</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 foncecoI" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                    <br>
                    <div class="col-md-6" align="center" style="margin-top:15px;">
                    	
                        <h4 class="textoTrazoTitulos"> Zonas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;margin-top:15px;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=19&idtorneo=1">Zona A</a></li>
                            <li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=20&idtorneo=1">Zona B</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 foncesoI" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                    <br>
                    <div class="col-md-6" align="center" style="margin-top:15px;">
                    	
                        <h4 class="textoTrazoTitulos"> Zonas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;margin-top:15px;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=19&idtorneo=2">Zona A</a></li>
                            <li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=20&idtorneo=2">Zona B</a></li>
                            <li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=21&idtorneo=2">Zona C</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 fsieteI" style="display:none;">
                	<div class="col-md-6" align="center">
                    	
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6" align="center" style="margin-top:15px;">
                    	
                        <h4 class="textoTrazoTitulos"> Zonas</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;margin-top:15px;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=19&idtorneo=3">Zona A</a></li>
                            <li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=20&idtorneo=3">Zona B</a></li>
                            <li><span class="glyphicon glyphicon-th"></span> <a href="zonas.php?zona=21&idtorneo=3">Zona C</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        
        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                    
                    
                    
                </article>

                

            </div> <!-- #main -->
            <aside style=" text-align:center; font-size:1.2em; margin-left:5px; margin-bottom:-12px;
" class="clearfix">
                    <ul class="list-inline" style="background-color:#fff; padding-top:15px; padding-bottom:15px;-moz-border-radius: 0em 0em 0.6em 0.6em;
-webkit-border-radius: 0em 0em 0.6em 0.6em;
border-radius: 0em 0em 0.6em 0.6em;">
                    	<li><a href="#">Inicio</a></li>
                        <li><a href="#">Reglamento</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Fotos</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </aside>
        </div> <!-- #main-container -->
        
        
    </div>
    
    
    
    
        
        
    
    <!--
	<div class="footer-container">
        <footer class="wrapper">
            <h3>footer</h3>
        </footer>
    </div>  -->
</div>
    <footer class="clearfix">
    
    
        <div align="center">
            <p><strong>Copyright © 2015 Predio98. Diseño Web: Saupurein Marcos.</strong></p>
        </div>


	</footer>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#btnfixture').click(function() {
		url = "fixture.php";
		$(location).attr('href',url);
	});
	
	
	
	$('.torneoMenu').hover(function(e) {
        $('#submenu').show(600);
		$('.torneoMenu').addClass('cambioT');
    });
	
	$('#submenu').mouseover(function(e) {
        
    });
	
	$('#submenu').mouseleave(function(e) {
		e.preventDefault();
        $('#submenu').hide(500);
    });
	
	$('#futbolco').hover(function(e) {
        /*$('.foncecoI').removeClass('hidden');
		$('.foncecoE').removeClass('hidden');*/
		$('.foncecoI').show(430);
		$('.foncecoE').show(460);
		$('#futbolso').css('opacity','0.7');
		$('#futbol').css('opacity','0.7');
		$('.foncesoI').hide(300);
		$('.foncesoE').hide(300);
		$('.fsieteI').hide(300);
		$('.fsieteE').hide(300);
    });
	
	$('#futbolco').mouseleave(function(e) {
        $('#futbolso').css('opacity','1');
		$('#futbol').css('opacity','1');
		
    });
	
	
	$('#futbolso').hover(function(e) {
        $('.foncesoI').show(430);
		$('.foncesoE').show(450);
		$('#futbolco').css('opacity','0.7');
		$('#futbol').css('opacity','0.7');
		$('.foncecoI').hide(300);
		$('.foncecoE').hide(300);
		$('.fsieteI').hide(300);
		$('.fsieteE').hide(300);
    });
	
	$('#futbolso').mouseleave(function(e) {
		$('#futbolco').css('opacity','1');
		$('#futbol').css('opacity','1');
    });
	
	$('#futbol').hover(function(e) {
        $('.fsieteI').show(430);
		$('.fsieteE').show(450);
		$('#futbolso').css('opacity','0.7');
		$('#futbolco').css('opacity','0.7');
		$('.foncesoI').hide(300);
		$('.foncesoE').hide(300);
		$('.foncecoI').hide(300);
		$('.foncecoE').hide(300);
    });
	
	$('#futbol').mouseleave(function(e) {
		$('#futbolso').css('opacity','1');
		$('#futbolco').css('opacity','1');
    });
	
	
});
</script>


</body>

</html>