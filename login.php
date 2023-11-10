
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<link rel="stylesheet" href="./css/login.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="./protect/user/adicionar.php" method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="username" placeholder="Nome" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="Senha" name="senha" placeholder="Senha" required="">
					<a href="login.html"> <button>Sign up</button></a>
				</form>
			</div>

			<div class="login">
				<form action="./protect/user/processar_login.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="Senha" name="senha" placeholder="Senha" required="">
					<a href="login.html"> <button>Sign up</button></a>
				</form>
			</div>
	</div>
</body>
</html>