USE portaldb;
DROP PROCEDURE IF EXISTS `sp_sendnoticia`;
delimiter #
CREATE PROCEDURE `sp_sendnoticia` (
 pid int(10)
)
BEGIN


UPDATE `noticia`
      SET 
      estado_noticia = 2,
	  publicacion = CURRENT_TIMESTAMP
	  WHERE 'id_noticia' = pid;

END#


call sp_sendnoticia(32);

('purchase_date')

