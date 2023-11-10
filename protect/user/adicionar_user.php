<?php
include ('../db.php');

$nome = $_POST['username'];
$senha = $_POST['senha'];
$email= $_POST["email"];

// Aplica MD5 à senha
$senha_md5 = md5($senha);
$adm=1;

$sql = "INSERT INTO user VALUES (NULL, '$nome','$email','$adm', '$senha_md5', now());";

if (mysqli_query($conn, $sql)) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
