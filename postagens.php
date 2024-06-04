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

// Consulta as publicações
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados de cada publicação
    while($row = $result->fetch_assoc()) {
        echo "Título: " . $row["title"]. "<br>";
        echo "Conteúdo: " . $row["content"]. "<br>";
        echo "Data de criação: " . $row["created_at"]. "<br>";
        echo "<hr>";
    }
} else {
    echo "Nenhuma publicação encontrada";
}

$conn->close();
?>
