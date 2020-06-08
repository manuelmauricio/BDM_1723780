USE portaldb;
DROP PROCEDURE IF EXISTS `sp_registration`;
delimiter #
CREATE PROCEDURE `sp_registration` (
 nombresp  varchar(70),
 apellidosp  varchar(70),
 correop  varchar(70),
 usernamep  varchar(30),
 contraseñap  varchar(30),
 telefonop int,
 foto_perfilp mediumblob,
 extfotop  varchar(20)
)
BEGIN


INSERT INTO `usuario` (nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario)
VALUES(nombresp, apellidosp, correop, usernamep ,contraseñap, telefonop ,'commonuser' ,foto_perfilp ,extfotop ,1);


END#
