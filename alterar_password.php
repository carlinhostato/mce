<?php
if(isset($_POST['submit_alterar_password'])){
	$pass=$_POST['password'];
	$passnova=$_POST['novapassword'];
	$confpassnova=$_POST['confirmarpassword'];
	
	if($passnova!=$confpassnova || $passnova=="") {
		?>
		<script> alert("A password e a confirmação não coincidem ou a password é nula!")</script>
		<?php
	} else {
		$procura="select password from utilizador where email='".$_SESSION['email']."';";
		$result=mysqli_query($ligax,$procura);
		if($result) {	
			$registo=mysqli_fetch_assoc($result);
			$passwordbd=$registo["password"];
			$pass=md5($pass);
			if($pass!=$passwordbd) {
				?>
				<script> alert("Password incorreta! ")</script>
				<?php
			} else {
				
				$passnova=md5($passnova);
				$atualizar="UPDATE utilizador set password='".$passnova."' where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
				$result=mysqli_query($ligax, $atualizar);
				?>
				<script> alert("Password atualizada com sucesso! ")</script>
				<?php
			}
		}
	}
}
?>	
    <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Alterar Password</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Altere a sua <strong>Password</strong></h4>

            <form action="" method="post" role="form" class="contactForm">
              <div id="sendmessage">Sua Password foi alterada com sucesso!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="span4 form-group">
                  <input type="text" name="password" class="form-control" id="password" placeholder="Sua Password"  />
                  <div class="validation"></div>
				   <p class="text-center">
                </div>
                <div class="span4 form-group">
                  <input type="password" class="form-control" name="novapassword" id="novapassword" placeholder="Nova Password"  />
                  <div class="validation"></div>
				   <p class="text-center">
                </div>
                <div class="span4 form-group">
                  <input type="password" class="form-control" name="confirmarpassword" id="confirmarpassword" placeholder="Confirmar Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
				   <p class="text-center">
                </div>
                    <button name="submit_alterar_password" class="btn btn-large btn-theme margintop10" type="submit">Confirmar</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
 