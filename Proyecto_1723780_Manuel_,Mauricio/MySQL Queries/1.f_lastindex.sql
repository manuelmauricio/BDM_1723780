USE portaldb;
DROP FUNCTION IF EXISTS `f_lastindex`;
DELIMITER ;;
CREATE FUNCTION `f_lastindex`() RETURNS int DETERMINISTIC
BEGIN
 DECLARE var int;
  SELECT indice FROM seccion ORDER BY indice DESC LIMIT 1 into var;
  RETURN var + 1;
END 
;;
DELIMITER ;
