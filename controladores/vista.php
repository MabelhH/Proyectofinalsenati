<?php
// Incluir la conexión
include '../modelado/conexion.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tareas WHERE id = '$id'";
    $stmt = $con->prepare($sql);
   // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tarea) {
        die("Tarea no encontrada.");
    }
} else {
    header("Location: /vistas/tablas/tareas.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Tarea</title>
    <link rel="stylesheet" href="/controladores/vista.css">
</head>
<body>
    <div class="table-container">
        <h2>Detalles de la Tarea</h2>
        <table class="task-details">
            <tr><th>Nombre</th><td><?=$tarea['nombre']; ?></td></tr>
            <tr><th>Descripción</th><td><?= $tarea['descripcion']; ?></td></tr>
            <tr><th>Fecha Creación</th><td><?= $tarea['fecha_creacion']; ?></td></tr>
            <tr><th>Fecha Vencimiento</th><td><?= $tarea['fecha_vencimiento']; ?></td></tr>
            <tr><th>Estado</th><td><?= $tarea['estado']; ?></td></tr>
            <tr><th>Encargado</th><td><?= $tarea['Encargado']; ?></td></tr>
        </table>
        <div class="button-container">
            <a class="btn-cancel" href="/vistas/tablas/tareas.php">Volver</a>
        </div>
    </div>
</body>
</html>
