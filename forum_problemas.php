<?php
				if (isset($_GET["acao"])){
						if($_GET["acao"] =="publicacao_favorito"){
							$select="select * from publicacao_favorito where cod_problema='".$_GET['cod_problema']."'
					and	cod_utilizador='".$_SESSION['cod_utilizador']."'" ;
					
				
					$result=mysqli_query($ligax,$select);
					$n=mysqli_num_rows($result);
					if($n==1) {
						
						$delete="delete from publicacao_favorito where cod_problema='".$_GET['cod_problema']."'
						and cod_utilizador='".$_SESSION['cod_utilizador']."'";
						$result_delete=mysqli_query($ligax,$delete);
					
					}
							else{
								
								$insert="insert into publicacao_favorito (cod_problema, cod_utilizador) values ('".$_GET['cod_problema']."','".$_SESSION['cod_utilizador']."')";
								$result_insert=mysqli_query($ligax,$insert);
								}
							}
							
							if($_GET["acao"] =="eliminar"){ ?>
								<script>
								var confirmado = confirm('Deseja eliminar a publicação?');
								</script>
								<?php
									$variavelphp = "<script>document.write(confirmado)</script>";

								if($variavelphp==true) {
						$eliminar="delete from problema where cod_problema='".$_GET['cod_problema']."'
					and	cod_utilizador='".$_SESSION['cod_utilizador']."'" ;
					
				  
					$result=mysqli_query($ligax,$eliminar);
					if($result) {
						?>
					<script>
								window.alert('Publicação eliminada com sucesso!');
								</script>
					<?php
					} else { 
					?>
					<script>
								window.alert('Tem comentários associados à publicação que terão de ser previamente eliminados!');
								</script>
					<?php
							
				}	} } }
								
				?>		



    <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Ocorrências</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
 		
						 <?php 

    
					 if(isset($_GET['cod_categoria'])){$consulta="select * from problema, utilizador where problema.cod_utilizador=utilizador.cod_utilizador and problema.cod_categoria='".$_GET['cod_categoria']."' order by data_hora DESC" ;
					 } else { $consulta="select * from problema, utilizador where problema.cod_utilizador=utilizador.cod_utilizador order by data_hora DESC" ; }
		$result =mysqli_query($ligax, $consulta);
		if($result) {
			
			while($registo=mysqli_fetch_assoc($result)){
				$descricao=$registo['descricao'];
				$cod_utilizador=$registo['cod_utilizador'];
				$cod_problema=$registo['cod_problema'];
				$nome=$registo['nome'];
				$data_hora=$registo['data_hora'];
			
		 ?>
	 
            
			
            
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
				  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i> <?php echo $data_hora; ?></li>
					<?php if(isset($_SESSION['perfil'])){ ?>  
					  
                      
				<?php	 
				$select="select * from publicacao_favorito where cod_problema='".$cod_problema."' and (cod_utilizador='".$_SESSION['cod_utilizador']."' )";
				$result_fav=mysqli_query($ligax,$select);
				$n= mysqli_num_rows($result_fav);
				if($n==1){
				?>
				<li><i class=" icon-heart	"></i><a href="index.php?pagina=forum_problemas&acao=publicacao_favorito&cod_problema=<?php echo $cod_problema;?>">Gosto</a></li>			
				<?php
				}else{
				?><li><i class=" icon-heart-empty"></i><a href="index.php?pagina=forum_problemas&acao=publicacao_favorito&cod_problema=<?php echo $cod_problema;?>">Gosto</a></li>
                     
				<?php
				}
				?> 
					 
                      <li><i class="icon-comments"></i><a href="index.php?pagina=abrir_publicacao&cod_problema=<?php echo $cod_problema; ?>">Ver Publicação</a></li>
					  <?php if($cod_utilizador==$_SESSION['cod_utilizador']){ ?>
					  <li><i class=" icon-cogs"></i><a href="index.php?pagina=editar_problema&cod_problema=<?php echo $cod_problema; ?>">Editar Publicação</a></li>
					  <li><i  name="del" class=""></i><a href="index.php?pagina=forum_problemas&acao=eliminar&cod_problema=<?php echo $cod_problema;?> ">Eliminar</a></li>
					  </form>
					  <?php } ?>
					  
					<?php } ?>
                    
					
					</ul>
                  </div>
                </div>
              </div>
			  <?php }} ?>
            
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
  </div>
  <a href="#" class="scrollup"><i class="icon-chevron-up icon-square icon-32 active"></i></a>
  <!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jcarousel/jquery.jcarousel.min.js"></script>
  <script src="js/jquery.fancybox.pack.js"></script>
  <script src="js/jquery.fancybox-media.js"></script>
  <script src="js/google-code-prettify/prettify.js"></script>
  <script src="js/portfolio/jquery.quicksand.js"></script>
  <script src="js/portfolio/setting.js"></script>
  <script src="js/jquery.flexslider.js"></script>
  <script src="js/jquery.nivo.slider.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/jquery.ba-cond.min.js"></script>
  <script src="js/jquery.slitslider.js"></script>
  <script src="js/animate.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="js/custom.js"></script>

</body>

</html>
