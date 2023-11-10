<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION["id"])) {
    header("Location: ./login.php");
    exit();
}

// Dados do usuário
$nome = $_SESSION["nome"];
$data = $_SESSION["data"];
$admin = $_SESSION["admin"];
$email = $_SESSION["email"];

// Página HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Adicione estilos personalizados aqui, se necessário */
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Informações do Usuário</h1>

    <div class="card mb-4" id="infoCard">
        <div class="card-body">
            <p class="card-text"><strong>Nome:</strong> <?php echo $nome; ?></p>
            <p class="card-text"><strong>Data de Registro:</strong> <?php echo $data; ?></p>
            <p class="card-text"><strong>Email:</strong> <?php echo $email; ?></p>

            <?php
            if ($admin == 2) {
                echo "<p class='card-text'><strong>Função:</strong> Administrador</p>
                    <div class='btn-group' role='group'>
                        <a href='./admin/autor.php' class='btn btn-success'><ion-icon name='shield'></ion-icon>Área Admin</a>
                    </div>
                    <div class='btn-group' role='group'>
                        <a href='./index.php' class='btn btn-primary'>Área Usuário</a>
                    </div><br>";
            }
            ?>
            <button class="btn btn-primary mt-3" onclick="toggleForm()">Editar Informações</button><br><br>
            <a href="./protect/logout.php" class="btn btn-danger">Encerrar Sessão</a>
        </div>
    </div>

    <!-- Formulário de Edição -->
    <div class="card" id="formCard" style="display: none;">
        <div class="card-body">
            <h5 class="card-title">Editar Informações</h5>
            <form action="./protect/user/atualizar_usuario.php" method="post">
                <!-- Campos de edição -->
                <div class="form-group">
                    <label for="editNome">Novo Nome:</label>
                    <input type="text" class="form-control" id="editNome" name="editNome" placeholder="Novo Nome" value="<?php echo $nome; ?>">
                </div>
                <div class="form-group">
                    <label for="editEmail">Novo Email:</label>
                    <input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Novo Email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="editSenha">Nova Senha:</label>
                    <input type="password" class="form-control" id="editSenha" name="editSenha" placeholder="Nova Senha">
                </div>

                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <button type="button" class="btn btn-secondary ml-2" onclick="cancelarEdicao()">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function toggleForm() {
        var formCard = document.getElementById('formCard');
        var infoCard = document.getElementById('infoCard');

        formCard.style.display = (formCard.style.display === 'none') ? 'block' : 'none';
        infoCard.style.display = (infoCard.style.display === 'none') ? 'block' : 'none';
    }

    function cancelarEdicao() {
        toggleForm();
    }
</script>
</body>
</html>
