<?php 
	if(isset($_POST['submit_confirmar_dados'])) {
		$flag=false;
		$flag_email=false;
		$flag_password=false;
		$nome=$_POST['nome'];
		$genero=$_POST['genero'];
		$nif=$_POST['nif'];
		$morada=$_POST['morada'];
		$codigo_postal=$_POST['codigo_postal'];
		$localidade=$_POST['localidade'];
		$pais=$_POST['pais'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$data_nascimento=$_POST['data_nascimento'];
		$telemovel=$_POST['telemovel'];
		
		$password=md5($password);
		
		/* confirmar palavra passe */
		$query="select password from utilizador where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
		$result=mysqli_query($ligax,$query);
		$registo=mysqli_fetch_assoc($result);
		$passwordBD=$registo['password'];
		if(($passwordBD!=$password)) {
			$flag=true;
			$flag_password=true;
		}
		
		/*	Verificar se o email já existe */
		$query="select cod_utilizador from utilizador where email='".$email."';";
		$result=mysqli_query($ligax,$query);
		$n=mysqli_num_rows($result);
		if($n>0) {
			$registo=mysqli_fetch_assoc($result);
			$cod_utlilizadorBD=$registo['cod_utilizador'];
			if($cod_utlilizadorBD!=$_SESSION["cod_utilizador"]){
				$flag=true;
				$flag_email=true;
			}
		}
		
		
		if($flag==true) {
			if($flag_password==true) { ?>
			   <script>
			   alert("Password incorreta! Insira a sua password para atualizar os dados do perfil");
			   </script>
			<?php
			if($flag_email==true) { ?>
			   <script>
			   alert("Email incorreto! Já existe na BD);
			   </script>
			<?php }
		} } else {
		

		   $atualizar="UPDATE utilizador set nome='".$nome."',email='".$email."',data_nascimento='".$data_nascimento."',genero='".$genero."',
           telemovel='".$telemovel."',nif='".$nif."',morada='".$morada."',codigo_postal='".$codigo_postal."',localidade='".$localidade."',
           pais='".$pais."' where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
           $result=mysqli_query($ligax,$atualizar);
           if($result==1){
                if($_FILES['foto']['error']==0){
                    $file_name=$_FILES['foto']['name'];
                    $file_type=$_FILES['foto']['type'];
                    $file_size=$_FILES['foto']['size'];
                    $file_tmp=$_FILES['foto']['tmp_name'];
                    $data=base64_encode(file_get_contents($file_tmp));
                    $query="update utilizador set foto_nome='".$file_name."',foto_tipo='".$file_type."',
                    foto_tamanho='".$file_size."',foto_dados='".$data."' where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
                    $result_up=mysqli_query($ligax,$query);
				}
				echo ("
				<script>
				alert('Parabéns". $nome.", a edição de perfil foi realizada com sucesso.');
				</script>
				");
		   } else { ?>	
		       <script>
			   alert("Dados não inseridos!");
			   </script>
		   <?php }
		}
	} 
	?>
	
	
	
	
    <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Editar Perfil</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Edite o seu <strong>Perfil</strong></h4>

<?php
    $query="select * from utilizador where cod_utilizador='".$_SESSION["cod_utilizador"]."'";
    $result=mysqli_query($ligax,$query);
    $registo=mysqli_fetch_assoc($result);
    $nome=$registo['nome'];
    $genero=$registo['genero'];
    $nif=$registo['nif'];
    $morada=$registo['morada'];
    $codigo_postal=$registo['codigo_postal'];
    $localidade=$registo['localidade'];
    $pais=$registo['pais'];
	$email=$registo['email'];
	$data_nascimento=$registo['data_nascimento'];
	$telemovel=$registo['telemovel'];
?>



            <form action="" method="POST" role="form" class="contactForm" enctype="multipart/form-data">
              <div id="sendmessage">Perfil alterado com sucesso!</div>
              <div id="errormessage"></div>

              <div class="row">
				<p align="center"><img class="redondo" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $_SESSION['cod_utilizador'];?>" width="100" align="center"></p>
				 <div class="span4 form-group">
				Nome
                  <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" id="" placeholder="" required="required"  />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				Email
                  <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" id="" placeholder="" required="required"  />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				NIF
                  <input type="text" class="form-control" value="<?php echo $nif; ?>" name="nif" id="" placeholder=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Morada
                  <input type="text" class="form-control" value="<?php echo $morada; ?>" name="morada" id="" placeholder=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Código Postal
                  <input type="text" class="form-control" value="<?php echo $codigo_postal; ?>" name="codigo_postal" id="" placeholder=""   />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Localidade
                  <input type="text" name="localidade" value="<?php echo $localidade; ?>" class="form-control"  id="localidade" />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				País
                  <input type="text" name="pais" class="form-control" value="<?php echo $pais; ?>" id="" />
                  <div class="validation"></div>
                </div>	
				 <div class="span4 form-group">
				Telemóvel
                  <input type="text" name="telemovel" class="form-control" value="<?php echo $telemovel; ?>" id="telemovel" />
                  <div class="validation"></div>
                </div>	
				 <div class="span4 form-group">
				<p>Data de nascimento</p>
                  <input type="date" class="form-control" value="<?php echo $data_nascimento; ?>" name="data_nascimento" id=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				<p>Género</p>
                  <select type="genero" class="form-control" value="<?php echo $genero; ?>" name="genero" id=""  />
                  <option value="F" <?php if($genero=="F") echo "selected"; ?> > Feminino </option>
				  <option value="M" <?php if($genero=="M") echo "selected"; ?> > Masculino </option>
				  </select>
				  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				<p>Password</p>
                  <input type="password" class="form-control"  value="" name="password" id=""  />
                  <div class="validation"></div>
                </div>
				<div class="span4 form-group">
				Foto de Perfil
                  <input type="file" name="foto" class="form-control" value="<?php echo $foto; ?>" id=""  />
                  <div class="validation"></div>
                </div>		
				
                <div class="span12 margintop10 form-group"> 
                  <div class="validation"></div>
                  <p class="text-center">
                    <button class="btn btn-large btn-theme margintop10" type="submit" name="submit_confirmar_dados">Guardar alterações</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
	