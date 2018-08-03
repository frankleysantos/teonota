<meta charset="utf-8">
<?php 
session_start();
$login = $_SESSION['id'];
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=notas_cadastradas.xls");
header("Pragma: no-cache");
require "config.php";
 $sql = $pdo -> prepare("SELECT c.id, c.Nome, c.CPF, c.Cod_Ver_Nota, c.Valor_Nota, c.Insercao, p.cupom, p.atualizacao FROM concorrentes as c INNER JOIN premiacao as p WHERE c.id = p.id_concorrente");
 $sql -> execute();
 $count = 0;
    if ($sql -> rowCount() > 0 ) {
        $sql = $sql -> fetchAll();       
?>
<div class="form-control">
<h1>Lista de Notas cadastradas</h1>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Nome</th>
			<th>CPF</th>
			<th>Cod. Verificação</th>
			<th>Valor</th>
			<th>Inserção</th>
			<th>Cupom</th>
			<th>Atualização</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sql as $notas) {  
  $count +=1;
?>
		<tr>
			<td><?php echo $notas['Nome'];?></td>
			<td><?php echo $notas['CPF'];?></td>
			<td><?php echo $notas['Cod_Ver_Nota'];?></td>
			<td><?php echo $notas['Valor_Nota'];?></td>
			<td><?php echo $notas['Insercao']?></td>
			<td><?php echo $notas['cupom'];?></td>
			<td><?php echo $notas['atualizacao']?></td>
		</tr>
	</tbody>

<?php
         }
}
?>
 </table>
 </div>
 <?php
 }else{
 	header("Location: login.php");
 }
 ?>