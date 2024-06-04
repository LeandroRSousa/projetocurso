<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_example";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $query = "SELECT id, nome FROM users WHERE email = '$email' AND senha = '$senha'";
        $result = $conn->query($query);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['usuario'] = $row['nome'];
            $_SESSION['user_id'] = $row['id'];
            header('Location: ver_publicacoes.php');
            exit;
        } else {
            echo "Usuário ou senha inválidos";
        }
    } else {
        echo "Por favor, preencha ambos os campos de email e senha.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
