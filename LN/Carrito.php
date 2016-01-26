<?php
session_start();
class Carrito
{
 
	//aquí guardamos el contenido del carrito
	private $carrito = array();
 
	//seteamos el carrito exista o no exista en el constructor
	public function __construct()
	{
		
		if(!isset($_SESSION["carrito"]))
		{
			$_SESSION["carrito"] = null;
			$this->carrito["precio_total"] = 0;
			$this->carrito["articulos_total"] = 0;
		}
		$this->carrito = $_SESSION['carrito'];
	}
 
	//añadimos un producto al carrito
	public function add($articulo = array())
	{
		
                //nuestro carro necesita siempre un id producto, cantidad y precio articulo
		if((!is_array($articulo) || empty($articulo))||(!$articulo["id"] || !$articulo["cantidad"])||(!is_numeric($articulo["id"]) || !is_numeric($articulo["cantidad"])))
		{
				
		}else{
                    //debemos crear un identificador único para cada producto
                    $unique_id = md5($articulo["id"]);

                    //creamos la id única para el producto
                    $articulo["unique_id"] = $unique_id;

                    //si no está vacío el carrito lo recorremos 
                    if(!empty($this->carrito))
                    {
                            foreach ($this->carrito as $row) 
                            {
                                    if($row["unique_id"] === $unique_id)
                                    {
                                            //si modifica la cantidad
                                            $articulo["cantidad"] = $articulo["cantidad"];
                                    }
                            }
                    }
                    //evitamos que nos pongan números negativos y que sólo sean números para cantidad y precio
                    $articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
                    //primero debemos eliminar el producto si es que estaba en el carrito
                    $this->unset_producto($unique_id);
                    ///ahora añadimos el producto al carrito
                    $_SESSION["carrito"][$unique_id] = $articulo;
                    //actualizamos el carrito
                    $this->update_carrito();
                }
	}
 
        //método que retorna el precio total del carrito
	public function precio_total()
	{
            $vloCarrito = $this->carrito;
            $vloMontoTotalCarrito = 0;
            foreach ($vloCarrito as $vloProducto)
            {
                $vloMontoTotalCarrito +=($vloProducto['precio'] * $vloProducto['cantidad']);
            }
		return $vloMontoTotalCarrito;
	}
 
	//método que retorna el número de artículos del carrito
	public function articulos_total()
	{
		return count($this->carrito);//$this->carrito["articulos_total"] ? $this->carrito["articulos_total"] : 0;
	}
 
	//este método retorna el contenido del carrito
	public function get_content()
	{
		//asignamos el carrito a una variable
		$carrito = $this->carrito;
		//debemos eliminar del carrito el número de artículos
		//y el precio total para poder mostrar bien los artículos
		//ya que estos datos los devuelven los métodos 
		//articulos_total y precio_total
		unset($carrito["articulos_total"]);
		unset($carrito["precio_total"]);
		return $carrito == null ? null : $carrito;
	}
 
        
	//método que llamamos al insertar un nuevo producto al 
	//carrito para eliminarlo si existia, así podemos insertarlo
	//de nuevo pero actualizado
	private function unset_producto($unique_id)
	{
		unset($_SESSION["carrito"][$unique_id]);
	}
 
	//para eliminar un producto debemos pasar la clave única
	//que contiene cada uno de ellos
	public function remove_producto($unique_id)
	{
		//si no existe el carrito
		if($this->carrito === null)
		{
			throw new Exception("El carrito no existe!", 1);
		}
 
		//si no existe la id única del producto en el carrito
		if(!isset($this->carrito[$unique_id]))
		{
			throw new Exception("La unique_id $unique_id no existe!", 1);
		}
 
		//en otro caso, eliminamos el producto, actualizamos el carrito y 
		//el precio y cantidad totales del carrito
		unset($_SESSION["carrito"][$unique_id]);
		$this->update_carrito();
		
		return true;
	}
 
	//eliminamos el contenido del carrito por completo
	public function destroy()
	{
		unset($_SESSION["carrito"]);
		$this->carrito = null;
		return true;
	}
 
	//actualizamos el contenido del carrito
	public function update_carrito()
	{
		self::__construct();
	}
 
}

