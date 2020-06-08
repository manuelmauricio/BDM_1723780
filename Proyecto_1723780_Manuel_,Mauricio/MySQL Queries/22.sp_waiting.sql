USE portaldb;
DROP PROCEDURE IF EXISTS `sp_waiting`;
delimiter #
CREATE PROCEDURE `sp_waiting` (
)
BEGIN

select idnoticia, activov, idautorv, titulov, seccionv, sidv, currentstate, currentnum, autorv from v_waiting
where currentnum = 2
and activov = 1;
END#

