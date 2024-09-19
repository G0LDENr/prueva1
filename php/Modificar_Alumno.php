<?php
// Conexión a la base de datos
include "../mysql/conexion.php";

// Obtener el ID del usuario desde la URL
$id_Alumno = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error_msg = ''; // Variable para almacenar el mensaje de error

// Verificar si el ID es válido
if ($id_Alumno > 0) {
    // Consultar los datos del usuario
    $sql = $conexion->query("SELECT * FROM Alumnos WHERE Id_Alumno = $id_Alumno");
    if ($sql->num_rows > 0) {
        $datos = $sql->fetch_object();
    } else {
        die("Alumno no encontrado.");
    }
} else {
    die("ID Alumno.");
}

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $Foto = $conexion->real_escape_string($_POST['Foto']);
    $Nombre = $conexion->real_escape_string($_POST['Nommbre']);
    $Fecha_N = $conexion->real_escape_string($_POST['Fecha_N']);

    // Actualizar los datos en la tabla usuarios sin modificar la contraseña
    $update_sql = "UPDATE Alumnos SET Foto='$Foto', Nombre='$Nombre', Fecha_N='$Fecha_N' WHERE Id_Alumno='$id_Alumno'";

    if ($conexion->query($update_sql) === TRUE) {
        echo "Datos actualizados exitosamente";
        header("Location: ../index.php"); // Redirigir a la lista de Administradores
        exit();
    } else {
        $error_msg = "Error al actualizar los datos: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
    <link rel="stylesheet" href="../css/ModiAlu.css">
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="../img/Avatar_Usuario.png" alt="Imagen descriptiva">
    </div>

    <div class="register-container">
        <h2>Modificar Alumno</h2>
        <form method="POST">
            <input type="hidden" name="id_Alummno" value="<?= $datos->Id_Alumno ?>">
            <input type="file" name="Foto" placeholder="Foto" value="<?= htmlspecialchars($datos->Foto) ?>" required>
            <input type="text" name="Nombre" placeholder="Nombre Nuevo" value="<?= htmlspecialchars($datos->Nombre) ?>" required>
            <input type="date" name="Fecha_N" placeholder="Nueva Fecha de Nacimiento" value="<?= htmlspecialchars($datos->Fecha_N) ?>" required>
            <input type="submit" name="Actualizar" value="Modificar Datos">
            
        </form>
        <p><a href="../index.php">Cancelar</a></p>
    </div>
</div>

</body>
</html>