USE portaldb;
DROP PROCEDURE IF EXISTS `sp_detail`;
delimiter #
CREATE PROCEDURE `sp_detail` (
 idnew int
)
BEGIN

select idv, activov, fechav, titulov, descripcionv, fotov, lugarv, publicacionv, textov, idsv,
seccionv, colorv , idautorv, autorv , correov, profesionv, perfilv from v_detail
where idv = idnew;
 
END#

