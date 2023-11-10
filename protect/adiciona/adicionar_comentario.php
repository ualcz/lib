<?php
include('../db.php');
session_start();

if (!isset($_SESSION["id"])) {
    $livro_id = $_POST['livro_id'];
    header("Location: ../../detalhes_livro.php?id=" . $livro_id);
} else {
    
  
   


    // Verifique se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os dados do formulário
        $livro_id = $_POST['livro_id'];
        $novo_comentario = $_POST['novo_comentario'];

        // Obtenha o ID do usuário (você deve implementar a lógica para isso)
        $usuario_id = $_SESSION['id']; // Substitua 'id' pelo nome da variável que armazena o ID do usuário

        // Obtenha a data atual
        $data_comentario = date("Y-m-d H:i:s"); // Data no formato MySQL

        // Valide os dados, se necessário

        // Insira o novo comentário na tabela "comentarios" com o ID do usuário e a data
        $sql = "INSERT INTO comentarios (livro_id, user_id, comentario, data) 
                VALUES ('$livro_id', '$usuario_id', '$novo_comentario', '$data_comentario')";

        if ($conn->query($sql) === TRUE) {
            // Comentário inserido com sucesso
            header("Location: ../../detalhes_livro.php?id=" . $livro_id);
        } else {
            echo "Erro ao inserir o comentário: " . $conn->error;
        }
    } else {
        echo "Acesso inválido a esta página.";
    }
}
?>
