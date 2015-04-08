<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosNoticias {
	
	function insertarNoticiasPrincipales($titulo,$noticiaprincipal,$fechacreacion) {
	$sql = "insert into dbnoticiaprincipal(idnoticiaprincipal,titulo,noticiaprincipal,fechacreacion)
	values ('','".utf8_decode($titulo)."','".utf8_decode($noticiaprincipal)."','".utf8_decode($fechacreacion)."')";
	$res = $this->query($sql,1);
	return $res;
	}
	
	
	function modificarNoticiasPrincipales($id,$titulo,$noticiaprincipal,$fechacreacion) {
	$sql = "update dbnoticiaprincipal
	set
	titulo = '".utf8_decode($titulo)."',noticiaprincipal = '".utf8_decode($noticiaprincipal)."',fechacreacion = '".utf8_decode($fechacreacion)."'
	where idnoticiaprincipal =".$id;
	$res = $this->query($sql,0);
	return $res;
	}
	
	
	function eliminarNoticiasPrincipales($id) {
	$sql = "delete from dbnoticiaprincipal where idnoticiaprincipal =".$id;
	$res = $this->query($sql,0);
	return $res;
	}
	
	function traerNoticiaPrincipal() {
		$sql = "select * from dbnoticiaprincipal order by fechacreacion";
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function traerNoticiaPrincipalPorId($id) {
		$sql = "select * from dbnoticiaprincipal where idnoticiaprincipal =".$id;
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function insertarNoticiasPredio($titulo,$noticiapredio,$fechacreacion) {
$sql = "insert into dbnoticiapredio(idnoticiapredio,titulo,noticiapredio,fechacreacion)
values ('','".utf8_decode($titulo)."','".utf8_decode($noticiapredio)."','".utf8_decode($fechacreacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarNoticiasPredio($id,$titulo,$noticiapredio,$fechacreacion) {
$sql = "update dbnoticiapredio
set
titulo = '".utf8_decode($titulo)."',noticiapredio = '".utf8_decode($noticiapredio)."',fechacreacion = '".utf8_decode($fechacreacion)."'
where idnoticiapredio =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarNoticiasPredio($id) {
$sql = "delete from dbnoticiapredio where idnoticiapredio =".$id;
$res = $this->query($sql,0);
return $res;
} 


	function traerNoticiaPredio() {
		$sql = "select * from dbnoticiapredio order by fechacreacion";
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function traerNoticiaPredioPorId($id) {
		$sql = "select * from dbnoticiapredio where idnoticiapredio =".$id;
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
	}

?>