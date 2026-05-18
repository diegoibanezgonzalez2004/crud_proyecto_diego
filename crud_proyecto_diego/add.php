<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("conexion.php");

if (isset($_POST['submit'])) {
    // Escape special characters in a string for use in an SQL statement
    $dni  = mysqli_real_escape_string($mysqli, $_POST['dni']);
    $id_a = mysqli_real_escape_string($mysqli, $_POST['id_a']);

    // Check for empty fields
    if (empty($dni) || empty($id_a)) {
        if (empty($dni)) {
            echo "<font color='red'>Visitante field is empty.</font><br/>";
        }
        if (empty($id_a)) {
            echo "<font color='red'>Actividad field is empty.</font><br/>";
        }

        // Show link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // Insert data into database
        $result = mysqli_query($mysqli, "INSERT INTO Visitante_Realiza_Actividad (dni, id_a) VALUES ('$dni', '$id_a')");

        // Display success message
        echo "<p><font color='green'>Data added successfully!</p>";
        echo "<a href='index.php'>View Result</a>";
    }
} else {
?>
    <h2>Add Data</h2>
    <p><a href="index.php">Home</a></p>

    <form action="add.php" method="post" name="add">
        <table width="25%" border="0">
            <tr>
                <td>Visitante (DNI)</td>
                <td>
                    <?php
                    $visitantes = mysqli_query($mysqli, "SELECT dni, nombre, apellido FROM Visitante ORDER BY apellido");
                    echo "<select name='dni'>";
                    while ($v = mysqli_fetch_assoc($visitantes)) {
                        echo "<option value='".$v['dni']."'>".$v['apellido'].", ".$v['nombre']." (".$v['dni'].")</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>Actividad</td>
                <td>
                    <?php
                    $actividades = mysqli_query($mysqli, "SELECT id_a, nombre FROM Actividad ORDER BY nombre");
                    echo "<select name='id_a'>";
                    while ($a = mysqli_fetch_assoc($actividades)) {
                        echo "<option value='".$a['id_a']."'>".$a['nombre']."</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Add"></td>
            </tr>
        </table>
    </form>
<?php } ?>
</body>
</html>
