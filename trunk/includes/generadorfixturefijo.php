<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Fixture</title>
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




function traerEquipoPorId($id) {

		$sql		=	"
			select 
				tge.refGrupo,
				g.nombre,
				tge.IdTorneoGE,
				tge.refequipo,
				e.Nombre,
				h.horario,
				tge.prioridad,
				tp.valor
			from
				dbtorneoge tge
					inner join
				dbturnosequiposprioridad tp ON tge.IdTorneoGE = tp.reftorneoge
					inner join
				dbequipos e ON e.IdEquipo = tge.refequipo
					inner join
				dbgrupos g ON g.IdGrupo = tge.refgrupo
					inner join
				tbhorarios h ON h.idhorario = tp.refturno
			where tge.refequipo = ".$id."
			order by g.nombre  , tp.valor desc , tge.prioridad desc

				";

	
	$res = query($sql,0);
	if (mysql_num_rows($res)>0) {
		return $res;
	}
	return 0;
}


function traerEquipos() {

		$sql		=	"
			select
					e.nombre
					from	dbtorneoge tge
					
					inner
					join	dbequipos e
					on		e.idequipo = tge.refequipo
					inner 
					join dbtorneos t
					on tge.reftorneo = t.idtorneo and t.activo = 1
					
					inner 
					join tbtipotorneo tp
					on t.reftipotorneo = tp.idtipotorneo

					
					where	tp.idtipotorneo = 3 and tge.refgrupo = 21
					limit 12
			
				";

	
	$res2 = query($sql,0);

	return $res2;
}


$equipo = traerEquipos();



$cadFixture = '';
$arEquipos = array();

if ((mysql_num_rows($equipo)%2) == 1) {
	$cantidadEquipos = mysql_num_rows($equipo)+1;
	for ($p=0;$p<mysql_num_rows($equipo);$p++) {
		$arEquipos[$p] = mysql_result($equipo,$p,0);
	}
	$arEquipos[$cantidadEquipos-1] = "borrar";
} else {
	$cantidadEquipos = mysql_num_rows($equipo);
	for ($p=0;$p<mysql_num_rows($equipo);$p++) {
		$arEquipos[$p] = mysql_result($equipo,$p,0);
	}
}

//var_dump($arEquipos);



$columnas	= $cantidadEquipos - 1;
$filas		= $cantidadEquipos / 2;

$fixture = array();

$fixtureNum = array();

$k = $cantidadEquipos;
$m = 2;

for ($i=1;$i<=$filas;$i++) {
	$m = $i + 1;
	//$k = $k - 1;
	if ($i >2) {
		$k = $k - 1;
	}
	//echo 'esta es k:'.$k."<br>";
	for ($j=1;$j<=$columnas;$j++) {
		
		if (($i == 1) && ($j == 1)) {
			$fixture[$i-1][$j-1] = $arEquipos[0]."***".$arEquipos[1];
			$fixtureNum[$i-1][$j-1] = "1***2";
			//echo 'bien';
		} else {
			if ($i == 1) {
				//echo 'bien'.($cantidadEquipos+1-$j);
				$fixture[$i-1][$j-1] = $arEquipos[0]."***".$arEquipos[$cantidadEquipos+1-$j];
				//$fixtureNum[$i-1][$j-1] = "1***".($cantidadEquipos+2-$j);	
					
			} else {
				//echo 'bien'.($k-$i+1)."<br>";
				//echo 'esta es m:'.$m."<br>";
				//echo 'esta es j:'.$j."<br>";
				//echo 'mal'.($m)."<br>";
				//echo 'esta es i:'.$i."<br>";
				$fixture[$i-1][$j-1] = $arEquipos[$k-1]."***".$arEquipos[$m-1];
				$fixtureNum[$i-1][$j-1] = ($k)."***".($m);
				$k = $k - 1;
				
					
				if ($k < 2) {
					$k = $cantidadEquipos;	
				}
				
				$m = $m - 1;

				if ($m < 2) {
					$m = $cantidadEquipos;	
				}
				
				
			}
		}
		
		
	}	
}

var_dump($fixture);

?>
</body>
</html>