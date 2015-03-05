<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class ServiciosJ {
	
	function TraerJugadores() {
		$sql = "select * from dbjugadores order by apellido,nombre";
		return $this->query($sql,0);
	}
	
	function TraerJugadoresEquipos() {
		$sql = "select * from dbjugadores j
		        inner join dbequipos e
		        on j.idequipo = e.idequipo
				order by j.apellido,j.nombre";
		return $this->query($sql,0);
	}
	
        Function TraerJugadoresPorEquipo($idequipo) {
		$sql = "select dbjugadores.idjugador,
trim(dbjugadores.apellido) as apellido,
trim(dbjugadores.nombre) as nombre,
dbjugadores.idequipo,
concat(trim(apellido),' ' ,trim(nombre)) as apellidonombre from dbjugadores where idequipo = ".$idequipo." order by apellido,nombre";
		return $this->query($sql,0);
	}



	function TraerIdJugadoresEquipos($id) {
		$sql = "select * from dbjugadores j
		        inner join dbequipos e
		        on j.idequipo = e.idequipo
		        where idjugador =".$id; 
				
		return $this->query($sql,0);
	}
	
	function TraerIdJugador($id) {
		$sql = "select * from dbjugadores where idjugador =".$id;
		return $this->query($sql,0);
	}
	
        function insertarJugador($apellido,$nombre,$idequipo) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		$sql = "insert into dbjugadores(idjugador,apellido,nombre,idequipo)
										values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."',".$idequipo.")";
		$this->query($sql,1);
		return 1;
	}


	
	function modificarJugador($apellido,$nombre,$idequipo,$id) {
		$sql = "update dbjugadores set apellido = '".utf8_decode($apellido)."', nombre = '".utf8_decode($nombre)."', idequipo = ".$idequipo." where idjugador =".$id;
		$this->query($sql,0);
		return 1;
	}
	
	function eliminarJugador($id) {
		$sql = "delete from dbjugadores where idjugador =".$id;
		$this->query($sql,0);
		return 1;
	}
	
	
	Function query($sql,$accion) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}
	
	
	
	
	} //fin de servicios


?>