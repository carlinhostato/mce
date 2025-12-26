<?php include "ligacao.php"; ?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <title>MCE - Manutenção da Cidade de Espinho</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <!-- css -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700|Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet" />
  <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
  <link href="css/jcarousel.css" rel="stylesheet" />
  <link href="css/flexslider.css" rel="stylesheet" />
  <link href="css/slitslider.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <!-- Theme skin -->
  <link id="t-colors" href="skins/default.css" rel="stylesheet" />
  <!-- boxed bg -->
  <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
  <link rel="shortcut icon" href="ico/icone.png" />


</head>

<body>
  <div id="wrapper">
    <!-- toggle top area -->
    <div class="hidden-top">
      <div class="hidden-top-inner container">
        <div class="row">
          <div class="span12">
            <ul>
              <li><strong>Estamos à disposição para qualquer tipo de anomalia que exista no aplicativo, entre outros.</strong></li>
              <li></li>
              <li><i class="icon-envelope-alt"></i> manutencaocidadedeespinho@sapo.pt</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- end toggle top area -->
    <!-- start header -->
<?php 
	if(isset($_GET['pagina'])){
        if($_GET['pagina']=='validacao'){
            include("validacao.php");
        }
    }
	
	//MENUS
	
	include "header.php";
	
	
	//PÁGINAS
  
	if(isset($_GET['pagina'])){
        $pagina=$_GET['pagina'];
		if($pagina=="editar_perfil") include "editar_perfil.php"; 
		else if($pagina=="alterar_password") include "alterar_password.php";
		else if($pagina=="listar_utilizadores") include "listar_utilizadores.php";
		else if($pagina=="validar_login") include "home.php";
		else if($pagina=="editar_utilizador") include "editar_utilizador.php";
		else if($pagina=="contact") include "contact.php";
		else if($pagina=="recuperar_password") include "recuperar_password.php";
		else if($pagina=="forum_problemas") include "forum_problemas.php";
		else if($pagina=="publicar_problema") include "publicar_problema.php";
		else if($pagina=="listar_categorias") include "listar_categorias.php";
		else if($pagina=="editar_categoria") include "editar_categoria.php";
		else if($pagina=="inserir_categoria") include "inserir_categoria.php";
		else if($pagina=="abrir_publicacao") include "abrir_publicacao.php";
		else if($pagina=="about") include "about.php";
		else if($pagina=="validar_newsletter") include "validar_newsletter.php";
		else if($pagina=="editar_problema") include "editar_problema.php";
		
    } else include "home.php";
    
  
  
  
	//RODAPÉ
    include "footer.php";  
  ?>
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
