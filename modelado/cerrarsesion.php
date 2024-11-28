<?php
session_start();
session_destroy();
header('Location: ../vistas/inicio/inicio.html');
exit();
?>