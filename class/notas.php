<?php

class Nota
{

    private $url_notas = "http://localhost/laboratorios_dsvii/proyecto_2/API/003_actividades/";

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


    //VAINA DE RANSES

    public function filtar_id($id)
    {
        $instruccion = "CALL sp_mostrar_por_id('" . $id . "')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if ($resultado) {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function editar($id, $titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiemporep, $actividad)
    {
        $instruccion = "CALL sp_actualizar_nota('" . $id . "','" . $titulo . "','" . $fecha . "','" . $hora . "','" . $ubicacion . "','" . $correo . "','" . $repetir . "','" . $tiemporep . "','" . $actividad . "')";

        $actualiza = $this->_db->query($instruccion);


        if ($actualiza) {
            return $actualiza;
            $actualiza->close();
            $this->_db->close();
        }
    }

    public function agregar_nota($titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiemporep, $actividad)
    {
        $instruccion = "CALL sp_crear_nota('" . $titulo . "','" . $fecha . "','" . $hora . "','" . $ubicacion . "','" . $correo . "','" . $repetir . "','" . $tiemporep . "','" . $actividad . "')";


        $actualiza = $this->_db->query($instruccion);


        if ($actualiza) {
            return $actualiza;
            $actualiza->close();
            $this->_db->close();
        }
    }
}
