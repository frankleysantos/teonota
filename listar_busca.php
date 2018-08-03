<?php 
session_start();
require "config.php";
require "cabecalho.php";
$login = $_SESSION['id'];

if (!empty($_POST['cod_ver'])) {
	# code...
}
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
 $excluido = $_GET['msn'];
 if (!empty($excluido)) {
 	  echo "<label class='form-control btn btn-danger'>".$excluido."</label>";
 	}	
 $cod_ver = $_GET['cod_ver'];
 ?>
 <div class="col-md-10"><h2>Lista de Cadastros Realizados</h2></div>
 <form action="listar_busca.php?msn=0&cod_ver=0" method="POST" role="form">
 	<div class="row">
 	   <div class="col-md-10">
 		<input type="text" class="form-control" placeholder="CPF ou Cod. Verificador" name="cod_ver">
 		</div>
 		<div class="col-md-1" align="right">
 		<button type="submit" class="btn btn-primary fa fa-search">Buscar</button>
 		</div>
 	</div>
 </form>
 <?php
 if (!empty($_POST['cod_ver'])) {
 	$cod_ver = $_POST['cod_ver'];
 	$str = strlen($_POST['cod_ver']);
 	$sql = $pdo->prepare("SELECT c.id, c.Nome, c.CPF, c.Cod_Ver_Nota, c.Valor_Nota, c.Insercao, p.cupom FROM concorrentes as c INNER JOIN premiacao as p WHERE c.Cod_Ver_Nota = :cod_ver AND c.id = p.id_concorrente OR c.CPF = :cod_ver AND c.id = p.id_concorrente ORDER BY c.id");
 	$sql->bindValue(":cod_ver", $cod_ver);
 	$sql->execute();
 	if ($str == 11 ) {
 	$soma = $pdo->prepare("SELECT SUM(Valor_Nota) AS resultado FROM concorrentes WHERE CPF = :cod_ver");
 	$soma->bindValue(":cod_ver", $cod_ver);
 	$soma->execute();
 	}else{
 	$soma = $pdo->prepare("SELECT SUM(Valor_Nota) AS resultado FROM concorrentes WHERE Cod_Ver_Nota = :cod_ver");
 	$soma->bindValue(":cod_ver", $cod_ver);
 	$soma->execute();
    }
 	if ($soma->rowCount() > 0){
 		$soma = $soma->fetchAll();
 	foreach ($soma as $resultado) {
 		echo "Valor Total é:&ensp;R$&ensp;<label class='btn btn-default'>".$resultado['resultado']."</label>";
 	}
 	}
 	if ($sql->rowCount() > 0) {
 		$sql = $sql->fetchAll();
 		?>
 		<legend>Dados Encontrados</legend>
 		<table class="table table-striped table-hover">
 			<thead>
 				<tr>
 					<th><li class="fa fa-users"></li>&ensp;Nome</th>
			        <th><li class="fa fa-list"></li>&ensp;CPF</th>
			        <th><li class="fa fa-key"></li>&ensp;Cod. Verificador</th>
			        <th><li class="fa fa-money"></li>&ensp;Valor Nota</th>
			        <th><li class="fa fa-list"></li>&ensp;Cupom</th>
			        <th><li class="fa fa-list"></li>&ensp;Data Cadastro</th>
 				</tr>
 			</thead>
 		<?php
 		foreach ($sql as $notas) {
 			$count =+1;
 		?>	
 			<tbody>
 				<tr>
 					<td><?php echo $notas['Nome'];?></td>
			        <td><?php echo $notas['CPF'];?></td>
			        <td><?php echo $notas['Cod_Ver_Nota'];?></td>
			        <td><?php echo $notas['Valor_Nota'];?></td>
			        <td><?php echo $notas['cupom'];?></td>
			        <td><?php echo date("d/m/Y H:i:s", strtotime($notas['Insercao']));?></td>				
			        <?php 
                       if ($_SESSION['perfil'] == 'admin') {
			            ?>				
			        <td><abbr title="Editar dados Pessoais"><a class="btn btn-primary fa fa-pencil-square-o" href="listar_nota_cadastrada.php?id=<?=$notas['id']?>"></a></abbr></td>
			        <?php 
			           }
			        ?>
			        <td><abbr title="Listar e Editar Nº Sorte e Cupom"><a class="btn btn-success fa fa-list" href="listar_cupom.php?cod=<?=$notas['Cod_Ver_Nota']?>"></a></abbr></td>
 				</tr>
 			</tbody>
 		<?php
 		}
 		?>
 		</table>
 		<a href="listar_busca.php?msn=0&cod_ver=0" class="btn btn-primary">Voltar</a>
 		<?php
 	}else{
 		echo "<label class='btn btn-warning'>Nenhum dado encontrado!</label>";
 	}


 }else{
 $total = 0;
 $sql2 = $pdo -> prepare("SELECT count(*) as c FROM premiacao");
 $sql2->execute();
 $sql2 = $sql2->fetch();
 $total = $sql2['c'];
 $paginas = $total / 10;
 
 $qntpg = 10;
 $pg= 1;

 if(isset($_GET['p']) && !empty($_GET['p'])){
 	$pg = addslashes($_GET['p']);
 }
 $p = ($pg-1) * $qntpg;

 $sql = $pdo->prepare("SELECT c.id, c.Nome, c.CPF, c.Cod_Ver_Nota, c.Valor_Nota, c.Insercao, p.cupom FROM concorrentes as c INNER JOIN premiacao as p WHERE c.id = p.id_concorrente ORDER BY c.id LIMIT $p, $qntpg");
 $sql -> execute();
 $count = 0;
    if ($sql -> rowCount() > 0 ) {
        $sql = $sql -> fetchAll();
        
?>
<table class="table table-striped table-hover" id="ulItens">
	<thead>
		<tr>
			<th><li class="fa fa-users"></li>&ensp;Nome</th>
			<th><li class="fa fa-list"></li>&ensp;CPF</th>
			<th><li class="fa fa-key"></li>&ensp;Cod. Verificador</th>
			<th><li class="fa fa-money"></li>&ensp;Valor Nota</th>
			<th><li class="fa fa-list"></li>&ensp;Cupom</th>
			<th><li class="fa fa-list"></li>&ensp;Data Cadastro</th>
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
			<td><?php echo $notas['cupom'];?></td>
			<td><?php echo date("d/m/Y H:i:s", strtotime($notas['Insercao']));?></td>
			<?php 
             if ($_SESSION['perfil'] == 'admin') {
             	# code...
			?>				
			<td><abbr title="Editar dados Pessoais"><a class="btn btn-primary fa fa-pencil-square-o" href="listar_nota_cadastrada.php?id=<?=$notas['id']?>"></a></abbr></td>
			<?php 
			}
			?>
			<td><abbr title="Listar e Editar Cupom"><a class="btn btn-success fa fa-list" href="listar_cupom.php?cod=<?=$notas['Cod_Ver_Nota']?>"></a></abbr></button></td>
		</tr>
	</tbody>

<?php
         }
}
echo "<h3><label class='form-control label-warning' align='center'>".$count."&ensp;de&ensp;".$total."&ensp;Registros"."</label></h3>";
?>
 </table>

 <?php
 echo "<hr/>";
 for ($q=0; $q < $paginas; $q++) { 
 	echo '<a href="./listar_busca.php?p='.($q+1).'&msn=0&cod_ver=0" class="btn btn-warning">'.($q+1).'</a>';
 }
}
}
 else{
 	header("Location: login.php");
 }
 require "rodape.php"
 ?>