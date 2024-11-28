<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="/vistas/tablas/tareas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="table-container">
        <h2>Lista de Tareas</h2>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Buscar tarea...">
            <a href="/vistas/registarea/tarea.html"><i class="fas fa-plus"></i> Nueva Tarea</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Vencimiento</th>
                    <th>Estado</th>
                    <th>Encargado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="taskTable">
                <?php
                
                include '../../modelado/conexion.php'; 
                
                $sql = "SELECT * FROM tareas";
                $stmt = $con->prepare($sql);// permite enlazar parámetros y evitar tener que escapar los parámetros. 
                $stmt->execute();
                $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);//devuelve un array con todas las filas devueltas por la base de datos

                foreach ($tareas as $tarea) {
                    echo "<tr>
                            <td>" . $tarea['nombre']. "</td>
                            <td>" . $tarea['descripcion'] . "</td>
                            <td>" . $tarea['fecha_creacion'] . "</td>
                            <td>" . $tarea['fecha_vencimiento']. "</td>
                            <td>" . $tarea['estado'] . "</td>
                            <td>" . $tarea['Encargado'] . "</td>
                            <td class='action-icons'>
                                <a href='/controladores/editar.php?id=" . $tarea['id'] . "' class='edit'><i class='fas fa-edit'></i></a>
                                <a href='/controladores/borrar.php?id=" . $tarea['id'] . "' class='delete'><i class='fas fa-trash'></i></a>
                                <a href='/controladores/vista.php?id=" . $tarea['id'] . "' class='view'><i class='fas fa-eye'></i></a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table><br>
        <a href="/vistas/pagina/index.php">Inicio</a>
    </div>
    <script>
        let timeout;
        document.getElementById("search").addEventListener("keyup", function () {//detecta el evento
            clearTimeout(timeout);//evitar llamadas de filtrado innecesarias mientras el usuario aún está escribiendo.
            timeout = setTimeout(() => {//eliminación de rebotes para garantizar que el proceso de filtrado solo se realice después de que el usuario haya terminado de escribir
                const searchTerm = this.value.toLowerCase();//recupera el valor actual de la entrada de búsqueda para comparar
                const rows = document.querySelectorAll("#taskTable tr");//selecciona todas las filas ( <tr>) de la tabla con el ID taskTable.
                rows.forEach(row => {//bucle itera a través de cada fila ( <tr>) de la tabla.
                    const text = row.textContent.toLowerCase();//extrae el contenido de texto de cada fila y lo convierte a minúsculas.
                    row.style.display = text.includes(searchTerm) ? "" : "none";//Comprueba si el texto de la fila incluye el término de búsqueda
                });
            }, 100); 
        });
    </script>
</body>
</html>

