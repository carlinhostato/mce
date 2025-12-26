<?php
include ('ligacao.php');
$query=" select foto_nome,tipo_imagem,tamanho_imagem,dados_imagem from problema where cod_problema='".$_GET['cod_problema']."'"; 

$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["tipo_imagem"];
$nome_img=$row["foto_nome"];
$tamanho_img=$row["tamanho_imagem"];
$dados_img=base64_decode($row["dados_imagem"]);

header("Content-type: $tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
?>