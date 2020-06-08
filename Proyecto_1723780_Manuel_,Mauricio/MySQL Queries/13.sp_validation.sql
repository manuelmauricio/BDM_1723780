USE portaldb;
DROP PROCEDURE IF EXISTS `sp_validation`;
delimiter #
CREATE PROCEDURE `sp_validation` (
usernamepp varchar (40),
paswordpp varchar (40)
)
BEGIN

IF EXISTS(SELECT id_usuario FROM usuario WHERE username = usernamepp
AND contraseña = paswordpp
AND activo = 1)
THEN
   SELECT id_usuario as resultlogin FROM usuario WHERE username = usernamepp;
ELSE
  SELECT 0 as resultlogin;
   END IF;
END#

