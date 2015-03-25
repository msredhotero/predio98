<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Ajax y Includes</title>
</head>

<body>
<?php
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


$tabla = "DbJugadores";
$nombre = "Jugadores";

$sql	=	"show columns from ".$tabla;
$res 	=	query($sql,0);

if ($res == false) {
	return 'Error al traer datos';
} else {

	$ajax		=	'';
	$includes	=	'';
	
	$cuerpoVariableComunes = "";
	$cuerpoVariable = "'',";
	$cuerpoSQL = '';
	
	$cuerpoVariableUpdate = "";
	
	while ($row = mysql_fetch_array($res)) {
		if ($row[3] == 'PRI') {
			$clave = $row[0];			
		} else {
			
			switch ($row[1]) {
				case "date":
				
					$cuerpoVariable = $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
					$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
					$cuerpoSQL = $cuerpoSQL.$row[0].",";
					
					$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";
					break;
				case "datetime":
					$cuerpoVariable = $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
					$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
					$cuerpoSQL = $cuerpoSQL.$row[0].",";
					$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";
					break;
				default:
					if (strpos($row[1],"varchar") !== false) {
						$cuerpoVariable = $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
						$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
						$cuerpoSQL = $cuerpoSQL.$row[0].",";
						$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";	
					} else {
						$cuerpoVariable = $cuerpoVariable.'".$'.$row[0].'.",';
						$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
						$cuerpoSQL = $cuerpoSQL.$row[0].",";
						$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '.'".$'.$row[0].'."'.",";
					}
					
					break;
			}
			
		}
		
	}
	
	$cuerpoVariable			= substr($cuerpoVariable,0,strlen($cuerpoVariable)-1);
	$cuerpoVariableUpdate	= substr($cuerpoVariableUpdate,0,strlen($cuerpoVariableUpdate)-1);
	$cuerpoVariableComunes	= substr($cuerpoVariableComunes,0,strlen($cuerpoVariableComunes)-1);
	$cuerpoSQL				= substr($cuerpoSQL,0,strlen($cuerpoSQL)-1);
	
	//// para el insert ///
	/*  '','".utf8_decode($apellido)."',".$dni.",".$idequipo." */
	
	/*  para el update
	
						apellido = '".utf8_decode($apellido)."', 
						nombre = '".utf8_decode($nombre)."', 
						idequipo = ".$idequipo." 
						
						*/
	$includes = $includes.'
	
		function insertar'.$nombre.'('.$cuerpoVariableComunes.') { <br>		
			$sql = "insert into '.$tabla.'('.$clave.','.$cuerpoSQL.') <br>		
											values ('.$cuerpoVariable.')"; <br>		
			$res = $this->query($sql,1); <br>		
			return $res; <br>
		} <br>
	
	
		<br>
		<br>
		function modificar'.$nombre.'($id) { <br>
			$sql = "update '.$tabla.' <br>
					set <br>
						'.$cuerpoVariableUpdate.' <br>
						where '.$clave.' =".$id; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>
		} <br>
		<br>
		<br>
		function eliminar'.$nombre.'($id) { <br>
			$sql = "delete from '.$tabla.' where '.$clave.' =".$id; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>
		} <br>
	
	';
	

	
	echo $includes;
}



?>
</body>
</html>