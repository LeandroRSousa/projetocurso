<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_example";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["senha"]) || empty($_POST["confirmar_senha"])) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Dados do formulário
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $confirmar_senha = $_POST["confirmar_senha"];
        
        // Verifica se as senhas são iguais
        if ($senha !== $confirmar_senha) {
            echo "As senhas não coincidem.";
        } else {
            // Aqui você pode fazer mais validações, como verificar se o e-mail é válido, por exemplo
            
            // Agora você pode inserir os dados no banco de dados
            $sql = "INSERT INTO users (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Usuário cadastrado com sucesso!";
                echo "<script>setTimeout(function() { window.location.href = 'ProjetoCurso2/index.html'; }, 900);</script>";
            } else {
                echo "Erro ao cadastrar o usuário: " . $conn->error;
            }
        }
    }
}
?>

<?php
// Fechar a conexão
$conn->close();
?>
