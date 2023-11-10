<?php
include('./menu_adm.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tabela.css">
    <title>Cadastro de Livro</title>
    <style>
        td{
            max-width:200px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <form action="../protect/adiciona/adicionar_cadastro_livro.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="">
                <label>ID</label>
            </div>
            <div class="">
                <label>Título:</label>
                <input name="titulo" required type="text" class="form-control">
            </div>
            <div class="">
                <label>Gênero:</label>
                <input name="genero" required type="text" class="form-control">
            </div>
            <div class="">
                <label>Sinopse:</label>
                <input name="sinopse" required type="text" class="form-control">
            </div>
            <div class="">
                <label>Autor:</label>
                <select name="autor_ids[]" id="autor_ids" class="form-control" multiple required>
                    <?php
                    // Conexão com o banco de dados
                    include('../protect/db.php');

                    // Consulta SQL para obter os nomes dos autores
                    $sql = "SELECT id, nome FROM autor";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="">
                <label for="pdfFile">PDF:</label>
                <input type="file" name="pdfFile" accept=".pdf" class="form-control-file">
            </div>
            <div class="">
                <label for="imageFile">Imagem:</label>
                <input type="file" name="imageFile" id="imageFile" class="form-control-file">
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Autores</th>
            <th>editar</th>
            <th>deletar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Conexão com o banco de dados
        include('../protect/db.php');

        // Consulta SQL para obter todos os livros e seus autores
        $sql = "SELECT livros.id, livros.titulo, livros.genero, livros.sinopse, GROUP_CONCAT(autor.nome SEPARATOR ', ') AS autores
        FROM livros
        LEFT JOIN livro_autor ON livros.id = livro_autor.livro_id
        LEFT JOIN autor ON livro_autor.autor_id = autor.id
        GROUP BY livros.id";

        $result = $conn->query($sql);

        // Verifica se há resultados
        if ($result->num_rows > 0) {
            // Exibe os dados em uma tabela
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['titulo']}</td>
                        <td>{$row['genero']}</td>
                        <td>{$row['autores']}</td>
                        <td>
                            <form action='./editar_livro.php' method='post' style='display: inline;'>
                                <input type='hidden' name='livro_id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-warning btn-sm'>Editar</button>
                            </form>
                        </td>
                        <td>
                            <form action='../protect/delet/deletar_livro.php' method='post' style='display: inline;'>
                                <input type='hidden' name='livro_id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm'>Excluir</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum livro encontrado.</td></tr>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
