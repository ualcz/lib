<?php
include('./menu_adm.php');
include("../protect/db.php");

// Verificar se o usuário está autenticado como administrador
if ($_SESSION["admin"] != 2) {
    // Se não for um administrador, redirecionar para a página padrão
    header("Location: ../index.php");
    exit();
}

// Consulta SQL para obter todos os usuários e suas informações
$sql = "SELECT id, user, data, admin FROM user";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tabela.css">
    <title>Cadastro de Autor</title>
</head>
<body>
<?php
// Verificar se há resultados
if ($result->num_rows > 0) {
    echo "<div class='container mt-4'>";
    echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nome</th>";
    echo "<th>Data</th>";
    echo "<th>Administrador</th>";
    echo "<th>Ações</th>"; // Nova coluna para os botões de ação
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop através dos resultados e exibir cada linha na tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user"] . "</td>";
        echo "<td>" . $row["data"] . "</td>";
        echo "<td>" . ($row["admin"] == 2 ? "Sim" : "Não") . "</td>";
        echo "<td>";
        
        // Adicionar botões de ação
        if ($row["admin"] == 2) {
            echo "<form action='../protect/user/remover_admin.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>Remover Admin</button>";
            echo "</form>";
        } else {
            echo "<form action='../protect/user/promover_admin.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='btn btn-success btn-sm'>Promover Admin</button>";
            echo "</form>";
        }

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "Nenhum usuário encontrado.";
}

// Fechar a conexão
$conn->close();
?>
</body>
</html>
