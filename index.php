<?php

session_start();

if (!isset($_SESSION['usua_predio_jugador']))
{
	header('Location: index_l.html');
} else {

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

date_default_timezone_set('America/Buenos_Aires');

$fecha = date('Y-m-d');

$resUltimaFechaTorneoA = $serviciosFunciones->TraerUltimaFechaPorTorneo(1);
$resUltimaFechaTorneoB = $serviciosFunciones->TraerUltimaFechaPorTorneo(2);
$resUltimaFechaTorneoC = $serviciosFunciones->TraerUltimaFechaPorTorneo(3);

if (mysql_num_rows($resUltimaFechaTorneoA)>0) {
	$UltimaFecha = mysql_result($resUltimaFechaTorneoA,0,1);
	$IdUltimaFecha = mysql_result($resUltimaFechaTorneoA,0,0);
} else {
	$UltimaFecha = "Fecha 1";
	$IdUltimaFecha = 23;
}


if (mysql_num_rows($resUltimaFechaTorneoB)>0) {
	$UltimaFechaB = mysql_result($resUltimaFechaTorneoB,0,1);
	$IdUltimaFechaB = mysql_result($resUltimaFechaTorneoB,0,0);
} else {
	$UltimaFechaB = "Fecha 1";
	$IdUltimaFechaB = 23;
}


if (mysql_num_rows($resUltimaFechaTorneoC)>0) {
	$UltimaFechaC = mysql_result($resUltimaFechaTorneoC,0,1);
	$IdUltimaFechaC = mysql_result($resUltimaFechaTorneoC,0,0);
} else {
	$UltimaFechaC = "Fecha 1";
	$IdUltimaFechaC = 23;
}


$resNuevaFehca = $serviciosFunciones->NuevaFecha($IdUltimaFecha );

if (mysql_num_rows($resNuevaFehca)>0) {
	$dia = mysql_result($resNuevaFehca,0,1);
	$mes = mysql_result($resNuevaFehca,0,0);
} else {
	$dia = "0";
	$mes = "------";
}


/////////////////////////////////////////////////***    NOTICIAS   *******////////////////////////////////////////////////

$resNoticiaPrincipal 	= $serviciosNoticias->traerUltimaNoticiaPrincipal();

if (mysql_num_rows($resNoticiaPrincipal)>0) {
	$Principal = (mysql_result($resNoticiaPrincipal,0,3));
} else {
	$Principal = '';
}

$resNoticiaPredio		= $serviciosNoticias->traerUltimaNoticiaPredio();

if (mysql_num_rows($resNoticiaPredio)>0) {
	$Predio = (mysql_result($resNoticiaPredio,0,3));
} else {
	$Predio = '';
}

$resNoticia				= $serviciosNoticias->traerUltimaNoticias();

if (mysql_num_rows($resNoticia)>0) {

	$TituloNoticia 	= (mysql_result($resNoticia,0,'titulo'));
	$CuerpoNoticia 	= (mysql_result($resNoticia,0,'parrafo'));
	$FechaNoticia 	= (mysql_result($resNoticia,0,'fechacreacion'));
	$GaleriaNoticia = (mysql_result($resNoticia,0,'galeria'));
	$idNoticia		= (mysql_result($resNoticia,0,'idnoticia'));

	$resLstNoticia		= $serviciosNoticias->traerNoticiasMenosHasta(mysql_result($resNoticia,0,0),5);
} else {
	$CuerpoNoticia 	= '<h3>No hay noticias cargadas!!</h3>';
	$TituloNoticia 	= '';
	$FechaNoticia 	= '';
	$GaleriaNoticia = '';
}



////////////////////////////////////////////////////////////////////////////////////////////////

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
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<style>
	body {
		overflow: hidden;

	}

	/* Preloader */

	#preloader {
		position:fixed;
		top:0;
		left:0;
		right:0;
		bottom:0;
		background-color: #0c0c0c; /* change if the mask should have another color then white */
		z-index:99; /* makes sure it stays on top */
	}

	#status {
		width:800px;
		height:600px;
		position:absolute;
		margin-left:-400px;
		left:50%; /* centers the loading animation horizontally one the screen */

		top:200px;; /* centers the loading animation vertically one the screen */
		background-image:url(imagenes/loading2.gif); /* path to your loading animation */
		background-repeat:no-repeat;
		background-position:center;
		/*margin:-100px 0 0 -100px; /* is width and height divided by two */
	}

    label {
        padding-bottom:6px;
		padding-top:6px;
    }

	.panel-body-predio ul {
		margin-left:15px;
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


	function TraerResultados(reftorneo, refzona, reffecha, zona) {
		$.ajax({
				data:  {reftorneo: reftorneo,
						refzona: refzona,
						reffecha: reffecha,
						zona: zona,
						accion: 'traerResultadosPorTorneoZonaFechaPagina'},
				url:   'ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
						$('#resultados').html(response);

				}
		});
	}

	TraerResultados(1,19,<?php echo $IdUltimaFecha; ?>,'Zona A');

	$('#buscar').click(function(e) {



		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'TraerFixturePorZonaTorneo'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
						$('#posiciones').html(response);

				}
		});


		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'Goleadores'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
						$('#goleadores').html(response);

				}
		});

		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						reffecha: $('#reffecha').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'Suspendidos'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
						$('#suspendidos').html(response);

				}
		});
    });

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
</head>



