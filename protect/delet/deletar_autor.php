<?php
// Verifique se o ID do autor foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["autor_id"])) {
    // Conexão com o banco de dados
    include('../db.php');

    // Obtenha o ID do autor a ser excluído
    $autor_id = $_POST["autor_id"];

    // Inicie uma transação para garantir consistência
    $conn->begin_transaction();

    try {
        // Consulta SQL para excluir os registros associados na tabela autor_livro
        $sql_delete_livros = "DELETE FROM livro_autor WHERE autor_id = $autor_id";
        $conn->query($sql_delete_livros);

        // Consulta SQL para excluir o autor
        $sql_delete_autor = "DELETE FROM autor WHERE id = $autor_id";
        $conn->query($sql_delete_autor);

        // Confirme a transação se todas as consultas foram bem-sucedidas
        $conn->commit();

        // Autor excluído com sucesso, redirecione de volta à página de exibição de autores
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } catch (Exception $e) {
        // Se ocorrer um erro, reverta a transação
        $conn->rollback();

        // Exiba uma mensagem de erro
        echo "Erro ao excluir o autor: " . $e->getMessage();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // Redirecionar se o ID do autor não foi enviado
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>
