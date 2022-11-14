<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
    include("class/actividades.php");
    include("class/notas.php");

    $obj_actividades = new actividad();
    $actividades = $obj_actividades->mostrar_actividades();
    ?>
    <main class="contenedor">
        <h2 class="centrar-texto">Agregar Nota</h2>
        <div>
            <a href="index.php" class="boton">Regresar</a>
        </div>
        <div>
            <form action="agregar.php" method="post" class="formulario">
                <div class="campo">
                Titulo: <input type="text" name="titulo" class="campo_form"><br>
                </div>
                <div class="campo"> 
                    Fecha: <input type="date" name="fecha" class="campo_form"><br>   
                </div>
                <div class="campo">   
                    Hora: <input type="time" name="hora" class="campo_form"><br>
                </div>
                <div class="campo">  
                    Ubicacion: <input type="text" name="ubicacion" class="campo_form"><br>
                </div>
                <div class="campo">     
                    Correo: <input type="email" name="correo" class="campo_form"><br>
                </div>
                <div class="campo">    
                    Repetir: <input type="text" name="repetir" class="campo_form"><br>
                </div>
                <div class="campo">   
                    Tiempo de Repeticion: <input type="time" name="tiem_repetir" class="campo_form"><br>
                </div>
                <div class="campo">     
                    Actividad:
                    <select name="actividad"  class='campo_form'>

                        <?php
                        //lista todas las actividades en la base de datos (si se actualiza la base de datos de actualiza automaticamente)
                        foreach ($actividades as $resultado_a) {
                            print("<option value='" . $resultado_a['id'] . "'>" . $resultado_a['descripcion'] . "</option>");
                        }
                        ?>
                    </select><br>
                </div>
                <div class="campo">    
                    <input type="submit" value="Agregar" name="enviar" class="boton">
                </div>
            </form>
        </div>
        <?php
        //envia los datos a la base de datos
        if (array_key_exists('enviar', $_POST)) {
            $obj_notas = new Nota();
            $obj_notas->agregar_nota($_REQUEST['titulo'], $_REQUEST['fecha'], $_REQUEST['hora'], $_REQUEST['ubicacion'], $_REQUEST['correo'], $_REQUEST['repetir'], $_REQUEST['tiem_repetir'], $_REQUEST['actividad']);
            echo "Se envio correctamente";
        }
        ?>
    </main>
</body>

</html>