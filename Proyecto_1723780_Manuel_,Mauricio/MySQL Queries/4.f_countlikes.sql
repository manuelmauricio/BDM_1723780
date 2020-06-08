USE portaldb;
DROP FUNCTION IF EXISTS `f_countlikes`;
DELIMITER ;;
CREATE FUNCTION `f_countlikes`(notid int(1)) RETURNS int DETERMINISTIC
BEGIN
 DECLARE counted int;
SET counted = (SELECT COUNT(*) FROM me_gusta where noticia_id = notid);
  RETURN counted;
END 
;;
DELIMITER ;
