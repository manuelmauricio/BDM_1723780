USE portaldb;
DROP PROCEDURE IF EXISTS `sp_reportero`;
delimiter #
CREATE PROCEDURE `sp_reportero` (
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

  IF opc = "R" THEN 
 select id_usuario, nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario from usuario
 WHERE activo = 1
 AND rol_usuario = 2 ;
 END IF;

 IF opc = "S" THEN 
 select nombres, apellidos, correo, username ,contraseña, telefono, profesion, foto_perfil, extfoto , rol_usuario from usuario
 WHERE activo = 1 
 AND id_usuario = idp;
 END IF;  
 
IF opc = "D" THEN 
UPDATE `usuario` 
SET activo = 0
WHERE id_usuario = idp;
END IF;

END#

