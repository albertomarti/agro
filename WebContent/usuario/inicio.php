<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])){ 
      header("Location: ../../index.php");
  }


  include_once '../servidor/productos.php';


  $server = new producto();

  $producto = $server->getProducto();  

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
    <title>
	   tuAGRO - Usuario
    </title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css"
      media="screen,projection" />
    <link rel="stylesheet" type="text/css" rel="stylesheet" href="../../css/estilo.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
				
</head>  
     
<body class="font-cover" id="main">
  <!-- MENU DE NAVEGACION --> 
<nav class="teal">
	<div class="container">
	  <div class="nav-wrapper">
	    <div class="row">
	      <div class="col s12">
	          <a href="../index.html" class="brand-logo"><h1>tuAGRO</h1></a> 
	          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>     
	          <ul id="nav-mobile" class="right hide-on-med-and-down">
	            <li  class="active"><a href="inicio.php">Inicio</a></li>
	         	   <li><a href="cultivo.php">Mis Cultivos</a></li>
                <li>
                 <a class="dropdown-button" href="#!" data-activates="dropdown2"><?php echo $_SESSION["nombre"]; ?> <?php echo $_SESSION["apellido"]; ?></a>
                </li>
                <i class="material-icons left">account_circle</i>
	          </ul>  
	          <!--menu desplegable-->
              <ul class="dropdown-content" id="dropdown2">
                <li><a href="../servidor/logout.php">Cerrar Sesion</a></li>
              </ul> 
 				<!--Menu movile-->      
                <ul class="side-nav" id="mobile-demo">
                  <li>
                    <div class="user-view">
                      <div class="background">
                        <img src="../../imagenes/banner1.jpg">
                      </div>
                      <a href="#"><img class="circle" src="../../imagenes/banner1.jpg"></a>
                      <a href="#"><span class="name"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"] ?></span></a>
                      <a href="#"><span class="email"><?php echo $_SESSION["email"]; ?></span></a>
                    </div>
                  </li>
                  <li class="active"><a href="inicio.php">Inicio</a></li>
                  <li><div class="divider"></div></li>
                  <li class="no-padding">
                  <li><a href="cultivo.php">Mis Cultivos</a></li>
                  <li><div class="divider"></div></li>
                  <li><a href="../servidor/logout.php">Cerrar Sesion</a></li>
                </ul>                      
	      </div>
	    </div>
	  </div>		
	</div>	
</nav>  

<div class="contenedor-principal">
    <div class="banner" style="visibility: visible; width: 100%; height: 200px; position: relative; overflow: hidden;">

          <img class="z-depth-3 responsive-img img-banner" src="../../imagenes/banner1.jpg">
          <div class="box">
              <h1><b>Bienvenidos</b></h1>
          </div><!-- /.box -->
    </div> 
    <div class="white banner center-align">
    	<div class="row">
        	<div class="bienvenida black-text col s12">
          		<h2>Hola <?php echo $_SESSION["usuario"]; ?></h2>
          		<h3>En este espacio podras ver los productos que se cultivan, datos sobre ellos y realizar estimaciones para una produccion</h3>
        	</div>
    	</div>  
    </div>
      <div class="container">
        <div class="row">
        <?php 
          if (count($producto) != 0) {
            for ($i=0; $i <count($producto) ; $i++) {
              echo '
                
                <div class="col s10 l4 m4 offset-s1">
                  <div class="card sticky-action"> 
                    <div class="card-image waves-effect waves-block waves-light">
                      <div class="row">
                        <img class="activator responsive-img" src="../../imagenes/papa.jpg"  style="width: 262px; height: 230px">
                      </div>
                    </div>
                    <div class="card-content" style="word-wrap: break-word;">
                      <span class="card-title activator grey-text text-darken-4">'.$producto[$i]['nombre'].'<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-action">
                      <span>
                      <a class="ver" id="'.$producto[$i]['id_producto'].'">Ver Producto<i class="material-icons left">folder_open</i></a>
                      </span>
                    </div>                        
                    <div class="card-reveal" style="word-wrap: break-word;">
                      <b><span class="card-title grey-text text-darken-4">'.$producto[$i]['nombre'].'<i class="material-icons right">close</i></span></b>
                      <br>
                      <hr>
                      <br>
                      <p ALIGN="justify">'.$producto[$i]['descripcion'].'</p>  
                      <br>
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
              ';
            }
          }  

          ?>
        </div>        
      </div>
</div>


        <footer class="page-footer teal">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">tuAGRO</h5>
                <p class="grey-text text-lighten-4">Proyecto de Actualizacion tecnologica 10mo Semestre, Ingenieria de Sistemas, Corporacion Universitaria de Caribe CECAR</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Desarrolladores</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Jose Alberto Martinez Villegas</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Luis Fernando Navaz Sierra</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Jahir Jose Estrada</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright Text
            </div>
          </div>
        </footer>




	<script type="text/javascript"
		src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="../../js/materialize.js"></script>
  <script type="text/javascript">
  		 $(document).ready(function() {
    	$('select').material_select();
    	$('.dropdown-button').dropdown({
        contrainWidth: true,
        gutter: 20,
        belowOrigin: true,
        alignment: 'left',
        stopPropagation: false
      }); 
      $('.button-collapse').sideNav();

      $(".ver").click(function(e){ 
        window.location="Producto.php?id_producto=" + e.target.id;          
      }); 


  	});
  </script>


</body>
</html>