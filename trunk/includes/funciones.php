<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class Servicios {
	
	Function TraerUsuario($nombre,$pass) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		
		$conn = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		$db = mysql_select_db($database);
	 
	 	
	 
		$error = 0;		
		
		
		
		$sqlusu = "select * from dbusuarios where usuario = '".$nombre."'";
		
		$respusu = mysql_query($sqlusu,$conn) or die (mysql_error(1));;
		
		$filas = mysql_num_rows($respusu);
		
		if ($filas > 0) {
			$sqlpass = "select * from dbusuarios where Pass = '".$pass."' and idusuario = ".mysql_result($respusu,0,0);
		    //echo $sqlpass;
		    $error = 1;
		    
			$resppass = mysql_query($sqlpass,$conn) or die (mysql_error(1));;
			
			$filas2 = mysql_num_rows($resppass);
			
			if ($filas2 > 0) {
				$error = 1;
				
				$_SESSION['sg_usuario'] = $nombre;
				$_SESSION['sg_pass'] = $pass;
				
				} else {
				$error = 0;
				}
			
			}
			else
			
			{
				$error = 0;	
			}
			
	    mysql_close($conn);
	
		return $error;
		
	}
	
	Function TraerTipoDoc() {
		$sql = "select * from tbtipodoc";
		return $this-> query($sql,0);
	}
	
	
	
	function activarTabla($tabla,$id,$campo,$todos)
	{
		if ($todos == true) {
		$sql = "update ".$tabla." set activo = false";
		$this-> query($sql,0);
		}
		
		$sql = "";
		$sql = "update ".$tabla." set activo = true where ".$campo." = ".$id;
		$this-> query($sql,0);
	}
	
	function TraerTorneos() {
		$sql = "select * from dbtorneos order by idtorneo desc limit 10";
		return $this-> query($sql,0);
	}
	
	function TraerIdTorneos($id) {
		$sql = "select * from dbtorneos where idtorneo = ".$id;
		return $this-> query($sql,0);
	}
	
function TraerTorneosClientes() {
		$sql = "select * from dbtorneos where idtorneo >23 and activo = 0 order by idtorneo";
		return $this-> query($sql,0);
	}

	function TraerTorneosActivo() {
		$sql = "select * from dbtorneos where activo = 1";
		return $this-> query($sql,0);
	}
	
	function insertTorneo($nombre) {
		$usu = utf8_encode($nombre);
		$fechacrea = date('Y-m-d');
		$activo = true;
		
		if (trim($nombre) != "") 
		{
		
		$nombre = str_replace("'","",$nombre);
		
		
		
		$sql = "insert into dbtorneos(idtorneo,nombre,fechacreacion,activo) values ('','".$nombre."', '".$fechacrea."', ".$activo.")";
		$this-> query($sql,1);
		
		$idUltimo = "select max(idtorneo) from dbtorneos";
		$resid = $this-> query($idUltimo,0);
		$idtorneo = mysql_result($resid,0,0);
		$this->activarTabla("dbtorneos",$idtorneo,"idtorneo",true);
		return 1;
		} else {
			return 0;
		}
	}
	
	function modificarTorneo($nombre,$activo,$idtorneo) {
		$fechacrea = date('Y-m-d');
		$nombre = str_replace("'","",$nombre);
		
		if (trim($nombre) != "") 
		{
		if ($activo == true) {
			$this->activarTabla("dbtorneos",$idtorneo,"idtorneo",true);
		}
		
		$sql = "update dbtorneos set nombre = '".$nombre."', fechacreacion = '".$fechacrea."', activo =".$activo." where idtorneo =".$idtorneo;
		$this-> query($sql,0);
		return 1;
		} else {
			return 0;
		}
		
	}
	
	
	function eliminarTorneo($idtorneo) {
		
		//fijarse si este torneo no tiene relacionado ningun grupo.
		$sqlHayGrupos = "select * from dbtorneoge where reftorneo =".$idtorneo;
		$resHayGrupos = $this-> query($sqlHayGrupos,0);
		
		
		$HayFilas = mysql_num_rows($resHayGrupos);
		
		if ($HayFilas < 1) {
		$sql = "delete from dbtorneos where idtorneo =".$idtorneo;
		$this-> query($sql,0);
		return 1;
		} else {
			return 0;
		}
		
	}
	
	function TraerFecha() {
		$sql = "select * from tbfechas";
		return $this-> query($sql,0);
	}
	
	
	function TraerIdFecha($fecha) {
		$sql = "select * from tbfechas where idfecha=".$fecha;
		return $this-> query($sql,0);
	}
	
	
	function ModificarFechas($fecha,$resumen) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		
		$sqlfecha = "select * from tbfechas where tipofecha='".$fecha."'";
		
		$resfecha = $this->query($sqlfecha,0);
		$idfecha= mysql_result($resfecha,0,0);
		
		$sql = "update tbfechas set resumen = '".utf8_decode($resumen)."' where idfecha=".$idfecha;
		return $this-> query($sql,0);
	}
	
	function insertarContacto($nombre,$apellido,$mail,$asunto,$mensaje) {
		
		$sql = "insert into dbcontactos(dbcontactos.idcontacto,
										dbcontactos.nombre,
										dbcontactos.apellido,
										dbcontactos.asunto,
										dbcontactos.mensaje,
										dbcontactos.telefono,
										dbcontactos.mail,
										dbcontactos.domicilio,
										dbcontactos.imagen) values 
										('','".$nombre."','".$apellido."','".$asunto."','".$mensaje."',null,'".$mail."','','')";

                $correo = "info@complejoshowbol.com.ar"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);
                
                $correo = "matias_ortega22@hotmail.com"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);


                $correo = "msredhotero@msn.com"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);



		return $this-> query($sql,1);
		//return $sql;
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
	
	
	
	
	
	
	
	
	
	
	
	
	}

?>