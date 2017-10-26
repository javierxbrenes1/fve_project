USE `verfruta_application`;
DROP procedure IF EXISTS `spInicializaDatosPedido`;

DELIMITER //
Create PROCEDURE spInicializaDatosPedido(Nombre varchar(200), Email varchar(200), 
        TelPrin varchar(200), TelSec varchar(200), Direccion varchar(200), Zona int, TotProd double, 
        MontoTotal double, Dia_Entrega varchar(15), Medio_Pago varchar(15))
BEGIN 
    /*Obtiene la fecha actual*/
   set @FechaActual = current_timestamp();
   /*Definir año*/
   SET @Anno = Year(@FechaActual);
   /*Definir mes*/
    SET @Mes = MONTH(@FechaActual);
    /*Define el dia*/
    SET @Dia = Day(@FechaActual);
    /*Obtiene el numero de pedidos */
    SET @countPedido = (SELECT COUNT(*) + 1 FROM fve_ped_enc);
    /*Otiene el total de clientes*/
    SET @Countcli = (SELECT COUNT(*) + 1 FROM fve_cli);
    /*Define el pedido*/
    SET @ped_enc_id = (SELECT CONCAT(@Anno,@Mes,@countPedido) as ped_enc_id);    
    /*Define el id del cliente*/
    SET @cli_id = (SELECT CONCAT(@Anno,@Mes, @Dia, @Countcli));
    /*Realiza los inserts*/
    /*cliente*/
    INSERT INTO fve_cli(cli_id, cli_nombre, cli_email, cli_tel_prm, cli_tel_ext, cli_direccion)
    VALUES(@cli_id, Nombre, Email,  TelPrin , TelSec , Direccion);
    /*Pedido*/
    INSERT INTO fve_ped_enc(ped_enc_id, ped_enc_fecha, ped_enc_tot_prod, ped_enc_mont_tot, cli_id, zon_id, ped_med_pag, ped_dia_ent) 
    values(@ped_enc_id, @FechaActual, TotProd, MontoTotal, @cli_id, Zona, Medio_Pago, Dia_Entrega);
    /*Retorna el pedido*/
    SELECT @ped_enc_id as ped_enc_id;
END