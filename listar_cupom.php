<?php 
session_start();
require "config.php";
require "cabecalho.php";
 if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
 $cod = $_GET['cod'];
 $total = 0;
 $sql2 = $pdo -> prepare("SELECT count(*) as c FROM premiacao WHERE Cod_Ver_Nota = :cod");
 $sql2->bindValue(":cod", $cod);
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

 $sql = $pdo->prepare("SELECT * FROM premiacao WHERE Cod_Ver_Nota = :cod ORDER BY id LIMIT $p, $qntpg");
 $sql -> bindValue(":cod", $cod);
 $sql -> execute();
 $count = 0;
    if ($sql -> rowCount() > 0 ) {
        $sql = $sql -> fetchAll();
        
?>
<h3><i class="fa fa-list">Cupoms Cadastrados por Cod. de Verificação</i></h3>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Cod. Ver. Nota</th>
			<th>Cupom</th>
			<th>Inserção</th>
			<th>Atualização</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sql as $notas) {  
  $count +=1;
?>
		<tr>
			<td><?php echo $notas['id'];?></td>
			<td><?php echo $notas['Cod_Ver_Nota']?></td>
			<td><?php echo $notas['cupom'];?></td>
			<td><?php echo date("d/m/Y H:i:s", strtotime($notas['Insercao']));?></td>
			<td><?php echo date("d/m/Y H:i:s", strtotime($notas['atualizacao']));?></td>
			<?php 
              if ($_SESSION['perfil'] == 'admin') {
			?>				
			<td><a class="btn btn-primary" href="form_numsorte_cupom.php?id=<?=$notas['id']?>">Editar Cupom</a></td>
			<td><abbr title="Excluir dados"><a class="btn btn-danger fa fa-trash" href="excluir_cupom.php?id=<?=$notas['id']?>"></a></abbr></td>
			<?php
              }
			?>
		</tr>
	</tbody>

<?php
         }
}
echo "<h3><label class='form-control label-warning' align='center'>".$count."&ensp;de&ensp;".$total."&ensp;Registros"."</label></h3>";
?>
 </table>
<?php
if (isset($_POST['premiacaototal']) && !empty($_POST['premiacaototal'])) {
     $Cod_Ver_Nota = $_POST['cod'];
     $sql3 = $pdo -> prepare("SELECT id_concorrente FROM premiacao WHERE Cod_Ver_Nota = :cod");
     $sql3->bindValue(":cod", $Cod_Ver_Nota);
     $sql3->execute();
        if ($sql3->rowCount() > 0) {
           $sql3 = $sql3->fetchAll();
             foreach ($sql3 as $id_concorrente) {
               $id = $id_concorrente['id_concorrente'];
              } 
                $premiacaototal = $_POST['premiacaototal'];
                if($premiacaototal>0){
                  for ($i=0;$i<$premiacaototal;$i++){
                    if (isset($_POST['cupom'.$i]) && !empty($_POST['cupom'.$i])) {
                    $tmpcupom = $_POST['cupom'.$i];

                    $sql = $pdo->prepare("INSERT INTO premiacao (cupom, id_concorrente, Cod_Ver_Nota, Insercao, atualizacao) VALUES (:cupom, :id_concorrente, :Cod_Ver_Nota, Now(), Now())");
                    $sql->bindValue(":cupom", $tmpcupom);
                    $sql->bindValue(":id_concorrente", $id);
                    $sql->bindValue(":Cod_Ver_Nota",$Cod_Ver_Nota);
                    $sql->execute();
                    }  
                  }
                }
        }
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=listar_busca.php?cod_ver=0&msn=Cupom adicionado'>";
}

?>
<form action="" method="POST" role="form">
<legend><i class="fa fa-plus-square-o"></i>&ensp;Cupons</legend>
<div class="row">
<div class="col-md-12">
        <input type="hidden" name="cod" value="<?php echo $cod?>">
        <input type="hidden" name="premiacaototal" id="premiacaototal" value="<?php if(empty($_SESSION['NOTA']['premiacaototal'])) echo 0; else echo $_SESSION['NOTA']['premiacaototal'] ?>" />
        <table class='table table-striped table-bordered table-hover' id="TabPremiacao">
         <tr><td colspan="6" align="center"><strong>Inserir Cupons</strong></td></tr>
         <tr>
          <td><i class="fa fa-list"></i>Cupom</td>
          <td><strong></strong></td>
         </tr>
        </table>
</div>
</div>
<div class="row">
  <div class="col-md-6"><button class="btn btn-large btn-success fa fa-plus-square" onclick="adicionarLinha()" type="button">&ensp;Adicionar Cupom</button></div>
</div>

<button type="submit" class="btn btn-primary">Cadastrar Novo Cupom</button>
</form>

 <?php
 echo "<hr/>";
 for ($q=0; $q < $paginas; $q++) { 
 	echo '<a href="./listar_cupom.php?cod='.$cod.'&p='.($q+1).'&msn=0" class="btn btn-default">'.($q+1).'</a>';
 }
}else{
	header("Location: login.php");
}
 require "rodape.php";
 ?>