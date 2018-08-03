<?php

require "cabecalho.php";
require "config.php";
session_start();
if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
	$usuario = addslashes($_POST['usuario']);
	$senha = md5(addslashes($_POST['senha']));

	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario and senha = :senha");
	$sql->bindValue(":usuario", $usuario);
	$sql->bindValue(":senha", $senha);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql = $sql->fetchAll();
		foreach ($sql as $tipo) {
			
		$_SESSION['id'] = $tipo['id'];
		$_SESSION['perfil'] = $tipo['perfil'];
		$_SESSION['user']   = $tipo['usuario'];
		}
   	    header("Location: index.php?msn=0");
	}
	else{
		?>
    <label class="btn btn-danger form-control"><?php echo "Usuário não existe";?></label>
<?php		
	}
}
?>
<form method="POST">
	<legend>Téo Nota-10</legend>

	<div class="form-group">
		<label class="fa fa-user">&ensp;Usuário</label>
		<input type="text" class="form-control" name="usuario" placeholder="LOGIN">
	</div>
	<div class="form-group">
		<label class="fa fa-unlock">&ensp;Senha</label>
		<input type="password" class="form-control" name="senha" placeholder="SENHA">
	</div>

	<button type="submit" class="btn btn-primary fa fa-sign-in">&ensp;Logar</button>
</form>

<?php
require "rodape.php";
?>