<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_example";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$title = $_POST["title"];
$content = $_POST["content"];
$user_id = $_POST["user"];

$sql = "INSERT INTO posts (title, content, user_id, created_at) VALUES ('$title', '$content', '$user_id', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Postagem criada com sucesso";
    echo "<script>setTimeout(function() { window.location.href = '/testes/ver_publicacoes.php'; }, 900);</script>";
} else {
    echo "Erro ao criar postagem: " . $conn->error;
}

$conn->close();
?>
