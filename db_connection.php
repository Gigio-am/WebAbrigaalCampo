<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; // Deja en blanco si estás usando XAMPP sin una contraseña de root.
$dbname = "fundacion_db";

// Crear la conexión
$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verificar la conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
