<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require('db.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id']; // Obtém o ID do usuário da sessão

    // Insere a nova postagem no banco de dados
    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        header('Location: ver_publicacoes.php'); // Redireciona para a página de visualização de postagens
        exit;
    } else {
        echo "Erro ao criar a postagem: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Post</title>
    <link rel="stylesheet" href="ProjetoCurso2/styles.css">
    <style>
        body {
            text-align: center;
        }

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

        #publicar {
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

        #verpost {
            text-align: center;
            position: relative;
            padding: 10px;
            color: #6959CD;
            border-radius: 5px;
            cursor: pointer;
            max-width: 400px;
            width: 100%;
            font-size: 20px;
            border: none;
        }

        #verpost:hover {
            color: #0000FF;
        }

        #publicar:hover {
            background-color: #4F4F4F;
        }

        #user,
        #user:hover {
            display: none; /* Oculta o campo de seleção de usuário */
        }

    </style>
</head>
<body>
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
        </ul>
    </nav>
</header>

<section class="banner">
    <img class="home-img" src="ProjetoCurso2/imagens/Design_an_image_or_logo_stylized_with_the_phrase.png" alt="logo">
    <h2>Faça uma postagem</h2>
</section>

<span style="font-size: 50px">Bem-vindo, <?php echo $_SESSION['usuario']; ?></span>
<form action="" method="post">
    <label for="title">Título:</label><br>
    <input type="text" id="title" name="title" required><br><br>
    <label for="content">Conteúdo:</label><br>
    <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"> <!-- Campo hidden com o ID do usuário da sessão -->
    <input id="publicar" type="submit" value="Publicar"><br>
    <br><a id="verpost" href="ver_publicacoes.php" class="container-publis"><b>Clique aqui para ver as postagens</b></a>
</form>
</body>
</html>
