<?php
include('./menu_adm.php');
include('../protect/db.php');


// Verificar se o formulário foi submetido
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
        header("Location: ../detalhes_livro.php?id=" . $livro_id);
    } else {
        echo "Erro ao inserir o comentário: " . $conn->error;
    }
} else {
    // Consulta para obter todos os comentários de todos os livros
    $sql = "SELECT comentarios.id as comentario_id, comentarios.comentario, comentarios.data, user.user as autor_nome
            FROM comentarios
            INNER JOIN user ON comentarios.user_id = user.id
            ORDER BY comentarios.data DESC";

    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tabela.css">
    <title>Comentários de Todos os Livros</title>
</head>
<body>
<?php
    if ($result->num_rows > 0) {
        echo "<div class='container mt-4'>";
        echo "<table class='table'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Autor do Comentário</th>";
        echo "<th>Comentário</th>";
        echo "<th>Data do Comentário</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["comentario_id"] . "</td>";
            echo "<td>" . $row["autor_nome"] . "</td>";
            echo "<td>" . $row["comentario"] . "</td>";
            echo "<td>" . $row["data"] . "</td>";
            echo "<td>";
            echo "<form action='../protect/delet/deletar_comentario.php' method='post'>";
            echo "<input type='hidden' name='comentario_id' value='" . $row["comentario_id"] . "'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>Deletar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "Nenhum comentário encontrado.";
    }

    // Fechar a conexão
    $conn->close();
}
?>
</body>
</html>
