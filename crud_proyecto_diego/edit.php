<html>
<head>
    <title>Edit Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("conexion.php");

if (isset($_POST['update'])) {
    // Escape special characters in a string for use in an SQL statement
    $dni      = mysqli_real_escape_string($mysqli, $_POST['dni']);
    $id_a     = mysqli_real_escape_string($mysqli, $_POST['id_a']);
    $old_dni  = mysqli_real_escape_string($mysqli, $_POST['old_dni']);
    $old_id_a = mysqli_real_escape_string($mysqli, $_POST['old_id_a']);

    // Check for empty fields
    if (empty($dni) || empty($id_a)) {
        if (empty($dni)) {
            echo "<font color='red'>Visitante field is empty.</font><br/>";
        }
        if (empty($id_a)) {
            echo "<font color='red'>Actividad field is empty.</font><br/>";
        }
    } else {
        // Update the database table
        $result = mysqli_query($mysqli, "UPDATE Visitante_Realiza_Actividad SET dni='$dni', id_a=$id_a WHERE dni='$old_dni' AND id_a=$old_id_a");

        // Display success message
        echo "<p><font color='green'>Data updated successfully!</p>";
        echo "<a href='index.php'>View Result</a>";
    }
} else {
    // Get parameters from URL
    $dni  = $_GET['dni'];
    $id_a = $_GET['id_a'];

    // Select data associated with this particular record
    $result     = mysqli_query($mysqli, "SELECT * FROM Visitante_Realiza_Actividad WHERE dni='$dni' AND id_a=$id_a");

    // Fetch the next row of a result set as an associative array
    $resultData = mysqli_fetch_assoc($result);

    $current_dni  = $resultData['dni'];
    $current_id_a = $resultData['id_a'];
?>
    <h2>Edit Data</h2>
    <p><a href="index.php">Home</a></p>

    <form name="edit" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Visitante (DNI)</td>
                <td>
                    <?php
                    $visitantes = mysqli_query($mysqli, "SELECT dni, nombre, apellido FROM Visitante ORDER BY apellido");
                    echo "<select name='dni'>";
                    while ($v = mysqli_fetch_assoc($visitantes)) {
                        $selected = ($v['dni'] === $current_dni) ? "selected" : "";
                        echo "<option value='".$v['dni']."' $selected>".$v['apellido'].", ".$v['nombre']." (".$v['dni'].")</option>";
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
                        $selected = ($a['id_a'] == $current_id_a) ? "selected" : "";
                        echo "<option value='".$a['id_a']."' $selected>".$a['nombre']."</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="old_dni"  value="<?php echo $current_dni; ?>"></td>
                <td><input type="hidden" name="old_id_a" value="<?php echo $current_id_a; ?>">
                    <input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
<?php } ?>
</body>
</html>
