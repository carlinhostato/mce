<?php

   require "PHPMailer/src/Exception.php";
   require "PHPMailer/src/OAuth.php";
   require "PHPMailer/src/PHPMailer.php";
   require "PHPMailer/src/POP3.php";
   require "PHPMailer/src/SMTP.php";

    //Instanciando os sNamespaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array(
            'codigo_status' => null,
            'descricao_status' => '',
        );
		
        public function __get($attr){
            return $this->$attr;
         }

         public function __set($attr, $value){
             $this->$attr = $value;
         }

         public function mensagemValida(){

                if( empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                    return false;
                }
                else return true;
         } 
    }

    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
		
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%&*()_+="; // $si contem os símbolos
        $password="";
		
        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($ma);
        }
    
        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($mi);
        }
    
        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($nu);
        }
    
        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $password
            $password .= str_shuffle($si);
        }
    
        // retorna a password embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($password),0,$tamanho);
    }

   if(isset($_POST["submit"])){

    $email=$_POST["email"]; 
    $procura="select * from utilizador where email='".$email."' ;";
    $result=mysqli_query($ligax,$procura);
    $nregistos=mysqli_num_rows($result);
    $registo=mysqli_fetch_assoc($result);

	if($nregistos == 0){ ?>
	 <script> alert("Conta não registada!")</script>	
	<?php } else if($nregistos==1){

    //  Este email existe na base de dados!";
    $email=$registo["email"]; //guarda email para quem será enviado o formulário
	
	// Função Gerar Senha		
	$password=gerar_senha(10, true, true, true, true);

	//altera o registo com a nova password
	$sql="UPDATE utilizador SET password='".md5($password)."' where email='".$email."';";
	$result=mysqli_query($ligax,$sql);

    $mensagem = new Mensagem();
    $mensagem->__set('para' , $_POST['email']);
    $mensagem->__set('assunto' , "Recuperacao de Password");
    $mensagem->__set('mensagem' , "Solicitou a requisicao da sua password.<br><br>
    A sua nova password e: 
	$password
	<br>
    Por favor, nao responda a este email. A sua unica funcao e informar.<br><br>
    Atenciosamente, Equipa responsavel pelo projeto MCE - Manutencao da cidade de Espinho");

    // print_r($mensagem);
    
    //criar objeto PHPMAILER
	    if(!$mensagem->mensagemValida()){
			echo "Mensagem não é válida";
	    }

   $mail = new PHPMailer(true);

   try {
    //Server settings
    $mail->SMTPDebug = false;                      
    $mail->isSMTP();                                            
    $mail->Host       = "smtp.sapo.pt";
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = "manutencaocidadedeespinho@sapo.pt";                    
    $mail->Password   = "Manutencao2021#";                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom("manutencaocidadedeespinho@sapo.pt", 'MCE - Manutencao da cidade de Espinho');
    $mail->addAddress($mensagem->__get('para'));    

    $headers = "MIME-Version: 1.1/r/n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1/r/n";
	$headers .= "From: Equipa do Projeto/r/n"; //Devem personalizar com o nome do vosso projeto
    $headers .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
                    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = $mensagem->__get('mensagem');
    $mail->AltBody = 'É necessario utilizar um cliente que suport HTML para ter acesso total ao conteúdo dessa mensagem';

    $mail->send();
    $mensagem->status['codigo_status'] = 1;
    $mensagem->status['descricao_status'] = 'E-Mail enviado com secesso!<br> Vá até à sua caixa de correio eletrónico!';
	?>
	<script> alert("Consulte o seu email.") </script>
	<?php
} catch (Exception $e) {

    $mensagem->status['codigo_status'] = 2;
    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;

   
}
}
include("home.php");
}

?>