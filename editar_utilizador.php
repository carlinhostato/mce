

<?php 
	if(isset($_POST['submit_confirmar_dados'])) {
		$flag=false;
		$flag_password=false;
		$perfil=$_POST['perfil'];
		$password=$_POST['password'];
		$password=md5($password);
		/* confirmar palavra passe */
		$query="select password from utilizador where cod_utilizador='".$_SESSION["cod_utilizador"]."'"; //Password do admin que é o que tem a sessão iniciada!!!
		$result=mysqli_query($ligax,$query);
		$registo=mysqli_fetch_assoc($result);
		$passwordBD=$registo['password'];
		if(($passwordBD!=$password)){
			$flag=true;
			$flag_password=true;
		    }
			
		if($flag==true){
			if($flag_password==true) echo "Password incorreta! Insira a password de admin para atualizar os dados do perfil do utilizador";
		}
		else {
			$atualizar="UPDATE utilizador set perfil='".$perfil."' where cod_utilizador='".$_GET["cod_utilizador"]."'";
			//Estou a alterar a variável perfil do utilizador cujo código vem pelo método GET
			$result=mysqli_query($ligax,$atualizar);
			if($result==1){
				
			} else {
				
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
              <h2>Perfil do utilizador</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li class="active">Perfil do utilizador</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">


<?php
    $query="select * from utilizador where cod_utilizador='".$_GET["cod_utilizador"]."'";
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
	$perfil=$registo['perfil'];
?>



            <form action="" method="POST" role="form" class="contactForm" enctype="multipart/form-data">
              <div id="sendmessage">Perfil alterado com sucesso!</div>
              <div id="errormessage"></div>

              <div class="row">
			  <p align="center"><img class="redondo" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $_GET['cod_utilizador'];?>" width="100" align="center"></p>
                <div class="span4 form-group">
				
				Nome
                  <input type="text" name="nome" class="form-control" disabled value="<?php echo $nome; ?>" id="" placeholder="" required="required"  />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				Email
                  <input type="email" class="form-control" disabled value="<?php echo $email; ?>" name="email" id="" placeholder="" required="required"  />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				NIF
                  <input type="text" class="form-control" disabled value="<?php echo $nif; ?>" name="nif" id="" placeholder=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Morada
                  <input type="text" class="form-control" disabled value="<?php echo $morada; ?>" name="morada" id="" placeholder=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Código Postal
                  <input type="text" class="form-control" disabled value="<?php echo $codigo_postal; ?>" name="codigo_postal" id="" placeholder=""   />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				Localidade
                  <input type="text" name="localidade" disabled value="<?php echo $localidade; ?>" class="form-control"  id="localidade" />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				País
                  <input type="text" name="pais" disabled class="form-control" value="<?php echo $pais; ?>" id="" />
                  <div class="validation"></div>
                </div>	
				 <div class="span4 form-group">
				Telemóvel
                  <input type="text" name="telemovel" disabled class="form-control" value="<?php echo $telemovel; ?>" id="telemovel" />
                  <div class="validation"></div>
                </div>	
				 <div class="span4 form-group">
				<p>Data de nascimento</p>
                  <input type="date" class="form-control" disabled value="<?php echo $data_nascimento; ?>" name="data_nascimento" id=""  />
                  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
				<p>Género</p>
                  <select type="genero" disabled class="form-control" value="<?php echo $genero; ?>" name="genero" id=""  />
                  <option value="F" <?php if($genero=="F") echo "selected"; ?> > Feminino </option>
				  <option value="M" <?php if($genero=="M") echo "selected"; ?> > Masculino </option>
				  </select>
				  <div class="validation"></div>
                </div>
				 <div class="span4 form-group">
	            <p>Alteração de Perfil</p>
                 <?php 
                          if($_SESSION['perfil'] == 2){ ?>
                                
                                <select name="perfil"  <?php if ( $perfil==2)  { echo "disabled"; } ?>>
                                    <option value="-1"<?php if ($perfil==-1) echo "selected";?>>Banido</option>    
                                    <option value="0" <?php if ($perfil==0) echo "selected";?>>Por Validar</option>
                                    <option value="1" <?php if ($perfil==1) echo "selected";?>>Cliente</option>
                                    <option value="3"<?php if ($perfil==3) echo "selected";?>>Fundador</option>
                                    <option value="2" <?php if ($perfil==2) echo "selected";?>>Administrador</option>
                                </select> 
                            <?php  

                               
                            } else if($_SESSION['perfil'] == 3){ ?>
                                    
                           
                                <select name="perfil" <?php if ($perfil==2 || $perfil==3)  { echo "disabled"; } ?>>
                       
                                <option value="-1"<?php if ($perfil==-1) echo "selected";?>>Banido</option>    
                                    <option value="0" <?php if ($perfil==0) echo "selected";?>>Por Validar</option>
                                    <option value="1" <?php if ($perfil==1) echo "selected";?>>Cliente</option>
                                    <option value="3"<?php if ($perfil==3) echo "selected";?>>Fundador</option>
                                    <option value="2" <?php if ($perfil==2) echo "selected";?>>Administrador</option>
                                </select>
                            <?php     
                            } 
                        ?>
							
	            <p>Password de admin</p>
		        <input type="password" class="form-control" placeholder="Confirmar password de admin" name="password" required="required" value="">
	            <div class="validation"></div>
	        </div>
			
			
			
			
			
                <div class="span12 margintop10 form-group"> 
                  <div class="validation"></div>
                  <p class="text-center">
                    <button class="btn btn-large btn-theme margintop10" type="submit" name="submit_confirmar_dados">Guardar alteração</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
	
	