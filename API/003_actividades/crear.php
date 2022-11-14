<?php
// encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
// obtener conexion de base de datos
include_once('../configuracion/conexion.php');
// instanciar el objeto producto
include_once('../objetos/productos.php');
$conex = new Conexion();
$db = $conex->obtenerConexion();
$producto = new Producto($db);
// obtener los datos
$data = json_decode(file_get_contents("php://input"));
// asegurar que los datos no esten vacios
if(
 !empty($data->nombre) &&
 !empty($data->precio) &&
 !empty($data->descripcion) &&
 !empty($data->categoria_id)
){
 // asignar valores de propiedad a producto
 $producto->nombre = $data->nombre;
 $producto->precio = $data->precio;
 $producto->descripcion = $data->descripcion;
 $producto->categoria_id = $data->categoria_id;
 $producto->creado = date('Y-m-d H:i:s');

 // crear el producto
 if($producto->crear()){
    // asignar codigo de respuesta - 201 creado
    http_response_code(201);
    // informar al usuario
    echo json_encode(array("message" => "El producto ha sido creado."));
    }
    // si no puede crear el producto, informar al usuario
    else{
    // asignar codigo de respuesta - 503 servicio no disponible
    http_response_code(503);
    // informar al usuario
    echo json_encode(array("message" => "No se puede crear el producto."));
    }
   }
   // informar al usuario que los datos estan incompletos
   else{
    // asignar codigo de respuesta - 400 solicitud incorrecta
    http_response_code(400);
    // informar al usuario
    echo json_encode(array("message" => "No se puede crear el producto. Los datos
   están incompletos."));
   }