<body>

<!-- Preloader -->
<div id="preloader">
	<div align="center" id="flashear"><img src="imagenes/marca.png"/></div>
    <div id="status"></div>
</div>

<div style="background-color:#000; height:auto; margin-top:-20px; padding-top:20px;">

    <div class="clearfix content">
    	<div class="row">

        </div>
    	<div class="header-container">
        	<div class="menuopo">
            <div class="navbar-header page-scroll">
                <button data-target="#navbar-collapse-4" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>

                <a href="index.php"><img src="imagenes/logo.png" style="width:10%;"></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-4">
              <ul class="nav navbar-nav navbar-right">



                <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Torneo de Fútbol 11 con Off-side <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="fixture.php">Fixture</a></li>
                    <li><a href="historial.php?idtorneo=1">Historial</a></li>
                    <li><a href="zonas.php?zona=19&idtorneo=1">Zona A</a></li>
                    <li><a href="zonas.php?zona=20&idtorneo=1">Zona B</a></li>
                    <li><a href="zonas.php?zona=21&idtorneo=1">Zona C</a></li>
                  </ul>
				</li>

                <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Torneo de Fútbol 11 sin Off-side <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="fixture.php">Fixture</a></li>
                    <li><a href="historial.php?idtorneo=1">Historial</a></li>
                    <li><a href="zonas.php?zona=19&idtorneo=2">Zona A</a></li>
                    <li><a href="zonas.php?zona=20&idtorneo=2">Zona B</a></li>
                    <li><a href="zonas.php?zona=21&idtorneo=2">Zona C</a></li>
                  </ul>
                </li>

				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Torneo de Fútbol 7 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="fixture.php">Fixture</a></li>
                    <li><a href="historial.php?idtorneo=1">Historial</a></li>
                    <li><a href="zonas.php?zona=19&idtorneo=3">Zona A</a></li>
                    <li><a href="zonas.php?zona=20&idtorneo=3">Zona B</a></li>
                    <li><a href="zonas.php?zona=21&idtorneo=3">Zona C</a></li>
                  </ul>
                </li>

                <li><a href="reglamento.html">Reglamento</a></li>
                <li><a href="premios.html">Premios</a></li>
                <li><a href="desarrollo.html">Desarrollo</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="fotos.html">Fotos</a></li>
                <li><a href="contacto.html">Contacto</a></li>

              </ul>

            </div><!-- /.navbar-collapse -->


            </div>
            <header class="wrapper clearfix menuop">
            	<!-- Brand and toggle get grouped for better mobile display -->


                <div align="center" style="margin-bottom:-55px; margin-left:-25px;">
                <a href="index.php"><img src="imagenes/logo2.png"></a>
                </div>


                <nav id="menu">
                    <ul class="clearfix contenedorMenu">
                        <li class="menuA"><a href="index.php">Inicio</a></li>
                        <li class="torneoMenu"><a href="#">Torneos</a></li>
                        <li class="menuA"><a href="reglamento.html">Reglamento</a></li>
                        <li class="menuA"><a href="premios.html">Premios</a></li>
                        <li id="separar" style="margin-right:60px; padding-right:60px; display:block;"> </li>
                        <li class="menuA"><a href="desarrollo.html">Desarrollo</a></li>
                        <li class="menuA"><a href="servicios.html">Servicios</a></li>
                        <li class="menuA"><a href="fotos.html">Fotos</a></li>
                        <li class="menuA"><a href="contacto.html">Contacto</a></li>
                    </ul>
                    <a href="#" id="pull">Menú</a>
                </nav>
            </header>
        </div>

        <?php echo $serviciosHTML->menuHTML(); ?>

        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>

                    <section>
                        <div class="col-md-7">

                        <!-- Slideshow 4 -->
                        	<div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Noticias</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px; ">
                              </div>
                              <div class="panel-body-predio" style="padding:5px 10px; max-height:350px; overflow:hidden;line-height:1.5em; text-align:justify;">

                                    <div align="center">
                                    	<h4><?php echo $TituloNoticia; ?></h4>
                                    </div>
                              		<p style="color:#999; font-size:12px;">
                                    	<i>
										<?php
											$date = new DateTime($FechaNoticia);
											$date->setTimezone( new \DateTimeZone( 'America/Buenos_Aires' ) );
											echo "Publicado: ".$date->format('Y-m-d');
											//echo $FechaNoticia;
										?>
                                        </i>
                                    </p>
                                    <?php echo $CuerpoNoticia; ?>
                                    <?php if ($GaleriaNoticia == 1) { ?>
                                    	<div align="center" style="position:absolute; top:320px; width:93%; height:54px; display:inline-block;">
                                        <ul class="list-inline">
                                        <li>

											<button type="button" style="padding:10px 10%;background-color: #0890a8;border-radius: 7px 7px 7px 7px;display: inline-block;margin-bottom: 0px!important; box-shadow: 0 -4px 0 #054955 inset; -webkit-box-shadow: 0 -4px 0 #054955 inset; -moz-box-shadow: 0 -4px 0 #054955 inset; border:none; color:#fff; font-size:1.2em;text-shadow:1px 1px 1px #047093;" id="noticiagaleria"><span class="glyphicon glyphicon-picture"></span> Galeria de Fotos</button>


                                        </li>
                                        <li>

											<button type="button" style="padding:10px 10%;background-color: #ffab23;border-radius: 7px 7px 7px 7px;display: inline-block;margin-bottom: 0px!important; box-shadow: 0 -4px 0 #bd750a inset; -webkit-box-shadow: 0 -4px 0 #bd750a inset; -moz-box-shadow: 0 -4px 0 #bd750a inset; border:none; color:#fff; font-size:1.2em;text-shadow:1px 1px 1px #A68502;" id="noticiauno"><span class="glyphicon glyphicon-search"></span> Ver Noticia</button>
                                        </li>
                                        </ul>
                                        </div>
                                    <?php } else { if ($TituloNoticia != '') {?>
                                    	<div align="center" style="position:absolute; bottom:0; width:93%; height:54px; display:inline-block; z-index:8; margin-bottom:222px;">

											<button type="button" style="padding:10px 10%;background-color: #ffab23;border-radius: 7px 7px 7px 7px;display: inline-block;margin-bottom: 0px!important; box-shadow: 0 -4px 0 #bd750a inset; -webkit-box-shadow: 0 -4px 0 #bd750a inset; -moz-box-shadow: 0 -4px 0 #bd750a inset; border:none; color:#fff; font-size:1.2em;text-shadow:1px 1px 1px #A68502;" id="noticiauno"><span class="glyphicon glyphicon-search"></span> Ver Noticia</button>

                                        </div>
                                    <?php }
										} ?>
                              </div>
                            </div>

                            <?php


								if (($TituloNoticia!='') && (mysql_num_rows($resLstNoticia)>0)) {

									while ($rowLstNoticias = mysql_fetch_array($resLstNoticia)) {
							?>
                            <div id="noticias">
                            	<?php if ($rowLstNoticias['galeria'] == 0) { ?>
                                <img src="imagenes/sin_img.jpg">
                                <?php
									} else {
										$resPrimerImg = $serviciosNoticias->traerPrimerImagenNoticiaPorId($rowLstNoticias['idnoticia']);
										if (mysql_num_rows($resPrimerImg)>0) {
								?>

                                			<img src="<?php echo "archivos/".mysql_result($resPrimerImg,0,0)."/".mysql_result($resPrimerImg,0,1)."/".mysql_result($resPrimerImg,0,2); ?>">
										<?php } else { ?>
                                        	<img src="imagenes/sin_img.jpg">
                                		<?php } ?>
                                <?php } ?>
                                <div class="textoTrazoTitulosN">
                                	<?php echo $rowLstNoticias['titulo']; ?>
                                </div>
                                <h6 style=" font-family:RobotoThin; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff; height:8px; margin-bottom:10px; ">Publicado: <?php
											$dateA = new DateTime($rowLstNoticias['fechacreacion']);
											$dateA->setTimezone( new \DateTimeZone( 'America/Buenos_Aires' ) );
											echo "Publicado: ".$dateA->format('Y-m-d');
											//echo $FechaNoticia;
										?></h6>
                                <div id="parrafo">
                                	<?php echo str_replace("font-size:","",$rowLstNoticias['parrafo']); ?>
                                </div>
								<div class="preabajo"></div>
                                <div class="preabajo1 trans5"></div>
                                <div class="preabajo2 trans4"></div>
                                <div class="preabajo3 trans3"></div>
                                <div class="preabajo4 trans2"></div>
                                <div class="preabajo5 trans1"></div>
                            	<div class="abajo">
                                <div align="right" class="abajo_text">
                                    <a href="noticias.php?id=<?php echo $rowLstNoticias['idnoticia']; ?>">Continuar leyendo</a>
                                </div>
                                <div class="abajo_bg"></div>
                            	</div>
                            </div>
                            <br>

                            <?php

									}
								}

							?>
                            <button type="button" style="padding:10px 10%;background-color: #ffab23;border-radius: 7px 7px 7px 7px;display: inline-block;margin-bottom: 0px!important; box-shadow: 0 -4px 0 #bd750a inset; -webkit-box-shadow: 0 -4px 0 #bd750a inset; -moz-box-shadow: 0 -4px 0 #bd750a inset; border:none; color:#fff; font-size:1.2em; text-shadow:1px 1px 1px #A68502;" id="noticiasanteriores"><span class="glyphicon glyphicon-th-list"></span> Ver Noticias Anteriores</button>

                            <div class="help-block events">

                            </div>


                        </div>
                        <div class="col-md-5">
                        	<div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Noticias de Predio</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right; margin-top:-21px; width:26px; height:24px;">
                              </div>
                              <div class="panel-body-predio" style="line-height:16px; padding-left:10px; padding-top:10px;">
                                <!--<h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Lunes 9 de Marzo, 12:00:41</h6>-->
                                <?php echo $Predio; ?>
                              </div>
                            </div>

                            <div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Ultimo Momento</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                              </div>
                              <div class="panel-body-predio" style="line-height:16px; padding-left:10px; padding-top:10px;">
                                <!--<h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Domingo 8 de Marzo, 10:34:43</h6>-->
                                <?php echo $Principal; ?>
                              </div>
                            </div>


                            <div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Fixture</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                              </div>
                              <div class="panel-body-predio">
                                <!--<h5 style="font-weight:900; font-family:Tahoma, Geneva, sans-serif; font-size:1.1em; text-decoration:underline;">In semper consequat</h5>
                                <h6 style=" font-family:Tahoma, Geneva, sans-serif; font-size:0.9em; color:#00F; text-shadow:1px 1px 1px #fff;">Jueves 5 de Marzo, 19:20:23</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero.</p>-->


								<div align="center">
                                <ul class="nav nav-pills">

                                    <li class="dropdown">

                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="padding:3px;">Fútbol 11 c/Off-Side <b class="caret"></b></a>

                                        <ul class="dropdown-menu">

                                            <li id="zonaAtoneoA" class="zona">Zona A</li>

                                            <li id="zonaBtoneoA" class="zona">Zona B</li>

                                            <li id="zonaCtoneoA" class="zona">Zona C</li>

                                        </ul>

                                    </li>

                                    <li class="dropdown">

                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="padding:3px;">Fútbol 11 s/Off-Side <b class="caret"></b></a>

                                        <ul class="dropdown-menu">

                                            <li id="zonaAtoneoB" class="zona">Zona A</li>

                                            <li id="zonaBtoneoB" class="zona">Zona B</li>

                                            <li id="zonaCtoneoB" class="zona">Zona C</li>

                                        </ul>

                                    </li>

                                    <li class="dropdown">

                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="padding:3px;">Fútbol 7<b class="caret"></b></a>

                                        <ul class="dropdown-menu">

                                            <li id="zonaAtoneoC" class="zona">Zona A</li>

                                            <li id="zonaBtoneoC" class="zona">Zona B</li>

                                            <li id="zonaCtoneoC" class="zona">Zona C</li>

                                        </ul>

                                    </li>

                                </ul>
                            	</div>
                                <table class="table table-responsive table-striped" style="font-size:0.8em; padding:2px;">
                                	<caption id="zonaExp" style="font-size:1.2em; color:#333; font-weight:bold; padding:3px;">Zona A</caption>
                                	<thead>
                                    	<tr>
                                        	<th style="text-align:center; font-size:1.3em;">Result. A</th>
                                            <th style="text-align:center; font-size:1.3em;">Equipo A</th>
                                            <th style="text-align:center; font-size:1.3em;">Horario</th>
                                            <th style="text-align:center; font-size:1.3em;">Equipo B</th>
                                            <th style="text-align:center; font-size:1.3em;">Result. B</th>

                                        </tr>
                                    </thead>
                                    <tbody id="resultados" style="padding:2px;">


                                    </tbody>
                                </table>
								<button type="button" class="btn btn-info btn-lg" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <?php echo $UltimaFecha; ?>
                                </button>
                                <ul class="list-inline" style="margin-top:15px;">
                                	<li>
                                    	<button id="btnposiciones" type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Posiciones
                                        </button>
                                    </li>
                                    <li>
                                        <button id="btnfixture" type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Fixture
                                        </button>
                                    </li>
                                    <!--<li>
                                        <button type="button" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Datos
                                        </button>
                                    </li>-->
                                </ul>
                              </div>
                            </div>

                            <div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">Proxima Fecha</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                              </div>
                              <div class="panel-body-predio">
                                <div align="center">
                                <div id="calendario" align="center">
                                	<h4><?php echo $mes; ?></h4>
                                    <p><?php echo $dia; ?></p>
                                </div>
                                </div>


                              </div>
                            </div>


                            <div class="panel panel-predio" style="margin-top:5px;">
                              <div class="panel-heading">
                                <h3 class="panel-title">El tiempo en La Plata</h3>
                                <img src="imagenes/logo2-chico.png" style="float:right;margin-top:-21px; width:26px; height:24px;">
                              </div>
                              <div class="panel-body-predio">
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

