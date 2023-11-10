<?php
include('../db.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $livro_id = $_POST['livro_id'];
    $novoAutor_id = $_POST['novoAutor'];

    // Verificar se a relação autor-livro já existe
    $sqlVerificar = "SELECT * FROM livro_autor WHERE livro_id = '$livro_id' AND autor_id = '$novoAutor_id'";
    $resultVerificar = $conn->query($sqlVerificar);

    if ($resultVerificar->num_rows == 0) {
        // Inserir a nova relação autor-livro
        $sqlInserir = "INSERT INTO livro_autor (autor_id, livro_id) VALUES ('$novoAutor_id', '$livro_id')";

        if ($conn->query($sqlInserir) === TRUE) {
            // Redirecionar para a página do livro com uma mensagem de sucesso
            header("Location:  {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            // Redirecionar para a página de erro com uma mensagem de erro
            header("Location: ../pagina_de_erro.php");
            exit();
        }
    } else {
        // Relação autor-livro já existe, redirecionar para a página do livro com uma mensagem
        header("Location: ../caminho_da_sua_pagina_do_livro.php?mensagem=RelacaoJaExiste");
        exit();
    }
} else {
    // Se o formulário não foi enviado, redirecionar para a página de erro
    header("Location: ../pagina_de_erro.php");
    exit();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
