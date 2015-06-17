select
t.tipofecha, t.nombre, sum(t.puntos) as puntos
from
(
	select
	f.tipofecha,e.nombre, sum(a.amarillas) as puntos, f.idfecha
	from		tbamonestados a
	inner
	join		dbequipos e
	on			e.idequipo = a.refequipo
	inner
	join		dbfixture fix
	on			fix.idfixture = a.reffixture
	inner
	join		tbfechas f
	on			f.idfecha = fix.reffecha
	where		a.amarillas = 1
	group by 	f.tipofecha,e.nombre, f.idfecha
	
/*
	union all

	select
	f.tipofecha,e.nombre, sum(3) as puntos, f.idfecha
	from		tbamonestados a
	inner
	join		dbequipos e
	on			e.idequipo = a.refequipo
	inner
	join		dbfixture fix
	on			fix.idfixture = a.reffixture
	inner
	join		tbfechas f
	on			f.idfecha = fix.reffecha
	where		a.amarillas = 2
	group by 	f.tipofecha,e.nombre, f.idfecha
*/
	union all

	select
	f.tipofecha,e.nombre, sum(3) as puntos, sp.idfecha
	from		tbsuspendidos a
	inner
	join		dbequipos e
	on			e.idequipo = a.refequipo
	inner
	join		(select refsuspendido,min(reffecha) as idfecha from dbsuspendidosfechas group by refsuspendido)  sp
	on			sp.refsuspendido = a.idsuspendido
	inner
	join		tbfechas f
	on			f.idfecha = sp.idfecha -1
	group by 	f.tipofecha,e.nombre, sp.idfecha
) as t
group by t.tipofecha, t.nombre
order by    t.nombre,t.idfecha