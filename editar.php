<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <main class="contenedor">
        <?php
        $actividad;
        //clase nota
        include_once('class/notas.php');
        $obj_filtrar = new nota();
        $obj_notas = new nota();

        //clase actividades
        $obj_actividades = new Nota();
        $actividades = $obj_actividades->mostrar_actividades();
        if (array_key_exists('enviar', $_POST)) {

            $arr = array(
                "titulo" => $_REQUEST['titulo'],
                "fecha" => $_REQUEST['fecha'],
                "hora" => $_REQUEST['hora'],
                "ubicacion" => $_REQUEST['ubicacion'],
                "correo" => $_REQUEST['correo'],
                "repetir" => $_REQUEST['repetir'],
                "tiem_repetir" => $_REQUEST['tiem_repetir'],
                "actividad" => $_REQUEST['actividad']
            );


            $obj_notas->editar(json_encode($arr), $_REQUEST['id']);
            print("<h2 class='centrar-texto'>Editar Nota</h2>");
        ?>
            <div class="reg">
                <a href="index.php" class="boton">Regresar</a>
            </div>
            <h3 class='centrar-texto'>Se actualizo correctamente</h3>
        <?php
        } else {
            $id = $_GET['id'];
            $resultado = $obj_filtrar->filtar_id($id);
            $titulo = $resultado['titulo'];
            $fecha = $resultado['fecha'];
            $hora = $resultado['hora'];
            $ubicacion = $resultado['ubicacion'];
            $correo = $resultado['correo'];
            $repetir = $resultado['repetir'];
            $tiemp_rep = $resultado['tiempo_repetir_hora'];
            $actividad = $resultado['id_actividad'];
        ?>

            <h2 class="centrar-texto">Editar Nota</h2>

            <div>
                <a href="index.php" class="boton">Regresar</a>
            </div>
            <form action="editar.php" method="post" class="formulario">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="campo">
                    Titulo: <input type="text" name="titulo" class="campo_form" value="<?php echo $titulo ?>"><br>
                </div>
                <div class="campo">
                    Fecha: <input type="text" name="fecha" class="campo_form" value=" <?php echo $fecha ?>"><br>
                </div>
                <div class="campo">
                    Hora: <input type="time" name="hora" class="campo_form" value="<?php echo $hora ?>"><br>
                </div>
                <div class="campo">
                    Ubicacion: <input type="text" name="ubicacion" class="campo_form" value="<?php echo $ubicacion ?>"><br>
                </div>
                <div class="campo">
                    Correo: <input type="email" name="correo" class="campo_form" value="<?php echo $correo ?>"><br>
                </div>
                <div class="campo">
                    Repetir: <input type="text" name="repetir" class="campo_form" value="<?php echo $repetir ?>"><br>
                </div>
                <div class="campo">
                    Tiempo de Repeticion: <input type="time" name="tiem_repetir" class="campo_form" value="<?php echo $tiemp_rep ?>"><br>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="campo">
                    Actividad:
                    <select name="actividad" class='campo_form'>

                        <?php
                        //lista todas las actividades en la base de datos (si se actualiza la base de datos de actualiza automaticamente)
                        foreach ($actividades as $resultado_a) {
                            print("<option value='" . $resultado_a['id'] . "'>" . $resultado_a['descripcion'] . "</option>");
                        }
                        ?>
                    </select><br>
                </div>
                <div class="campo">
                    <input type="submit" value="Actualizar" name="enviar" class="boton">
                </div>
            </form>
    </main>
<?php
        }
?>

</body>

</html>