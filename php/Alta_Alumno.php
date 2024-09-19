<?php
// Conexión a la base de datos
include "../mysql/conexion.php";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $Foto = $conexion->real_escape_string($_POST['Foto']);
    $Nombre = $conexion->real_escape_string($_POST['Nombre']);
    $Fecha_N = $conexion->real_escape_string($_POST['Fecha_N']);

    // Obtener el ID disponible de la tabla ids_disponibles
    $result = $conexion->query("SELECT Id_Alumno FROM ids_disponibles LIMIT 1");
    if ($result->num_rows > 0) {
        $id_disponible = $result->fetch_object()->Id_Alumno;
        // Eliminar el ID de la tabla ids_disponibles
        $conexion->query("DELETE FROM ids_disponibles WHERE Id_Alumno = $id_disponible");
    } else {
        // Obtener el ID más bajo disponible de la tabla usuarios
        $result = $conexion->query("SELECT IFNULL(MAX(Id_Alumno) + 1, 1) AS id_disponible FROM Alumnos");
        $id_disponible = $result->fetch_object()->id_disponible;
    }

    // Insertar los datos en la tabla usuarios con el ID disponible
    $sql = "INSERT INTO Alumnos (Id_Alumno, Foto, Nombre, Fecha_N) 
            VALUES ('$id_disponible', '$Foto', '$Nombre', '$Fecha_N')";

    if ($conexion->query($sql) === TRUE) {
        // Redirigir al usuario a la página de inicio de sesión
        header("Location: ../index.php");
        exit(); // Asegura que no se siga ejecutando el script después de la redirección
    } else {
        echo "Error al registrar el Alumno: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
