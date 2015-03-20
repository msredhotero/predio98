<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class ServiciosE {
	
	function TraerEquipos() {
		$sql = "select IdEquipo,
				Nombre,
				nombrecapitan,
				emailcapitan,
				telefonocapitan,
				facebookcapitan,
				nombresubcapitan,
				emailsubcapitan,
				telefonosubcapitan,
				facebooksubcapitan from dbequipos order by nombre";
		return $this-> query($sql,0);
	}
	
	function TraerIdEquipo($id) {
		$sql = "select * from dbequipos where idequipo = ".$id;
		return $this-> query($sql,0);
	}
	
	function TraerIdEquipoInfo($id) {
		$sql = "select * from dbequipos e
				inner join dbcontactos c
				on e.refcontacto = c.idcontacto 
				where idequipo = ".$id;
		return $this-> query($sql,0);
	}
	
	function insertarEquipo($equipo,$nombre,$apellido,$mail,$tel) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		$equipo = utf8_decode(trim(str_replace("'","",$equipo)));
		$nombre = utf8_decode(trim(str_replace("'","",$nombre)));
		$apellido = utf8_decode(trim(str_replace("'","",$apellido)));
		$mail = trim(str_replace("'","",$mail));
		$tel = trim(str_replace("'","",$tel));

		if ($equipo != "") {
		
		$sqlIdviejo = "select max(idcontacto) from dbcontactos";
		$resIdviejo =  $this-> query($sqlIdviejo,0);
		$idviejo = mysql_result($resIdviejo,0,0);
		
		$sqlcontactos = "insert into dbcontactos
							(idcontacto,
							nombre,
							apellido,
							asunto,
							mensaje,
							telefono,
							mail,
							domicilio,imagen) values 
							('','".$nombre."','".$apellido."','','',".$tel.",'".$mail."','','')";
		$this-> query($sqlcontactos,1);
		
		$sqlId = "select max(idcontacto) from dbcontactos";
		$resId =  $this-> query($sqlId,0);
		$id = mysql_result($resId,0,0);
		
		if ($idviejo < $id)
		{
		$sql = "insert into dbequipos (idequipo,nombre,refcontacto) values ('','".$equipo."',".$id.")";
		$this-> query($sql,1);
		return 1;
		} else {
			return 0;
		}
		} else {
			return 0;
		}
	}
	
	
	function modificarEquipo($equipo,$id) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		$equipo = trim(str_replace("'","",$equipo));
		
		if ($equipo != "") {
		$sql = "update dbequipos set nombre = '".utf8_decode($equipo)."' where idequipo =".$id; 
		$this -> query($sql,0);
		return 1;
		} else {
			return 0;
		}
		
	}
	
	function modificarInfoEquipo($idequipo,$apellido,$nombre,$mail,$tel,$imagen) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		$refcontacto = mysql_result($this->TraerIdEquipo($idequipo),0,2);
		
		$sql = "update dbcontactos
				set apellido = '".utf8_decode($apellido)."',nombre='".utf8_decode($nombre)."',mail='".$mail."',telefono= ".$tel.", imagen = '".$imagen."' where idcontacto =".$refcontacto;
		$this-> query($sql,0);
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