<?php

class Nota
{

    private $url_notas = "http://localhost/laboratorios_dsvii/proyecto_2/API/003_actividades/";
    //private $url_notas = "http://localhost:9090/proyecto_2/API/003_actividades/";

    public function mostrar_notas()
    {
        $ruta = $this->url_notas . 'leer.php';
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;
    }


    public function notas_hoy()
    {
        $ruta = $this->url_notas . 'leer_hoy.php';
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;
    }

    public function eliminar_nota($id)
    {
        $ruta = $this->url_notas . 'borrar.php?id=' . $id;
        json_decode(file_get_contents($ruta), true);
    }

    public function filtrar_nota($dato, $filtro)
    {
        $ruta = $this->url_notas . 'filtrar.php?filtro=' . $filtro . '&opcion=' . $dato;
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;
    }


    public function agregar_nota($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_URL, $this->url_notas . 'crear.php');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $resultado = curl_exec($ch);
    }

    public function mostrar_actividades()
    {
        $ruta = $this->url_notas . 'actividades.php';
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;
    }



    public function filtar_id($id)
    {
        $ruta = $this->url_notas . 'leer_uno.php?id=' . $id;
        $data = json_decode(file_get_contents($ruta), true);
        return $data;
    }

    public function editar($data, $id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_URL, $this->url_notas . 'actualizar.php?id=' . $id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $resultado = curl_exec($ch);
    }
}
