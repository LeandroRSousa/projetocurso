<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("Acesso negado.");
}

require('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['post_id']) && isset($_POST['comment_text'])) {
        $post_id = intval($_POST['post_id']);
        $comment_text = $conn->real_escape_string($_POST['comment_text']);
        $user_id = $_SESSION['user_id']; // Certifique-se de que o user_id está armazenado na sessão

        $sql = "INSERT INTO comments (post_id, user_id, comment_text) VALUES ('$post_id', '$user_id', '$comment_text')";
        if ($conn->query($sql) === TRUE) {
            echo "Comentário adicionado com sucesso.";
            echo "<script>setTimeout(function() { window.location.href = 'ver_publicacoes.php'; }, 900);</script>";
        } else {
            echo "Erro ao adicionar comentário: " . $conn->error;
        }
    } else {
        echo "Dados incompletos.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
