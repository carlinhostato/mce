<?php

   require "PHPMailer/src/Exception.php";
   require "PHPMailer/src/OAuth.php";
   require "PHPMailer/src/PHPMailer.php";
   require "PHPMailer/src/POP3.php";
   require "PHPMailer/src/SMTP.php";

  //Uso de classes
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

   
//Dados do formulário de contacto

 
	$email=$_POST["email"];
	
    
//Envio de mensagem para o email do contacto a confirmar a receção dos dados:

    $mensagem_1 = new Mensagem();
    $mensagem_1->__set('para' , $_POST['email']); //email do contacto
    $mensagem_1->__set('assunto' , "Contacto via site!");
    $mensagem_1->__set('mensagem' , "Aceda a este link para confirmar o seu registo. 
	https://manutencaocidadedeespinho.000webhostapp.com//index.php?pagina=validacao&codigo=$cod;
	Com os melhores cumprimentos, A equipa MCE - Manutenção da cidade de Espinho");
	
	if(!$mensagem_1->mensagemValida()){
			echo "Mensagem não é válida";
	}

   $mail_1 = new PHPMailer(true);

   try {
   
		$mail_1->SMTPDebug = false;                      // Enable verbose debug output
		$mail_1->isSMTP();                                            // Send using SMTP
		$mail_1->Host       = "smtp.sapo.pt";                    // Set the SMTP server to send through
		$mail_1->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail_1->Username   = "manutencaocidadedeespinho@sapo.pt";                     // SMTP username
		$mail_1->Password   = "Manutencao2021#";                               // SMTP password
		$mail_1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail_1->Port       = 587;                                    // TCP port to connect to


		$mail_1->setFrom("manutencaocidadedeespinho@sapo.pt", 'Equipa do Projeto');
		$mail_1->addAddress($mensagem_1->__get('para'));     // Add a recipient

		$headers_1 = "MIME-Version: 1.1/r/n";
		$headers_1 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
		$headers_1 .= "From: Equipa do Projeto/r/n"; //Devem personalizar com o nome do vosso projeto
		$headers_1 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
	  
		$mail_1->isHTML(true);                                  // Set email format to HTML
		$mail_1->Subject = $mensagem_1->__get('assunto');
		$mail_1->Body    = $mensagem_1->__get('mensagem');
		$mail_1->AltBody = 'É necessario utilizar um cliente que suport HTML para ter acesso total ao conteúdo dessa mensagem';

		$mail_1->send();
		$mensagem_1->status['codigo_status'] = 1;
		$mensagem_1->status['descricao_status'] = 'E-Mail enviado com secesso!<br> Vá até à sua caixa de correio eletrónico!';

	} catch (Exception $e_1) {

		$mensagem_1->status['codigo_status'] = 2;
		$mensagem_1->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail_1->ErrorInfo;

    //alguma lógica que armazene o erro para posterior análise por parte do programador
	
	}


 
?>