<?php
include('../protect/db.php');
include('./menu_adm.php');

$sql = "SELECT autor.id AS autor_id, autor.nome AS autor_nome, autor.nacionalidade, autor.sexo, 
               GROUP_CONCAT(livros.titulo ORDER BY livros.titulo SEPARATOR ', ') AS livros
        FROM autor
        LEFT JOIN livro_autor ON autor.id = livro_autor.autor_id
        LEFT JOIN livros ON livro_autor.livro_id = livros.id
        GROUP BY autor.id";

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

<div class="container mt-4">
    <form action="../protect/adiciona/adicionar_autor.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="">
                <label for="nacionalidade" class="form-label">Nacionalidade:</label>
                <input type="text" name="nacionalidade" id="nacionalidade" class="form-control" required>
            </div>
            <div class="">
                <label>Sexo:</label>
                <select name="sexo" class="form-control">
                    <option selected value="0">Sexo</option>
                    <option value='M'>Masculino</option>
                    <option value='F'>Feminino</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
            </div>
        </div>
    </form>

    <?php
    if ($result->num_rows > 0) {
        echo "<div class='container mt-4'>";
        echo "<table class='table'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>Autor ID</th>";
        echo "<th>Nome do Autor</th>";
        echo "<th>Nacionalidade</th>";
        echo "<th>Sexo</th>";
        echo "<th>Título do Livro</th>";
        echo "<th>Editar</th>";
        echo "<th>Excluir</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["autor_id"] . "</td>";
            echo "<td>" . $row["autor_nome"] . "</td>";
            echo "<td>" . $row["nacionalidade"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["livros"] . "</td>";
            echo "<td>
                    <form action='./editar_autor.php' method='post' style='display: inline;'>
                        <input type='hidden' name='autor_id' value='{$row['autor_id']}'>
                        <button type='submit' class='btn btn-warning btn-sm'>Editar</button>
                    </form>
                </td>
                <td>
                    <form action='../protect/delet/deletar_autor.php' method='post' style='display: inline;'>
                        <input type='hidden' name='autor_id' value='{$row['autor_id']}'>
                        <button type='submit' class='btn btn-danger btn-sm'>Excluir</button>
                    </form>
                </td>
                </tr>";
        }

        echo "</tbody>";
        echo "</table></div>";
    } else {
        echo "Nenhum autor encontrado.";
    }
    ?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
