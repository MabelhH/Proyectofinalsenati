<?php
// Incluir la conexión
include '../modelado/conexion.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM tareas WHERE id = '$id'";
        $stmt = $con->prepare($sql);
       // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /vistas/tablas/tareas.php"); 
    } catch (PDOException $e) {
        echo "Error al eliminar la tarea: ";
    }
} else {
    header("Location: /vistas/tablas/tareas.php");
}
?>

