USE portaldb;

DROP VIEW IF EXISTS v_thumbnail;
DELIMITER ;;
CREATE VIEW v_thumbnail AS
SELECT n.id_noticia as idv  , n.activo as activov  ,  n.fecha as fechav  , n.estado_noticia as estadov, n.titulo as titulov  ,  n.descripcion as descripcionv, n.fotothumb as fotov, n.destacada as destacadav, s.nombre_seccion as seccionv, 
s.color as colorv, s.id_seccion as sidv
FROM noticia as n 
JOIN seccion as s 
ON n.seccion_noticia = s.id_seccion
ORDER BY idv
;;
DELIMITER ;