<!-- Preloader -->
<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded

			$('#status').fadeOut(1200); // will first fade out the loading animation
			$('#preloader').delay(1200).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(650).css({'overflow':'visible'});
		})
	//]]>
</script>

<script type="text/javascript">
$(document).ready(function(){

	function TraerResultados(reftorneo, refzona, reffecha, zona) {
		$.ajax({
				data:  {reftorneo: reftorneo,
						refzona: refzona,
						reffecha: reffecha,
						zona: zona,
						accion: 'traerResultadosPorTorneoZonaFechaPagina'},
				url:   'ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
						$('#resultados').html(response);

				}
		});
	}

	$('#btnfixture').click(function() {
		url = "fixture.php";
		$(location).attr('href',url);
	});

	$('#btnposiciones').click(function() {
		url = "posiciones.php";
		$(location).attr('href',url);
	});

	$('#noticiauno').click(function() {
		<?php if ($TituloNoticia != '') { ?>
		url = "noticias.php?id="+<?php echo $idNoticia; ?>;
		<?php } else { ?>
		url = "noticias.php";
		<?php } ?>
		$(location).attr('href',url);
	});

	$('#noticiasanteriores').click(function() {
		url = "noticias.php";
		$(location).attr('href',url);
	});

	$('#noticiagaleria').click(function() {
		<?php if ($TituloNoticia != '') { ?>
		url = "noticias.php?id="+<?php echo $idNoticia; ?>;
		<?php } else { ?>
		url = "noticias.php";
		<?php } ?>
		$(location).attr('href',url);
	});

	$('#zonaAtoneoA').click(function() {
		TraerResultados(1,19,<?php echo $IdUltimaFecha; ?>,'Zona A');
		$('#zonaExp').html('Zona A');
	});


	$('#zonaBtoneoA').click(function() {
		TraerResultados(1,20,<?php echo $IdUltimaFecha; ?>,'Zona B');
		$('#zonaExp').html('Zona B');
	});

	$('#zonaCtoneoA').click(function() {
		TraerResultados(1,21,<?php echo $IdUltimaFecha; ?>,'Zona C');
		$('#zonaExp').html('Zona B');
	});


	$('#zonaAtoneoB').click(function() {
		TraerResultados(2,19,<?php echo $IdUltimaFechaB; ?>,'Zona A');
		$('#zonaExp').html('Zona A');
	});


	$('#zonaBtoneoB').click(function() {
		TraerResultados(2,20,<?php echo $IdUltimaFechaB; ?>,'Zona B');
		$('#zonaExp').html('Zona B');
	});

	$('#zonaCtoneoB').click(function() {
		TraerResultados(2,21,<?php echo $IdUltimaFechaB; ?>,'Zona C');
		$('#zonaExp').html('Zona C');
	});


	$('#zonaAtoneoC').click(function() {
		TraerResultados(3,19,<?php echo $IdUltimaFechaC; ?>,'Zona A');
		$('#zonaExp').html('Zona A');
	});


	$('#zonaBtoneoC').click(function() {
		TraerResultados(3,20,<?php echo $IdUltimaFechaC; ?>,'Zona B');
		$('#zonaExp').html('Zona B');
	});

	$('#zonaCtoneoC').click(function() {
		TraerResultados(3,21,<?php echo $IdUltimaFechaC; ?>,'Zona C');
		$('#zonaExp').html('Zona C');
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

<?php } ?>
