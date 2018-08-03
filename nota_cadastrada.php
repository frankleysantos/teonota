<?php
session_start();
require "cabecalho.php";
?>
<h2>Código Verificador Cadastrado:</h2>
<div class="table table-bordered table-hover">
	<table class="table table-hover">
			<tr>
				<th>Nome</th>
				<td><label class="form-control label-warning"><?php echo $_SESSION['NOTA']['Nome'];?></label></td>
			</tr>
			<tr>
			    <th>CPF</th>
				<td><label class="form-control"><?php echo $_SESSION['NOTA']['CPF'];?></label></td>
			</tr>
			<tr>
				<th>Cod. Verificação</th>
				<td><label class="form-control"><?php echo $_SESSION['NOTA']['Cod_Ver_Nota'];?></label></td>
			</tr>
		    <tr>
		    	<th>Valor Nota</th>
		    	<td><label class="form-control"><?php echo $_SESSION['NOTA']['Valor_Nota'];?></label></td>
		    </tr>
		    <tr>
		    	<th>Cadastrado Por:</th>
		    	<td><label class="form-control"><?php echo $_SESSION['NOTA']['Cadastrado_Por'];?></label></td>
		    </tr>
			<tr>
				<th>Data de Cadastro</th>
				<td><label class="form-control"><?php echo date("d/m/Y H:i:s", strtotime($_SESSION['NOTA']['Insercao']))?></label></td>
			</tr>
	</table>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Nº da Sorte:</th>
			</tr>
		</thead>
		<tbody>
			<?php
			 $contador = $_SESSION['NOTA']['count'];
			 for ($count=0; $count < $contador; $count++) { 
			 	if (isset($_SESSION['NOTA']['cupom'.$count])) {
			 		echo "<tr>";
			 		echo "<td><label class='form-control'>".$_SESSION['NOTA']['cupom'.$count]."</label></td>";
			 		echo "</tr>";
			 }
			 }
			?>
		</tbody>
	</table>
	<div class="row">
	    <div class="col-md-12" align="right">
		  <a href="index.php?msn=0" class="btn btn-success fa fa-search">&ensp;Nova Consulta</a>
		</div>
	</div>
</div>
<?php 
require "rodape.php";
?>