USE portaldb;
DROP PROCEDURE IF EXISTS `sp_redacted`;
delimiter #
CREATE PROCEDURE `sp_redacted` (
 idauthor int
)
BEGIN

select idv, activov, idautorv, titulov, seccionv, sidv, currentnum, currentstate from v_redacted
where idautorv = idauthor
and activov = 1;
 
END#
