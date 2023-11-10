<?php
// Conexão com o banco de dados
include('../db.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $autor_id = $_POST['autor_id'];
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $sexo = $_POST['sexo'];

    // Atualizar as informações do autor no banco de dados
    $sql = "UPDATE autor SET nome='$nome', nacionalidade='$nacionalidade', sexo='$sexo' WHERE id=$autor_id";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de autores com uma mensagem de sucesso
        header("Location:{$_SERVER['HTTP_REFERER']}");
    
    } else {
        // Redirecionar para a página de erro com uma mensagem de erro
        header("Location: {$_SERVER['HTTP_REFERER']}");
        
    }
} else {
    // Se o formulário não foi enviado, redirecionar para a página de erro
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
