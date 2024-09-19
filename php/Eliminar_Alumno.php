<?php
// Conexión a la base de datos
include "../mysql/conexion.php";

// Obtener el ID del usuario desde la URL
$Id_Alumno = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($Id_Alumno > 0) {
    // Insertar el ID eliminado en la tabla ids_disponibles
    $sql_insert = "INSERT INTO ids_disponibles (Id_Alumno) VALUES ($Id_Alumno)";
    $conexion->query($sql_insert);

    // Ejecutar la eliminación del usuario
    $sql_delete = "DELETE FROM Alumnos WHERE Id_Alumno = $Id_Alumno";
    if ($conexion->query($sql_delete) === TRUE) {
        echo "<script>alert('Alumno eliminado exitosamente.'); window.location.href='../index.php';</script>";
    } else {
        echo "Error al eliminar el Alumno: " . $conexion->error;
    }
} else {
    echo "ID de Alumno no válido.";
}

// Cerrar la conexión
$conexion->close();
?>