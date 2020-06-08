USE portaldb;
DROP PROCEDURE IF EXISTS `sp_gallery`;
delimiter #
CREATE PROCEDURE `sp_gallery` (
 idnew int
)
BEGIN

select id_imagen, foto from imagen
where noticia_id = idnew
ORDER BY id_imagen;
 
END#
