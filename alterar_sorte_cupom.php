<?php
require "functions.php";
require "config.php";
$id = $_POST['id'];
$cupom = $_POST['cupom'];
$atualizado_por = $_SESSION['user'];

alterarCupom($id, $cupom, $atualizado_por);
?>