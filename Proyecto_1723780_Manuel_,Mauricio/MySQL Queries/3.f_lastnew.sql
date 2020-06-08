USE portaldb;

DROP FUNCTION IF EXISTS f_lastnew;
DELIMITER ;;
CREATE FUNCTION `f_lastnew`() RETURNS int DETERMINISTIC
BEGIN
 DECLARE var int;
  SELECT id_noticia INTO var FROM noticia ORDER BY id_noticia DESC LIMIT 1;
  RETURN var;
END 
;;
DELIMITER ;
