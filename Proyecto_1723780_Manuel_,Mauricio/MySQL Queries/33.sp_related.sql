USE portaldb;
DROP PROCEDURE IF EXISTS `sp_related`;
delimiter #
CREATE PROCEDURE `sp_related` (
 idsec int,
 idcurrent int
)
BEGIN

select idv, fechav, titulov, descripcionv, fotov, seccionv, colorv, sidv from v_thumbnail
where idsec = sidv
and idcurrent <> idv
and activov = 1
and estadov = 3
Limit 3;

 
END;