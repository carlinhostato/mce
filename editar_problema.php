
<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Editar Ocorrência</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">
            
			<?php
                                    if(isset($_POST['submit_edit'])){

                                 
                                       
										
                                        $cod_categoria=$_POST['cod_categoria'];
                                        $descricao=$_POST['descricao'];
										
															

                               
										
                                        $alterar="update problema set descricao='".$descricao."' where cod_problema='".$_GET['cod_problema']."'";
										$result=mysqli_query($ligax,$alterar);
                                        if($result==1){
                                            
                                            
											if($_FILES['foto']['error']==0){
                    $file_name=$_FILES['foto']['name'];
                    $file_type=$_FILES['foto']['type'];
                    $file_size=$_FILES['foto']['size'];
                    $file_tmp=$_FILES['foto']['tmp_name'];
                    $data=base64_encode(file_get_contents($file_tmp));
                    $query="update problema set foto_nome='".$file_name."',tipo_imagem='".$file_type."',
                    tamanho_imagem='".$file_size."',dados_imagem='".$data."' where cod_problema='".$_GET['cod_problema']."'";
                    $result_up=mysqli_query($ligax,$query);
				}
											
											
                                            ?> 
                                            <script>
                                                alert("Editado com sucesso."); 
                                            </script> 
                                        <?php    }   else {
                                                ?>
                                                <script>
                                                    alert("Erro ao Editar, tente novamente!");
                                                </script> 
                                                <?php
                                                }
                                            }
                                         ?>

    <section id="content">

      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Edite o sua ocorrência</h4>

            <form action="" method="POST" role="form" class="contactForm" enctype="multipart/form-data">
              <div id="sendmessage">Editado com sucesso!</div>
              <div id="errormessage"></div>
			<?php
				$query="select * from problema where cod_problema='".$_GET["cod_problema"]."'";
				$result=mysqli_query($ligax,$query);
				$alterar=mysqli_fetch_assoc($result);
				
				
				$descricao=$alterar['descricao'];
			
			?>




              <div class="row">
                <div class="span4 form-group">
				<p>Seu Nome Completo</p>
                  <input type="text" name="name" class="form-control" id="name" disabled value="<?php echo $_SESSION['nome']; ?>" data-rule="minlen:4" required="required" />
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
				<p>Seu Endereço de Email</p>
                  <input type="email" class="form-control" name="email" id="email"data-rule="email" disabled value="<?php echo $_SESSION['email']; ?>" required="required"/>
                  <div class="validation"></div>
                </div>
                <div class="span4 form-group">
							<p>Tipo de Problema</p>
				 
				 
				 <?php 
				 
				$select="select cod_categoria, nome_categoria  from categoria order by nome_categoria ASC";
				$result =mysqli_query($ligax, $select);
				if($result) {
					$n=mysqli_num_rows($result);
					if($n>0) {?>
					   <select name="cod_categoria">
					<?php
						
					while($registo=mysqli_fetch_assoc($result)){
						$cod_categoria=$registo['cod_categoria'];
						$nome_categoria=$registo['nome_categoria'];
				 
				 
				 ?>
				 
               
                  <option value="<?php echo $cod_categoria;?>"><?php echo $nome_categoria; ?></option>
                 
                  
				  
					<?php } ?>
				  
				  
                  </select>	
				<?php } } ?>
               

                  <div class="validation"></div>
                </div>
				<div class="span4 form-group">
				Foto da Ocorrência
                  <input type="file" name="foto" class="form-control" value="<?php echo $foto; ?>" id=""  />
                  <div class="validation"></div>
                </div>	
				
                <div class="span12 margintop10 form-group">
				<p>Descrição da Ocorrência</p>
                  <textarea class="form-control" name="descricao" rows="12" data-rule="required" required="required"> <?php echo $descricao; ?></textarea>
                  <div class="validation"></div>
                  <p class="text-center">
                    <button class="btn btn-large btn-theme margintop10" name="submit_edit" type="submit">Editar</button>
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
	