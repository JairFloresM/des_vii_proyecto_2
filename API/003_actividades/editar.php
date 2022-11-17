<?php

//encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// incluir archivos de conexion y objetos
include_once('../001_configuracion/conexion.php');
include_once('../002_objetos/notas.php');

// inicializar base de datos y objeto producto
$conex = new Conexion();
$db = $conex->obtenerConexion();


// inicializar objeto
$Notas = new Notas($db);
$id = isset($_GET['id']) ? $_GET['id'] : die();
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : die();
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : die();
$hora = isset($_GET['hora']) ? $_GET['hora'] : die();
$ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : die();
$correo = isset($_GET['correo']) ? $_GET['correo'] : die();
$repetir = isset($_GET['repetir$repetir']) ? $_GET['repetir$repetir'] : die();
$tiem_repetir = isset($_GET['tiem_repetir']) ? $_GET['tiem_repetir'] : die();
$actividad = isset($_GET['actividad']) ? $_GET['actividad'] : die();

if ($Notas->editar($id,$titulo,$fecha,$hora,$ubicacion,$correo,$repetir,$tiem_repetir,$actividad)) {
    http_response_code(200);
    echo json_encode(array("message" => "se actualizo la nota"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "no se actualizo la nota"));
}
