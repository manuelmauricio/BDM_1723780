USE portaldb;
DROP PROCEDURE IF EXISTS `sp_deletenoticiar`;
delimiter #
CREATE PROCEDURE `sp_deletenoticiar` (
 pid int(10)
)
BEGIN


UPDATE `noticia` 
      SET 
      activo = 0
	WHERE id_noticia = pid;

END#






