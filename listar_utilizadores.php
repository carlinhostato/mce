<?php
if(isset($_POST['submit_perfil'])){
    $perfil=$_POST['perfil_util'];
	$utilizador=$_POST['utilizador'];
	$atualizar="UPDATE utilizador set perfil='".$perfil."' where cod_utilizador='".$utilizador."'";
	$result=mysqli_query($ligax,$atualizar);
	if($result==1){
		echo"<p>A edição da variável de perfil foi atualizada. </p>";
	} else {
		echo "<p>Variável perfil não atualizada. </p>";
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
        </div>
      </div>
    </section>
    <section id="content">
   
      <div class="container">
        <div class="row">
          <div class="span12">
           <form action="" method="POST">
    <table class="table">
        <tr>
            <td>
    <input type="text" class="form-control" size="50%" id="nome" name="nome"
    value= "<?php if(isset($_POST['Confirmar'])) echo $_POST['nome']; ?>" required="required"/>
</td>
<td>
    <input class="btn btn-primary py-2 px-3" name="Pesquisar" type="submit" value="Pesquisar" />
</td>
</tr>
</table>
</form>
 


<?php
if(isset($_POST['Pesquisar'])){
	$consulta="select * from utilizador where nome like'%".$_POST['nome']."%'";
} else {
	$consulta="select * from utilizador order by nome ASC" ;
}
$result =mysqli_query($ligax, $consulta);
if($result) {
    $n=mysqli_num_rows($result);
	if($n>0) {
		
		

        //paginação - Apenas listar 10 clientes numa pagina
        $reg_pag=2; // Número de registos a apresentar por pagina
        if(isset($_GET['pag'])) { $pag=$_GET['pag'];} else {$pag=1;}
        $pag_ant=$pag-1;
        $pag_seg=$pag+1;
        $pag_ini=($reg_pag*$pag) -$reg_pag;
        $num_reg=mysqli_num_rows ($result);
        if($num_reg <= $reg_pag){
            $num_pag=1;
        }
        else if (($num_reg % $reg_pag)==0)    {
            $num_pag=$num_reg/$reg_pag;
        }    else {
           $num_pag=$num_reg/$reg_pag + 1;
		}
	
	//Na base de dados seleciona os registos entre dois limites
$consulta=$consulta." limit $pag_ini,$reg_pag";
$result=mysqli_query($ligax, $consulta);
?>

	
		<table class="table">
		  <thead class="thead-primary">
		     <tr class="text-center">
			  <th>Código</th>
			  <th>Foto</th>
			  <th>Nome</th>
			  <th>Email</th>
			  <th>Perfil</th>
			  <th></th>
			  <th></th>
			</tr>
		 </thead>
<tbody>
    <?php
    while($registo=mysqli_fetch_assoc($result)){
        $cod_utilizador=$registo['cod_utilizador'];
        $nome=$registo['nome'];
        $email=$registo['email'];
        $telemovel=$registo['telemovel'];
        $perfil=$registo['perfil'];
    ?>
    <form action="" method="POST">
      <tr class="text-center">
        <td class=""><?php echo $cod_utilizador; ?></td>
        <input type="hidden" class="" name="utilizador" value="<?php echo $cod_utilizador; ?>">
        <td class=""><img class="redondo_pequeno" width="50" src="showfile_fotodeperfil.php?cod_utilizador=<?php echo $cod_utilizador; ?>"></td>
        <td class=""><?php echo $nome; ?></td>
        <td class=""><?php echo $email; ?></td>
        <td class="">

        <?php 
                          if($perfil == 3){ ?>
                                 <select name="perfil_util" >
                                    
                                    <option value="3">Fundador</option>
                                  
                                </select> 
						  <?php } else if ($perfil==2 && $_SESSION['perfil']!=3){?>

                                <select name="perfil_util"   >
                                    <option value="2">Administrador</option>
                                </select> 
                            <?php  

                               
                            } else { ?>
                                    
                           
                                <select name="perfil_util">
									<option value="-1"<?php if ($perfil==-1) echo "selected";?>>Banido</option>    
                                    <option value="0" <?php if ($perfil==0) echo "selected";?>>Por Validar</option>
                                    <option value="1" <?php if ($perfil==1) echo "selected";?>>Cliente</option>
                                    <option value="2" <?php if ($perfil==2) echo "selected";?>>Administrador</option>
                                </select>
                            <?php     
                            } 
                        
                      
                        ?>
		</td>
		<td class=""><input type="submit" class="btn btn-primary py-2 px-3" name="submit_perfil" value="Alterar perfil"></td>
		<td class=""><a href="index.php?pagina=editar_utilizador&cod_utilizador=<?php echo $cod_utilizador;?>">Ver perfil</a></td>
	  </tr><!-- END TR-->	
	  </form>
	<?php
	    }
    ?>
    </tbody>

        </table>
	<?php
    }
}
?>	

<table>
<tr>


                <?php
                if(($pag_ant)&&($pag>1)){    ?>
				<td>
                
                <a class="page-link" href="index.php?pagina=listar_utilizadores&pag=<?php echo $pag_ant; ?>" aria-label="Anterior">
                <span aria-hidden="true"><font color='blue'><b>&laquo;&nbsp;</b></font></span>
              
                </a>
                
				</td>
				
                <?php }
                for($i=1;$i<=$num_pag;$i++){
                    if($i!=$pag) {
                        echo "<td><a class='page-link' href='index.php?pagina=listar_utilizadores&pag=$i'><font color='blue'><b>&nbsp;&nbsp;$i</b></font></a></td>";
                    }
                else {
                    echo "<td><a class='page-link' href='index.php?pagina=listar_utilizadores&pag=$i'><font color'red'><b>&nbsp;&nbsp;$i</b></font></a></td>";
                    }
                }
				?>
					
				<?php
                if($pag+1<=$num_pag){ ?>
                <td>
                <a class="page-link" href="index.php?pagina=listar_utilizadores&pag=<?php echo $pag_seg; ?>" aria-label="">
                <span aria-hidden='true'><font color='blue'><b>&nbsp;&raquo;</b></font></span>
                
                </a></td>
                <?php
                }
                ?>
         
			
			</tr>
			</table>

			</div>
			
			

			
			
			
			
			
        </div>
      </div>
    </section>



