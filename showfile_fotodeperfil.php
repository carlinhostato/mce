<?php
include ('ligacao.php');
$query=" select foto_nome,foto_tipo,foto_tamanho,foto_dados from utilizador where cod_utilizador='".$_GET['cod_utilizador']."'"; 

$result=mysqli_query($ligax,$query);
$row=mysqli_fetch_array($result);
$tipo_img=$row["foto_tipo"];
$nome_img=$row["foto_nome"];
$tamanho_img=$row["foto_tamanho"];
$dados_img=base64_decode($row["foto_dados"]);

header("Content-type: $tipo_img");
header("Content-lenght:$tamanho_img");
header("Content-Disposition: inline; filename=$nome_img");
header ("Content-Description: PHP Generated Data");
ob_clean();
echo $dados_img;
?>