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
    $campos = ['numero_doc', 'nombre', 'carrera', 'semestre', 'correo'];
    $valores = [];

    // Recorrer los campos para obtener los valores del formulario
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valores[$campo] = $_POST[$campo];
        } else {
            $valores[$campo] = ''; // Por si algún campo está vacío
        }
    }

    // Verificar si el número de documento ya existe
    $numero_doc = $valores['numero_doc'];
    $sql_verificar = "SELECT * FROM estudiantes WHERE numero_doc = '$numero_doc'";
    $result = $conn->query($sql_verificar);

    if ($result->num_rows > 0) {
        // Si el número de documento ya está registrado
        echo "<script>alert('El número de documento ya está registrado.');  window.location.href='../Inicio.html';</script>";
        exit();
    } else {
        // Si no está registrado, realizar la inserción
        $sql = "INSERT INTO estudiantes (numero_doc, nombre, carrera, semestre, correo) 
                VALUES ('" . $valores['numero_doc'] . "', '" . $valores['nombre'] . "', '" . $valores['carrera'] . "', '" . $valores['semestre'] . "', '" . $valores['correo'] . "')";
        
        if ($conn->query($sql) === TRUE) {
            // Si la inserción fue exitosa
            echo "<script>alert('Usuario registrado exitosamente'); window.location.href='../Inicio.html';</script>";
            exit();
        } else {
            // Si hubo un error al insertar
            echo "<script>alert('Error al registrar el usuario: " . $conn->error . "'); window.history.back();</script>";
            exit();
        }
    }
}

// Cerrar la conexión
$conn->close();
?>


