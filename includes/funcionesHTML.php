<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

function menu() {
echo '<div id="menu">
<ul class="jd_menu jd_menu_slate">
			<li><a href="adminshowgol.php">Inicio</a></li>
			<li>Torneo

		  <ul>
					<li><a href="tAgregar.php">Agregar</a></li>
					<li><a href="tConsultar.php" >Consultar</a></li>
					<li><a href="tCerrar.php">Cerrar Torneo</a></li>
					
				</ul>
			</li>
			<li>Grupos
		  <ul>
					<li><a href="gAgregar.php" >Agregar</a></li>
					<li><a href="gConsultar.php" >Consultar</a></li>

					
				</ul>
			</li>
            
            <li>Equipos
		  <ul>
					<li><a href="eAgregar.php" >Agregar</a></li>
					<li><a href="eConsultar.php" >Consultar</a></li>
					<li><a href="eImagenes.php" >Cargar Imagenes</a></li>
					
				</ul>
			</li>
            
            
            <li>Grupos-Equipos
		  <ul>
		  			<li><a href="geSeleccionarGrupo.php" >Seleccionar Grupo</a></li>
	
				</ul>
			</li>
			
			<li>Fixture
		    <ul>
		    		<li><a href="fixSeleccionarGrupo.php" >Seleccionar Grupo</a></li>
	                        <li><a href="fixModificarMasivo.php" >Carga masiva</a></li>
<li><a href="fixModificarMasivoPorZona.php" >Carga Nueva</a></li>

				</ul>
			</li>
			<li>Noticias
		    <ul>
					<li><a href="notiAgregar.php" >Cargar</a></li>
					<li><a href="notiConsultar.php" >Consultar</a></li>
					<li><a href="fechasAgregar.php" >Cargar Resumen</a></li>
					<li><a href="notiprincAgregar.php" >Cargar Noticias-Principales</a></li>
					<li><a href="turAgregar.php" >Cargar Turnos</a></li>
					<li><a href="seleccAgregar.php" >Cargar Selección</a></li>
					<li><a href="premiosModificar.php" >Modificar Premios</a></li>
					<li><a href="reglamentoModificar.php" >Modificar Reglamento</a></li>
					<li><a href="serviciosModificar.php" >Modificar Servicios</a></li>
                                        <li><a href="horarioprincAgregar.php" >Agregar Horario Principal</a></li>	
				</ul>
			</li>
			<li>Tabla de Conducta
		    <ul>
		    		<li><a href="conAgregar.php" >Agregar</a></li>
		    		<li><a href="conConsultar.php" >Consultar</a></li>
		    		
				</ul>
			</li>
			<li>Amonestados
		    <ul>
		    		<li><a href="amonestadosp.php" >Agregar</a></li>
		    		<li><a href="amonestadosc.php" >Consultar</a></li>
				</ul>
			</li>
			
			<li>Goleadores
		    <ul>
		    		<li><a href="goleadoresp.php" >Agregar</a></li>
		    		<li><a href="goleadoresc.php" >Consultar</a></li>
				</ul>
			</li>
			
			<li>Suspendidos
		    <ul>
		    		<li><a href="suspendidosp.php" >Agregar</a></li>
		    		<li><a href="suspendidosc.php" >Consultar</a></li>
				</ul>
			</li>
			<li>Jugadores
		    <ul>
		    		<li><a href="jAgregar.php" >Agregar</a></li>
		    		<li><a href="jConsultar.php" >Consultar</a></li>
				</ul>
			</li>
            <li><a href="Cerrar_login.php" >Cerrar Session</a></li>
	</ul>
</div>';
}


function footer() {
	echo "<!--comienzo del footer-->
<div id='footer'>
<div id='dentroFooter'>
<div align='center'>
<table width='800'>
<tr valign='top'>
<td align='left'>
<h4>Link's de interes</h4>
<ul>
<li><a href='http://www.grandt.clarin.com/'>Gran DT</a></li>
<li><a href='http://www.ole.com.ar/'>OLE</a></li>
<li><a href='http://www.foxsportsla.com/ar/'>Fox Sport</a></li>
<li><a href='http://www.afa.org.ar/'>AFA</a></li>
</ul>
</td>
<td align='left'>
<h4>Noticias</h4>
<ul>
<li><a href='http://www.eldia.com.ar/'>El Dia</a></li>
<li><a href='http://www.clarin.com/'>Clarin</a></li>
<li><a href='http://diariohoy.net/'>Hoy</a></li>
<li><a href='http://www.lanacion.com.ar/'>La Nación</a></li>
</ul>
</td>
<td align='left'>
<h4>Recursos</h4>
<ul>
<li><a href='http://www.hotmail.com/'>Hotmail</a></li>
<li><a href='http://ar.yahoo.com/'>Yahoo</a></li>
<li><a href='http://www.google.com.ar/'>Google</a></li>

</ul>
</td>
</tr>
</table>
</div>
</div>

   <div id='yo' align='center'>
   <br />
<p>© Copyright 2013 | ComplejoShowBol - La PLata, Buenos Aires. Diseño Web: Saupurein Marcos y Saupurein Javier .Tel:(0221)15-6184415</p>
</div>
</div><!--fin del footer-->";
}


?>