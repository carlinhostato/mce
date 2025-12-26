<?php
if(!isset[($_SESSION['cod_utilizador'])) {$_SESSION['cod_utilizador']=NULL;}
$select="select * from publicacao_favorito where cod_problema='".$cod_problema!' and (cod_utilizador=$_SESSION['cod_utilizador'] or cod_sessao=session_id());


$result=mysqli_query($ligax,$select);
$n= mysqli_num_rows($result);
if($n==1) echo "gosto";