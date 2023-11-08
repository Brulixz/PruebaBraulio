<?php
// confirmar sesion
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="loggedin">
    <nav class="navtop">
        <div class="header">
            <h1 style="color:white; margin-right: 20px;">PartiTech</h1>
            <div class="nav-links">
                <a href="listagrupos.php" class="nav-link">Grupos</a>
                <a href="perfil.php" class="nav-link">Perfil</a>
                <a href="cerrar-sesion.php" class="nav-link">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    <div class="content">
        <h2>Insertar Nueva Fruta</h2>
        <!-- Formulario para insertar datos en la tabla students con diseño Bootstrap -->
        <?php
        if (isset($_GET['mensaje'])) {
            echo "<p style='color: green;'>" . $_GET['mensaje'] . "</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>" . $_GET['error'] . "</p>";
        }
        ?>
        <form method="POST" action="registro.php" class="form-horizontal">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Fruta:</th>
                    <th>Precio:</th>
                    <th>Buena o Mala:</th>
                    <th>Tipo de fruta:</th>
                    <th>Enviar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="nombres" required></td>
                    <td><input type="text" class="form-control" name="apellidomat" required></td>
                    <td><input type="text" class="form-control" name="apellidopat" required></td>
                    <td><input type="text" class="form-control" name="grupo" required></td>
                    <td><input type="submit" class="btn btn-primary" value="Guardar"></td>
                </tr>
                </tbody>
            </table>
        </form>
        <!-- Mostrar la tabla de estudiantes -->
        <h3>Tabla de Estudiantes</h3>
        <?php
        // Aquí debes obtener y mostrar los datos de la tabla students
        // Conectar a la base de datos (incluye tu archivo de conexión)
        include 'conexionDB.php';
        global $con;
        // Consulta SQL para obtener todos los registros de students
        $sql = "SELECT * FROM estudiantes";
        $result = $con->query($sql);
        // Verificar si la tabla está vacía
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id Fruta</th>";
            echo "<th>Nombre de la fruta</th>";
            echo "<th>Precio</th>";
            echo "<th>Calidad</th>";
            echo "<th>Tipo</th>";
            echo "<th>Creador</th>";
            echo "<th>Borrar</th>";
            echo "<th>Actualizar</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_estudiante']}</td>";
                echo "<td>{$row['nombres']}</td>";
                echo "<td>{$row['apellidomat']}</td>";
                echo "<td>{$row['apellidopat']}</td>";
                echo "<td>{$row['grupo']}</td>";
                echo "<td>{$row['prof_autor']}</td>";
                echo "<td>
                <form method='POST' action='borrar_estudiante.php'>
                    <input type='hidden' name='id_estudiante' value='{$row['id_estudiante']}'>
                    <input type='submit' class='btn btn-danger' value='Borrar'>
                </form>
              </td>";
        echo "<td></td>";
        echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No hay frutas del diablo registrada.</p>";
        }
        // Cerrar la consulta
        $result->close();
        ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
