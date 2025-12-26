 <?php
   if(isset($_GET['pagina'])){
        if($_GET['pagina']=='validar_login'){
            include("validar_login.php");
        }
       
    }
        if(isset($_SESSION["perfil"])){
            if(($_SESSION["perfil"])==2) include("menu_admin.php"); 
            else if(($_SESSION["perfil"])==1) include("menu_utilizador.php"); 
			else if(($_SESSION["perfil"])==3) include("menu_fundador.php"); 
        } else include("menu_visit.php");?>   

  