USE portaldb;
DROP PROCEDURE IF EXISTS `sp_featured`;
delimiter #
CREATE PROCEDURE `sp_featured` (
)
BEGIN

select idv,  titulov, descripcionv, fotov from v_thumbnail
where estadov = 3
and activov = 1
AND destacadav = 1
ORDER BY idv DESC
limit 2 OFFSET 1;
 
END#
