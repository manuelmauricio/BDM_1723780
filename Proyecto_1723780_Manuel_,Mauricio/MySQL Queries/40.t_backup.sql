
USE portaldb;


DROP TABLE IF EXISTS `backup_noticias`;
CREATE TABLE `backup_noticias`(
  `id_noticiab` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lugarb` varchar(100) NOT NULL,
  `fechab` varchar(70),
  `publicacionb` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `titulob` varchar(70) NOT NULL,
  `descripcionb` varchar(70) NOT NULL,
   PRIMARY KEY (`id_noticiab`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

drop trigger if exists t_backup
delimiter #
CREATE TRIGGER t_backup AFTER UPDATE ON `noticia`
    FOR EACH ROW
BEGIN
         INSERT INTO `backup_noticias` (lugarb, fechab, publicacionb, titulob, descripcionb)
         VALUES (OLD.lugar, OLD.fecha,OLD.publicacion, OLD.titulo, OLD.descripcion);
END#