<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Página Principal</title>
</head>
<body>
<header>
  <div class="topnav" id="myTopnav">
      <img src="/imagenes/logo.png" alt="">
      <h1>registro de tareas</h1>
      <a class="menu" href="/vistas/pagina/index.php">Inicio</a>
      <a class="menu" href="/vistas/registarea/tarea.html">Registro</a>
      <div class="boton">
        <a class="boton" href="/modelado/cerrarsesion.php">Cerrar Sesión</a>
      </div>
      
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</header>
<h3>lista de tareas</h3>
<div class="tareas">
  <?php
      include '../../modelado/conexion.php'; 
      $query = "SELECT * FROM tareas";
      $stmt = $con->prepare($query); 
      $stmt->execute();              

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      
      echo '
      <div class="container-card">
        <div class="card">
            <img src="/imagenes/tarea.png" alt="">
            <div class="titulo">
            <h2>'. $row["nombre"] .'</h2>
            </div>
            <div class="cuerpo">
                <p class="card-description">Descripcion: ' . $row["descripcion"] . '</p>
                <p class="card-description">Fecha Inicio: ' . $row["fecha_creacion"] . '</p>
                <p class="card-description">Fecha Vencimiento: ' . $row["fecha_vencimiento"] . '</p>
                <p class="card-description">Estado: ' . $row["estado"] . '</p>
                <p class="card-description">Encargado: ' . $row["Encargado"] . '</p><br>
                <a href="/vistas/tablas/tareas.php">Más información</a>
            </div>
        </div>
      </div>
      ';
     }
    ?>
</div>
<footer>
  <p>&copy; 2024 Registro de Tareas. Todos los derechos reservados.</p>
</footer>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</body>
</html>
