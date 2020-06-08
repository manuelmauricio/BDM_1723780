USE portaldb;
DROP PROCEDURE IF EXISTS `sp_search`;
delimiter #
CREATE PROCEDURE `sp_search` (
descp varchar(100)
)
BEGIN

select idv, fechav, titulov, descripcionv, fotov, seccionv, colorv from v_thumbnail
where
titulov like CONCAT('%', descp, '%') 
or  descripcionv like CONCAT('%', descp, '%') 
and activov = 1
and estadov = 3
ORDER BY idv DESC;

 
END#

