USE portaldb;
DROP PROCEDURE IF EXISTS `sp_recent`;
delimiter #
CREATE PROCEDURE `sp_recent` (
)
BEGIN

select idv, fechav, titulov, descripcionv, fotov, seccionv, colorv from v_thumbnail
where activov = 1
and estadov = 3
ORDER BY idv DESC
limit 15;
 
END#
