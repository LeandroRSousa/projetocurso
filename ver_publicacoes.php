<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require('db.php');

$sql = "SELECT posts.*, users.nome AS user_nome FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="ProjetoCurso2/scripts.js"></script>
    <title>Ver Publicações</title>
    <link rel="stylesheet" href="ProjetoCurso2/styles.css">
    <script src="ProjetoCurso2/scripts.js"></script>
    <style>

        

        h4 {
            text-align: center;
            position: relative;
            margin-left: 2%;
            font-family: Arial, sans-serif;
            color: #4F4F4F;
            text-shadow: 2px 2px 4px #696969;
        }

        #postar {
            text-align: center;
            position: relative;
            margin-left: 2%;
            margin-right: 80%;
            padding: 10px; 
            margin-top: 10px;
            margin-bottom: 5px;
            box-sizing: border-box;
            background-color: #6959CD; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            text-decoration: none;
            transition: all 0.1s ease-in-out;
        }

        #postar:hover {
            background-color: ##6959CD;
            color: #cbee77;
            box-shadow:  
            0 0 5px  #6959CD,
            0 0 25px  #6959CD,
            0 0 50px  #6959CD,
            0 0 150px  #6959CD;
        }

        .container-postagens {
            color: #556672;
            padding: 10px 10px;
            background-color: #f2f5f8;
            margin-bottom: 0;
            font-size: 25px;
            margin-left: 30%;
            word-wrap: break-word;
            max-width: 900px;
            margin-top: -315px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container-postagens h5 {
            color: #6959CD;
            font-size: 25px;
            font-family: Arial, sans-serif;
            word-wrap: break-word;
            padding-bottom: 15px;
            padding-top: 15px;
        }

        .container-postagens p {
            padding-bottom: 15px;
            padding-top: 15px;
        }

        #post-img {
            max-width: 400px;
            display: flex;
            align-items: flex-end;
            margin-left: 1%;
            margin-top: -20px;
            width: 440px; /* Largura da imagem */
            height: 340px; /* Altura da imagem */
            padding: 0;
        }

        #editar {
            background-color: #6959CD;
            cursor: pointer;
            text-align: center;
            padding: 5px;
            box-sizing: border-box;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            position: relative;
            left: 70px;
            top: 44px;
            margin-right: 10px; /* Adiciona um espaçamento entre os botões */
            font-size: 14px;
            margin-bottom: 10px;
        }

        #excluir {
            background-color: #6959CD;
            cursor: pointer;
            text-align: center;
            padding: 5px;
            box-sizing: border-box;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            position: relative;
            margin-right: 10px; /* Adiciona um espaçamento entre os botões */
            margin-bottom: 10px;
        }

        #editar:hover,
        #excluir:hover {
            background-color: #4169E1;
        }

        .comments-section {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            
            margin-bottom: 100px;
        }

        .comments-section h3 {
            margin-bottom: 15px;
            margin-top: 5px;
            font-size: 25px;
            margin-left: 0;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-form button {
            background-color: #6959CD;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .comment-form button:hover {
            background-color: #4169E1;
        }

        .comments-list .comment {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .comments-list .comment p {
            margin: 5px 0;
            padding: 0;
            font-size: 20px;
        }

        @media screen and (max-width: 768px) {
            .container-postagens {
                flex: 0 1 100%;
                margin: auto; /* Centraliza o conteúdo */
                margin-top: 10px;
                margin-bottom: 10px;
                margin-inline: 5px;
                margin-left: 0;
                max-width: 100%;
            }

            #postar {
                margin: 10px auto; /* Centraliza o botão na tela */
                width: 80%; /* Define a largura do botão */
                max-width: 300px; /* Define a largura máxima do botão */
            }
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
            <li id="bem-vindo">
                <span>Bem-vindo, <?php echo $_SESSION['usuario']; ?></span>
            </li>
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
    <h2>Postagens da Comunidade</h2>
</section>

<button id="tema" onClick="toggleTheme()">Tema Escuro</button>

<a id="postar" href="/testes/novo_post.php"><p>Faça sua postagem</p></a>
<img id="post-img" src="https://cdni.iconscout.com/illustration/premium/thumb/social-media-influencer-4217557-3524795.png" alt="">
<div class="container-postagens">
    


<?php

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo "<div class='post'>";
        echo "<hr>";
        echo "<h5>Título: " . $row["title"] . "</h5>";
        echo "<p><b>Conteúdo:</b> " . $row["content"] . "</p>";
        echo "<p><b>Autor:</b> " . $row["user_nome"] . "</p>";
        echo "<a href='/testes/editar_postagem.php?id=" . $row["id"] . "'><button id='editar'>Editar</button></a>";
        
        // Formulário para exclusão da postagem
        echo "<form method='post' action='/testes/deletar_postagem.php' onsubmit='return confirm(\"Tem certeza que deseja excluir esta postagem?\")'>";
        echo "<input type='hidden' name='post_id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='usuario' value='" . $row["user_id"] . "'>";
        echo "<button id='excluir' type='submit' class=''>Excluir</button>";
        echo "</form>";

        // Seção de comentários
        echo "<div class='comments-section'>";
        echo "<h3>Comentários</h3>";

        // Exibir comentários
        $postId = $row["id"];
        $sql_comments = "SELECT comments.*, users.nome AS user_nome FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = $postId ORDER BY comments.id DESC";
        $result_comments = $conn->query($sql_comments);

        if ($result_comments->num_rows > 0) {
            echo "<div class='comments-list'>";
            while ($comment = $result_comments->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p><b>" . $comment["user_nome"] . ":</b> " . $comment["comment_text"] . "</p>";
                echo "</div>";
                
                
            }
            echo "</div>";
        } else {
            echo "<p>Sem comentários ainda. Seja o primeiro a comentar!</p>";
        }

        // Formulário de comentário
        echo "<form class='comment-form' action='/testes/add_comment.php' method='post'>";
        echo "<textarea name='comment_text' placeholder='Escreva um comentário...' required></textarea>";
        echo "<input type='hidden' name='post_id' value='$postId'>";
        echo "<button type='submit'>Comentar</button>";
        echo "</form>";
        echo "</div>"; // Fim da seção de comentários

        echo "</div>"; // Fim do post
    }
} else {
    echo "<p>Sem postagens encontradas.</p>";
}

