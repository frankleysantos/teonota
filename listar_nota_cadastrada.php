<?php
require "functions.php";
require "cabecalho.php";
require "config.php";

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && ($_SESSION['perfil'] == 'admin')) {
    $id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM concorrentes WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql ->execute();

    if ($sql -> rowCount() > 0) {
        # code...
        $sql = $sql ->fetch();
?>
<form action="alterar_nota.php" method="POST" role="form">
	<legend>Faça sua Alteração</legend>

	<div class="form-group">
	    <input type="hidden" name="id" value="<?php echo $sql['id'];?>">
	    <label for="Nome"><i class="fa fa-user"></i>&ensp;Nome</label>
		<input type="text" name="Nome" value="<?php echo $sql['Nome'];?>" class="form-control" onkeyup="maiuscula(this)">
		<label for="CPF"><i class="fa fa-list"></i>&ensp;CPF</label>
        <input type="text" name="CPF" value="<?php echo $sql['CPF'];?>" class="form-control" maxlength="12" minlength="11" id="cpf" onblur="return verificarCPF(this.value)">
        <label for="Cod. Verificação"><i class="fa fa-key"></i>&ensp;Cod. Verificação</label>
        <input type="text" name="Cod_Ver_Nota" value="<?php echo $sql['Cod_Ver_Nota'];?>" class="form-control" readonly="readonly">
        <label for="Valor Nota"><i class="fa fa-money"></i>&ensp;Valor Nota</label>
        <input type="text" name="Valor_Nota" value="<?php echo $sql['Valor_Nota'];?>" class="form-control" onkeyup="moeda(this);">
        <!--
        <?php
        $sql2 = $pdo->prepare("SELECT * FROM premiacao WHERE id_concorrente = :id_concorrente");
        $sql2->bindValue(":id_concorrente", $id);
        $sql2 ->execute();

        if ($sql2 -> rowCount() > 0 ) {
            $sql2 = $sql2 ->fetchAll();
            $count = 0;
            foreach ($sql2 as $notas) {  
            $count +=1;
            $dado = $count;
            ?>
            <input type="" name="id_premiacao" value="<?php echo $notas['id'];?>">
            <input type="text" name="count" value="<?php echo $count?>">
            <div class="row">
            <div class="col-md-6">
            <label for="Nº da Sorte">Nº da Sorte</label>
            <?php $numsorte = "numsorte".$dado?>
            <input type="text" name="<?php print_r($numsorte);?>" value="<?php echo $notas['numsorte'];?>" class="form-control">
            </div>
            <div class="col-md-6">
            <label for="Cupom">Cupom</label>
            <?php $cupom = "cupom".$dado?>
            <input type="text" name="<?php print_r($cupom);?>" value="<?php echo $notas['cupom'];?>" class="form-control">
            </div>
            </div>
<?php
        }
        }
        ?>-->
	</div>
	<div class="row">
	<div class="col-md-3">
	<button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i>&ensp;Alterar</button>
	</div>
    <div class="col-md-3"><abbr title="Exclui todos os dados vinculados ao código"><a class="btn btn-danger fa fa-trash-o" href="excluir_dados.php?id=<?=$_GET['id']?>">&ensp;Excluir Nota e Cupons.</a></abbr></div>
    <div class="col-md-3"><abbr title="Listar e Editar Nº Sorte e Cupom"><a class="btn btn-success fa fa-list" href="listar_cupom.php?cod=<?=$sql['Cod_Ver_Nota']?>">&ensp;Editar Cupons</a></abbr></div>
	<div class="col-md-3" align="right">
	<a href="index.php" class="btn btn-success"><i class="fa fa-home"></i>&ensp;Página Inicial</a>
	</div>
    </div>
</form>
<?php
$cod = $sql['Cod_Ver_Nota'];
$sql =  $pdo->prepare("SELECT * FROM premiacao WHERE Cod_Ver_Nota = :Cod_Ver_Nota");
$sql -> bindValue(":Cod_Ver_Nota", $cod);
$sql -> execute();
if ($sql->rowCount() > 0) {
    $sql = $sql->fetchAll();
?>
<table class="table table-striped table-hover" id="ulItens">
    <thead>
        <tr>
            <th><li class="fa fa-key"></li>&ensp;Cod. Verificador</th>
            <th><li class="fa fa-list"></li>&ensp;Cupom</th>
        </tr>
    </thead>
    <tbody>
<?php    
    foreach ($sql as $premiacao) {
?>
    <tr>
        <td><?php echo $premiacao['Cod_Ver_Nota'];?></td>
        <td><?php echo $premiacao['cupom'];?></td>
    </tr>                
<?php 
   }
?>
    </tbody>
</table>
<?php   
}       
    }
}else{
    header("Location: login.php");
}
require "rodape.php";
?>