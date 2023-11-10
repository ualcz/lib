<?php
include ('../db.php');

// Receber os dados do formulário
$nome = $_POST['nome'];
$nacionalidade = $_POST['nacionalidade'];
$sexo = $_POST['sexo'];

// Inserir os dados no banco de dados
$sql = "INSERT INTO autor (nome, nacionalidade, sexo) VALUES ('$nome', '$nacionalidade', '$sexo')";

if ($conn->query($sql) === TRUE) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
} else {
    echo "Erro ao adicionar autor: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
