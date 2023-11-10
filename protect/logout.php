<?php
session_start();

// Encerra a sessão
session_destroy();

// Redireciona para a página de login (ou qualquer outra página após o logout)
header("Location: ../index.php");
exit();
?>
