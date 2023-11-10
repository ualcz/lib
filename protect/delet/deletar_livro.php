<?php
// Verifique se o ID do livro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["livro_id"])) {
    // Conexão com o banco de dados
    include('../db.php');

    // Obtenha o ID do livro a ser excluído
    $livro_id = $_POST["livro_id"];

    // Inicie uma transação para garantir a consistência dos dados
    $conn->begin_transaction();

    try {
        // Consulta SQL para obter o nome do arquivo PDF e da imagem associados ao livro
        $sql_arquivos = "SELECT link, image FROM livros WHERE id = $livro_id";
        $result = $conn->query($sql_arquivos);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Caminho para os arquivos de upload
            $caminho_upload = "../.";

            // Exclua o arquivo PDF
            $pdf_path = $caminho_upload . $row["link"];
            if (file_exists($pdf_path)) {
                unlink($pdf_path);
            }

            // Exclua a imagem
            $imagem_path = $caminho_upload . $row["image"];
            if (file_exists($imagem_path)) {
                unlink($imagem_path);
            }
        }

        // Consulta SQL para excluir registros correspondentes na tabela autor_livro
        $sql_autor_livro = "DELETE FROM livro_autor WHERE livro_id = $livro_id";

        // Executar a consulta para excluir na tabela autor_livro
        if ($conn->query($sql_autor_livro) === FALSE) {
            throw new Exception("Erro ao excluir registros na tabela autor_livro: " . $conn->error);
        }

        // Consulta SQL para excluir o livro
        $sql_livro = "DELETE FROM livros WHERE id = $livro_id";

        // Executar a consulta para excluir o livro
        if ($conn->query($sql_livro) === FALSE) {
            throw new Exception("Erro ao excluir o livro: " . $conn->error);
        }

        // Commit se tudo ocorrer sem erros
        $conn->commit();

        // Livro excluído com sucesso, redirecione de volta à página de exibição de livros
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollback();

        // Exibir mensagem de erro
        echo "Erro: " . $e->getMessage();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // Redirecionar se o ID do livro não foi enviado
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>
