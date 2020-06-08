DROP DATABASE IF EXISTS  portaldb;

CREATE DATABASE portaldb;
USE portaldb;

DROP TABLE IF EXISTS  `rol`;
CREATE TABLE `rol` (
  `id_rol` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `rol` (`nombre_rol`) VALUES("Usuario");
INSERT INTO `rol` (`nombre_rol`) VALUES("Reportero");
INSERT INTO `rol` (`nombre_rol`) VALUES("Admin");


DROP TABLE IF EXISTS  `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(70) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL UNIQUE,
  `contraseña` varchar(30) NOT NULL,
  `telefono` int,
  `profesion` varchar(70) DEFAULT 'usuario común',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `foto_perfil` mediumblob NOT NULL,
   `extfoto` varchar(20) DEFAULT NULL,
  `rol_usuario` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario`),
  FOREIGN KEY(`rol_usuario`) 
  REFERENCES rol(id_rol)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `usuario` (nombres, apellidos, correo, username ,contraseña, telefono, profesion, rol_usuario)
VALUES('Manuel Alejandro', 'Mauricio', 'admin@hotmail.com', 'adminmain' ,'adminmain', 123 ,'admin' ,3);


DROP TABLE IF EXISTS  `seccion`;
CREATE TABLE `seccion` (
  `id_seccion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_seccion` varchar(30) NOT NULL,
  `indice` int(10) unsigned NOT NULL,
  `color` varchar(8) NOT NULL,
  `descripcion` varchar(70) NOT NULL DEFAULT 'FFFFFF',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
   PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `seccion` (`nombre_seccion`,`indice`,`color`,`descripcion`) VALUES("Internacional", 1 ,  "#6F39BD" ,"Noticias de todas partes del mundo");

DROP TABLE IF EXISTS  `estado`;
CREATE TABLE `estado` (
  `id_estado` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(30) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `estado` (`nombre_estado`) VALUES("En Redacción");
INSERT INTO `estado` (`nombre_estado`) VALUES("Terminada");
INSERT INTO `estado` (`nombre_estado`) VALUES("Publicada");

select * from estado

DROP TABLE IF EXISTS  `noticia`;
CREATE TABLE `noticia` (
  `id_noticia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lugar` varchar(100) NOT NULL,
  `fecha` varchar(70),
  `publicacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(70) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `texto`  varchar(2000) NOT NULL,
  `autor` int(10) unsigned NOT NULL,
  `seccion_noticia` int(10) unsigned NOT NULL,
  `estado_noticia` int(3) unsigned NOT NULL,
   `activo` tinyint(1) NOT NULL DEFAULT '1',
   `destacada` tinyint(1) NOT NULL DEFAULT '0',
	`fotothumb` MEDIUMBLOB,
    `extfoto` varchar(20),
   PRIMARY KEY (`id_noticia`),
   FOREIGN KEY(`autor`) 
   REFERENCES usuario(id_usuario),
   FOREIGN KEY(`seccion_noticia`) 
   REFERENCES seccion(id_seccion),
   FOREIGN KEY(`estado_noticia`) 
   REFERENCES estado(id_estado)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `imagen`;
CREATE TABLE `imagen`(
	`id_imagen` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `noticia_id` INT (10) UNSIGNED NOT NULL,
    `foto` MEDIUMBLOB NOT NULL,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
    `extimg` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id_imagen`),
	FOREIGN KEY(`noticia_id`) 
	REFERENCES  noticia(`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`(
	`id_video` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `noticia_id` INT (10) UNSIGNED NOT NULL,
    `ruta` LONGBLOB NOT NULL,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id_video`),
	FOREIGN KEY(`noticia_id`) 
	REFERENCES  noticia(`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario`(
	`id_comentario` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `comentario_texto` varchar(512) NOT NULL,
    `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
	`respuesta_id` INT UNSIGNED,
    `noticia_id` INT (10) UNSIGNED NOT NULL,
    `comentario_autor` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id_comentario`),
	FOREIGN KEY(`noticia_id`) 
	REFERENCES  noticia(`id_noticia`),
	FOREIGN KEY(`comentario_autor`) 
	REFERENCES  usuario(`id_usuario`),
	FOREIGN KEY(`respuesta_id`) 
	REFERENCES  comentario(`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `me_gusta`;
CREATE TABLE `me_gusta`(
	`id_megusta` INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
	`usuario_id` INT UNSIGNED NOT NULL,
    `noticia_id` INT (10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_megusta`),
	FOREIGN KEY(`noticia_id`) 
	REFERENCES  noticia(`id_noticia`),
	FOREIGN KEY(`usuario_id`) 
	REFERENCES  usuario(`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

DROP TABLE IF EXISTS `palabras_clave`;
CREATE TABLE `palabras_clave`(
	`id_palabra` INT UNSIGNED AUTO_INCREMENT NOT NULL,
	`palabra` varchar(30) NOT NULL,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
    `noticia_id` INT (10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_palabra`),
	FOREIGN KEY(`noticia_id`) 
	REFERENCES  noticia(`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1




