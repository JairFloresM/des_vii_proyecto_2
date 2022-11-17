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

// query productos
$stmt = $Notas->actividades();
$num = $stmt->rowCount();

if ($num > 0) {

    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            "id" => $id,
            "descripcion" => html_entity_decode($descripcion)
        );
        array_push($products_arr["records"], $product_item);
    }
    http_response_code(200);
    echo json_encode($products_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron las actividades.")
    );
}
