USE portaldb;
DROP PROCEDURE IF EXISTS `sp_showcomments`;
delimiter #
CREATE PROCEDURE `sp_showcomments` (
newid int(10)
)
BEGIN

select id_comentariov, textov, fechav, activov, noticiaidv, autoridv, autornv, perfilv from v_comment
where newid = noticiaidv
ORDER BY id_comentariov DESC;

 
END#
