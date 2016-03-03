<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Ajax y Includes</title>
</head>

<body>
<?php
include ('../includes/generadorfixturefijo.php');

$Generar = new GenerarFixture();

$fixture = $Generar->DatosFixture(42);
ini_set('max_execution_time', '360');

$i = 1;
$sql = '';
while ($row = mysql_fetch_array($fixture)) {
	switch ($i)	{
		case 1:
			$val1 = 'avalor1';
			$val2 = 'bvalor1';	
			$horario = '12:00:00';
			$idHorario = 5;
			break;
		case 2:
			$val1 = 'avalor2';
			$val2 = 'bvalor2';	
			$horario = '13:30:00';
			$idHorario = 6;
			break;
		case 3:
			$val1 = 'avalor3';
			$val2 = 'bvalor3';	
			$horario = '15:00:00';
			$idHorario = 7;
			break;
		case 4:
			$val1 = 'avalor4';
			$val2 = 'bvalor4';	
			$horario = '16:30:00';
			$idHorario = 8;
			break;
	}
	
	//$cad = $row['fecha'].$row['idfixture'].$val1.$val2;
	//die(var_dump($cad));
	$band = $Generar->traerTodos($row['fecha'],$row['idfixture'],$val1,$val2);
	//die(var_dump($band));
	if ($band == 1) {

		$sql = "update dbfixture set hora ='".$horario."' where idfixture =".$row['idfixture'];	
	
		//echo $sql;
		$res 	=	query($sql,0);
	} else {
		$sql = "update dbfixture set hora ='00:00:00' where idfixture =".$row['idfixture'];
		$res 	=	query($sql,0);
		$ar[] = array('id'=>$row['idfixture'],'horario'=>$idHorario,'cancha'=>$row['cancha'],'fecha'=>$row['idfecha'],'tge1'=>$row['reftorneoge_a'],'tge2'=>$row['reftorneoge_b'],'zona'=>$row['idgrupo'],'hora'=>$horario);	
	}
	
	if ($i==4) {
		$i = 0;	
	}
	$i += 1;
}


//grupo de equipos sin horarios
foreach ($ar as $valor) {
    $nuevoHorario = $Generar->buscarHorario($valor['zona'],42,2,$valor['horario'],$valor['tge1'],$valor['tge2'],$valor['cancha'],$valor['fecha']);
	//echo $nuevoHorario['id']."<br><br>";
	if ($nuevoHorario['id'] != 0) {
		$sql = "update dbfixture set hora ='".$nuevoHorario['horario']."' where idfixture =".$valor['id'];	
	
		//echo $sql;
		$res 	=	query($sql,0);
	} else {
		$sqlHorario = "select
							hh.idhorario, hh.horario
						from	tbhorarios hh where hh.idhorario not in (".$valor['horario'].")
									and hh.idhorario not in (
						select distinct
										h.idhorario
									from
										dbequipos e
									inner join dbtorneoge tge ON tge.refequipo = e.idequipo
									inner join dbgrupos g ON g.idgrupo = tge.refgrupo
									inner join dbtorneos t ON t.idtorneo = tge.reftorneo
									inner join tbtipotorneo tp ON tp.idtipotorneo = t.reftipotorneo
									inner join dbfixture fix ON fix.reftorneoge_a = tge.idtorneoge
										or fix.reftorneoge_b = tge.idtorneoge
									inner join tbhorarios h ON h.horario = fix.hora
										and h.reftipotorneo = 2
									where
										t.idtorneo = 42 and t.activo = 1
											and fix.cancha = '".$valor['cancha']."'
											and fix.reffecha = ".$valor['fecha'].") and hh.reftipotorneo = 2";
		//echo $sqlHorario;
		$resNueva = query($sqlHorario,0);
		if (mysql_num_rows($resNueva)>0) {
			$horaNueva = mysql_result($resNueva,0,1);	
		} else {
			$horaNueva = '0';
		}

		
		$ar2[] = array('id'=>$valor['id'],'horario'=>$valor['horario'],'hora'=>$horaNueva,'fecha'=>$valor['fecha'],'tge1'=>$valor['tge1'],'tge2'=>$valor['tge2'],'zona'=>$valor['zona']);	
	}
}

//grupo de equipos que no les quedan horarios
foreach ($ar2 as $valor) {
	
	$nuevoHorario = $Generar->buscarReemplazoHorario($valor['zona'],42,2,$valor['horario'],$valor['hora'],$valor['fecha']);

	if ($nuevoHorario['tge1'] != 0) {
		$sql1 = "update dbfixture set hora ='".$valor['hora']."',
									 reftorneoge_a = ".$nuevoHorario['tge1'].",
									 reftorneoge_b = ".$nuevoHorario['tge2']." where idfixture =".$valor['id'];	
	
		$res 	=	query($sql1,0);

		$sql2 = "update dbfixture set hora ='".$nuevoHorario['hora']."',
									 reftorneoge_a = ".$valor['tge1'].",
									 reftorneoge_b = ".$valor['tge2']." where idfixture =".$nuevoHorario['idfixture'];	
	
		$res 	=	query($sql2,0);
		//$sql = $sql1."<br>".$sql2;
		//echo $sql."<br><br>";
	} else {
		$ar3[] = array('id'=>$valor['id'],'horario'=>$valor['horario'],'hora'=>$valor['hora'],'fecha'=>$valor['fecha'],'tge1'=>$valor['tge1'],'tge2'=>$valor['tge2'],'zona'=>$valor['zona']);	
	}
}

//var_dump($ar3);
echo 'Listo';
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




?>
</body>
</html>