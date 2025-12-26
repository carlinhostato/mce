<?php
if(isset($_GET['codigo'])){
	$codigo=$_GET['codigo'];
	$update="update utilizador set perfil=1 where cod_utilizador='".$codigo."'";
	$result=mysqli_query($ligax,$update);
?>
<script>
    alert("Confirmação realizada com sucesso. Efetue login!");
   
</script>
<?php
}
?>		