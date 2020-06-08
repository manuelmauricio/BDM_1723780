USE portaldb;

DROP TABLE IF EXISTS  datadictionary;
CREATE TABLE datadictionary (
  id_dd int(3) unsigned NOT NULL AUTO_INCREMENT,
  tabla varchar(70) ,
  nombre varchar(70) ,
  tipo_de_dato varchar(70) ,
  restricciones varchar(70) ,
  valor_default varchar(70) ,
  acepta_nulos varchar(70) ,
  longitud  varchar(70) ,
  descripcion varchar(70) ,
  PRIMARY KEY (id_dd)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

select id_dd,tabla,nombre,tipo_de_dato,restricciones,valor_default,acepta_nulos,longitud,descripcion from datadictionary;

DROP PROCEDURE IF EXISTS `sp_datadictionary`;
delimiter #
CREATE PROCEDURE `sp_datadictionary` (
)
BEGIN

select tabla,nombre,tipo_de_dato,restricciones,valor_default,acepta_nulos,longitud,descripcion from datadictionary;

 
END#

