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

$id = isset($_GET['id']) ? $_GET['id'] : die();

// inicializar objeto
$Notas = new Notas($db);

// query productos
$data = $Notas->leer_uno($id);

if (!empty($data)) {
    http_response_code(200);
    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron Notas.")
    );
}
