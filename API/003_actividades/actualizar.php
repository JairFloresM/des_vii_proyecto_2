<?php
// encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");

// incluir archivos de conexion y objetos
include_once('../001_configuracion/conexion.php');
include_once('../002_objetos/notas.php');

// inicializar base de datos y objeto producto
$conex = new Conexion();
$db = $conex->obtenerConexion();

$id = isset($_GET['id']) ? $_GET['id'] : die();

// inicializar objeto
$Notas = new Notas($db);

$data = json_decode(file_get_contents("php://input"));
// asegurar que los datos no esten vacios

if (
    !empty($data->titulo) &&
    !empty($data->fecha) &&
    !empty($data->hora) &&
    !empty($data->correo) &&
    !empty($data->tiem_repetir) &&
    !empty($data->ubicacion) &&
    !empty($data->actividad)
) {

    $Notas->titulo = $data->titulo;
    $Notas->fecha = $data->fecha;
    $Notas->hora = $data->hora;
    $Notas->correo = $data->correo;
    $Notas->repetir = $data->repetir;
    $Notas->tiem_repetir = $data->tiem_repetir;
    $Notas->ubicacion = $data->ubicacion;
    $Notas->actividad = $data->actividad;

    // crear el producto
    if ($Notas->actualizar($id)) {
        // asignar codigo de respuesta - 201 creado
        http_response_code(201);
        // informar al usuario
        echo json_encode(array("message" => "La nota se ha actualizado."));
    }
    // si no puede crear el producto, informar al usuario
    else {

        // asignar codigo de respuesta - 503 servicio no disponible
        http_response_code(503);
        // informar al usuario
        echo json_encode(array("message" => "No se pudo actualizar la nota."));
    }
    echo "3";
}
// informar al usuario que los datos estan incompletos
else {
    // asignar codigo de respuesta - 400 solicitud incorrecta
    http_response_code(400);
    // informar al usuario
    echo json_encode(array("message" => "No se pudo actualizar la nota"));
}
