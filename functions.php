<?php
session_start();

function buscarNota($VerCod){
	require "config.php";
    $sql = $pdo->prepare("SELECT * FROM concorrentes WHERE Cod_Ver_Nota = :VerCod");
    $sql->bindValue(":VerCod", $VerCod);
    $sql ->execute();

    if ($sql -> rowCount() > 0) {
    	# code...
    	$sql = $sql ->fetch();
    	$_SESSION['NOTA']['Nome'] = $sql['Nome'];
    	$_SESSION['NOTA']['CPF'] = $sql['CPF'];
    	$_SESSION['NOTA']['Cod_Ver_Nota'] = $sql['Cod_Ver_Nota'];
    	$_SESSION['NOTA']['Valor_Nota'] = $sql['Valor_Nota'];
    	$_SESSION['NOTA']['Insercao'] = $sql['Insercao'];
        $_SESSION['NOTA']['Cadastrado_Por'] = $sql['Cadastrado_Por'];
      $sql2 = $pdo->prepare("SELECT p.cupom FROM premiacao as p 
        INNER JOIN concorrentes as c ON p.id_concorrente = c.id AND p.Cod_Ver_Nota = :VerCod");
        $sql2->bindValue(":VerCod", $VerCod);
        $sql2->execute();
        if ($sql2->rowCount() > 0) {
             $sql2 = $sql2->fetchAll();
             $count=0;
             foreach ($sql2 as $premiacao) {
                 $_SESSION['NOTA']['cupom'.$count] = $premiacao['cupom'];
                 $count+=1;
              }
              $_SESSION['NOTA']['count'] = $count;
         } 
    	header("Location: nota_cadastrada.php?msn=0");
    }
    else{
        $_SESSION['NOTA']['Cod_Ver_Nota'] = $VerCod;
    	header("Location: form_cadastrar_nota.php?msn=0");
    }
}

function alterarNota($id, $Nome, $CPF, $Cod_Ver_Nota, $Valor_Nota){
    require "config.php";
    $sql = $pdo->prepare("UPDATE concorrentes SET
        Nome = :Nome,
        CPF = :CPF,
        Cod_Ver_Nota = :Cod_Ver_Nota,
        Valor_Nota = :Valor_Nota,
        Insercao = Now() WHERE id = :id");

    $sql->bindValue(":id", $id);
    $sql->bindValue(":Nome", $Nome);
    $sql->bindValue(":CPF", $CPF);
    $sql->bindValue(":Cod_Ver_Nota", $Cod_Ver_Nota);
    $sql->bindValue(":Valor_Nota", $Valor_Nota);
    $sql ->execute();
    header("Location: index.php?msn=Usuário alterado");
}

function alterarCupom($id, $cupom, $atualizado_por){
    require "config.php";
    $sql = $pdo->prepare("UPDATE premiacao SET
        cupom = :cupom,
        atualizado_por = :atualizado_por,
        atualizacao = Now() WHERE id = :id");

    $sql->bindValue(":id", $id);
    $sql->bindValue(":cupom", $cupom);
    $sql->bindValue(":atualizado_por", $atualizado_por);
    $sql ->execute();
    header("Location: index.php?msn=Cupom Alterado");
}

function inserirNota($Nome, $CPF, $Cod_Ver_Nota, $Valor_Nota, $Cupom){
    require "config.php";
    $sql = $pdo->prepare("INSERT INTO concorrentes (Nome, CPF, Cod_Ver_Nota, Valor_Nota, Cupom, Insercao) 
        VALUES (:Nome, :CPF, :Cod_Ver_Nota, :Valor_Nota, :Cupom, Now())");
    $sql->bindValue(":Nome", $Nome);
    $sql->bindValue(":CPF", $CPF);
    $sql->bindValue(":Cod_Ver_Nota", $Cod_Ver_Nota);
    $sql->bindValue(":Valor_Nota", $Valor_Nota);
    $sql->bindValue(":Cupom", $Cupom);
    $sql->execute();
    header("Location: form_cadastrar_nota.php");

}

function removerCadastros($id){
    require "config.php";
    $sql = $pdo->prepare("DELETE concorrentes.*, premiacao.* FROM concorrentes INNER JOIN premiacao ON concorrentes.id = premiacao.id_concorrente where concorrentes.id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    header("Location: listar_busca.php?msn=Removido com Sucesso!&cod_ver=0");
}

function removerCupom($id){
    require "config.php";
    $sql = $pdo->prepare("DELETE FROM premiacao WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    header("Location: listar_busca.php?msn=Removido com Sucesso!&cod_ver=0");
}