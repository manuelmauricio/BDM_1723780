USE portaldb;
DROP PROCEDURE IF EXISTS `sp_editnoticia`;
delimiter #
CREATE PROCEDURE `sp_editnoticia` (
 vidnoticia int
)
BEGIN

select id_noticia, titulo, lugar, descripcion, fecha, seccion_noticia, texto, destacada, fotothumb from noticia
where id_noticia = vidnoticia;
 
END#
