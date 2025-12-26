
<?php
	
	require "PHPMailer/src/Exception.php";
	require "PHPMailer/src/OAuth.php";
	require "PHPMailer/src/PHPMailer.php";
	require "PHPMailer/src/POP3.php";
	require "PHPMailer/src/SMTP.php";

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

	if(isset($_POST['submit'])){

    

   
//Dados do formulário de contacto

    $nome=$_POST["name"];
	$email=$_POST["email"];
	$subject=$_POST['subject'];
    $message=$_POST['message'];
	

//Envio de mensagem para o email do contacto a confirmar a receção dos dados:

    $mensagem_1 = new Mensagem();
    $mensagem_1->__set('para' , $_POST['email']); //email do contacto
    $mensagem_1->__set('assunto' , "Confirmação do seu email enviado!");
    $mensagem_1->__set('mensagem' , "Olá, ".$nome.", sua mensagem foi recebida, aguarde sua resposta. <br>
	Não responda a este email");

	if(!$mensagem_1->mensagemValida()){
			echo "Mensagem não é válida";
	}

   $mail_1 = new PHPMailer(true);

    

   try {
   
		$mail_1->SMTPDebug = false;                      // Enable verbose debug output
		$mail_1->isSMTP();                                            // Send using SMTP
		$mail_1->Host       = "smtp.sapo.pt";                    // Set the SMTP server to send through
		$mail_1->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail_1->Username   = "manutencaocidadedeespinho@sapo.pt";				// SMTP username
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

    $mensagem_2 = new Mensagem();
    $mensagem_2->__set('para' , "manutencaocidadedeespinho@sapo.pt"); //email do contacto
    $mensagem_2->__set('assunto' , "Email Contactos");
    $mensagem_2->__set('mensagem' , "Email de: ".$nome."<br> Assunto: ".$subject." <br> Mensagem: ".$message."<br>");

	if(!$mensagem_2->mensagemValida()){
			echo "Mensagem não é válida";
	}

   $mail_2 = new PHPMailer(true);

   try {
   
		$mail_2->SMTPDebug = false;                      // Enable verbose debug output
		$mail_2->isSMTP();                                            // Send using SMTP
		$mail_2->Host       = "smtp.sapo.pt";                    // Set the SMTP server to send through
		$mail_2->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail_2->Username   = "manutencaocidadedeespinho@sapo.pt";				// SMTP username
		$mail_2->Password   = "Manutencao2021#";                               // SMTP password
		$mail_2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail_2->Port       = 587;                                    // TCP port to connect to
			
		$mail_2->setFrom("manutencaocidadedeespinho@sapo.pt", 'Equipa do Projeto');
		$mail_2->addAddress($mensagem_2->__get('para'));     // Add a recipient

		$headers_2 = "MIME-Version: 1.1/r/n";
		$headers_2 .= "Content-type: text/plain; charset=iso-8859-1/r/n";
		$headers_2 .= "From: Equipa do Projeto/r/n"; //Devem personalizar com o nome do vosso projeto
		$headers_2 .= "Return-Path: User"; //Devem personalizar com o nome do vosso projeto
	  
		$mail_2->isHTML(true);                                  // Set email format to HTML
		$mail_2->Subject = $mensagem_2->__get('assunto');
		$mail_2->Body    = $mensagem_2->__get('mensagem');
		$mail_2->AltBody = 'É necessario utilizar um cliente que suport HTML para ter acesso total ao conteúdo dessa mensagem';

		$mail_2->send();
		$mensagem_2->status['codigo_status'] = 1;
		$mensagem_2->status['descricao_status'] = 'Obrigado pelo seu contacto!<br> Consulte a sua caixa de correio eletrónico!';

	} catch (Exception $e_1) {

		$mensagem_2->status['codigo_status'] = 2;
		$mensagem_2->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail_2->ErrorInfo;

    //alguma lógica que armazene o erro para posterior análise por parte do programador
	}
    }
?>	
<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Contactar Administração</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">
            


    <section id="content">

      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Entre em contacto connosco preenchendo o formulário de contato abaixo</h4>

            <form action="" method="POST" role="form" class="contactForm">
              <div id="sendmessage">Sua mensagem foi enviada. Obrigada!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="span4 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome Completo" data-rule="minlen:4" required="required" />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" data-rule="email" required="required"/>
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sobre" data-rule="minlen:4" required="required"/>
                  <div class="validation"></div>
                </div>
                <div class="span12 margintop10 form-group">
                  <textarea class="form-control" name="message" rows="12" data-rule="required" required="required" placeholder="Mensagem"></textarea>
                  <div class="validation"></div>
                  <p class="text-center">
                    <button class="btn btn-large btn-theme margintop10" name="submit" type="submit">Submit message</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
        </div>
      </div>
    </section>	