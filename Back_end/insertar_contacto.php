<?php
// Datos de conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambia esto por tu usuario
$pass = ""; // Cambia esto por tu contraseña
$db = "semillero_cun";

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Crear un array para los campos y otro para los valores
    $campos = ['nombre', 'correo', 'mensaje'];
    $valores = [];

    // Recorrer los campos para obtener los valores del formulario
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            // Escapar los valores antes de usarlos en la consulta
            $valores[$campo] = $conn->real_escape_string($_POST[$campo]);
        } else {
            $valores[$campo] = ''; // Por si algún campo está vacío
        }
    }

    // Crear la consulta de inserción
    $sql = "INSERT INTO formulario (nombre, correo, mensaje) 
            VALUES ('" . $valores['nombre'] . "', '" . $valores['correo'] . "', '" . $valores['mensaje'] . "')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa
        echo "<script>alert('Mensaje enviado exitosamente'); window.location.href='../Contactos.html';</script>";
        exit();
    } else {
        // Si hubo un error
        echo "<script>alert('Error al enviar el mensaje: " . $conn->error . "'); window.history.back();</script>";
        exit();
    }
}

// Cerrar la conexión
$conn->close();
?>