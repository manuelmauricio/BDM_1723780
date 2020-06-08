USE portaldb;

DROP VIEW IF EXISTS v_comment;
DELIMITER ;;
CREATE VIEW v_comment AS
SELECT c.id_comentario as id_comentariov  , c.comentario_texto as textov, c.fecha as fechav,
c.activo as activov, c.noticia_id as noticiaidv, c.comentario_autor  as autoridv,
CONCAT(a.nombres, " ", a.apellidos," ", "(",a.username, ")", " " ) as autornv,
a.foto_perfil as perfilv
FROM comentario as c 
JOIN usuario as a
ON c.comentario_autor = a.id_usuario
ORDER BY id_comentariov
;;
DELIMITER ;



