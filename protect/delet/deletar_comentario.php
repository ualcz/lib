<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario_id = $_POST["comentario_id"];

    // Verificar se o usuário tem permissão para excluir o comentário (você pode adicionar lógica de verificação aqui)

    // Excluir o comentário do banco de dados
    $sql = "DELETE FROM comentarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comentario_id);

    if ($stmt->execute()) {
        // Comentário excluído com sucesso, redirecionar para a página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Se ocorrer um erro na execução da consulta, exibir mensagem de erro
        echo "Erro ao excluir o comentário. Tente novamente.";
    }

    // Fechar a instrução preparada
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>
