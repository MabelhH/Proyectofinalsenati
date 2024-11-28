<?php 
include '../conexion/conexion.php';

if ($_POST) {
    
    $DNI = $_POST['dni'];
    $NOMBRE = $_POST['nombre'];
    $CORREO = $_POST['correo'];
    $TELEFONO = $_POST['Telefono'];
    $DIRECCION = $_POST['direccion'];
    $MENSAGE = $_POST['mensage'];
    try
    {
        $instruccionSql ="INSERT IGNORE INTO contactos (Dni,NombreCompleto,Correo,Telefono,Mensage)
                        VALUES ('$DNI', '$NOMBRE', '$CORREO', '$TELEFONO','$MENSAGE')";
        $resutado=$con->query($instruccionSql);
        
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}
      
?>