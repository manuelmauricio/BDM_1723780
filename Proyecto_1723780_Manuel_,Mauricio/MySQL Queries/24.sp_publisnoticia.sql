USE portaldb;
DROP PROCEDURE IF EXISTS `sp_publishnoticia`;
delimiter #
CREATE PROCEDURE `sp_publishnoticia` (
 pid int(10)
)
BEGIN


UPDATE noticia
      SET 
      titulo = "3",
	publicacion = CURRENT_TIMESTAMP
	  WHERE id_noticia = `pid`;

END#




