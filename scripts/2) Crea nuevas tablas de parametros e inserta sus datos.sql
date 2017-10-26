/*CREA TABLAS DE  CATALOS DE PARAMETROS */
CREATE TABLE `verfruta_application`.`fve_cat_param` (
  `param_id` VARCHAR(15) NOT NULL,
  `param_desc` VARCHAR(45) NULL,
  PRIMARY KEY (`param_id`));


/*CREA LA TABLA DE PARAMETROS DEL SISTEMA*/
CREATE TABLE `verfruta_application`.`fve_params` (
  `param_id` VARCHAR(15) NOT NULL,
  `param_val` VARCHAR(5000) NULL,
  INDEX `param_id_idx` (`param_id` ASC),
  CONSTRAINT `param_id`
    FOREIGN KEY (`param_id`)
    REFERENCES `verfruta_application`.`fve_cat_param` (`param_id`)
);