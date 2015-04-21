<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosDatos {
	
	function traerResultadosPorTorneoZonaFecha($idtorneo,$idzona,$idfecha) {
		$sql = "select 

		       (select ea.nombre from dbequipos ea where ea.idequipo = t.equipoa) as equipo1,
		       t.resultadoa,
		       t.resultadob,
		       (select ea.nombre from dbequipos ea where ea.idequipo = t.equipob) as equipo2, 
		       t.fechajuego,
		       t.fecha,
		       t.hora
		 
				from (
				select 
				fi.idfixture,
				(select e.idequipo 
				        from dbtorneoge tge

				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
						inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo

				        inner 
				        join dbequipos e
				        on e.idequipo = tge.refequipo
				        
				        inner 
				        join dbgrupos g
				        on g.idgrupo = tge.refgrupo
				        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idzona." and tp.idtipotorneo = ".$idtorneo.") as equipoa,
				
				(case when fi.resultado_a is null then (select
												(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
												from		tbgoleadores gg
												where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
																										where tge.idtorneoge = fi.reftorneoge_a))
				else fi.resultado_a end) as resultadoa,
				
				(select e.idequipo 
				        from dbtorneoge tge

				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
						inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo

				        inner 
				        join dbequipos e
				        on e.idequipo = tge.refequipo
				        
				        inner 
				        join dbgrupos g
				        on g.idgrupo = tge.refgrupo
				        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idzona." and tp.idtipotorneo = ".$idtorneo.") as equipob,
				
				(case when fi.resultado_b is null then (select
															(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
															from		tbgoleadores gg
															where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
						where tge.idtorneoge = fi.reftorneoge_b))
							else fi.resultado_b end) as resultadob,
				
				(select g.nombre
				        from dbtorneoge tge

				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
						inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo

				        inner 
				        join dbequipos e
				        on e.idequipo = tge.refequipo
				        
				        inner 
				        join dbgrupos g
				        on g.idgrupo = tge.refgrupo
				        where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idzona." and tp.idtipotorneo = ".$idtorneo.") as zona,
				        
				        
				fi.fechajuego,
				f.idfecha as fecha,
				DATE_FORMAT(fi.hora,'%k:%i') as hora
				
				
				from dbfixture as fi
				        inner 
				        join tbfechas AS f
				        on fi.reffecha = f.idfecha
				
				        inner 
				        join dbtorneoge tge
				        on tge.idtorneoge = fi.reftorneoge_b

				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
						inner 
				        join tbtipotorneo tp
				        on t.reftipotorneo = tp.idtipotorneo

				        inner 
				        join dbgrupos g
				        on g.idgrupo = tge.refgrupo
				
				where g.idgrupo=".$idzona." and tp.idtipotorneo = ".$idtorneo."
				order by fecha
				) as t
				where t.fecha = '".$idfecha."'";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerPuntosReemplazo($idequipo) {
		$sqlR = "select puntos from dbreemplazo where refequipo = ".$idequipo;
		$resRR = $this->query($sqlR,0);	
		$puntos = 0;
		if (mysql_num_rows($resRR)>0) {
			$puntos = mysql_result($resRR,0,0);
		} else {
			$puntos = 0;	
		}
		return $puntos;
	}
	
	function TraerFixturePorZonaTorneo($idtorneo,$zona) {
		$sql = '
			select
			fix.nombre,
			fix.partidos,
			fix.ganados,
			fix.empatados,
			fix.perdidos,
			fix.golesafavor,
			(case when rr.idreemplazo is null then fix.golesencontra else fix.golesencontra + rr.golesencontra end) as golesencontra,
			fix.diferencia,
			(case when rr.idreemplazo is null then fix.pts else fix.pts + rr.puntos end) as pts,
			fix.idequipo,
			fix.puntos,
			fix.equipoactivo
			from
			(
				select 
		       r.nombre,
		       count(*) as partidos,
		       sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) as ganados, 
		       sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) as empatados,
		       sum(case when r.resultado_a < r.resultado_b then 1 else 0 end) as perdidos,
		       sum(r.resultado_a) as golesafavor,
		       sum(r.resultado_b) as golesencontra,
		       (sum(r.resultado_a) - sum(r.resultado_b)) as diferencia,
		       ((sum(case when r.resultado_a > r.resultado_b then 1 else 0 end) * 3) +
		        (sum(case when r.resultado_a = r.resultado_b then 1 else 0 end) * 1)) as pts,
		        r.idequipo,
				fp.puntos,
				(case when r.equipoactivo = 0 then false else true end) as equipoactivo
		
				from (
				SELECT
				e.idequipo,
				e.nombre,
				t.activo,
				f.tipofecha,
				fi.hora,
				(case when fi.resultado_a is null then (select
												(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
												from		tbgoleadores gg
												where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
																										where tge.idtorneoge = fi.reftorneoge_a))
				else fi.resultado_a end) as resultado_a,
				(case when fi.resultado_b is null then (select
															(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
															from		tbgoleadores gg
															where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
						where tge.idtorneoge = fi.reftorneoge_b))
							else fi.resultado_b end) as resultado_b,
				fi.reffecha,
				tge.refgrupo,
				tge.activo as equipoactivo
				FROM
				dbtorneoge tge
				Inner Join dbequipos e ON tge.refequipo = e.idequipo
				inner join dbgrupos g on tge.refgrupo = g.idgrupo
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				Inner Join dbfixture fi ON tge.idtorneoge = fi.reftorneoge_a
				inner join tbtipotorneo tp ON tp.idtipotorneo = t.reftipotorneo
				inner join tbfechas f ON fi.refFecha = f.idfecha
				where tge.refgrupo = '.$zona.'
				and tp.idtipotorneo = '.$idtorneo.'
				
				UNION all
				
				SELECT
				e.idequipo,
				e.nombre,
				t.activo,
				f.tipofecha,
				fi.hora,
				(case when fi.resultado_b is null then (select
															(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
															from		tbgoleadores gg
															where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
						where tge.idtorneoge = fi.reftorneoge_b))
							else fi.resultado_b end) as resultado_b,
				(case when fi.resultado_a is null then (select
												(case when sum(gg.goles) is null then (case when fi.chequeado = 1 then 0 else null end) else sum(gg.goles) end)
												from		tbgoleadores gg
												where gg.reffixture = fi.idfixture and gg.refequipo = (select tge.refequipo 
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
																										where tge.idtorneoge = fi.reftorneoge_a))
				else fi.resultado_a end) as resultado_a,
				fi.reffecha,
				tge.refgrupo,
				tge.activo as equipoactivo
				FROM
				dbtorneoge tge
				Inner Join dbequipos e ON tge.refequipo = e.idequipo
				inner join dbgrupos g on tge.refgrupo = g.idgrupo
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				Inner Join dbfixture fi ON tge.idtorneoge = fi.reftorneoge_b
				inner join tbtipotorneo tp ON tp.idtipotorneo = t.reftipotorneo
				inner join tbfechas f ON fi.refFecha = f.idfecha
				where tge.refgrupo = '.$zona.'
				and tp.idtipotorneo = '.$idtorneo.'
				
				) as r
				inner
				join	(select refequipo,sum(puntos) as puntos from tbconducta group by refequipo) fp
				on		r.idequipo = fp.refequipo
				group by r.nombre,r.idequipo 
) as fix

left join dbreemplazo rr on rr.refequipo = fix.idequipo

				order by fix.pts desc,fix.diferencia desc,fix.golesafavor desc,fix.golesencontra desc,fix.ganados desc';
		$res = $this->query($sql,0);
		return $res;	
	}
	
	
	
	function Goleadores($idtorneo,$zona) {
		$sql = 'select
				t.apyn,t.nombre,t.cantidad
				from
				(
				select
				r.apyn, r.nombre, sum(r.goles) as cantidad
				from
				(
					select
					j.apyn, e.nombre, a.goles
					from	tbgoleadores a
					inner
					join	dbfixture fi
					on		a.reffixture = fi.Idfixture
					inner
					join	dbjugadores j
					on		j.idjugador = a.refjugador
					inner
					join	dbequipos e
					on		e.idequipo = a.refequipo
					inner 
					join dbtorneoge tge
					on tge.idtorneoge = fi.reftorneoge_b
				
					inner 
					join dbtorneos t
					on tge.reftorneo = t.idtorneo and t.activo = 1
					
					inner 
					join tbtipotorneo tp
					on t.reftipotorneo = tp.idtipotorneo
				
					where	tp.idtipotorneo = '.$idtorneo.' and tge.refgrupo = '.$zona.'

				) r
				group by r.apyn, r.nombre
				) t
				order by t.cantidad desc';
			return $this-> query($sql,0);
	}
	
	
	
	function Suspendidos($idtorneo,$zona) {
		$sql = 'select
				t.apyn,t.nombre, t.motivos,t.cantidad,t.reffecha, t.refjugador, t.refequipo
				from
				(
				select
				r.apyn, r.nombre, r.motivos, r.cantidadfechas as cantidad,r.reffecha, r.refjugador, r.refequipo
				from
				(
					select
					j.apyn, e.nombre, a.motivos, a.cantidadfechas,fi.reffecha, a.refjugador, a.refequipo
					from	tbsuspendidos a
					inner
					join	dbfixture fi
					on		a.reffixture = fi.Idfixture
					inner
					join	dbjugadores j
					on		j.idjugador = a.refjugador
					inner
					join	dbequipos e
					on		e.idequipo = a.refequipo
					inner 
					join dbtorneoge tge
					on tge.idtorneoge = fi.reftorneoge_b
				
					inner 
					join dbtorneos t
					on tge.reftorneo = t.idtorneo and t.activo = 1
					
					inner
					join dbsuspendidosfechas sf
					on sf.refjugador = a.refjugador and sf.refequipo = a.refequipo

					inner 
					join tbtipotorneo tp
					on t.reftipotorneo = tp.idtipotorneo
				
					where	tp.idtipotorneo = '.$idtorneo.' and tge.refgrupo = '.$zona.'

				) r
				group by r.apyn, r.nombre, r.motivos,r.reffecha,r.cantidadfechas, r.refjugador, r.refequipo
				) t
				order by t.cantidad desc';
			return $this-> query($sql,0);
	}
	
	function traerFechasRestantes($reffecha,$idjugador,$idequipo) {
		$sqlRest = "SELECT count(*) FROM dbsuspendidosfechas where reffecha <= ".$reffecha." and refequipo =".$idequipo." and refjugador =".$idjugador;
		//return $sqlRest;
		$resRest = $this-> query($sqlRest,0);
		$restan = 0;
		if (mysql_num_rows($resRest)>0) {
			$restan = mysql_result($resRest,0,0);	
		}
		return $restan;
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