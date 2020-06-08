USE portaldb;
DROP FUNCTION IF EXISTS `f_login`;
DELIMITER ;;
CREATE FUNCTION `f_login`(usernamef varchar(50), contraseñaf varchar(50)) 
 RETURNS BOOL
NOT DETERMINISTIC
READS SQL DATA
BEGIN
RETURN EXISTS ((select username from `usuario` where username = usernamef and contraseña  = contraseñaf ));
END 
;;
DELIMITER ;

