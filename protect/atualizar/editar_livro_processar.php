<?php
// Conexão com o banco de dados
include('../db.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $livro_id = $_POST['livro_id'];
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $sinopse = $_POST['sinopse'];
    $autor_id = $_POST['autor_id'];

    // Atualizar as informações do livro no banco de dados
    $sql = "UPDATE livros SET titulo='$titulo', genero='$genero',  sinopse='$sinopse', WHERE id=$livro_id";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de livros com uma mensagem de sucesso
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Redirecionar para a página de erro com uma mensagem de erro
        header("Location:  {$_SERVER['HTTP_REFERER']}");
        exit();
    }
} else {
    // Se o formulário não foi enviado, redirecionar para a página de erro
    header("Location:  {$_SERVER['HTTP_REFERER']}");
    exit();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
