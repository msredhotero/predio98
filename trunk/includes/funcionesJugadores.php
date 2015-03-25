<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class ServiciosJ {
	
	function TraerJugadores() {
		$sql = "select idjugador,apyn,dni from dbjugadores order by apellido,nombre";
		return $this->query($sql,0);
	}
	
	function TraerJugadoresEquipos() {
		$sql = "select j.idequipo,j.apyn,j.dni,e.nombre from dbjugadores j
		        inner join dbequipos e
		        on j.idequipo = e.idequipo
				order by e.nombre,j.apyn";
		return $this->query($sql,0);
	}
	
    function TraerJugadoresPorEquipo($idequipo) {
		$sql = "select dbjugadores.idjugador,
dbjugadores.idequipo,
concat(trim(apellido),' ' ,trim(nombre)) as apellidonombre from dbjugadores where idequipo = ".$idequipo." order by apyn";
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
	
    function insertarJugadores($apyn,$dni,$idequipo) {
		$sql = "insert into dbjugadores(idjugador,apyn,dni,idequipo)
										values ('','".utf8_decode($apellido)."',".$dni.",".$idequipo.")";
		$res = $this->query($sql,1);
		return $res;
	}


	
	function modificarJugadores($apyn,$dni,$idequipo,$id) {
		$sql = "update dbjugadores set apellido = '".utf8_decode($apellido)."', nombre = '".utf8_decode($nombre)."', idequipo = ".$idequipo." where idjugador =".$id;
		$this->query($sql,0);
		return 1;
	}
	
	function eliminarJugadores($id) {
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