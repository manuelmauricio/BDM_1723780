USE portaldb;

DROP VIEW IF EXISTS v_redacted;
DELIMITER ;;
CREATE VIEW v_redacted AS
SELECT n.id_noticia as idv  , n.activo as activov, n.autor as idautorv  ,  n.titulo as titulov  , s.nombre_seccion as seccionv, 
s.id_seccion as sidv, n.estado_noticia as currentnum,
CASE WHEN n.estado_noticia = 1 THEN 'En redacción'
WHEN n.estado_noticia = 2 THEN 'Enviada, en espera'
WHEN n.estado_noticia = 3 THEN 'Publicada'
END AS currentstate
FROM noticia as n 
JOIN seccion as s 
ON n.seccion_noticia = s.id_seccion
ORDER BY idv
;;
DELIMITER ;



