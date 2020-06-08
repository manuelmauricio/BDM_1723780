USE portaldb;
DROP PROCEDURE IF EXISTS `sp_countlikes`;
delimiter #
CREATE PROCEDURE `sp_countlikes` (
notid int(10)
)
BEGIN

SELECT `f_countlikes`(notid) as contador;


END#
