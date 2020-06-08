USE portaldb;
DROP PROCEDURE IF EXISTS `sp_datauser`;
delimiter #
CREATE PROCEDURE `sp_datauser` (
 usernamep  varchar(30)
)
BEGIN

select id_usuario, nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario from usuario
 WHERE activo = 1 
 AND username = usernamep;

END#
