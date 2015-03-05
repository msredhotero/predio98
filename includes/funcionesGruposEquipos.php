<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosGE {
	
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
			        where tge.idtorneoge = fi.reftorneoge_a) as equipoa,
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
			        where tge.idtorneoge = fi.reftorneoge_b) as equipob,
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
					        join dbgruposequipos ge
					        on ge.idgrupoequipo = tge.refgrupoequipo
					        inner 
					        join dbtorneos t
					        on tge.reftorneo = t.idtorneo and t.activo = true
					        inner 
					        join dbgrupos g
					        on g.idgrupo = ge.refgrupo
					 order by g.nombre,f.tipofecha";
		 return $this-> query($sql,0);
	}
	
	
	
	function insertarGrupoEquipo($idgrupo,$idequipo,$idtorneo) {
		$sql = "insert into dbgruposequipos(idgrupoequipo,refequipo,refgrupo) 
					values ('',".$idequipo.",".$idgrupo.")";
		$this-> query($sql,1);
		
		$sqleg = "select max(idgrupoequipo) from dbgruposequipos";
		$reseg = $this-> query($sqleg,0);
		$sqlt = "insert into dbtorneoge(idtorneoge,refgrupoequipo,reftorneo)
					values ('',".mysql_result($reseg,0,0).",".$idtorneo.")";
		$this-> query($sqlt,1);
		
		return 1;			
					
	}
	
	function eliminarGrupoEquipo($idgrupo,$idequipo,$idtorneo) {
		
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
	
	
	function modificarFixture($idfixture,$resultadoa,$resultadob) {
		$sql = "update dbfixture set resultado_a =".$resultadoa.", resultado_b=".$resultadob." where idfixture =".$idfixture;
		$this-> query($sql,0);
		return 1;
	}
	
	function eliminarFixture($idfixture) {
		$sql = "delete from dbfixture where idfixture =".$idfixture;
		$this-> query($sql,0);
		return 1;
	}
	
	function cambiarEquipoPorEquipo($idequipob,$idgrupoequipo) {
		$sql = "update dbgruposequipos set refequipo =".$idequipob." where idgrupoequipo =".$idgrupoequipo;
		$this-> query($sql,0);
		return 1;
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