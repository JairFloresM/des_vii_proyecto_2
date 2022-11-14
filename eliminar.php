<?php

include_once('class/notas.php');

$id = $_GET['id'];

$nota = new Nota();
$resp = $nota->eliminar_nota($id);

header('Location: index.php');
