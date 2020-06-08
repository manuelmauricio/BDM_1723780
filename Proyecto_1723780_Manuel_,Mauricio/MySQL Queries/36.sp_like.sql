USE portaldb;
DROP PROCEDURE IF EXISTS `sp_like`;
delimiter #
CREATE PROCEDURE `sp_like` (
 noticia_idp  int(10),
 like_userp  int(10)
)
BEGIN


INSERT INTO `me_gusta` ( noticia_id, usuario_id)
VALUES(noticia_idp, like_userp);


END#

