USE portaldb;
DROP PROCEDURE IF EXISTS `sp_updateuser`;
delimiter #
CREATE PROCEDURE `sp_updateuser` (
 idp int(10),
 nombresp  varchar(70),
 apellidosp  varchar(70),
 correop  varchar(70),
 usernamep  varchar(30),
 contraseñap  varchar(30),
 telefonop int,
 foto_perfilp mediumblob
)
BEGIN


UPDATE `usuario` 
      SET
      nombres = nombresp,
      apellidos = apellidosp,
      correo = correop,
      username = usernamep,
      contraseña = contraseñap,
      telefono = telefonop,
      foto_perfil = foto_perfilp
	WHERE id_usuario = idp;



 
END#

