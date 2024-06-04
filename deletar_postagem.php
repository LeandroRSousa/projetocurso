<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id']) && isset($_POST['usuario'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['usuario'];

    // Exclua os comentários associados à postagem
    $sql_delete_comments = "DELETE FROM comments WHERE post_id = ?";
    $stmt_delete_comments = $conn->prepare($sql_delete_comments);
    $stmt_delete_comments->bind_param("i", $post_id);
    $stmt_delete_comments->execute();

    // O ID do usuário autenticado corresponde ao ID do usuário da postagem, pode excluir
    $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Postagem excluída com sucesso";
        echo "<script>setTimeout(function() { window.location.href = 'ver_publicacoes.php'; }, 900);</script>";
    } else {
        echo "Erro ao excluir a postagem.";
    }
}
?>
