<?php
class Notas
{
    // conexion de base de datos y tabla productos
    private $conn;

    public $titulo;
    public $fecha;
    public $hora;
    public $ubicacion;
    public $correo;
    public $repetir;
    public $tiemporep;
    public $actividad;

    // constructor con $db como conexion a base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }


    function leer()
    {
        // query para seleccionar todos
        $query = "CALL sp_mostrar_nota()";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        // ejecutar query
        $stmt->execute();
        return $stmt;
    }

    function leer_hoy()
    {
        // query para seleccionar todos
        $query = "CALL sp_notas_hoy()";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        // ejecutar query
        $stmt->execute();
        return $stmt;
    }

    function borrar($id)
    {
        // query para seleccionar todos
        $query = "CALL sp_eliminar_nota(?)";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        // ejecutar query
        $stmt->execute();
        return $stmt;
    }

    function filtrar($dato, $campo)
    {
        // query para seleccionar todos
        $query = "CALL sp_mostrar_por_filtro(?, ?)";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dato);
        $stmt->bindParam(2, $campo);
        // ejecutar query
        $stmt->execute();
        return $stmt;
    }



    // crear producto
    function crear($titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiemporep, $actividad)
    {
        // query para seleccionar todos
        $query = "CALL sp_crear_nota(?, ?, ?, ?, ?, ?, ?, ?)";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, htmlspecialchars($this->titulo));
        $stmt->bindParam(2, htmlspecialchars($this->fecha));
        $stmt->bindParam(3, htmlspecialchars($this->hora));
        $stmt->bindParam(4, htmlspecialchars($this->ubicacion));
        $stmt->bindParam(5, htmlspecialchars($this->correo));
        $stmt->bindParam(6, htmlspecialchars($this->repetir));
        $stmt->bindParam(7, $this->tiemporep, PDO::PARAM_STR);
        $stmt->bindParam(8, htmlspecialchars($this->actividad));

        // ejecutar query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function actividades()
    {
        // query para seleccionar todos
        $query = "CALL sp_mostrar_actividades()";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        // ejecutar query
        $stmt->execute();
        return $stmt;
    }

    function leer_uno($id)
    {
        // query para seleccionar todos
        $query = "CALL sp_mostrar_por_id(?)";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        // ejecutar query
        $stmt->bindParam(1, htmlspecialchars($id));
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        $data = array(
            "id" => $row["id"],
            "titulo" => $row["titulo"],
            "fecha" => $row["fecha"],
            "hora" => $row["hora"],
            "ubicacion" => $row["ubicacion"],
            "repetir" => $row["repetir"],
            "correo" => $row["correo"],
            "tiempo_repetir_hora" => $row["tiempo_repetir_hora"],
            "descripcion" => $row["descripcion"]
        );

        return $data;
    }



    function actualizar($id)
    {
        // query para seleccionar todos
        $query = "CALL sp_actualizar_nota(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // sentencia para preparar query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, htmlspecialchars($id));
        $stmt->bindParam(2, htmlspecialchars($this->titulo));
        $stmt->bindParam(3, htmlspecialchars($this->fecha));
        $stmt->bindParam(4, htmlspecialchars($this->hora));
        $stmt->bindParam(5, htmlspecialchars($this->ubicacion));
        $stmt->bindParam(6, htmlspecialchars($this->correo));
        $stmt->bindParam(7, htmlspecialchars($this->repetir));
        $stmt->bindParam(8, $this->tiemporep, PDO::PARAM_STR);
        $stmt->bindParam(9, htmlspecialchars($this->actividad));

        // ejecutar query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // utilizado al completar el formulario de actualización del producto
    function readOne()
    {
        // consulta para leer un solo registro
        $query = "SELECT c.nombre as categoria_desc, p.id, p.nombre, p.descripcion, p.precio, p.categoria_id, p.creado FROM
         " . $this->nombre_tabla . " p
            LEFT JOIN
            categorias c
            ON p.categoria_id = c.id
            WHERE
            p.id = ?
            LIMIT 0,1";
        // preparar declaración de consulta
        $stmt = $this->conn->prepare($query);
        // ID de enlace del producto a actualizar
        $stmt->bindParam(1, $this->id);
        // ejecutar consulta
        $stmt->execute();
        // obtener fila recuperada
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // establecer valores a las propiedades del objeto
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->descripcion = $row['descripcion'];
        $this->categoria_id = $row['categoria_id'];
        $this->categoria_desc = $row['categoria_desc'];
    }
}
