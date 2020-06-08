USE portaldb;
DROP PROCEDURE IF EXISTS `sp_comment`;
delimiter #
CREATE PROCEDURE `sp_comment` (
 comentario_textop  varchar(512),
 noticia_idp  int(10),
 comentario_autorp  int(10)
)
BEGIN


INSERT INTO `comentario` (comentario_texto, fecha, noticia_id, comentario_autor)
VALUES(comentario_textop, CURRENT_TIMESTAMP, noticia_idp, comentario_autorp);


END#
