<?php
include('./menu_adm.php');

// Conexão com o banco de dados
include('../protect/db.php');

// Verificar se um autor foi selecionado para edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['autor_id'])) {
    $autor_id = $_POST['autor_id'];

    // Consulta SQL para obter as informações do autor
    $sqlAutor = "SELECT * FROM autor WHERE id = '$autor_id'";
    $resultAutor = $conn->query($sqlAutor);

    if ($resultAutor->num_rows > 0) {
        $autor = $resultAutor->fetch_assoc();
    } else {
        // Autor não encontrado, redirecionar ou exibir uma mensagem de erro
        header("Location:./autor.php");
        exit();
    }

    // Consulta SQL para obter os livros relacionados ao autor
    $sqlLivros = "SELECT l.id as livro_id, l.titulo FROM livros l
                  JOIN livro_autor al ON l.id = al.livro_id
                  WHERE al.autor_id = '$autor_id'";
    $resultLivros = $conn->query($sqlLivros);
} else {
    // Nenhum autor selecionado, redirecionar ou exibir uma mensagem de erro
    header("Location:./autor.php");
    exit();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tabela.css">
    <title>Editar Autor</title>
</head>
<body>

<div class="container mt-4">
    <form action="../protect/atualizar/editar_autor_processar.php" method="post">
        <input type="hidden" name="autor_id" value="<?php echo $autor['id']; ?>">

        <div class="form-row">
            <!-- Campos para editar as informações do autor -->
            <div class="col-md-4 mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $autor['nome']; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="nacionalidade" class="form-label">Nacionalidade:</label>
                <input type="text" name="nacionalidade" id="nacionalidade" class="form-control" value="<?php echo $autor['nacionalidade']; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" class="form-control">
                    <option value="M" <?php echo ($autor['sexo'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo ($autor['sexo'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary mt-2">Salvar Edições</button>
            </div>
        </div>
    </form>

    <!-- Exibir os livros relacionados ao autor em uma tabela -->
    <h2>Livros Relacionados</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $rowClass = ''; ?>
                <?php while ($livro = $resultLivros->fetch_assoc()) { ?>
                    <?php $rowClass = ($rowClass == 'even') ? 'odd' : 'even'; ?>
                    <tr class="<?php echo $rowClass; ?>">
                        <td><?php echo $livro['livro_id']; ?></td>
                        <td><?php echo $livro['titulo']; ?></td>
                        <td>
                            <a href="../protect/delet/excluir_relacao_autor_livro.php?autor_id=<?php echo $autor['id']; ?>&livro_id=<?php echo $livro['livro_id']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Excluir Relação
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>

</body>
</html>
