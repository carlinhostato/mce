<?php
if(isset($_GET['email'])){
	$email=$_GET['email'];
	$update="update newsletter set ativo=1 where email='".$email."'";
	$result=mysqli_query($ligax,$update);
?>
<script>
    alert("Confirmação realizada com sucesso. Efetue login!");
   
</script>
<?php
include("home.php");
}
?>		