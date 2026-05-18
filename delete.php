<?php
// Include the database connection file
require_once("conexion.php");

// Get parameter values from URL
$dni  = $_GET['dni'];
$id_a = $_GET['id_a'];

// Delete row from the database table
$result = mysqli_query($mysqli, "DELETE FROM Visitante_Realiza_Actividad WHERE dni='$dni' AND id_a=$id_a");

// Redirect to the main display page (index.php in our case)
header("Location:index.php");
?>
