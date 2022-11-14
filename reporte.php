<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Reporte de Actividades</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <h2 class="centrar-texto">Reporte de actividades</h2>
    <div>
        <a href="index.php" class="boton">Regresar</a>
    </div>

    <?php
    require_once('class/notas.php');
    $obj_notas = new Nota();


    if (array_key_exists('filtrar', $_POST)) {
        $notas = $obj_notas->filtrar_nota($_REQUEST['filtro'], $_REQUEST['opcion']);
    } else {
        $notas = $obj_notas->mostrar_notas();
    }


    ?>

    <form action="reporte.php" method="post" class="formulario-rep">
        Filtrar por
        <select name="filtro" class="filtro">
            <option value="descripcion" selected>Actividad</option>
            <option value="day">Dia</option>
            <option value="week">Semana</option>
            <option value="month">Mes</option>
            <option value="year">Año</option>
        </select>
        con el valor de

        <input type="text" name="opcion" class="opcion">
        <input name="filtrar" value="Filtrar Actividades" type="submit" class="boton">
        <input name="todos" value="Todas las Actividades" type="submit" class="boton">
    </form>

    <table class="tabla">
        <thead>
            <td>Id</td>
            <td>Titulo</td>
            <td>Fecha</td>
            <td>Ubicación</td>
            <td>Correo</td>
            <td>Repetir</td>
            <td>Tiempo de Repeticion</td>
            <td>Actividad</td>
        </thead>

        <tbody>
            <?php foreach ($notas as $nota) { ?>
                <tr>

                    <td> <?= $nota['id'] ?> </td>
                    <td> <?= $nota['titulo'] ?> </td>
                    <td> <?= $nota['fecha'] ?> </td>
                    <td> <?= $nota['ubicacion'] ?> </td>
                    <td> <?= $nota['correo'] ?> </td>
                    <td> <?= $nota['repetir'] ?> </td>
                    <td> <?= $nota['tiempo_repetir_hora'] ?> </td>
                    <td> <?= $nota['descripcion'] ?> </td>
                </tr>
            <?php } ?>


        </tbody>
    </table>


</body>

</html>