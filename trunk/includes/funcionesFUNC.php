<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosFUNC {
	
	function PJ($idgrupo) {
		$sql = "select t.equipo,count(*)
				from (
				select fi.idfixture, 
				(select e.idequipo 
				from dbtorneoge tge 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbequipos e 
				on e.idequipo = ge.refequipo 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipo, 
				fi.resultado_a as resultadoa, 
				(select g.nombre 
				from dbtorneoge tge 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbequipos e 
				on e.idequipo = ge.refequipo 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona, 
				fi.fechajuego, 
				f.tipofecha as fecha, 
				fi.hora
				from dbfixture as fi 
				inner join tbfechas AS f 
				on fi.reffecha = f.idfecha 
				inner join dbtorneoge tge 
				on tge.idtorneoge = fi.reftorneoge_b 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where g.idgrupo=".$idgrupo." 
				
				union all
				
				
				select fi.idfixture, 
				(select e.idequipo 
				from dbtorneoge tge 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbequipos e 
				on e.idequipo = ge.refequipo 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as equipo, 
				fi.resultado_b as resultadob, 
				(select g.nombre 
				from dbtorneoge tge 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbequipos e 
				on e.idequipo = ge.refequipo 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where tge.idtorneoge = fi.reftorneoge_b and g.idgrupo=".$idgrupo.") as zona, 
				fi.fechajuego, 
				f.tipofecha as fecha, 
				fi.hora
				from dbfixture as fi 
				inner join tbfechas AS f 
				on fi.reffecha = f.idfecha 
				inner join dbtorneoge tge 
				on tge.idtorneoge = fi.reftorneoge_b 
				inner join dbgruposequipos ge 
				on ge.idgrupoequipo = tge.refgrupoequipo 
				inner join dbtorneos t 
				on tge.reftorneo = t.idtorneo and t.activo = 1 
				inner join dbgrupos g 
				on g.idgrupo = ge.refgrupo 
				where g.idgrupo=".$idgrupo." 
				) as t
				group by t.equipo
				order by t.equipo";
	}
	
	function PE() {
		
	}
	
	function PP() {
		
	}
	
	function PG() {
		
	}
	
	function GE() {
		
	}
	
	function GA() {
		
	}
	
	function TraerResultadosPorGrupos($idgrupo) {
		$sql = "select 
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
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoEquipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.IdTorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo."
				/*AND dbequipos.IdEquipo =  17*/
				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
				return $this-> query($sql,0);
				//return $sql;
	}
	
	
	function TraerPrograma($idgrupo,$idequipo) {
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
				        join dbgruposequipos ge
				        on ge.idgrupoequipo = tge.refgrupoequipo
				        
				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
				        inner 
				        join dbequipos e
				        on e.idequipo = ge.refequipo
				        
				        inner 
				        join dbgrupos g
				        on g.idgrupo = ge.refgrupo
				        where tge.idtorneoge = fi.reftorneoge_a and g.idgrupo=".$idgrupo.") as equipoa,
				
				fi.resultado_a as resultadoa,
				
				(select e.idequipo 
				        from dbtorneoge tge
				        
				        inner 
				        join dbgruposequipos ge
				        on ge.idgrupoequipo = tge.refgrupoequipo
				        
				        inner 
				        join dbtorneos t
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
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
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
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
				        on tge.reftorneo = t.idtorneo and t.activo = 1
				        
				        inner 
				        join dbgrupos g
				        on g.idgrupo = ge.refgrupo
				
				where g.idgrupo=".$idgrupo."
				order by fecha
				) as t
				where t.equipoa = ".$idequipo." or t.equipob = ".$idequipo;
				return $this-> query($sql,0);
	}
	
	function TraerFixturePorGrupoFechaZona($idgrupo,$fecha) {
		$sql = "select 
			fi.idfixture,
			(select e.nombre 
			        from dbtorneoge tge
			        
			        inner 
			        join dbgruposequipos ge
			        on ge.idgrupoequipo = tge.refgrupoequipo
			        
			        inner 
			        join dbtorneos t
			        on tge.reftorneo = t.idtorneo and t.activo = 1
			        
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
			        on tge.reftorneo = t.idtorneo and t.activo = 1
			        
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
			        on tge.reftorneo = t.idtorneo and t.activo = 1
			        
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
			        on tge.reftorneo = t.idtorneo and t.activo = 1
			        
			        inner 
			        join dbgrupos g
			        on g.idgrupo = ge.refgrupo
			
			where g.idgrupo=".$idgrupo." and f.tipofecha = '".$fecha."'";
			return $this-> query($sql,0);
			//return $sql;
			
	}
	
	function TraerResultadoPorGrupoFechaZona($idgrupo,$fecha){
	
	if ($fecha != "") {
		$in = "";
		for ($i=1;$i<=$fecha;$i++)
		{
			$in = $in.$i.",";
		}
		$fecha = " and dbfixture.reffecha in (".substr($in, 0, -1).")";
	}	
		
	$sql = "select 

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
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fecha."
				
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fecha."

				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
			//$sql2 = "select * from dbgrupos where idgrupo=".$idgrupo;
			return $this-> query($sql,0);
			//return $sql;
			
}
	
	function TraerFechasJugadas() {
		$sql = "SELECT
				f.reffecha,
				t.nombre,
				fe.tipofecha
				FROM
				dbfixture f
				Inner Join dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				inner join tbfechas fe on fe.idfecha = f.reffecha
				WHERE
				t.activo =  '1' AND (f.resultado_a <>  '' or f.resultado_b <>  '')
				GROUP BY
				f.reffecha,
				t.nombre,
				fe.tipofecha";
		return $this-> query($sql,0);
	}
	
	function TraerFechasJugadasFix() {
		$sql = "SELECT
				f.reffecha,
				t.nombre,
				fe.tipofecha
				FROM
				dbfixture f
				Inner Join dbtorneoge tge ON tge.idtorneoge = f.reftorneoge_a
				Inner Join dbtorneos t ON t.idtorneo = tge.reftorneo
				inner join tbfechas fe on fe.idfecha = f.reffecha
				WHERE
				t.activo =  '1'
				GROUP BY
				f.reffecha,
				t.nombre,
				fe.tipofecha";
		return $this-> query($sql,0);
	}
	
	function TraerTodosGruposResultados() {
		$sql = "select 

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
		        r.refgrupo,
			    r.idgrupoequipo
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo,
				dbgruposequipos.idgrupoequipo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.Activo =  '1' 
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo,
				dbgruposequipos.idgrupoequipo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.activo =  '1' 
				
				) as r
				group by r.nombre,r.idequipo,r.refgrupo,r.idgrupoequipo 
				order by refgrupo,pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
				return $this-> query($sql,0);
	}
	
	function copiarTorneoge($idtorneo) {

                //copio los goleadores
		$sqlgoleadores = "insert into `bcktbgoleadores`
						(idgoleador,apellido,nombre,equipo,goles,grupo,refTorneo)
						SELECT
						'',tbgoleadores.apellido,tbgoleadores.nombre,tbgoleadores.equipo,tbgoleadores.goles,tbgoleadores.grupo,".$idtorneo." as reftorneo
						FROM
						tbgoleadores";
		$this-> query($sqlgoleadores,1);
		
		//elimino los goleadores
		$sqlDelete1 = "Delete from tbgoleadores";
		$this-> query($sqlDelete1,0);


		//elimino los amonestados
		$sqlDelete2 = "Delete from tbamonestados";
		$this-> query($sqlDelete2,0);


		//elimino los conducta
		$sqlDelete3 = "Delete from tbconducta";
		$this-> query($sqlDelete3,0);



		//$sqlDelete = "delete from copia_dbtorneoge where reftorneo =".$idtorneo;
		//$this-> query($sqlDelete,0);
		
		//COPIO TODOS LOS EQUIPOS Y GRUPOS
		$sql1 = "insert into copia_dbtorneoge(idtorneoge,
											 refgrupoequipo,
											 reftorneo)
											 select idtorneoge,
											 refgrupoequipo,
											 reftorneo from dbtorneoge where reftorneo =".$idtorneo;
	    $this-> query($sql1,1);
	    
	    //$sqlDelete = "delete from copia_dbgruposequipos where reftorneo =".$idtorneo;
		//$this-> query($sqlDelete,0);
		
		//COPIO LAS ZONAS
		$sql2 = "insert into copia_dbgruposequipos(idgrupoequipo,
											 refequipo,
											 refgrupo,
											 reftorneo)
											 select idgrupoequipo,
											 refequipo,
											 refgrupo,".$idtorneo." from dbgruposequipos";
	    $this-> query($sql2,1);
	    
	    
	    return 1;
	}
	
	function cerrarTorneo($idtorneo,$insertEquiposGrupos,$idgrupoequipo) {
		//$sqlDelete = "delete from dbgruposequipos where idgrupoequipo in (".$idgrupoequipo.")";
		$sqlDelete = "delete from dbgruposequipos";
		$this-> query($sqlDelete,0);
		
		$sqlInsert = "insert into dbgruposequipos(idgrupoequipo,refequipo,refgrupo) values ".$insertEquiposGrupos;
		$this-> query($sqlInsert,1);
		
		$sqlDeleteT = "delete from dbtorneoge";
		$this-> query($sqlDeleteT,0);
		
		$sql = "insert into dbtorneoge(idtorneoge,
	 								   refgrupoequipo,
	 								   reftorneo)
											 select '',
											 idgrupoequipo,
											 ".$idtorneo." from dbgruposequipos";
	    $this-> query($sql,1);
		//return $sql;
		//return $sqlInsert;
		return 1;
	}
	
	function TraerPosocionEquipo($fechaActual,$fechaAnterior,$idgrupo,$idequipo) {
		if ($fechaActual != "") {
		$in = "";
		for ($i=1;$i<=$fechaActual;$i++)
		{
			$in = $in.$i.",";
		}
		$fechaActual = " and dbfixture.reffecha in (".substr($in, 0, -1).")";
	}	
		
	$sql = "select 

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
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fechaActual."
				
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fechaActual."

				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
				
		$resActual = $this->query($sql,0);
		$posicionActual = 0;
		$cant = 0;
		while ($row = mysql_fetch_array($resActual)) {
			$cant++;
			if ($row['idequipo'] == $idequipo) {
				$posicionActual = $cant;
			}
		}		
				
				if ($fechaAnterior != "") {
		$in2 = "";
		for ($i=1;$i<=$fechaAnterior;$i++)
		{
			$in2 = $in2.$i.",";
		}
		$fechaAnterior = " and dbfixture.reffecha in (".substr($in2, 0, -1).")";
	}	
		
	$sql2 = "select 

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
		        r.idequipo
		
				from (
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_a,
				dbfixture.resultado_b,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_a
				WHERE
				dbtorneos.activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fechaAnterior."
				
				
				UNION all
				
				SELECT
				dbequipos.idequipo,
				dbequipos.nombre,
				dbtorneos.activo,
				dbfixture.fechajuego,
				dbfixture.hora,
				dbfixture.resultado_b,
				dbfixture.resultado_a,
				dbfixture.reffecha,
				dbgruposequipos.refgrupo
				FROM
				dbequipos
				Inner Join dbgruposequipos ON dbequipos.idequipo = dbgruposequipos.refequipo
				Inner Join dbtorneoge ON dbgruposequipos.idgrupoequipo = dbtorneoge.refgrupoequipo
				Inner Join dbtorneos ON dbtorneos.idtorneo = dbtorneoge.reftorneo
				Inner Join dbfixture ON dbtorneoge.idtorneoge = dbfixture.reftorneoge_b
				WHERE
				dbtorneos.Activo =  '1' 
				and dbgruposequipos.refgrupo = ".$idgrupo.$fechaAnterior."

				
				) as r
				group by r.nombre,r.idequipo 
				order by pts desc,diferencia desc,golesafavor desc,golesencontra desc,ganados desc";
				
				$resAnterior = $this->query($sql2,0);
				
				$posicionAnterior = 0;
				$cant = 0;
				while ($row2 = mysql_fetch_array($resAnterior)) {
					$cant++;
					if ($row2['idequipo'] == $idequipo) {
						$posicionAnterior = $cant;
					}
				}
				
				if ($posicionActual > $posicionAnterior) {
					return $posicionAnterior - $posicionActual;
				} else {
					if ($posicionActual == $posicionAnterior) {
						return 0;
						} else {
							return $posicionAnterior - $posicionActual;
						}
					}
				
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