<?php

class Nota
{

    private $url_notas = "http://localhost/desarrollovii/des_vii_proyecto_2/API/003_actividades/";

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

    public function filtar_id($id){
        $ruta=$this->url_notas.'filtrar_id.php?id='. $id;
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;
    }

    public function editar($id, $titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiem_repetir, $actividad){

        $ruta=$this->url_notas.'editar.php?id='. $id .'&titulo='.$titulo.'&fecha='.$fecha.'&hora='.$hora.'&ubicacion='.$ubicacion.'&correo='.$correo.'&repetir='.$repetir.'&tiem_repetir='.$tiem_repetir.'&actividad'.$actividad;
        $data = json_decode(file_get_contents($ruta), true);
        $result = $data["records"];
        return $result;

        
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
