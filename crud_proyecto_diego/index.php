<?php
// Include the database connection file
require_once("conexion.php");

// Fetch data joining the 3 tables
$result = mysqli_query($mysqli, "
    SELECT v.dni, v.nombre, v.apellido, v.pais,
           a.id_a, a.nombre AS actividad, a.tipo, a.duracion
    FROM Visitante_Realiza_Actividad vra
    JOIN Visitante v ON vra.dni = v.dni
    JOIN Actividad a ON vra.id_a = a.id_a
    ORDER BY v.apellido
");
?>

<html>
<head>
    <title>Homepage</title>
</head>

<body>
    <h2>Visitantes y Actividades</h2>
    <p>
        <a href="add.php">Add New Data</a>
    </p>
    <table width='80%' border=1>
        <tr bgcolor='#DDDDDD'>
            <td><strong>DNI</strong></td>
            <td><strong>Nombre</strong></td>
            <td><strong>Apellido</strong></td>
            <td><strong>País</strong></td>
            <td><strong>Actividad</strong></td>
            <td><strong>Tipo</strong></td>
            <td><strong>Duración (min)</strong></td>
            <td><strong>Action</strong></td>
        </tr>
        <?php
        // Fetch the next row of a result set as an associative array
        while ($res = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$res['dni']."</td>";
            echo "<td>".$res['nombre']."</td>";
            echo "<td>".$res['apellido']."</td>";
            echo "<td>".$res['pais']."</td>";
            echo "<td>".$res['actividad']."</td>";
            echo "<td>".$res['tipo']."</td>";
            echo "<td>".$res['duracion']."</td>";
            echo "<td><a href=\"edit.php?dni=".$res['dni']."&id_a=".$res['id_a']."\">Edit</a> |
                  <a href=\"delete.php?dni=".$res['dni']."&id_a=".$res['id_a']."\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
    </table>
</body>
</html>
