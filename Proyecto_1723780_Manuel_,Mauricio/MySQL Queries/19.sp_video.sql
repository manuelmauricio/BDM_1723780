USE portaldb;
DROP PROCEDURE IF EXISTS `sp_video`;
delimiter #
CREATE PROCEDURE `sp_video` (
 idnew int
)
BEGIN

select id_video, ruta from video
where noticia_id = idnew;
 
END#
