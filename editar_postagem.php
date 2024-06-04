
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="ProjetoCurso2/scripts.js"></script>
    <title>Editar postagem</title>
    <link rel="stylesheet" href="ProjetoCurso2/styles.css">
    <script src="ProjetoCurso2/scripts.js"></script>
    <style>
        form {
            position: relative;
            text-align: center;
            align-items: center;
            margin-top: auto;
            margin-bottom: auto;
            color: rgb(0, 0, 0);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
            padding: 8px;
            width: 100%;
            text-align: center;
            font-size: 20px;
            border-radius: 8px;
        }

        input,
        textarea {
            color: rgb(0, 0, 0);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            max-width: 400px;
            opacity: 0.9;
            padding: 8px;
            width: 100%;
            text-align: center;
            font-size: 20px;
            border-radius: 8px;
        }

        textarea {
            max-width: 400px;
        }

        #content {
            max-width: 600px;
            height: 300px;
        }

        #salvar {
            text-align: center;
            position: relative;
            padding: 10px;
            box-sizing: border-box;
            background-color: #556672;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        #salvar:hover {
            background-color: #4F4F4F;
        }

    </style>
</head>
<body style="background-color: #f2f5f8;">
    <header>
    <div class="menu-icon" onclick="toggleMenu()">
        &#9776; <!-- Ícone de menu -->
    </div>
    <div class="close-icon" onclick="toggleMenu()" style="display: none;">
        &#10006; <!-- Ícone de fechar -->
    </div>
         
    <nav class="nav">
        <ul>
            <li><a href="ProjetoCurso2/index.html">Home</a></li>
            <li><a href="ProjetoCurso2/login.html">Painel</a></li>
            <li><a href="/testes/ver_publicacoes.php">Fórum</a></li>
            <li><a href="ProjetoCurso2/comunidade.html">Pesquisa</a></li>
            <li id="search-container">
                <input type="text" id="search" placeholder="Pesquisar...">
                <button id="search-button" onclick="performSearch()">🔍</button>
            <li>
        </ul>
    </nav>
    </header>
    <section class="banner">
        <nav class="login-menu">
            <ul>
                <li><a href="ProjetoCurso2/login.html">Login</a></li>
                <li><a href="ProjetoCurso2/cadastro.html">Cadastre-se</a></li>
                
            </ul>
        </nav>
    <img class="home-img" src="ProjetoCurso2/imagens/Design_an_image_or_logo_stylized_with_the_phrase.png" alt="logo">
    <h2>Edite a postagem</h2>
</section>


<body>

</body>
</html>


<?php

// Verifica se o ID da postagem foi passado pela URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $post_id = $_GET["id"];

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "crud_example");
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta para obter os dados da postagem com o ID fornecido
    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Exibe o formulário de edição com os dados da postagem
        echo "<div>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='post_id' value='" . $row["id"] . "'>";
        echo "<label for='title'>Título:</label><br>";
        echo "<input type='text' id='title' name='title' value='" . $row["title"] . "'><br><br>";
        echo "<label for='content'>Conteúdo:</label><br>";
        echo "<textarea id='content' name='content' rows='4' cols='50'>" . $row["content"] . "</textarea><br><br>";
        echo "<input id='salvar' type='submit' value='Salvar'>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Postagem não encontrada.";
    }

    $conn->close();
} else {
    echo "ID da postagem não fornecido.";
}

// Processa o formulário de edição da postagem
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST["post_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$post_id";

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "crud_example");
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    if ($conn->query($sql) === TRUE) {
        echo "Postagem atualizada com sucesso";
        echo "<script>setTimeout(function() { window.location.href = '/testes/ver_publicacoes.php'; }, 900);</script>";
    } else {
        echo "Erro ao atualizar postagem: " . $conn->error;
    }

    $conn->close();
}
?>


