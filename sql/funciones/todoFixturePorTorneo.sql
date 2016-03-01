select 
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
			g.nombre,
			fi.cancha,
			fi.reftorneoge_a,
			fi.reftorneoge_b
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
							join		tbtipotorneo tp
							on			tp.idtipotorneo = t.reftipotorneo
					        inner 
					        join dbgrupos g
					        on g.idgrupo = tge.refgrupo
							
							where	t.idtorneo = 42
							
					 order by f.idfecha,fi.cancha