<script type="text/javaScript">
function Trim(str){
	return str.replace(/^\s+|\s+$/g,"");
}
</script>
<?php 
session_start();
require "cabecalho.php";
require "config.php";
$login = $_SESSION['id'];
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	
	if (!empty($_GET['msn']) && isset($_GET['msn'])) {
		$alterado = $_GET['msn'];
		echo "<label class='form-control btn btn-info'>".$alterado."</label>";
		# code...
	}
?>
<form action="buscar_nota.php" method="POST" role="form">
	<legend>Bem Vindo a tela de consulta da Nota Fiscal.</legend>

	<div class="form-group">
		<label class="fa fa-list">&ensp;Código de Verificação da Nota</label>
		<input type="text" class="form-control" name="Cod_Ver_Nota" placeholder="Inserir Código Verificação" onkeyup="this.value = Trim( this.value ); maiuscula(this);" maxlength="19" onkeypress="codVer(this);">
	</div>
	<button type="submit" class="btn btn-primary fa fa-search">&ensp;Buscar</button>
</form>
<div>
	<label>
	Após inserir o Código de Verificação, você será encaminhado para tela de cadastro ou para tela da nota cadastrada.
	</label>
</div>
<?php    
}
else{
    header("Location: login.php");
}
require "rodape.php";
?>
