<?php
include ('ligacao.php');
$query=" select nome_imagem,tipo_imagem,tamanho_imagem,dados_imagem from categoria where cod_categoria='".$_GET['cod_categoria']."'"; 

$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["tipo_imagem"];
$nome_img=$row["nome_imagem"];
$tamanho_img=$row["tamanho_imagem"];
$dados_img=base64_decode($row["dados_imagem"]);

header("Content-type: $tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
?>