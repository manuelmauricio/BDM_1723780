USE portaldb;
DROP PROCEDURE IF EXISTS `sp_deleteuser`;
delimiter #
CREATE PROCEDURE `sp_deleteuser` (
 idp int(10),
 paswordpp varchar (40)
)
BEGIN

IF EXISTS(SELECT id_usuario FROM usuario WHERE contraseña = paswordpp
AND activo = 1)
THEN
UPDATE `usuario` 
      SET
	activo = 0
WHERE id_usuario = idp;
  SELECT 1 as resultdelate;
ELSE
  SELECT 0 as resultdelate;
END IF;

END#
