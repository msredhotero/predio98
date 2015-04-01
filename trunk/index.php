<?php





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
        auto: false,
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
      
</head>



<body>
<div style="background-color:#000; height:auto; margin-top:-20px; padding-top:20px;">
    <div class="clearfix content">
    	<div class="row">
        
        </div>
    	<div class="header-container">
            <header class="wrapper clearfix">
                <div align="center">
                <a href="index.php"><img src="imagenes/logo.png"></a>
                </div>
               
                
                <nav id="menu">
                    <ul class="clearfix contenedorMenu">
                        <li class="menuA"><a href="#">Inicio</a></li>
                        <li class="torneoMenu"><a href="#">Torneos</a></li>
                        <li class="menuA"><a href="#">Reglamento</a></li>
                        <li class="menuA"><a href="#">Desarrollo</a></li>
                        <li class="menuA"><a href="#">Premios</a></li>
                        <li class="menuA"><a href="#">Servicios</a></li>
                        <li class="menuA"><a href="#">Fotos</a></li>
                    </ul>
                    <a href="#" id="pull">Menú</a>
                </nav>
            </header>
        </div>
    	
        <div class="row" style=" background-color:#dadada; z-index:9999999px; display:block;">
        	<div id="submenu" style="display:none; z-index:9999999px;">
            <div style="height:auto; position:relative; ">
            	<div class="col-md-4" style="padding-top:10px;">
                	<div class="alert alert-danger alert-dismissible submenu" id="futbolco">
                    	<p style="font-size:1.3em;"><img src="imagenes/pelota.png" width="35" height="35" style="float:left; margin-top:-1%;  margin-right:4%;"> Torneo de Fútbol 11 con Off-side</p> 
                    </div>
                    <div class="alert alert-info alert-dismissible submenu" id="futbolso">
                    	<p style="font-size:1.3em;"><img src="imagenes/pelota.png" width="35" height="35" style="float:left; margin-top:-1%;margin-right:4%;"> Torneo de Fútbol 11 sin Off-side</p> 
                    </div>
                    <div class="alert alert-success alert-dismissible submenu" id="futbol">
                    	<p style="font-size:1.3em;"><img src="imagenes/pelota.png" width="35" height="35" style="float:left; margin-top:-1%;margin-right:4%;"> Torneo de Fútbol 7</p> 
                    </div>
                </div>
                <div class="col-md-4 foncecoE" style="display:none;">
                	<div class="col-md-6" align="center">
                    	<img src="imagenes/estadisticas2.png">
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
                    	<img src="imagenes/estadisticas2.png">
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
                    	<img src="imagenes/estadisticas2.png">
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
                    	<img src="imagenes/datos2.png">
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 foncesoI" style="display:none;">
                	<div class="col-md-6" align="center">
                    	<img src="imagenes/datos2.png">
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 fsieteI" style="display:none;">
                	<div class="col-md-6" align="center">
                    	<img src="imagenes/datos2.png">
                        <h4 class="textoTrazoTitulos"> Información</h4>
                    </div>
                    <div class="col-md-6" style="border-left:1px dashed #333;" id="submenuestadisticas">
                    	<ul>
                        	<li><span class="glyphicon glyphicon-calendar"></span> <a href="">Fixture</a></li>
                            <li><span class="glyphicon glyphicon-gift"></span> <a href="">Premios</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        
        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                    
                    <section>
                        <div class="col-md-7">
                        
                        <!-- Slideshow 4 -->
                        	<div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Noticias</h3>
                              </div>
                              <div class="panel-body">
                                <div class="callbacks_container">
                                  <ul class="rslides" id="slider4">
                                    <li>
                                      <img src="imagenes/FIXTURE NUEVO F7 - FECHA 2 - 2015.png" alt="">
                                      <p class="caption">CERO TOLERANCIA / HORARIOS DE LA FECHA 2 
                                      	<button type="button" class="btn btn-info" aria-label="Left Align">
  											Leer <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
										</button>
									  </p>
                                    </li>
                                    <li>
                                      <img src="imagenes/20150304_143131.jpg" alt="">
                                      <p class="caption">COMIENZO DEL TORNEO ESTE SÁBADO 7-3 
                                      <button type="button" class="btn btn-info" aria-label="Left Align">
  											Leer <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
										</button>
                                      </p>
                                    </li>
                                    <li>
                                      <img src="imagenes/2015-02-04 20.39.18.jpg" alt="">
                                      <p class="caption">CRONOGRAMA A SEGUIR 
                                      <button type="button" class="btn btn-info" aria-label="Left Align">
  											Leer <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
									  </button>
                                      </p>
                                    </li>
                                  </ul>
                                </div>
                                
                              </div>
                              <div class="panel-footer">
                              <h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">Lorem ipsum dolor sit</h5>
                              <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Martes 10 de Marzo, 18:30:23</h6>
                              	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in.</p>
                              </div>
                            </div>
                            
                            <div id="noticias">
                            	<img src="imagenes/tarjeta-2013-ano-nuevo.jpg">
                                <div class="textoTrazoTitulosN">
                                	FELIZ AÑO NUEVO
                                </div>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff; font-style:italic; height:8px; margin-bottom:10px; ">Lunes 9 de Marzo, 12:00:41</h6>
                                <div id="parrafo">
                                	Estimados jugadores
