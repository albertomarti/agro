<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../index.php");

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
    <title>
	   SOCEA - administrador
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
 
 <!-- MENU DE NAVEGACION 
  <div class="navbar-fixed">--> 
   <nav class="teal">
      <div class="container">
        <div class="nav-wrapper">
          <a href="../index.html" class="brand-logo"><h1>tuAGRO</h1></a> 
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>     
                
          <!--Menu escritorio-->
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"> <a href="inicio.php">Inicio</a></li>
              <!--boton del menu desplegable-->
              <li>
                <a href="productos.php" >Productos</a>
              </li>
              <li><a href="plagas.php">Plagas</a></li>
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
            <li><a href="productos.php">Productos</a></li>
            <li><div class="divider"></div></li>            
            <li><a href="plagas.php">Plagas</a></li>
            <li><div class="divider"></div></li>
            <li><a href="../servidor/logout.php">Cerrar Sesion</a></li>
          </ul>
        </div>
      </div>  
    </nav>    
    
  <!--</div>-->




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
          		<h2>Hola <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"] ?></h2>
          		<h3></h3>
        	</div>
    	</div>  
    </div>

</div>
<br><br><br>

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

  	});
  </script>

<script type="text/javascript">	 
	
  $(document).ready(function(){
  	$('.tooltipped').tooltip({delay:50});
  	$('select').material_select();

       	    $("#registrarUsuario").click(function(){
    	    	 
       	    	 var datos=[];
       	    	 		datos.push({
       	    	 			"operacion": "registrarUsuario",
       	    				"documento": $("#documento").val(), 
       	    				"nombre": $("#nombre").val(),
       	    				"apellido": $("#apellido").val(), 
       	    				"email": $("#email").val(),
       	    				"programa": $("#programa").val(), 
       	    				"semestre": $("#semestre").val(),
       	    				"usuario": $("#usuario").val(), 
       	    				"contraseña": $("#contraseña").val()
       	    			}); 
       	    	var usuario = {"datos": datos};		
       	    	var json = JSON.stringify(usuario);

       	    	ajax("servidor/usuario.php", {"json": json}).done(function(info) {
       	    		if (info) {
		    			Materialize.toast('Usuario Registrado Corectamente', 3000,'',function(){
							location.reload(true);				    	
		    			});
       	    		}else{
		    			Materialize.toast('Error al Registrar el Usuario', 3000,'',function(){
							location.reload(true);				    	
		    			});
       	    		}
       	    	});

       	    	return false;



    	        
    	        
    	    });



  });

  	   function ajax(url, data){

    	    	var ajax = $.ajax({
       	    		"url": url,
       	    		"data": data,
       	    		"type": "POST",

       	    	
       	    	});
       	    	 return ajax;

    	    }

	</script>	
</body>
</html>