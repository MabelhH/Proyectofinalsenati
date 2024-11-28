<?php 
include '../modelado/conexion.php';

if ($_POST) {
    if (strlen($_POST['username']) >= 1 &&
        strlen($_POST['password']) >= 1) {
        $usuario = $_POST['username'];
        $contraseña = $_POST['password'];
        $instruccionsql = "INSERT INTO usuarios (username,password) 
                   VALUES ('$usuario','$contraseña')";

        $resultado = $con->query($instruccionsql);
        //$resultado->execute();

        if ($resultado) {
            header('Location: ../vistas/inicio/inicio.html');
        } else {
            echo '<h3 class="bad">¡Ups, ha ocurrido un error!</h3>';
        }
    } else {
        echo '<h3 class="bad">¡Por favor, ingresa valor a los campos vacíos!</h3>';
    }
}
?>