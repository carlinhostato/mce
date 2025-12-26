<header>
      <div class="container">
        <!-- hidden top area toggle link -->
        <div id="header-hidden-link">
          <a href="#" class="toggle-link" title="Click me you'll get a surprise" data-target=".hidden-top"><i></i>Open</a>
        </div>
        <!-- end toggle link -->
        <div class="row nomargin">
          <div class="span12">
            <div class="headnav">
              <ul>
                <li><a href="#mySignup" data-toggle="modal"><i class="icon-user"></i>Registe-se</a></li>
                <li><a href="#mySignin" data-toggle="modal">Entrar</a></li>
              </ul>
            </div>
            <!-- Signup Modal -->
            <div id="mySignup" class="modal styled hide fade" tabindex="-1" role="dialog" aria-labelledby="mySignupModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="mySignupModalLabel">Crie a sua<strong> conta</strong></h4>
              </div>
			  <?php
                                    if(isset($_POST['submit_registar'])){

                                        $flag=false;
                                        $flag_email=false;
                                        $flag_password=false;
										$flag_nome=false;
										$flag_morada=false;
										$flag_codigo_postal=false;
										$flag_pais=false;
										$flag_nif=false;
										$flag_data_nascimento=false;
										$flag_genero=false;
										$flag_localidade=false;
										$flag_telemovel=false;

                                        $email=$_POST['email'];
                                        $password=$_POST['password'];
                                        $repassword=$_POST['repassword'];
										$nome=$_POST['nome'];
										$morada=$_POST['morada'];
										$codigo_postal=$_POST['codigo_postal'];
										$pais=$_POST['pais'];
										$nif=$_POST['nif'];
										$data_nascimento=$_POST['data_nascimento'];
										$genero=$_POST['genero'];
										$localidade=$_POST['localidade'];
										$telemovel=$_POST['telemovel'];
										

                                        /* verificar se o email já existe */
                                        $query="select email from utilizador where email='".$email."'";
										$result=mysqli_query($ligax, $query);
                                        $n=mysqli_num_rows($result);
                                        if($n>0){
                                            $flag=true;
                                            $flag_email=true;
                                        }

                                        /*Validação de password*/
                                        if ($password!=$repassword || $password==""){
                                            $flag=true; 
                                            $flag_password=true;
                                        }

                                        /* Existiu um erro */
                                        if($flag==true) { 
                                            if($flag_email==true){ ?> 
                                            <script>
                                                alert("Email ja existente.");
                                            </script> 
                                        <?php } 
                                        if($flag_password==true) { ?> 
                                            <script>
                                                alert("passwords diferentes."); 
                                            </script> 
                                        <?php } 
                                    } else {
										$password = md5($password);
                                        $insere="INSERT INTO utilizador (email,password,nome,nif,morada,codigo_postal,localidade,pais,telemovel,data_nascimento,genero) VALUES ('".$email."','".$password."','".$nome."','".$nif."','".$morada."','".$codigo_postal."','".$localidade."','".$pais."','".$telemovel."','".$data_nascimento."','".$genero."')";
                                        $result=mysqli_query($ligax,$insere);
                                        if($result==1){
                                            $cod=mysqli_insert_id($ligax); //codigo do utilizador
                                            include("enviar_link_email.php"); 
                                            ?> 
                                            <script>
                                                alert("Dados inseridos com sucesso."); 
                                            </script> 
                                        <?php    }   else {
                                                ?>
                                                <script>
                                                    alert("Dados nao inseridos!");
                                                </script> 
                                                <?php
                                                }
                                            }
                                        } else {
                                    ?>
              <div class="modal-body">
                <form class="form-horizontal" action="" method="POST">
                  <div class="control-group">
                    <label class="control-label" for="inputEmail">Email</label>
                    <div class="controls">
                      <input type="email" name="email" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
				   <div class="control-group">
                    <label class="control-label" for="inputNome">Nome</label>
                    <div class="controls">
                      <input type="text" name="nome" id="inputNome" placeholder="Nome">
                    </div>
                  </div>
				   <div class="control-group">
                    <label class="control-label" for="inputNIF">NIF</label>
                    <div class="controls">
                      <input type="text" name="nif" id="inputNIF" placeholder="NIF">
                    </div>
                  </div>
				   <div class="control-group">
                    <label class="control-label" for="inputMorada">Morada</label>
                    <div class="controls">
                      <input type="text" name="morada" id="inputMorada" placeholder="Morada">
                    </div>
                  </div>
				   <div class="control-group">
                    <label class="control-label" for="inputcodigo_postal">Código Postal</label>
                    <div class="controls">
                      <input type="text" name="codigo_postal" id="inputcodigo_postal" placeholder="Código Postal">
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="inputLocalidade">Localidade</label>
                    <div class="controls">
                      <input type="text" name="localidade" id="inputLocalidade" placeholder="Localidade">
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="inputpais">País</label>
                    <div class="controls">
                      <input type="text" name="pais" id="inputpais" placeholder="País">
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="inputtelemovel">Telemóvel</label>
                    <div class="controls">
                      <input type="text" name="telemovel" id="inputtelemovel" placeholder="Telemóvel">
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="inputData_nascimento">Data de nascimento</label>
                    <div class="controls">
                      <input type="date" name="data_nascimento" id="inputdata_nascimento" placeholder="Data de Nascimento">
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="inputGenero">Género</label>
                    <div class="controls">
                      <select type="genero" class="form-control" value="<?php echo $genero; ?>" name="genero" id=""  />
						<option value="F"  > Feminino </option>
						<option value="M"  > Masculino </option>
				  </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputSignupPassword">Password</label>
                    <div class="controls">
                      <input type="password" name="password" id="inputSignupPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputSignupPassword2">Confirmar Password</label>
                    <div class="controls">
                      <input type="password" name="repassword" id="inputSignupPassword2" placeholder="Password">
                    </div>
                  </div>					
                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" class="btn" name="submit_registar">Registar</button>
                    </div>
                    <p class="aligncenter margintop20">
                      Já tem uma conta? <a href="#mySignin" data-dismiss="modal" aria-hidden="true" data-toggle="modal">Entrar</a>
                    </p>
                  </div>
                </form>
				<?php } ?>
              </div>
            </div>
            <!-- end signup modal -->
            <!-- Sign in Modal -->
            <div id="mySignin" class="modal styled hide fade" tabindex="-1" role="dialog" aria-labelledby="mySigninModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="mySigninModalLabel">Entra na sua <strong>conta</strong></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="index.php?pagina=validar_login" method="POST">
                  <div class="control-group">
                    <label class="control-label" for="inputText">Email</label>
                    <div class="controls">
                      <input type="text" id="inputText" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputSigninPassword">Password</label>
                    <div class="controls">
                      <input type="password" id="inputSigninPassword" placeholder="Password" name="password">
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" class="btn">Entrar</button>
                    </div>
                    <p class="aligncenter margintop20">
                     Esqueci-me da senha? <a href="#myReset" data-dismiss="modal" aria-hidden="true" data-toggle="modal">Restaurar</a>
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <!-- end signin modal -->
            <!-- Reset Modal -->
            <div id="myReset" class="modal styled hide fade" tabindex="-1" role="dialog" aria-labelledby="myResetModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myResetModalLabel">Restaure sua <strong>password</strong></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="POST" action="index.php?pagina=recuperar_password">
                  <div class="control-group">
                    <label class="control-label" for="inputResetEmail">Email</label>
                    <div class="controls">
                      <input type="text" id="inputResetEmail" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" name="submit" class="btn">Restaurar password</button>
                    </div>
                    <p class="aligncenter margintop20">
                      Enviaremos instruções sobre como redefinir sua senha para sua caixa de entrada do seu email
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <!-- end reset modal -->
          </div>
        </div>
        <div class="row">
          <div class="span4">
            <div class="logo">
              <a href="index.php"><img src="img/log.png" alt="" class="logo" /></a>
              <h1></h1>
            </div>
          </div>
          <div class="span8">
            <div class="navbar navbar-static-top">
              <div class="navigation">
                <nav>
                  <ul class="nav topnav">
                    <li class="dropdown">
                      <a href="index.php?pagina=about">Sobre<i></i></a>
                    </li>
					<li>
					<li class="dropdown active">
					<a href="">Ocorrências<i class="icon-angle-down"></i></a>
					<ul class="dropdown-menu">
                        <li><a href="index.php?pagina=forum_problemas">Ver Ocorrências</a></li>
					</ul>
                    </li>
					<li>
                      <a href="index.php?pagina=contact">Contactar Administração</a>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
      </div>
    </header>