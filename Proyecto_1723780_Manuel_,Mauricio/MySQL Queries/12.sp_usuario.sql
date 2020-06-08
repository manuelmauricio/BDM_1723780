USE portaldb;
DROP PROCEDURE IF EXISTS `sp_usuario`;
delimiter #
CREATE PROCEDURE `sp_usuario` (
 opc varchar (1),
 idp int(10),
 nombresp  varchar(70),
 apellidosp  varchar(70),
 correop  varchar(70),
 usernamep  varchar(30),
 contraseñap  varchar(30),
 telefonop int,
 profesionp  varchar(30),
 foto_perfilp mediumblob,
 extfotop  varchar(20),
 rol_usuariop int(3)
)
BEGIN

 IF opc = "I" THEN 
INSERT INTO `usuario` (nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario)
VALUES(nombresp, apellidosp, correop, usernamep ,contraseñap, telefonop ,profesionp ,foto_perfilp ,extfotop ,rol_usuariop);
 END IF;

END#

