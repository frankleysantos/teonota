<?php
require "functions.php";
$str = strlen($_POST['Cod_Ver_Nota']);
if (isset($_POST['Cod_Ver_Nota']) && !empty($_POST['Cod_Ver_Nota']) && $str == 19) {
	# code...
	$VerCod = $_POST['Cod_Ver_Nota'];
    buscarNota($VerCod);
}
else{
	header("Location: index.php?msn=Cod. Verificador inválido");
}