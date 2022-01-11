<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<title>Fast Pizza</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../config/mainScript.js"></script>
	<link rel="stylesheet" type="text/css" href="../config/style-dark.css">
	<link rel="icon" type="imagem/png" href="../img/logo.png" />

</head>

<body>
		<div class="logo-inicial" id="logo-inicial">
			<img src="../img/logo.png">
		</div>

		<div class="container" id="form-login">
			<form method="post" action="acoes/login.php">
				<input type="text" id="login-email" name="email" placeholder="E-mail">
				<input type="password" id="login-senha" name="senha" placeholder="Senha">
				<input type="submit" id="entrar" value="Entrar">
			</form>
		</div>

	<footer>
		Fast Pizza® | 2019
	</footer>
</body>

</html>