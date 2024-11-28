<?php
include '../modelado/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los valores existen en $_POST
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $usuario = $_POST['username'];
        $contraseña = $_POST['password'];

        $instruccionsql = $con->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
        $instruccionsql->bindParam(':username', $usuario);
        $instruccionsql->bindParam(':password', $contraseña);
        $instruccionsql->execute();

        if ($registro = $instruccionsql->fetch(PDO::FETCH_OBJ)) {
            session_start();
            $_SESSION["IdUsuarios"] = $registro->IdUsuarios;
            $_SESSION["NombreUsuario"] = $registro->NombreUsuario;
            $_SESSION["ContraseñaUsuario"] = $registro->ContraseñaUsuario;
            $_SESSION["TipoUsuario"] = $registro->TipoUsuario;
            header('Location: ../vistas/pagina/index.php');
            exit();  
        } else {
            echo "Las credenciales del usuario no existen";
        }
    } else {
        echo "Por favor, ingresa un nombre de usuario y contraseña.";
    }
}
?>


