USE portaldb;
DROP PROCEDURE IF EXISTS `sp_featuredone`;
delimiter #
CREATE PROCEDURE `sp_featuredone` (
)
BEGIN

select idv,  titulov, descripcionv, fotov from v_thumbnail
where estadov = 3
and activov = 1
AND destacadav = 1
ORDER BY idv DESC
limit 1;
 
END#
