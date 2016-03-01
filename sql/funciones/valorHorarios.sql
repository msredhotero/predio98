select 
					e.nombre,e.idequipo,tep.valor,h.idhorario,h.horario
				from
					dbequipos e
						inner join
					dbtorneoge tge ON tge.refequipo = e.idequipo
						inner join
					dbgrupos g ON g.idgrupo = tge.refgrupo
						inner join
					dbtorneos t ON t.idtorneo = tge.reftorneo
						inner join
					tbtipotorneo tp ON tp.idtipotorneo = t.reftipotorneo
						inner join
					dbturnosequiposprioridad tep ON tep.reftorneoge = tge.IdTorneoGE
						inner join
					tbhorarios h ON h.idhorario = tep.refturno

				where
					t.idtorneo = 42 and t.activo = 1 and tge.IdTorneoGE in (1392,1386)
						and tge.refgrupo = 20
				order by tge.prioridad desc,tep.valor desc,h.idhorario
				