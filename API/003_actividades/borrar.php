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

if ($Notas->borrar($id)) {
    http_response_code(200);
    echo json_encode(array("message" => "se borro la nota"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "no se borro la nota"));
}
