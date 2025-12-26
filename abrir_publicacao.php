<?php 
//Inserir comentário

if(isset($_POST['comentar'])){
	$comentario=$_POST['comentario'];
	$inserir="insert into comentario (cod_utilizador,cod_problema,texto_comentario,data_hora) 
	values ('".$_SESSION['cod_utilizador']."','".$_GET['cod_problema']."','".$comentario."',now())";
	//echo $inserir;
	$result=mysqli_query($ligax,$inserir);
	
}

?>


    <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Ver Ocorrência</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	<?php
	$consulta="select * from problema, utilizador where problema.cod_utilizador=utilizador.cod_utilizador and cod_problema	='".$_GET['cod_problema']."' order by data_hora DESC" ; 
		$result =mysqli_query($ligax, $consulta);
		if($result) {
			
			while($registo=mysqli_fetch_assoc($result)){
				$descricao=$registo['descricao'];
				$cod_utilizador=$registo['cod_utilizador'];
				$cod_problema=$registo['cod_problema'];
				$nome=$registo['nome'];
				$data_hora=$registo['data_hora'];
			}
		}
	?>
	
		<section id="content">
        <div class="container">
		<div class="row">
          <div class="span8">
			   <div class="media">
			   <?php if(isset($_SESSION["perfil"])) { if($_SESSION["perfil"]==2 ||$_SESSION["perfil"]==3){ ?>
			 

                <a href="index.php?pagina=editar_utilizador&cod_utilizador=<?php echo $cod_utilizador; ?>" class="thumbnail pull-left">
				
				<img width="100" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $cod_utilizador; ?>" alt="" /></a>
				
				
			   <?php } else { ?> 
			            <a href="" class="thumbnail pull-left">
			   <img width="100" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $cod_utilizador; ?>" alt="" /> </a>
			   <?php }
			   
			   } else { ?> 
			    <a href="" class="thumbnail pull-left">
			   <img width="100" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $cod_utilizador; ?>" alt="" /></a>
			   <?php }
			   ?> 
                <div class="media-body">
                  <div class="media-content">
                    <h6><span></span><?php echo $nome; ?></h6>
                    <p>
                      <?php echo $descricao; ?>
					  </p> <br> 
					  <p align="center">
					   <a href="#" class=""><img width="400" src="showfile_foto_problema.php?cod_problema=<?php echo $cod_problema; ?>" alt="" /></a>
					   </p>
                  </div>
				  
                </div>
              </div>
		
            <!-- author info -->
          <div class="comment-area">
		  
		   <h4>Comente a ocorrência</h4>
              <form id="commentform" action="#" method="post" name="comment-form">
                <div class="row">
                  
                  <div class="span8 margintop10">
                    <p>
                       <textarea class="form-control" name="comentario" rows="4" data-rule="required" required="required"></textarea>
                    </p>
                    <p>
                      <button class="btn btn-theme margintop10" name="comentar" type="submit">Comentar</button>
                    </p>
                  </div>
				  
				  
                </div>
              </form>
			  
			  
			 <?php
			 $consulta="select * from comentario where cod_problema='".$_GET['cod_problema']."' and estado=1 order by data_hora DESC" ; 
		$result =mysqli_query($ligax, $consulta);
		if($result) {
			
			while($registo=mysqli_fetch_assoc($result)){
				$texto_comentario=$registo['texto_comentario'];
				$data_hora=$registo['data_hora'];
				$cod_utilizador=$registo['cod_utilizador'];
				
			  $consulta_nome="select nome from utilizador where cod_utilizador='".$cod_utilizador."'";
			  $result_nome =mysqli_query($ligax, $consulta_nome);
			  if($result_nome) {
			  while($registo_nome=mysqli_fetch_assoc($result_nome)){
				$nome=$registo_nome['nome'];
			  } }
			  ?>
			  
			  
			  
              <div class="media">
                <a href="#" class="thumbnail pull-left"><img src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $cod_utilizador; ?>" alt="" /></a>
                <div class="media-body">
                  <div class="media-content">
                    <h6><?php echo $nome; ?> </h6><p><?php echo $data_hora; ?></p>
                    <p>
                    <?php echo $texto_comentario; ?>
                    </p>	
                  <!--  <a href="" class="align-right">Reply comment</a> -->
                  </div>
                </div>
              </div>
			  
			
		<?php }}
			 ?>
			
			
			
			
             
            </div>
          </div>
          <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <h5 class="widgetheading">Categorias</h5>
                <ul class="folio-detail">
				<?php $consulta="select * from categoria where ativa=1 order by nome_categoria ASC" ;
				$result =mysqli_query($ligax, $consulta);
				if($result) {
				$n=mysqli_num_rows($result);
				if($n>0) {
					while($registo=mysqli_fetch_assoc($result)){
						$cod_categoria=$registo['cod_categoria'];
						$nome_categoria=$registo['nome_categoria'];
						
						$consulta_problemas="select count(*) as total from problema where problema.cod_categoria='".$cod_categoria."'" ;
						$result_problemas =mysqli_query($ligax, $consulta_problemas);
						if($result_problemas) {
							$registo_problema=mysqli_fetch_assoc($result_problemas);
								$total=$registo_problema['total'];

						
						?>
                  <li><label><a href="index.php?pagina=forum_problemas&cod_categoria=<?php echo $cod_categoria; ?>"><?php echo $nome_categoria; ?>: </label><?php echo $total; ?></a></li>
				<?php	
				}
				}
				}
				}
				?> 
				  
                </ul>
            </aside>
          </div>
        </div>
      </div>
    </section>
  