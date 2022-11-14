<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Notas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>


    <?php
    require_once('class/notas.php');

    $obj_notas = new Nota();
    $notas = 1;
    //$notas = $obj_notas->mostrar_notas();
    $notas = $obj_notas->notas_hoy();
    ?>

    <header>
    </header>

    <main class="main">
        <h1>Actividades Para hoyassdsadsad</h1>

        <div class="nav">
            <a href="agregar.php">Agregar Actividad</a>
            <a href="reporte.php">Reporte de Actividades</a>

        </div>
        <section>
            <section class="actividades">

                <?php
                foreach ($notas as $nota) {

                ?>
                    <div class="card">
                        <div class="card__header">
                            <div class="">
                                <h4> <?= $nota['titulo'] ?> </h4>
                                <p> <?= $nota['descripcion'] ?> </p>
                            </div>
                            <div>
                                <a href="eliminar.php?id=<?= $nota['id'] ?>"><i class="fa-solid ff fa-trash"></i></a>
                                <a href="editar.php?id=<?= $nota['id'] ?>"><i class="fa-solid ff fa-pen-to-square"></i></a>
                                <i class="fa-solid dd fa-chevron-up"></i>
                            </div>
                        </div>
                        <div class="section card_ocultar">
                            <div class="card__body">

                            </div>
                            <div class="card__footer">
                                <div class="fecha">
                                    <i class="fa-solid fa-calendar-days"></i>

                                    <?= $nota['fecha'] ?>
                                </div>
                                <div class="hora">
                                    <i class="fa-solid fa-timer"></i>

                                    <?= $nota['hora'] ?>
                                </div>
                                <div class="lugar">
                                    <i class="fa-solid fa-location-dot"></i>

                                    <?= $nota['ubicacion'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
            <section class="proximas_actividades">

            </section>

    </main>

    <footer>

    </footer>

    <script src="js/index.js"></script>
</body>

</html>