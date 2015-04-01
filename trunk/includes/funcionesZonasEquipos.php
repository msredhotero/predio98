<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosZonasEquipos {
	
	function TraerGruposActivos() {
		$sql = "SELECT
			distinct	g.idgrupo,g.nombre
				FROM
				dbgrupos g
				Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
				Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				Inner Join dbequipos e ON e.idequipo = ge.refequipo
				where t.activo = 1";	
		return $this-> query($sql,0);
	
	}
	
	function TraerIdTorneoGE($idgrupo,$idequipo,$idtorneo) {
		$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					tge.idtorneoge as idtorneoeg
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = ge.refequipo
					where t.activo = 1 and g.idgrupo =".$idgrupo." and e.idequipo=".$idequipo." and t.idtorneo=".$idtorneo;
		$res = $this-> query($sql,0);
		return mysql_result($res,0,'idtorneoeg');		
					
	}
	
	function TraerEquiposSinGrupos() {
		$sql = "SELECT
					e.idequipo,
					e.nombre
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo and t.activo = 1
					right Join dbequipos e ON e.idequipo = ge.refequipo
					where tge.refgrupoequipo is  null
					order by e.nombre";
					return $this-> query($sql,0);
	}
	
	
	function TraerGruposEquiposId($idgrupo) {
		
		if ($idgrupo == "") {
			$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					ge.idgrupoequipo
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = ge.refequipo
					where t.activo = 1";	
		} else {
			$sql = "SELECT
					g.idgrupo,
					g.nombre as gruponombre,
					t.nombre as torneonombre,
					t.idtorneo,
					t.activo,
					e.idequipo,
					e.nombre as equiponombre,
					ge.idgrupoequipo
					FROM
					dbgrupos g
					Inner Join dbgruposequipos ge ON g.idgrupo = ge.refgrupo
					Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
					Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
					Inner Join dbequipos e ON e.idequipo = ge.refequipo
					where t.activo = 1 and g.idgrupo =".$idgrupo;
		}
		return $this-> query($sql,0);		
				
	}
	
	
	function TraerFixturePorGrupo($idgrupo){
	$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
			fi.resultado_a as resultadoa,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipob,
			fi.resultado_b as resultadob,
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbgruposequipos ge
					        on ge.idgrupoequipo = tge.refgrupoequipo
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = ge.refgrupo
					where g.idgrupo=".$idgrupo." order by f.tipofecha";
			//$sql2 = "select * from dbgrupos where idgrupo=".$idgrupo;
			return $this-> query($sql,0);
			//return $sql;
			
}
	
	function TraerTodoFixture() {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a) as equipoa,
			fi.resultado_a as resultadoa,
			fi.resultado_b as resultadob,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as equipob,
			
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = tge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = tge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b) as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora,
			g.nombre
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = tge.refgrupo
					 order by g.nombre,f.tipofecha,fi.hora";
		 return $this-> query($sql,0);
	}
	
	
	
	function insertarZonasEquipos($refgrupo,$reftorneo,$refequipo,$prioridad) {
		$sql = "insert into dbtorneoge(IdTorneoGE,refgrupo,reftorneo,refequipo,prioridad)
		values ('',".$refgrupo.",".$reftorneo.",".$refequipo.",".($prioridad == '' ? 0 : $prioridad).")";
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	function modificarZonasEquipos($id) {
		$sql = "update dbtorneoge
		set
		refgrupo = ".$refgrupo.",reftorneo = ".$reftorneo.",refequipo = ".$refequipo.",prioridad = ".$prioridad."
		where IdTorneoGE =".$id;
		$res = $this->query($sql,0);
		return $res;
	}

	
	function eliminarZonasEquipos($idgrupo,$idequipo,$idtorneo) {
		
		$sql = "SELECT
				tge.idtorneoge,
				ge.idgrupoequipo
				FROM
				dbgruposequipos ge
				Inner Join dbtorneoge tge ON ge.idgrupoequipo = tge.refgrupoequipo
				WHERE
				ge.refequipo =  ".$idequipo." AND
				ge.refgrupo =  ".$idgrupo;
				
		$res = $this-> query($sql,0);
		
		
		$idtorneoeg= mysql_result($res,0,0);
		$idgrupoequipo= mysql_result($res,0,1);
		
		
		$idfixture = "SELECT
					dbfixture.reffecha
					FROM
					dbfixture
					WHERE
					dbfixture.reftorneoge_a =  ".$idtorneoeg." OR
					dbfixture.reftorneoge_b =  ".$idtorneoeg;
		$resfix =  $this-> query($idfixture,0);
					
		if (mysql_num_rows($resfix) > 0) {
			return 0;
		} else {
			
			$sqldelGruEqui = "delete from dbgruposequipos where idgrupoequipo =".$idgrupoequipo;
			$this-> query($sqldelGruEqui,0);
			$sqldelTorGE = "delete from dbtorneoge where idtorneoge =".$idtorneoeg;
			$this-> query($sqldelTorGE,0);
			
			return 1;
		}
				
		
		
		
	}
	
	
	
	function agregarFixture($idgrupo,$idequipoa,$idequipob,$resultadoa,$resultadob,$idtorneo,$fecha,$fechajuego,$hora,$minutos) {
		
		
		
		$ideq1 = $this->TraerIdTorneoGE($idgrupo,$idequipoa,$idtorneo);
		$ideq2 = $this->TraerIdTorneoGE($idgrupo,$idequipob,$idtorneo);
		
		$sqlfecha = "select * from tbfechas where tipofecha='".$fecha."'";
		
		$resfecha = $this->query($sqlfecha,0);
		$idfecha= mysql_result($resfecha,0,0);
		
		$horario = $hora.":".$minutos;
		
		if ($resultadoa == '')
		$resultadoa = 'null';
		
		if ($resultadob == '')
		$resultadob = 'null';
		
		
		$sql = "insert into dbfixture(idfixture,
									  reftorneoge_a,
									  resultado_a,
									  reftorneoge_b,
									  resultado_b,
									  fechajuego,
									  refFecha,
									  hora) 
					values ('',".$ideq1.",".$resultadoa.",".$ideq2.",".$resultadob.",'".$fechajuego."',".$idfecha.",'".$horario."')";
		$this-> query($sql,1);
		
		return 1;	
					
					
	}
	
	
	function insertarFixture($reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario) {
		
		$sqlHorario = "select horario from tbhorarios where idhorario = ".$horario;
		$horario = mysql_result($this->query($sqlHorario,0),0,0);
		
		$sql = "insert into dbfixture(Idfixture,reftorneoge_a,resultado_a,reftorneoge_b,resultado_b,fechajuego,refFecha,cancha,hora)
		values ('',".$reftorneoge_a.",".($resultado_a == '' ? 'null' : $resultado_a).",".$reftorneoge_b.",".($resultado_b == '' ? 'null' : $resultado_b).",'".utf8_decode($fechajuego)."',".$refFecha.",'Cancha ".utf8_decode($cancha)."','".$horario."')";
		
		$res = $this->query($sql,1);
		return $res;
	}
	
	
	function modificarFixtureTodo($id) {
		$sql = "update dbfixture
		set
		reftorneoge_a = ".$reftorneoge_a.",resultado_a = ".$resultado_a.",reftorneoge_b = ".$reftorneoge_b.",resultado_b = ".$resultado_b.",fechajuego = '".$fechajuego."',refFecha = ".$refFecha.",cancha = '".utf8_decode($cancha)."',hora = '".$horario."'
		where Idfixture =".$id;
		
		$res = $this->query($sql,0);
		return $res;
	} 
	
	
	function eliminarFixture($id) {
		$sql = "delete from dbfixture where Idfixture =".$id;
		
		$res = $this->query($sql,0);
		return $res;
	} 

	
	function modificarFixture($idfixture,$resultadoa,$resultadob) {
		$sql = "update dbfixture set resultado_a =".$resultadoa.", resultado_b=".$resultadob." where idfixture =".$idfixture;
		$res = $this-> query($sql,0);
		return $res;
	}
	

	
	function cambiarEquipoPorEquipo($idequipob,$idgrupoequipo) {
		$sql = "update dbgruposequipos set refequipo =".$idequipob." where idgrupoequipo =".$idgrupoequipo;
		$res= $this-> query($sql,0);
		return $res;
	}
	
	function TraerIdFixture($idFixture,$idgrupo) {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
			fi.resultado_a as resultadoa,
			(select e.nombre 
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipob,
			fi.resultado_b as resultadob,
			(select g.nombre
			        from dbtorneoge tge
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = true
			        inner 
			        join dbequipos e
			        on e.idequipo = ge.refequipo
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona,   
			fi.fechajuego,
			f.tipofecha as fecha,
			fi.hora
					from dbfixture as fi
					        inner 
					        join tbfechas AS f
					        on fi.reffecha = f.idfecha
					        inner 
					        join dbtorneoge tge
					        on tge.idtorneoge = fi.reftorneoge_b
					        inner 
					        join dbgruposequipos ge
					        on ge.idgrupoequipo = tge.refgrupoequipo
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = ge.refgrupo
					where g.idgrupo=".$idgrupo." and fi.idfixture=".$idFixture;
		return $this->query($sql,0);
	}
	
	
	function TraerEquiposSinZona() {
		$sql  = "select
					e.IdEquipo, e.Nombre
				from		dbequipos e
				left
				join		dbtorneoge tge
				on			tge.refequipo = e.IdEquipo
				where		tge.IdTorneoGE is null
				order by e.Nombre";
		return $this->query($sql,0);
		
	}
	
	function TraerEquiposZonas() {
		$sql  = "select 
			tge.IdTorneoGE, g.nombre, e.Nombre, t.Nombre, tge.prioridad
		from
			dbequipos e
				inner join
			dbtorneoge tge ON tge.refequipo = e.IdEquipo
				inner join
			dbgrupos g ON g.IdGrupo = tge.refgrupo
				inner join
			dbtorneos t ON t.IdTorneo = tge.refTorneo
			order by g.nombre, e.Nombre";
		return $this->query($sql,0);
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