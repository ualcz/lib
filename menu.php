<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/menu.css" />
</head>
<body>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

    <header>
        <div class="header-top">
            <div class="logo">
                <div class="log"><a href="./index.php">Lib Seabra</a></div>
            </div>


            <form action="./pesquisar_livros.php" method="GET">
                <input type="text" name="search" placeholder="Buscar por título, autor ou gênero..." />    
            </form>

            <div class="welcome">

                <div class="navbar">
                    <nav>
                            <?php
                            session_start();
                            
                            if (!isset($_SESSION["id"])) {
                                
                                // O usuário não está logado, então exiba os links de login/cadastro
                                echo ' <div class="welcome-text-link">
                                <div class="welcome-link">
                                    <a href="./login.php">Entre</a>
                                </div>
                            </div>';
                            }
                            else {
                                $nome = $_SESSION["nome"];
                                echo ' <div class="welcome-text-link">
            
                                <div class="welcome-link">
                                    <a href="./user.php"><ion-icon name="person-circle" style="font-size: 3rem;"></ion-icon></a>
                                </div>
                            </div>';
                               
                            }
                        
                        
                            ?>
            
                </div>
            </div>
        </div>
        </div>

    </header>
</body>
</html>