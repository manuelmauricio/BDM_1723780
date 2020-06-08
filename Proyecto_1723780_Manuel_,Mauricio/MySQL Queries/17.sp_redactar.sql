USE portaldb;
DROP PROCEDURE IF EXISTS `sp_redactar`;
delimiter #
CREATE PROCEDURE `sp_redactar` (
 lugarp  varchar(100),
 fechap  varchar(70),
 titulop  varchar(70),
 descripcionp  varchar(70),
 textop  varchar(700),
 autorp int,
 seccionp int,
 destacadap int,
  pfoto1 mediumblob,
  extfoto1p  varchar(20),
  pfoto2 mediumblob,
  extfoto2p  varchar(20),
  pfoto3 mediumblob,
  extfoto3p  varchar(20),
  palabrap varchar(70),
  rutap longblob
)
BEGIN
DECLARE lastint int;

INSERT INTO `noticia` (lugar, fecha, titulo ,descripcion, texto, autor, seccion_noticia, estado_noticia , destacada, fotothumb, extfoto)
VALUES(lugarp, fechap, titulop, descripcionp ,textop, autorp ,seccionp ,1 ,destacadap, pfoto1, extfoto1p);

SELECT f_lastnew () INTO lastint;

INSERT INTO `imagen` (noticia_id, foto, extimg)
VALUES(lastint, pfoto2, extfoto2p);

INSERT INTO `imagen` (noticia_id, foto, extimg)
VALUES(lastint, pfoto3, extfoto3p);

INSERT INTO `palabras_clave` (palabra, noticia_id)
VALUES(palabrap, lastint);

INSERT INTO `video` (ruta, noticia_id)
VALUES(rutap, lastint);


END#
