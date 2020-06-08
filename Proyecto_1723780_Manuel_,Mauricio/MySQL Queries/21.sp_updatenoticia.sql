USE portaldb;
DROP PROCEDURE IF EXISTS `sp_updatenoticia`;
delimiter #
CREATE PROCEDURE `sp_updatenoticia` (
 pid int(10),
 ptitulo varchar(70),
 pdescripcion varchar(70),
 lugarp varchar(70),
 fechap varchar(70),
 seccionp int,
 textop varchar(700),
 destacadap int,
 fotop mediumblob
)
BEGIN


UPDATE `noticia` 
      SET 
      titulo = ptitulo,
      descripcion = pdescripcion,
      lugar = lugarp,
      fecha = fechap,
      seccion_noticia = seccionp,
      texto = textop,
      destacada = destacadap,
      fotothumb = fotop
	WHERE id_noticia = pid;

END#






