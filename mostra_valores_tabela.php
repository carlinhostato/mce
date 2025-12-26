<?php
    $query="select *from utilizador where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
    $result=mysqli_query($ligax,$query);
    $registo=mysqli_fetch_assoc($result);
    $nome=$registo['nome'];
    $genero=$_registo['genero'];
    $nif=$registo['nif'];
    $morada=$_registo['morada'];
    $codigo_postal=$registo['codigo_postal'];
    $localidade=$registo['localidade'];
    $pais=$registo['pais'];
	$email=$registo['email'];
	$data_nascimento=$registo['data_nascimento'];
	$telemovel=$registo['telemovel'];