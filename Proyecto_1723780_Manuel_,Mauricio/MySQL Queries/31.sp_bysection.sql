USE portaldb;
DROP PROCEDURE IF EXISTS `sp_bysection`;
delimiter #
CREATE PROCEDURE `sp_bysection` (
 idsec int
)
BEGIN

select idv, fechav, titulov, descripcionv, fotov, seccionv, colorv, sidv from v_thumbnail
where idsec = sidv
and activov = 1
and estadov = 3
ORDER BY idv DESC;

 
END#

