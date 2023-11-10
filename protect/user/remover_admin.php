<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["id"];

    // Atualizar o banco de dados para definir o status de administrador para 1
    $sql = "UPDATE user SET admin = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Atualização bem-sucedida, redirecionar de volta para a página de usuários
        header("Location:  {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Se ocorrer um erro na execução da consulta, exibir mensagem de erro
        echo "Erro ao remover status de administrador. Tente novamente.";
    }

    // Fechar a instrução preparada
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>
