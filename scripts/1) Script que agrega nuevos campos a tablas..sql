/*Agrega el campo de observación al detalle */
ALTER TABLE fve_ped_det add column ped_det_obs VARCHAR(21844);

/*Agrega valores por default*/
UPDATE fve_ped_det set ped_det_obs = '' where ped_enc_id <> '1';


/*NUEVOS CAMPOS EN TABLA ENCABEZADO*/
/*Agrega el medio de pago*/
ALTER TABLE fve_ped_enc ADD COLUMN ped_med_pag VARCHAR(15);
/*Agrega el dia de entrega*/
ALTER TABLE fve_ped_enc ADD COLUMN ped_dia_ent VARCHAR(15);

/*Agrega un campo en limpio para todo mundo */
UPDATE fve_ped_enc set ped_med_pag = '' WHERE ped_enc_id <> '1';
UPDATE fve_ped_enc set ped_dia_ent = '' WHERE ped_enc_id <> '1';