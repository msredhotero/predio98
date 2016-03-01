select 
    e.nombre, e.idequipo, tep.valor, h.idhorario, h.horario
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
    t.idtorneo = 42 and t.activo = 1
        and tge.idtorneoge in (1404 , 1399)
        and tge.refgrupo = 21
        and (h.idhorario not in (5 , 6, 8)
        and h.idhorario not in (select distinct
            h.idhorario
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
            dbfixture fix ON fix.reftorneoge_a = tge.idtorneoge
                or fix.reftorneoge_b = tge.idtorneoge
                inner join
            tbhorarios h ON h.horario = fix.hora
                and h.reftipotorneo = 2
        where
            t.idtorneo = 42 and t.activo = 1
                and fix.cancha = 'Cancha 8'
                and fix.reffecha = 27))
order by tge.prioridad desc , tep.valor desc , h.idhorario
limit 1