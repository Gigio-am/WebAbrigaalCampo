<?php
include 'db_connection.php';

// Obtención y validación de datos del formulario
$identificacion = $conexion->real_escape_string($_POST['identificacion']);
$nombres = $conexion->real_escape_string($_POST['nombre']);
$apellidos = $conexion->real_escape_string($_POST['apellidos']);
$edad = (int)$_POST['edad'];
$pais = $conexion->real_escape_string($_POST['pais']);
$ciudad = $conexion->real_escape_string($_POST['ciudad']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$telefono = $conexion->real_escape_string($_POST['telefono']);
$correo_electronico = $conexion->real_escape_string($_POST['correo_electronico']);

// Datos específicos de donante
$tipo_donacion = $conexion->real_escape_string($_POST['tipo_donacion']);

// Insertar en la tabla persona
$sql_persona = "INSERT INTO persona (identificacion, nombres, apellidos, edad, pais, ciudad, direccion, telefono, correo_electronico) 
                VALUES ('$identificacion', '$nombres', '$apellidos', $edad, '$pais', '$ciudad', '$direccion', '$telefono', '$correo_electronico')";

if ($conexion->query($sql_persona) === TRUE) {
    $persona_id = $conexion->insert_id;

    // Insertar en la tabla donante
    $sql_donante = "INSERT INTO donante (persona_id, tipo_donacion) 
                    VALUES ($persona_id, '$tipo_donacion')";
    if ($conexion->query($sql_donante) === TRUE) {
        echo "Datos de donante guardados exitosamente";
        echo "<script>setTimeout(() => { window.location.href = 'donante_menu.php'; }, 2000);</script>";
    } else {
        echo "Error al insertar en donante: " . $conexion->error;
    }
} else {
    echo "Error al insertar en persona: " . $conexion->error;
}

$conexion->close();
?>