$conn->close();
?>

<script>
function addComment(postId) {
    var commentText = document.getElementById("comment_text_" + postId).value;
    if (commentText.trim() === "") {
        alert("Por favor, escreva um comentário.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/testes/add_comment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var commentsDiv = document.getElementById("comments_" + postId);
            var newComment = document.createElement("div");
            newComment.classList.add("comment");
            newComment.innerHTML = "<p>" + commentText + "</p><small>Comentado agora mesmo</small>";
            commentsDiv.appendChild(newComment);
            document.getElementById("comment_text_" + postId).value = "";
        }
    };
    xhr.send("post_id=" + postId + "&comment_text=" + encodeURIComponent(commentText));
}
</script>

        <!--botão whatsapp -->
    </div> 
        <div class="whatsapp-btn">
        <a href="https://api.whatsapp.com/send?phone=#" target="_blank">
            <img src="/testes/ProjetoCurso2/imagens/whatsapp.jpg" alt="WhatsApp">
            <span class="tooltip">Precisa de ajuda?</span>
        </a>
    </div>

<footer>
    <p>&copy; OS DEVS: LEANDRO RIBEIRO DE SOUSA, LUIZA MARIA BOIKO COUTINHO, DOUGLAS MACHADO, RODRIGO PEREIRA DOS SANTOS, STELLA PIRES DE OLIVEIRA, SAMUEL AVILA CARVALHO, MARIA EDUARDA DA SILVA E SILVA. Todos os direitos reservados.</p>
</footer> 

</body>
</html>