<?php
header("Access-Control-Allow-Origin: *");  // Permitir acceso desde cualquier dominio
header("Content-Type: application/json");  // Indicar que la respuesta es JSON

$servername = "localhost";
$username = "root";
$password = "";
$database = "luz";

// Conectar a MySQL
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Obtener los datos
$sql = "SELECT * FROM datos_ldr ORDER BY fecha DESC";
$result = $conn->query($sql);

$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[] = $row;
}

echo json_encode($datos);

$conn->close();
?>
