<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_example";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
