<?php
// Incluir la conexión a la base de datos
include '../modelado/conexion.php';
// Verificar si el formulario ha sido enviado
if ($_POST) {
    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado'];
    $encargado = $_POST['encargado'];
    // Preparar la instrucción SQL para insertar los datos
    $sql = "INSERT INTO tareas (nombre, descripcion, fecha_creacion, fecha_vencimiento, estado, Encargado) 
            VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_vencimiento, :estado, :encargado)";
    // Preparar la consulta
    $stmt = $con->prepare($sql);
    // Vincular los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':encargado', $encargado);
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la inserción es exitosa, redirigir o mostrar un mensaje de éxito
        header("Location: ../vistas/tablas/tareas.php?<p>Tarea guardada correctamente.</p>");
        echo "<p>Tarea guardada correctamente.</p>";
        // O redirigir a otra página
        // header('Location: tarea_guardada.php');
    } else {
        echo "<p>Error al guardar la tarea.</p>";
    }
}
?>
