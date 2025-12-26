
<?php
    session_start(); 
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "pap_20_21_carlostato";
    $ligax = mysqli_connect($host, $user, $pwd)
    or die ("Nao foi possivel efetuar ligacao a base de dados ". mysqli_connect_error());
    mysqli_select_db($ligax,$db);
?>
