<?php
include("../db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha = $_POST["senha"];
    $email= $_POST["email"];

    $password = md5($senha);

    // Preparar a consulta SQL com instruções preparadas
    $sql = "SELECT * FROM user WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // As credenciais são válidas, o usuário está autenticado
    
        $user = $result->fetch_assoc(); // Obter os dados do usuário do resultado da consulta

        $_SESSION["nome"]=$user['user'];
        $_SESSION["data"]=$user['data'];
        $_SESSION["admin"]=$user['admin'];
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $user['id'] ;

         // Configurar a variável de sessão para indicar que o usuário está logado
    
        
            header("Location: ../../index.php"); // Redirecionar para a página do painel padrão após o login bem-sucedido

        
        exit();
    } else {
        // Credenciais inválidas, exibir mensagem de erro
        echo "Credenciais inválidas. Tente novamente.";
    }    

    // Fechar a instrução preparada e a conexão
    $stmt->close();
    $conn->close();
}
?>
