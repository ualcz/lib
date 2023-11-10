<?php 
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: ../index.php");                       
    }
    $privilege = $_SESSION["admin"];
    if ($privilege == 1) {
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Adicione esta classe personalizada para a cor de fundo mais escura */
        .navbar-dark-custom {
            background-color: #215BA8; /* Substitua pela cor desejada */
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <!-- Adicione a classe personalizada à barra de navegação -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-dark-custom">
            <a class="navbar-brand text-white" href="#">Lib Seabra</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mr-3">
                        <a class="nav-link text-white" href="./gerenciar_cometarios.php">Comentário</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link text-white" href="./livro.php">Livros</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link text-white" href="./autor.php">Autor</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link text-white" href="./gerenciar_user.php">Usuários</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../user.php"><ion-icon name="person-circle" style="font-size: 2rem;"></ion-icon></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
