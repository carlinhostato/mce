<?php	

if(isset($_POST['email'])){
    $email=$_POST['email'];
	$pass=$_POST['password'];

	$pass_encriptada=md5($pass);

	$procura="select * from utilizador where email='".$email."' and password='".$pass_encriptada."';";

	$result=mysqli_query($ligax,$procura);
	$nregistos=mysqli_num_rows($result);

	if ($nregistos==1) {
		$registo=mysqli_fetch_assoc($result);
		$perfil=$registo['perfil'];
		if($perfil==-1){ //o administrador desativou a conta do utilizador ?>
		    <script> alert("Conta desativada, por favor contacte o administrador!")</script> <?php
	    }elseif($perfil==0){ //o utilizador está registado mas ainda não ativou a sua conta ?>
		     <script> alert("Não ativou a sua conta!")</script> <?php
	    } else {
			$_SESSION["cod_utilizador"]=$registo["cod_utilizador"];
			$_SESSION["nome"]=$registo["nome"];
			$_SESSION["email"]=$registo["email"];
			$_SESSION["perfil"]=$registo["perfil"];
		}
	} else { ?>
	         <script> alert("Dados incorretos")</script> <?php
    }
	unset($_GET['pagina']);
}
?>
	