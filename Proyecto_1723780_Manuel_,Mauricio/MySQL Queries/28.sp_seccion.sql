USE portaldb;
DROP PROCEDURE IF EXISTS `sp_seccion`;
delimiter #
CREATE PROCEDURE `sp_seccion` (
 opc varchar (1),
 pid int(10),
 pnombre varchar(30),
 pindice int(10),
 pcolor varchar(30),
 pdescripcion varchar(70),
 pactivo tinyint(1)
)
BEGIN

 IF opc = "S" THEN 
 select `id_seccion`,`nombre_seccion`,`indice`,`color`,`descripcion`,`activo` from seccion
 WHERE activo = 1 ;
 END IF;
 
  IF opc = "Z" THEN 
 select `id_seccion`,`nombre_seccion`,`indice`,`color`,`descripcion`,`activo` from seccion
	WHERE id_seccion = pid;
 END IF;
 
 IF opc = "I" THEN 
INSERT INTO `seccion` (nombre_seccion, indice, color, descripcion)
VALUES(pnombre, f_lastindex(), CONCAT('#',pcolor), pdescripcion);
 END IF;
 
IF opc = "U" THEN 
UPDATE `seccion` 
      SET nombre_seccion = pnombre,
      indice = pindice,
      color =  CONCAT('#',pcolor),
      descripcion = pdescripcion
	WHERE id_seccion = pid;
END IF;

IF opc = "D" THEN 
UPDATE `seccion` 
      SET activo = 0
	WHERE id_seccion = pid;
END IF;
 
END#






