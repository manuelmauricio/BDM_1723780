USE portaldb;
DROP PROCEDURE IF EXISTS `sp_administrador`;
delimiter #
CREATE PROCEDURE `sp_administrador` (
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

  IF opc = "A" THEN 
 select nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario from usuario
 WHERE activo = 1
 AND rol_usuario = 3 ;
 END IF;

END#

