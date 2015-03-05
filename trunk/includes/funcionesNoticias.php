<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosNOTI {
	
	function TraerSeleccion() {
		$sql = "select * from tbseleccion order by grupo,posicion";
		return $this-> query($sql,0);
	}
	
	function TraerSeleccionPorZona($zona) {
		$sql = "select * from tbseleccion where grupo='".$zona."' order by grupo,posicion";
		return $this-> query($sql,0);
	}
	
	
	function insertarSeleccion($nombre1,$nombre2,$nombre3,$nombre4,$nombre5,$nombre6,$nombre7,$nombre8,$nombre9,$equipo1,$equipo2,$equipo3,$equipo4,$equipo5,$equipo6,$equipo7,$equipo8,$equipo9,$grupo1) {
		
		$borrar = "delete from tbseleccion where grupo='".$grupo1."'";
		$this-> query($borrar,0);
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".utf8_decode($nombre1)."','".trim($grupo1)."','".utf8_decode($equipo1)."',1),
    						('','".utf8_decode($nombre2)."','".trim($grupo1)."','".utf8_decode($equipo2)."',2),
						('','".utf8_decode($nombre3)."','".trim($grupo1)."','".utf8_decode($equipo3)."',3),
						('','".utf8_decode($nombre4)."','".trim($grupo1)."','".utf8_decode($equipo4)."',4),
						('','".utf8_decode($nombre5)."','".trim($grupo1)."','".utf8_decode($equipo5)."',5),
						('','".utf8_decode($nombre6)."','".trim($grupo1)."','".utf8_decode($equipo6)."',6),
						('','".utf8_decode($nombre7)."','".trim($grupo1)."','".utf8_decode($equipo7)."',7),
						('','".utf8_decode($nombre8)."','".trim($grupo1)."','".utf8_decode($equipo8)."',8),
						('','".utf8_decode($nombre9)."','".trim($grupo1)."','".utf8_decode($equipo9)."',9)";

				$this-> query($sql,1);
				//return $sql;
		/*
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre2."','".$grupo1."','".$equipo2."',2)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre3."','".$grupo1."','".$equipo3."',3)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre4."','".$grupo1."','".$equipo4."',4)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre5."','".$grupo1."','".$equipo5."',5)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre6."','".$grupo1."','".$equipo6."',6)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre7."','".$grupo1."','".$equipo7."',7)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre8."','".$grupo1."','".$equipo8."',8)";
				$this-> query($sql,1);
		$sql = "insert into tbseleccion(idseleccion,
				nombre,
				grupo,
				equipo,
				posicion) values('','".$nombre9."','".$grupo1."','".$equipo9."',9)";
				$this-> query($sql,1);
				*/
				return 1;
		
	}
	
	
	function TraerNoticias() {
		$sql = "select * from dbnoticias order by fechacreacion desc limit 6";
		return $this-> query($sql,0);
	}
	
	function TraerIdNoticias($id) {
		$sql = "select * from dbnoticias where idnoticia=".$id;
		return $this-> query($sql,0);
	}
	
	function BuscarImagenSubida($imagen) {
		$sql = "select * from tbimagenescargadas where nombre='".$imagen."'";
		$res = $this->query($sql,0);
		
		if (mysql_num_rows($res) > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function TraerNoticiasImagenes() {
		$sql = "select nombre from tbimagenescargadas where nombre <> '' order by nombre";
		return $this-> query($sql,0);
	}
	
	function insertarImagen($nombre) {
		$sql = "insert into tbimagenescargadas(idimagen,nombre) values ('','".$nombre."')";
		return $this-> query($sql,1);
	}
	
	function insertarNoticia($titulo,$parrafo,$imagen) {
                header( 'Content-type: text/html; charset=iso-8859-1' );
		$sql = "insert into dbnoticias(idnoticia,titulo,imagen,parrafo,fechacreacion)
				values ('','".utf8_decode($titulo)."','".$imagen."','".utf8_decode($parrafo)."','".date('Y-m-d H:i:s')."')";
			
		$this-> query($sql,1);
		return $sql;
		
	}
	
	function modificarNoticia($idnoticia,$titulo,$parrafo,$imagen) {
                header( 'Content-type: text/html; charset=iso-8859-1' );
		$sql = "update dbnoticias set titulo = '".utf8_decode($titulo)."', imagen = '".$imagen."', parrafo='".utf8_decode($parrafo)."', fechacreacion= '".date('Y-m-d H:i:s')."' where idnoticia=".$idnoticia;
		$this-> query($sql,0);
		return 1;
	}
	
	function eliminarNoticia($idnoticia) {
		$sql = "delete from dbnoticias where idnoticia=".$idnoticia;
		$this-> query($sql,0);
		return 1;
	}
	
	function TraerNotiPrinc() {
		$sql = "select * from dbnoticiaprincipal order by idnoticiaprincipal desc limit 1";
		return $this-> query($sql,0);
	}
	
	function insertarNotiPrinc($campo1,$campo2,$campo3,$campo4) {
                        header( 'Content-type: text/html; charset=iso-8859-1' );
			$sql = "insert into dbnoticiaprincipal(idnoticiaprincipal,campo1,campo2,campo3,campo4,fechacreacion)
				values ('','".utf8_decode($campo1)."','".utf8_decode($campo2)."','".utf8_decode($campo3)."','".utf8_decode($campo4)."','".date('Y-m-d H:i:s')."')";
			
		$this-> query($sql,1);
		return 1;
	}
	
	function TraerTurnos() {
		$sql = "SELECT * FROM dbturnos order by SUBSTRING(cancha,7) + 0,turno";
		return $this-> query($sql,0);
	}
	
	function TraerCanchaTurnos($cancha) {
		$sql = "select * from dbturnos where cancha = '".$cancha."' order by turno";
		return $this-> query($sql,0);
	}
	function LimpiarTodosTurnos() {
		$sql = "update dbturnos set equipoa = '', equipob='' ";
		return $this-> query($sql,0);
	}
	
	function LimpiarTurnos($cancha) {
		$sql = "update dbturnos set equipoa = '', equipob='' where cancha = '".$cancha."'";
		return $this-> query($sql,0);
	}
	
	function modificarTurnos($turno1,$turno2,$turno3,$turno4,$equipoa1,$equipoa2,$equipoa3,$equipoa4,$equipob1,$equipob2,$equipob3,$equipob4,$cancha) {
		
		 header( 'Content-type: text/html; charset=iso-8859-1' );
		 
		 
		$sql = "update dbturnos set horario = '".utf8_decode($turno1)."', equipoa = '".utf8_decode($equipoa1)."', equipob = '".utf8_decode($equipob1)."' where cancha = '".$cancha."' and turno = 1";
		$this-> query($sql,0);
		$sql = "update dbturnos set horario = '".utf8_decode($turno2)."', equipoa = '".utf8_decode($equipoa2)."', equipob = '".utf8_decode($equipob2)."' where cancha = '".$cancha."' and turno = 2";
		$this-> query($sql,0);
		$sql = "update dbturnos set horario = '".utf8_decode($turno3)."', equipoa = '".utf8_decode($equipoa3)."', equipob = '".utf8_decode($equipob3)."' where cancha = '".$cancha."' and turno = 3";
		$this-> query($sql,0);
		$sql = "update dbturnos set horario = '".utf8_decode($turno4)."', equipoa = '".utf8_decode($equipoa4)."', equipob = '".utf8_decode($equipob4)."' where cancha = '".$cancha."' and turno = 4";
		$this-> query($sql,0);
		
		return 1;
	}
	
	function TraerPremios() {
		$sql = "select * from tbpremios order by fechaactualizacion desc";
		return $this->query($sql,0);
	}
	
	function insertPremiosBCK($contenido) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "insert into tbpremios_bck(idpremio,contenido,fechaactualizacion)
										values ('','".utf8_decode($contenido)."','".date('Y-m-d')."')";
		return $this->query($sql,1);
		
	}
	
	function modificarPremios($contenido) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "update tbpremios set contenido = '".utf8_decode($contenido)."', fechaactualizacion = '".date('Y-m-d')."'";
		$this->query($sql,0);
	}
	
	
	
	function TraerReglamento() {
		$sql = "select * from tbreglamento order by fechaactualizacion desc";
		return $this->query($sql,0);
	}
	
	
	function insertReglamentoBCK($contenido) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "insert into tbreglamento_bck(idreglamento,contenido,fechaactualizacion)
										values ('','".utf8_decode($contenido)."','".date('Y-m-d')."')";
		return $this->query($sql,1);
		
	}
	
	
	function modificarReglamento($contenido) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "update tbreglamento set contenido = '".utf8_decode($contenido)."', fechaactualizacion = '".date('Y-m-d')."'";
		$this->query($sql,0);
	}
	
	function TraerServicios() {
		$sql = "select * from tbservicios order by fechaactualizacion desc";
		return $this->query($sql,0);
	}
	
	
	function insertServiciosBCK($planilla,$servmed,$arbit) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "insert into tbservicios_bck(idreglamento,planilleros,servmed,arbitraje,fechaactualizacion)
										values ('','".utf8_decode($planilla)."','".utf8_decode($servmed)."','".utf8_decode($arbit)."','".date('Y-m-d')."')";
		return $this->query($sql,1);
		
	}
	
	
	
	function modificarServicios($planilla,$servmed,$arbit) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		$sql = "update tbservicios set planilleros = '".utf8_decode($planilla)."',
										servmed = '".utf8_decode($servmed)."',
										arbitraje = '".utf8_decode($arbit)."', fechaactualizacion = '".date('Y-m-d')."'";
		$this->query($sql,0);
	}
	

        function TraerHorarioPrincipal() {
		$sql = "select * from tbhorarioprincipal";
		return $this->query($sql,0);
	}
	
	function InsertarHorarioPrincipal($nombre) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		$sql = "update tbhorarioprincipal set nombre = '".utf8_decode($nombre)."' where idhorarioprincipal = 1";
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
	}

?>