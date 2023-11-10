<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../login.php");
    exit();
}

include('../db.php');

$usuario_id = $_SESSION["id"];
$editNome = $_POST['editNome'];
$editEmail = $_POST['editEmail'];
$editSenha = md5($_POST['editSenha']);

$sql = "UPDATE user SET user='$editNome', email='$editEmail', senha='$editSenha' WHERE id=$usuario_id";

if ($conn->query($sql) === TRUE) {
    $_SESSION["nome"] = $editNome;
    $_SESSION["email"] = $editEmail;
    header("Location:  {$_SERVER['HTTP_REFERER']}");
} else {
    echo "Erro ao atualizar informações: " . $conn->error;
}

$conn->close();
?>
