USE `verfruta_application`;
DROP procedure IF EXISTS `ObtenerParametro`;

DELIMITER $$
USE `verfruta_application`$$
CREATE PROCEDURE `ObtenerParametro` (pvcParam_Id varchar(15))
BEGIN
	/*Selecciona de parametros el valor*/
    SELECT param_val
      FROM fve_params
	 WHERE param_id = pvcParam_Id;
END$$

DELIMITER ;