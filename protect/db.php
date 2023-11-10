<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$bancoDeDados = "lib";

$conn = new mysqli($host, $usuario, $senha, $bancoDeDados);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
