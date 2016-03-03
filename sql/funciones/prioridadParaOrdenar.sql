select
/*g.idfixture,g.equipoa,g.equipob,g.zona, */
sum(g.avalor1 + g.bvalor1) as v1,
sum(g.avalor2 + g.bvalor2) as v2,
sum(g.avalor3 + g.bvalor3) as v3,
sum(g.avalor4 + g.bvalor4) as v4,
g.ahorario1,g.ahorario2,g.ahorario3,g.ahorario4,g.fecha
/*,g.reftorneoge_a,g.reftorneoge_b*/
from
 (
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



			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 5
				) as avalor1,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 6
				) as avalor2,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 7
				) as avalor3,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 8
				) as avalor4,
				(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 5
				) as ahorario1,
				(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 6
				) as ahorario2,
			(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 7
				) as ahorario3,
			(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_a
						and tgee.refgrupo = g.idgrupo and tep.refturno = 8
				) as ahorario4,





				(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 5
				) as bvalor1,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 6
				) as bvalor2,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 7
				) as bvalor3,
			(select 
					tep.valor
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 8
				) as bvalor4,
				(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 5
				) as bhorario1,
				(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 6
				) as bhorario2,
			(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 7
				) as bhorario3,
			(select 
					h.horario
				from
					dbequipos eee
						inner join
					dbtorneoge tgee ON tgee.refequipo = eee.idequipo
						inner join
					dbgrupos ggg ON ggg.idgrupo = tgee.refgrupo
						inner join
					dbtorneos ttt ON ttt.idtorneo = tgee.reftorneo
						inner join
					tbtipotorneo tpp ON tpp.idtipotorneo = ttt.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tgee.idtorneoge
						inner join
					tbhorarios h ON h.idhorario = tep.refturno
				where
					ttt.idtorneo =42 and ttt.activo = 1
						and tgee.idtorneoge =fi.reftorneoge_b
						and tgee.refgrupo = g.idgrupo and tep.refturno = 8
				) as bhorario4,



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
							
) g

where g.fecha = 'Fecha 1' 
group by g.ahorario1,g.ahorario2,g.ahorario3,g.ahorario4,g.fecha


