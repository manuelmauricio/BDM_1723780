USE portaldb;
DROP PROCEDURE IF EXISTS `sp_liked`;
delimiter #
CREATE PROCEDURE `sp_liked` (
userlikes int(10)
)
BEGIN

select t.idv, t.fechav, t.titulov, t.descripcionv, t.fotov, t.seccionv, t.colorv from v_thumbnail t
JOIN me_gusta m 
ON t.idv = m.noticia_id 
WHERE t.activov = 1
AND t.estadov = 3
AND m.usuario_id = userlikes
ORDER BY t.idv DESC;

 
END#
