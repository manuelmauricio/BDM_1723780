USE portaldb;
DROP PROCEDURE IF EXISTS `sp_relatedwords`;
delimiter #
CREATE PROCEDURE `sp_relatedwords` (
 idnew int
)
BEGIN

select id_palabra, palabra from palabras_clave
where noticia_id = idnew;
 
END#
