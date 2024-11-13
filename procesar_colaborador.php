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

// Datos específicos de colaborador
$habilidades = $conexion->real_escape_string($_POST['habilidades']);

// Insertar en la tabla persona
$sql_persona = "INSERT INTO persona (identificacion, nombres, apellidos, edad, pais, ciudad, direccion, telefono, correo_electronico) 
                VALUES ('$identificacion', '$nombres', '$apellidos', $edad, '$pais', '$ciudad', '$direccion', '$telefono', '$correo_electronico')";

if ($conexion->query($sql_persona) === TRUE) {
    $persona_id = $conexion->insert_id;

    // Insertar en la tabla colaborador
    $sql_colaborador = "INSERT INTO colaborador (persona_id, habilidades) 
                        VALUES ($persona_id, '$habilidades')";
    if ($conexion->query($sql_colaborador) === TRUE) {
        echo "Datos de colaborador guardados exitosamente";
        echo "<script>setTimeout(() => { window.location.href = 'colaboradores.html'; }, 2000);</script>";
    } else {
        echo "Error al insertar en colaborador: " . $conexion->error;
    }
} else {
    echo "Error al insertar en persona: " . $conexion->error;
}

$conexion->close();
?>
