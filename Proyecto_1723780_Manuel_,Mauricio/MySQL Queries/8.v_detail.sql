USE portaldb;
DROP VIEW IF EXISTS v_detail;
DELIMITER ;;
CREATE VIEW v_detail
AS
SELECT n.id_noticia as idv  , n.activo as activov ,  n.fecha as fechav  , n.titulo as titulov  ,  n.descripcion as descripcionv, n.fotothumb as fotov,  
n.lugar as lugarv  , n.publicacion as publicacionv  ,  n.texto as textov,  s.id_seccion as idsv, s.nombre_seccion as seccionv, s.color as colorv, r.id_usuario as idautorv,
CONCAT(r.nombres, " ", r.apellidos) as autorv, r.correo as correov , r.profesion as profesionv, r.foto_perfil as perfilv
FROM noticia as n 
JOIN seccion as s 
ON n.seccion_noticia = s.id_seccion
JOIN usuario as r 
ON n.autor = r.id_usuario
ORDER BY idv
;;
DELIMITER ;

