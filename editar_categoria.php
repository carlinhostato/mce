<?php 
	if(isset($_POST['submit_confirmar_dados'])) {
		$flag=false;
		$flag_password=false;
		
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
			
											
			$nome_categoria=$_POST['nome_categoria'];
			$descricao_categoria=$_POST['descricao_categoria'];
			$ativa=$_POST['ativa'];
			$atualizar="UPDATE categoria set nome_categoria='".$nome_categoria."',descricao_categoria='".$descricao_categoria."', ativa='".$ativa."' where cod_categoria='".$_GET["cod_categoria"]."'";
			//Estou a alterar a variável perfil do utilizador cujo código vem pelo método GET
			$result=mysqli_query($ligax,$atualizar);
			if($result==1){
         
			
				if($_FILES['foto_categoria']['error']==0){
                    $file_name=$_FILES['foto_categoria']['name'];
                    $file_type=$_FILES['foto_categoria']['type'];
                    $file_size=$_FILES['foto_categoria']['size'];
                    $file_tmp=$_FILES['foto_categoria']['tmp_name'];
                    $data=base64_encode(file_get_contents($file_tmp));
                    $query="update categoria set nome_imagem='".$file_name."',tipo_imagem='".$file_type."',
                    tamanho_imagem='".$file_size."',dados_imagem='".$data."' where cod_categoria='".$_GET["cod_categoria"]."'";
                    $result_up=mysqli_query($ligax,$query);
				}	
		        echo "<p>A edição da variável de categoria foi atualizada.</p>";
			} else {
				echo "<p>Dados da categoria não atualizados!</p>";
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
              <h2>Categoria</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.php"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li class="active">Categoria</li>
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
    $query="select * from categoria where cod_categoria='".$_GET["cod_categoria"]."'";
    $result=mysqli_query($ligax,$query);
    $registo=mysqli_fetch_assoc($result);
    $nome_categoria=$registo['nome_categoria'];
    $descricao_categoria=$registo['descricao_categoria'];
	 $ativa=$registo['ativa'];
?>



            <form action="" method="POST" role="form" class="contactForm" enctype="multipart/form-data">
              <div id="sendmessage">Categoria alterada com sucesso!</div>
              <div id="errormessage"></div>

              <div class="row">
			  <p align="center"><img class="" src="showfile_foto_categoria.php?cod_categoria=<?php echo $_GET['cod_categoria'];?>" width="400" align="center"></p>
                <div class="span4 form-group">
				
				<div class="row">
                <div class="span4 form-group">
				<p>Nome da Categoria</p>
                  <input type="text" name="nome_categoria" class="form-control"  value="<?php echo $nome_categoria; ?>" id="" placeholder="" required="required"  />
                  <div class="validation"></div>
                </div>
				<div class="span4 form-group">
				<p>Foto da categoria</p>
				<input type="file" name="foto_categoria" class="form-control"  value="<?php echo $foto_categoria; ?>" id=""  />
                  <div class="validation"></div>  
				 </div>
				 <div class="span4 form-group">
				<p>Estado</p>
				<input type="radio" name="ativa" class="form-control"  value="1" id="" <?php if($ativa==1) { echo "checked";} ?> />&nbsp;Ativa
				&nbsp;&nbsp;
				<input type="radio" name="ativa" class="form-control"   value="0" id="" <?php if($ativa==0) { echo "checked";} ?> />&nbsp;Inativa
                  <div class="validation"></div>  
				 </div>
                <div class="span12 margintop10 form-group">
				<p>Descrição da Categoria</p>
                 <textarea class="form-control"  value="" name="descricao_categoria" rows="4" id="" placeholder="" required="required"><?php echo $descricao_categoria; ?>
				 </textarea>
                  <div class="validation">
				  </div>
	             <div class="span4 form-group">
	            <p>Password de admin</p>
		        <input type="password" class="form-control" placeholder="Confirmar password de admin" name="password" required="required" value="">
	            <div class="validation"></div>
	             </div>
                 </div>
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
	
	