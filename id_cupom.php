<?php
include "config.php";
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
}
?>