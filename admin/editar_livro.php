<?php
include('./menu_adm.php');
include('../protect/db.php');

// Verificar se um livro foi selecionado para edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['livro_id'])) {
    $livro_id = $_POST['livro_id'];

    // Consulta SQL para obter as informações do livro
    $sqlLivro = "SELECT * FROM livros WHERE id = '$livro_id'";
    $resultLivro = $conn->query($sqlLivro);

    if ($resultLivro->num_rows > 0) {
        $livro = $resultLivro->fetch_assoc();
    } else {
        // Livro não encontrado, redirecionar ou exibir uma mensagem de erro
        header("Location:./livro.php");
        exit();
    }
} else {
    // Nenhum livro selecionado, redirecionar ou exibir uma mensagem de erro
    header("Location:./livro.php");
    exit();
}

// Consulta SQL para obter todos os autores (para a lista suspensa)
$sqlTodosAutores = "SELECT * FROM autor";
$resultTodosAutores = $conn->query($sqlTodosAutores);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tabela.css">
    <title>Editar Livro</title>
</head>
<body>

<div class="container mt-4">
    <form action="../protect/atualizar/editar_livro_processar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="livro_id" value="<?php echo $livro['id']; ?>">

        <div class="form-row">
            <!-- Campos para editar as informações do livro -->
            <div class="col-md-3 mb-3">
                <label>Título:</label>
                <input name="titulo" required type="text" class="form-control" value="<?php echo $livro['titulo']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label>Gênero:</label>
                <input name="genero" required type="text" class="form-control" value="<?php echo $livro['genero']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label>Sinopse:</label>
                <input name="sinopse" required type="text" class="form-control" value="<?php echo $livro['sinopse']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="pdfFile">PDF:</label>
                <input type="file" name="pdfFile" accept=".pdf" class="form-control-file">
            </div>
            <div class="col-md-6 mb-3">
                <label for="imageFile">Imagem:</label>
                <input type="file" name="imageFile" id="imageFile" class="form-control-file">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary mt-2">Salvar Edições</button>
            </div>
        </div>
    </form>
    <!-- Adicionar um novo autor -->
    <form action="../protect/adiciona/inserir_relacao_autor_livro.php" method="post">
        <input type="hidden" name="livro_id" value="<?php echo $livro['id']; ?>">

        <div class="form-row">
            <div class="col-md-8 mb-3">
                <select name="novoAutor" id="novoAutor" class="form-control" required>
                    <?php while ($rowAutor = $resultTodosAutores->fetch_assoc()) { ?>
                        <option value="<?php echo $rowAutor['id']; ?>"><?php echo $rowAutor['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-success mt-2">Adicionar</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
