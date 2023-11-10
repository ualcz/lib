<?php
include('./menu.php');
include('./protect/db.php');

// Verifique se o parâmetro "id" foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para obter informações detalhadas do livro com base no ID
    $sql_livro = "SELECT livros.link, livros.titulo, livros.sinopse, livros.genero, livros.image, GROUP_CONCAT(autor.nome) AS autores
                  FROM livros
                  INNER JOIN livro_autor ON livros.id = livro_autor.livro_id
                  INNER JOIN autor ON livro_autor.autor_id = autor.id
                  WHERE livros.id = $id
                  GROUP BY livros.id";
    $result_livro = $conn->query($sql_livro);

    if ($result_livro->num_rows > 0) {
        $row_livro = $result_livro->fetch_assoc();

        // Consulta SQL para obter todos os comentários sobre o livro, incluindo informações do usuário
        $sql_comentarios = "SELECT comentarios.comentario, user.user AS nome_usuario, comentarios.data
                            FROM comentarios
                            INNER JOIN user ON comentarios.user_id = user.id
                            WHERE comentarios.livro_id = $id";
        $result_comentarios = $conn->query($sql_comentarios);

        echo '
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="stylesheet" href="./css/mais.css">
            <title>Detalhes do Livro</title>
        </head>
        <body>
            <div class="card">
                <img src="' . $row_livro['image'] . '">
                <h2>' . $row_livro['titulo'] . '</h2>
                <p>Autores: ' . $row_livro['autores'] .'</p>
                <p>Gênero: ' . $row_livro['genero'] .'</p>
                <p>Sinopse: ' . $row_livro['sinopse'] . '</p>
                <div class="buttons">
                ';
                if (!isset($_SESSION["id"])) {
                    echo "<a href='./user.php' class='button download-button'>login</a>";
                } else {
                    echo "<a href='" . $row_livro['link'] . "' class='button download-button'> Baixar</a>";
                }
                echo'</div>
            </div>';

            if (!isset($_SESSION["id"])) {
            } else {
                echo '<h3>Faça um comentário:</h3>
                <form action="./protect/adiciona/adicionar_comentario.php" method="post">
                    <input type="hidden" name="livro_id" value="' . $id . '">
                    <textarea name="novo_comentario" rows="4" cols="50"></textarea>
                    <input type="submit" value="Adicionar Comentário">
                </form>';
            }
            echo'<h3>Comentários:</h3>
            <ul class="comentarios">';

            // Exibir todos os comentários e informações do usuário
            while ($row_comentario = $result_comentarios->fetch_assoc()) {
                echo '
                <ul class="comentarios">
                    <li class="comentario">
                        <strong>' . $row_comentario['nome_usuario'] . ':<br></strong>' . $row_comentario['comentario'].'
                        <p class="data">' . $row_comentario['data'] . '</p>
                    </li>';
            }

            echo '</ul>
            <br><br><br><br><br><br><br>
        </body>
        </html>';
    } else {
        echo "Livro não encontrado.";
    }
} else {
    echo "ID do livro não fornecido na URL.";
}

include('./footer.php');
?>
