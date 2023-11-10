<?php
// Verifique se um arquivo PDF foi enviado
if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK &&
    isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
    
    // Caminho para onde as imagens serão armazenadas (altere para o seu diretório)
    $UploadDir = './upload/';


    // Limpe o título para criar um nome de arquivo seguro
    $cleanedTitulo = preg_replace('/[^a-zA-Z0-9]/','_','');

    // Gere um nome de arquivo único para evitar conflitos para o PDF
    $pdfFileName = $cleanedTitulo . '_' . uniqid() . '_' . basename($_FILES['pdfFile']['name']);

    // Gere um nome de arquivo único para evitar conflitos para a imagem
    $imageFileName = $cleanedTitulo . '_' . uniqid() . '_' . basename($_FILES['imageFile']['name']);

    $pdfFilePath = $UploadDir . $pdfFileName;
    $imageFilePath = $UploadDir . $imageFileName;


    // Mova o arquivo PDF para o diretório de destino
    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'],'../.'.$pdfFilePath) &&
        move_uploaded_file($_FILES['imageFile']['tmp_name'],'../.'. $imageFilePath)) {
        
        // Conecte-se ao banco de dados
        include('../db.php');
        // Receba o ID do autor do campo oculto
        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];
        $autor_ids = $_POST['autor_ids'];
        $sinopse = $_POST['sinopse'];
        

 

        // Inserir o caminho do arquivo PDF e imagem na tabela de livros
        $sqlLivro = "INSERT INTO livros (titulo,genero, link, image, sinopse) VALUES (?, ?, ?, ?, ?)";
        $stmtLivro = $conn->prepare($sqlLivro);
        $stmtLivro->bind_param("sssss", $titulo,$genero, $pdfFilePath, $imageFilePath, $sinopse);
        $stmtLivro->execute();

        if ($stmtLivro->affected_rows > 0) {
            $livro_id = $stmtLivro->insert_id;

            // Agora, insira os autores associados ao livro na tabela livro_autor
            foreach ($autor_ids as $autor_id) {
                $sqlLivroAutor = "INSERT INTO livro_autor (livro_id, autor_id) VALUES (?, ?)";
                $stmtLivroAutor = $conn->prepare($sqlLivroAutor);
                $stmtLivroAutor->bind_param("ii", $livro_id, $autor_id);
                $stmtLivroAutor->execute();

                if (!$stmtLivroAutor->affected_rows > 0) {
                    echo "Erro ao associar autor ao livro.";
                    break;
                }
            }

            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            echo "Erro ao cadastrar o livro.";
        }

        $stmtLivro->close();
        $conn->close();

    } else {
        echo "Erro ao mover o arquivo para o servidor.";
    }
} else {
    echo "Erro no envio do arquivo PDF ou imagem.";
}
?>
