USE portaldb;
DROP PROCEDURE IF EXISTS `sp_login`;
delimiter #
CREATE PROCEDURE `sp_login` (
 varname varchar (50),
 varpass varchar(50)
)
BEGIN
 SELECT f_login (varname, varpass) as loginvar;
END#