Les queremos agradecer por cumplir con nosotros nuestro primer año completo de trayectoria como organización de torneos. (Si bien el predio tiene 15 años, desde agosto del 2013 nos animamos a la organización).
Muchas gracias a todos los que confían y siguen con nosotros, sabemos que como somos nuevos tenemos miles de cosas que mejorar pero por otro lado sabemos que, con mucha buena onda, estamos marcando y vamos a seguir marcando una diferencia en la Ciudad de La Plata por la cantidad de cosas que nos diferencian del resto, con árbitros con mucha experiencia, que van a tener sus errores como todos, pero que no dejan de dar lo mejor de ellos en cada partido, con dos pelotas de Primera División de A.F.A
                                </div>
                              
                            <div class="abajo">
                                <div align="right" class="abajo_text">
                                    <a href="#">Continuar leyendo</a>
                                </div>
                                <div class="abajo_bg"></div>
                            </div>  
                            </div>
                            
                            
                            
                            <div class="help-block events">
                            	
                            </div>
                            
                            
                        </div>
                        <div class="col-md-5">
                        	<div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Noticias de Predio</h3>
                              </div>
                              <div class="panel-body">
                                <h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Lunes 9 de Marzo, 12:00:41</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices.</p>
                              </div>
                            </div>
                            
                            <div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Ultimo Momento</h3>
                              </div>
                              <div class="panel-body">
                                <h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Domingo 8 de Marzo, 10:34:43</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper.</p>
                              </div>
                            </div>
                            
                            
                            <div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Fixture</h3>
                              </div>
                              <div class="panel-body">
                                <h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Jueves 5 de Marzo, 19:20:23</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero.</p>
                                
                                

                                <ul class="nav nav-pills">
                            
                                    <li class="dropdown">
                            
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Fútbol 11 c/ off-side <b class="caret"></b></a>
                            
                                        <ul class="dropdown-menu">
                            
                                            <li><a href="#">Zona A</a></li>
                            
                                            <li><a href="#">Zona B</a></li>
                            
                                        </ul>
                            
                                    </li>
                            
                                    <li class="dropdown">
                            
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Fútbol 11 s/ off-side <b class="caret"></b></a>
                            
                                        <ul class="dropdown-menu">
                            
                                            <li><a href="#">Zona A</a></li>
                            
                                            <li><a href="#">Zona B</a></li>
                                            
                                            <li><a href="#">Zona C</a></li>
                            
                                        </ul>
                            
                                    </li>
                            
                                    <li class="dropdown">
                            
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Fútbol 7 <b class="caret"></b></a>
                            
                                        <ul class="dropdown-menu">
                            
                                            <li><a href="#">Zona A</a></li>
                            
                                            <li><a href="#">Zona B</a></li>
                                            
                                            <li><a href="#">Zona C</a></li>
                            
                                        </ul>
                            
                                    </li>
                            
                                </ul>
                            	
                                <table class="table table-responsive table-striped">
                                	<tbody>
                                    	<tr>
                                        	<td>Equipo A</td>
                                            <td align="center">0</td>
                                            <td align="center">2</td>
                                            <td align="right">Equipos B</td>
                                        </tr>
                                        <tr>
                                        	<td>Equipo C</td>
                                            <td align="center">3</td>
                                            <td align="center">2</td>
                                            <td align="right">Equipos D</td>
                                        </tr>
                                        <tr>
                                        	<td>Equipo E</td>
                                            <td align="center">1</td>
                                            <td align="center">4</td>
                                            <td align="right">Equipos F</td>
                                        </tr>

                                    </tbody>
                                </table>
								<button type="button" class="btn btn-info btn-lg" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Fecha 2
                                </button>
                                <ul class="list-inline" style="margin-top:15px;">
                                	<li>
                                    	<button type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Posiciones
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Fixture
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Datos
                                        </button>
                                    </li>
                                </ul>
                              </div>
                            </div>
                            
                            <div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Proxima Fecha</h3>
                              </div>
                              <div class="panel-body">
                                <h5>In semper consequat</h5>
                                <div align="center">
                                <div id="calendario" align="center">
                                	<h4>Marzo</h4>
                                    <p>10</p>
                                </div>
                                </div>
                                
                                
                              </div>
                            </div>
                            
                            
                            <div class="panel panel-predio" style="margin-top:20px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">El tiempo en La Plata</h3>
                              </div>
                              <div class="panel-body">
                                <div id="cont_56e6c96ebc37c4741354591bec3723d6">
  <span id="h_56e6c96ebc37c4741354591bec3723d6">Tiempo La Plata</span>
  <script type="text/javascript" async src="http://www.tiempo.com/wid_loader/56e6c96ebc37c4741354591bec3723d6"></script>
</div>
                              </div>
                            </div>
                            
                        </div>
                    </section>
                    
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