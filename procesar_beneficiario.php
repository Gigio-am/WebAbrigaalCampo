<?php
include 'db_connection.php';

// Datos comunes del formulario
$identificacion = $conexion->real_escape_string($_POST['identificacion']);
$nombres = $conexion->real_escape_string($_POST['nombre']);
$apellidos = $conexion->real_escape_string($_POST['apellidos']);
$edad = (int)$_POST['edad'];
$pais = $conexion->real_escape_string($_POST['pais']);
$ciudad = $conexion->real_escape_string($_POST['ciudad']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$telefono = $conexion->real_escape_string($_POST['telefono']);
$correo_electronico = $conexion->real_escape_string($_POST['correo_electronico']);

// Datos específicos de beneficiario
$mensaje = $conexion->real_escape_string($_POST['mensaje']);
$autorizacion = isset($_POST['autorizacion']) ? 1 : 0;

// 1. Insertar en la tabla persona
$sql_persona = "INSERT INTO persona (identificacion, nombres, apellidos, edad, pais, ciudad, direccion, telefono, correo_electronico) 
                VALUES ('$identificacion', '$nombres', '$apellidos', $edad, '$pais', '$ciudad', '$direccion', '$telefono', '$correo_electronico')";

if ($conexion->query($sql_persona) === TRUE) {
    $persona_id = $conexion->insert_id;

    // 2. Insertar en la tabla beneficiario
    $sql_beneficiario = "INSERT INTO beneficiario (persona_id, mensaje, autorizacion) 
                         VALUES ($persona_id, '$mensaje', $autorizacion)";
    if ($conexion->query($sql_beneficiario) === TRUE) {
        echo "Datos de beneficiario guardados exitosamente";
        echo "<script>setTimeout(() => { window.location.href = 'beneficiario_menu.php'; }, 2000);</script>";
    } else {
        echo "Error al insertar en beneficiario: " . $conexion->error;
    }
} else {
    echo "Error al insertar en persona: " . $conexion->error;
}

$conexion->close();
?>



 
