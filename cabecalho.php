<html>
<head>
	<meta charset="utf-8">
	<title>Téo Nota - 10</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/functions.js"></script>
    <script type="text/javascript">
  $(function(){
    $("#txtBusca").keyup(function(){
      var index = $(this).parent().index();
      var texto = $(this).val().toUpperCase();

      $("#ulItens td").each(function(){
        if($(this).text().toUpperCase().indexOf(texto) < 0)
         $(this).css("display", "none");
     });
      $("#ulItens td").each(function(){
        if($(this).text().toUpperCase().indexOf(texto) >= 0)
         $(this).css("display", "block");
     });
    });
  });
  function verificarCPF(c){
    var i;
    s = c;
    var c = s.substr(0,9);
    var dv = s.substr(9,2);
    var d1 = 0;
    var v = false;
    var cpf = s;

    if ( (cpf == "00000000000") || (cpf == "11111111111") || (cpf == "22222222222") || (cpf == "33333333333") 
        || (cpf == "44444444444") || (cpf == "55555555555") || (cpf == "66666666666")
        || (cpf == "77777777777") || (cpf == "88888888888") || (cpf == "99999999999")){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        return false; 
    }  
    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(10-i);
    }

    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        document.getElementById('CPF').value=null;
        return false;   
    }
 
    d1 *= 2;
    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(11-i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1){
        alert("CPF Inválido")
        v = true;
        document.getElementById('cpf').value=null;
        document.getElementById('CPF').value=null;
        return false;
        
    }
    if (!v) {
        
    }

}
  </script>
  <script src="funcoes.js"></script>
</head>
<body>
	
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand fa fa-check" href="index.php?msn=0">Téo Nota-10</a>
			</div>
			<div class="row">
      <div class="col-md-8">
				<ul class="nav navbar-nav">
					<!--<li><a href="listar_cadastros.php?msn=0&cod_ver=0">Listar Cadastrados</a></li>-->
          <?php
           if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
          ?>
					<li><a href="listar_excel.php"><i class="fa fa-file-excel-o"></i>&ensp;Excel</a></li>
          <li><a href="listar_busca.php?cod_ver=0&msn=0"><i class="fa fa-list"></i>&ensp;Listar Cadastrados</a></li>
          <?php }?>
				</ul>
        </div>
        <div class="col-md-2" align="right">
          <ul class="nav navbar-nav">
            <li><?php 
           if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
           echo "<a href='sair.php' class='btn-danger fa fa-sign-out'>&ensp;Sair</a>";
           }
          ?></li>
          </ul>
        </div>
			</div>
		</div>
	</div>
	
	
	<div class="container" style="padding-top: 100px" class="col-md-12">
		<div class="principal">
     <div class="row">
       <div class="col-md-12" align="right">
         <?php
          if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            echo "<label class='btn btn-default'>Usuário:&ensp;".$_SESSION['user']."</label>";
          }
         ?>
       </div>
     </div>
			