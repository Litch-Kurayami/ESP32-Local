<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "luz";

// Conectar a MySQL
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el valor enviado desde el ESP32
if (isset($_GET['valor'])) {
    $valor = $conn->real_escape_string($_GET['valor']);  // Sanitizar el valor

    // Insertar en la base de datos
    $sql = "INSERT INTO datos_ldr (nivel_luz) VALUES ('$valor')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No se recibieron datos";
}

$conn->close();
?>
