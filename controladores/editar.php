<?php
// Incluir la conexión
include '../modelado/conexion.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tareas WHERE id = '$id'";
    $stmt = $con->prepare($sql);
    //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tarea) {
        die("Tarea no encontrada.");
    }
} else {
    header("Location: /vistas/tablas/tareas.php");
}

if ($_POST) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado'];
    $encargado = $_POST['encargado'];

    $sql = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, fecha_vencimiento = :fecha_vencimiento, 
            estado = :estado, encargado = :encargado WHERE id = :id";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':encargado', $encargado);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: /vistas/tablas/tareas.php?mensaje=modificado");
    } else {
        die("Error al modificar la tarea.");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="/controladores/editar.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Tarea</h2>
        <form action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= $tarea['nombre']; ?>" required><br>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?=$tarea['descripcion']; ?></textarea><br>
            <label for="fecha_vencimiento">Fecha de Inicio:</label>
            <input type="date" name="fecha_vencimiento" value="<?=$tarea['fecha_creacion']; ?>" required><br>
            <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
            <input type="date" name="fecha_vencimiento" value="<?=$tarea['fecha_vencimiento']; ?>" required><br>
            <label for="estado">Estado:</label>
            <input type="text" name="estado" value="<?= $tarea['estado']; ?>" required><br>
            <label for="encargado">Encargado:</label>
            <input type="text" name="encargado" value="<?= $tarea['Encargado']; ?>" required><br>
            <div class="button-container">
                <button type="submit" class="btn-submit">Guardar Cambios</button>
                <a class="btn-submit1" href="/vistas/tablas/tareas.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
