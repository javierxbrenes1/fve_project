select * from verfruta_Application.fve_cat_param;


insert into verfruta_Application.fve_cat_param
values ('SMTP','Servidor SMTP');


insert into verfruta_Application.fve_cat_param
values ('PORT_SMTP','Puerto del Servidor SMTP');


insert into verfruta_Application.fve_cat_param
values ('SMTP_SEG','Seguridad en el servidor SMTP');


insert into verfruta_Application.fve_cat_param
values ('CORREO_SALIENTE','Correo de salida');


insert into verfruta_Application.fve_cat_param
values ('PWD_CORREO','Contraseña del correo de salida');

insert into verfruta_Application.fve_cat_param
values ('REM_CORRES','correos a los que se enviará el mail de forma oculta');


delete from verfruta_Application.fve_cat_param where param_id in ('REM_CORR','REM_CORREOS')
