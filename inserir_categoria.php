<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Inserir Categoria</h2>
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
		  
		  
		    <?php
                                    if(isset($_POST['submit_categoria'])){

                                        $flag=false;
                                        $flag_nome=false;
                                       
										
                                        $nome_categoria=$_POST['nome_categoria'];
                                        $descricao_categoria=$_POST['descricao_categoria'];
                                        $ativa=$_POST['ativa'];

                                        /* verificar se o nome categoria já existe */
                                        $query="select nome_categoria from categoria where nome_categoria='".$nome_categoria."' ";
										$result=mysqli_query($ligax, $query);
                                        $n=mysqli_num_rows($result);
                                        if($n>0){
                                            $flag=true;
                                            $flag_nome=true;
                                        }

                                        
                                        /* Existiu um erro */
                                        if($flag==true) { 
                                            if($flag_nome==true){ ?> 
                                            <script>
                                                alert("Nome da categoria já existente.");
                                            </script> 
                                        <?php } 
                                       
                                    } else {
										
                                        $insere="INSERT INTO categoria (nome_categoria,descricao_categoria,ativa) VALUES ('".$nome_categoria."','".$descricao_categoria."','".$ativa."')";
                                        $result=mysqli_query($ligax,$insere);
                                        if($result==1){
                                            $cod=mysqli_insert_id($ligax); 
                                            
											if($_FILES['foto']['error']==0){
                    $file_name=$_FILES['foto']['name'];
                    $file_type=$_FILES['foto']['type'];
                    $file_size=$_FILES['foto']['size'];
                    $file_tmp=$_FILES['foto']['tmp_name'];
                    $data=base64_encode(file_get_contents($file_tmp));
                    $query="update categoria set nome_imagem='".$file_name."',tipo_imagem='".$file_type."',
                    tamanho_imagem='".$file_size."',dados_imagem='".$data."' where cod_categoria='".$cod."'";
                    $result_up=mysqli_query($ligax,$query);
				}
											
											
                                            ?> 
                                            <script>
                                                alert("Categoria adicionada com sucesso."); 
                                            </script> 
                                        <?php    }   else {
                                                ?>
                                                <script>
                                                    alert("Categoria não inserida!");
                                                </script> 
                                                <?php
                                                }
                                            }
                                        } ?>
		  
            <h4>Insira a categoria</h4>

            <form action="" method="POST" role="form" class="contactForm" enctype="multipart/form-data">
              <div id="sendmessage">Categoria adicionada com sucesso!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="span4 form-group">
				<p>Nome da Categoria</p>
                  <input type="text" name="nome_categoria" class="form-control" id="name"	 data-rule="minlen:4" required="required" />
                  <div class="validation"></div>
                </div>
				<div class="span4 form-group">
				<p>Foto da categoria</p>
				<input type="file" name="foto" class="form-control" value="<?php echo $foto_categoria; ?>" id=""  />
                  <div class="validation"></div>  
				 </div>
				 <div class="span4 form-group">
				<p>Estado</p>
				<input type="radio" name="ativa" class="form-control" value="1" id="" checked />&nbsp;Ativada
				&nbsp;&nbsp;
				<input type="radio" name="ativa" class="form-control" value="0" id=""  />&nbsp;Desativada
                  <div class="validation"></div>  
				 </div>
                <div class="span12 margintop10 form-group">
				<p>Descrição da Categoria</p>
                  <textarea class="form-control" name="descricao_categoria" rows="4" data-rule="required" required="required"></textarea>
                  <div class="validation">
				  </div>
                  <p class="text-center">
                    <button class="btn btn-large btn-theme margintop10" name="submit_categoria" type="submit">Adicionar Categoria</button>
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