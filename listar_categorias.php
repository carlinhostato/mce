<?php
if(isset($_POST['submit_estado'])){
    $ativa=$_POST['ativa'];
	$cod_categoria=$_POST['cod_categoria'];
	$atualizar="UPDATE categoria set ativa='".$ativa."' where cod_categoria='".$cod_categoria."'";
	$result=mysqli_query($ligax,$atualizar);
	if($result==1){
		echo"<p>A edição do estado da categoria foi atualizado. </p>";
	} else {
		echo "<p>A edição do estado da categoria não foi atualizado. </p>";
	}
}
?>

	
    <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Tipos de Categorias</h2>
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
if(isset($_POST['Pesquisar'])){
	$consulta="select * from categoria where nome_categoria like'%".$_POST['nome']."%'";
} else {
	$consulta="select * from categoria order by nome_categoria ASC" ;
}

$result =mysqli_query($ligax, $consulta);
if($result) {
    $n=mysqli_num_rows($result);
	if($n>0) {
	?>
		<table class="table">
		  <thead class="thead-primary">
		     <tr class="text-center">
			  <th>Código</th>
			  <th>Foto</th>
			  <th>Nome da Categoria</th>
			  <th>Descrição da Categoria</th>
			  <th></th>
			  <th></th>
			</tr>
		 </thead>
<tbody>
    <?php
    while($registo=mysqli_fetch_assoc($result)){
        $cod_categoria=$registo['cod_categoria'];
        $nome_categoria=$registo['nome_categoria'];
        $descricao_categoria=$registo['descricao_categoria'];
		$ativa=$registo['ativa'];
    ?>
    <form action="" method="POST">
      <tr class="text-center">
        <td class=""><?php echo $cod_categoria; ?></td>
        <input type="hidden" class="" name="cod_categoria" value="<?php echo $cod_categoria; ?>">
        <td class=""><img class="" width="50" src="showfile_foto_categoria.php?cod_categoria=<?php echo $cod_categoria; ?>"></td>
        <td class=""><?php echo $nome_categoria; ?></td>
        <td class=""><?php echo $descricao_categoria; ?></td>
        <td class="">

                
                           <input type="radio" name="ativa" class="form-control" value="1" id="" <?php if($ativa==1) { echo "checked"; } ?> />&nbsp;Ativada
				&nbsp;&nbsp;
				<input type="radio" name="ativa" class="form-control" value="0" id="" <?php if($ativa==0) { echo "checked"; } ?>   />&nbsp;Desativada
                           
                   
		</td>
		<td class=""><input type="submit" class="btn btn-primary py-2 px-3" name="submit_estado" value="Alterar Estado"></td>
		<td class=""><a href="index.php?pagina=editar_categoria&cod_categoria=<?php echo $cod_categoria;?>">Ver Categoria</a></td>
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
			</div>
        </div>
      </div>
    </section>
