<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class ServiciosJ {
	
	function TraerJugadores() {
		$sql = "select idjugador,apyn,dni from dbjugadores order by apyn";
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
		$sql = "select idjugador,
						apyn,
						dni 
					from dbjugadores where idequipo = ".$idequipo." order by apyn";
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
	
	function existeJugador($dni,$idequipo) {
		$sql = "select idequipo from dbjugadores where dni = ".$dni;
		$res = $this->query($sql,0);
		if (mysql_num_rows($res)>0) {
			$sqlZonaEquipo = "select refgrupo,reftorneo from dbtorneoge where refequipo = ".$idequipo;
			$resZE = $this->query($sqlZonaEquipo,0);
			$sqlZonaEquipoActual = "select refgrupo,reftorneo from dbtorneoge where refequipo = ".mysql_result($res,0,0);
			$resZEA = $this->query($sqlZonaEquipoActual,0);
			
			if ((mysql_result($resZE,0,0) == mysql_result($resZEA,0,0)) && (mysql_result($resZE,0,1) == mysql_result($resZEA,0,1))) {
				return 1;	
			} else {
				return 0;
			}
		}
		return 0;
	}
	
    function insertarJugadores($apyn,$dni,$idequipo) {
		$sql = "insert into dbjugadores(idjugador,apyn,dni,idequipo)
										values ('','".utf8_decode($apellido)."',".$dni.",".$idequipo.")";
		if ($this->existeJugador($dni,$idequipo) == 0) {
			$res = $this->query($sql,1);
		} else {
			$res = "El jugador ya existe o no se puede cargar en la misma zona!";	
		}
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
	

function insertarGoleadores($refequipo,$reffixture,$goles,$refjugador) {
$sql = "insert into tbgoleadores(idgoleador,refequipo,reffixture,goles,refjugador)
values ('',".$refequipo.",".$reffixture.",".$goles.",".$refjugador.")";
$res = $this->query($sql,1);
return $res;
}


function modificarGoleadores($id,$refequipo,$reffixture,$goles,$refjugador) {
$sql = "update tbgoleadores
set
refequipo = ".$refequipo.",reffixture = ".$reffixture.",goles = ".$goles.",refjugador = ".$refjugador."
where idgoleador =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarGoleadores($id) {
$sql = "delete from tbgoleadores where idgoleador =".$id;
$res = $this->query($sql,0);
return $res;
} 

function traerGoleadores() {
	$sql = "select g.idgoleador,j.apyn, j.dni, e.nombre, ff.tipofecha, g.goles 
			from tbgoleadores g 
			inner join dbequipos e on g.refequipo = e.idequipo 
			inner join dbjugadores j on g.refjugador = j.idjugador 
			inner join dbfixture f on f.idfixture = g.reffixture
			inner join tbfechas ff on f.reffecha = ff.idfecha";
	$res = $this->query($sql,0);
	return $res;
}

function traerEstadisticas() {
	$sql = "select g.idgoleador,j.apyn, j.dni, e.nombre, ff.tipofecha, g.goles , (case when a.amarillas is null then 0 else a.amarillas end) as amarillas
			from tbgoleadores g 
			inner join dbequipos e on g.refequipo = e.idequipo 
			inner join dbjugadores j on g.refjugador = j.idjugador
			inner join tbamonestados a on a.refequipo = e.idequipo and a.refjugador = j.idjugador
			inner join dbfixture f on f.idfixture = g.reffixture
			inner join tbfechas ff on f.reffecha = ff.idfecha";
	$res = $this->query($sql,0);
	return $res;
}

function traerGoleadoresPorId($id) {
	$sql = "select g.idgoleador, j.idjugador,j.apyn, j.dni,e.idequipo, e.nombre,f.idfixture, ff.tipofecha, g.goles 
			from tbgoleadores g 
			inner join dbequipos e on g.refequipo = e.idequipo 
			inner join dbjugadores j on g.refjugador = j.idjugador 
			inner join dbfixture f on f.idfixture = g.reffixture
			inner join tbfechas ff on f.reffecha = ff.idfecha 
			where g.idgoleador = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

function insertarAmonestados($refjugador,$refequipo,$reffixture,$amarillas) {
	$sql = "insert into tbamonestados(idamonestado,refjugador,refequipo,reffixture,amarillas)
	values ('',".$refjugador.",".$refequipo.",".$reffixture.",".$amarillas.")";
	
	$res = $this->query($sql,1);
	return $res;
}


function modificarAmonestados($id,$refjugador,$refequipo,$reffixture,$amarillas) {
	$sql = "update tbamonestados
	set
	refjugador = ".$refjugador.",refequipo = ".$refequipo.",reffixture = ".$reffixture.",amarillas = ".$amarillas."
	where idamonestado =".$id;
	
	$res = $this->query($sql,0);
	return $res;
}


function eliminarAmonestados($id) {
$sql = "delete from tbamonestados where idamonestado =".$id;
$res = $this->query($sql,0);
return $res;
} 

function traerAmonestados() {
	$sql = "select g.idamonestado,j.apyn, j.dni, e.nombre, ff.tipofecha, g.amarillas 
			from tbamonestados g 
			inner join dbequipos e on g.refequipo = e.idequipo 
			inner join dbjugadores j on g.refjugador = j.idjugador 
			inner join dbfixture f on f.idfixture = g.reffixture
			inner join tbfechas ff on f.reffecha = ff.idfecha";
	$res = $this->query($sql,0);
	return $res;
}

function traerAmonestadosPorId($id) {
	$sql = "select g.idamonestado, j.idjugador,j.apyn, j.dni,e.idequipo, e.nombre,f.idfixture, ff.tipofecha, g.amarillas 
			from tbamonestados g 
			inner join dbequipos e on g.refequipo = e.idequipo 
			inner join dbjugadores j on g.refjugador = j.idjugador 
			inner join dbfixture f on f.idfixture = g.reffixture
			inner join tbfechas ff on f.reffecha = ff.idfecha 
			where g.idamonestado = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

	
	function query($sql,$accion) {
		
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