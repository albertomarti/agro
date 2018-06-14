<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../index.php");



  include_once '../servidor/cultivo.php';


  $server = new cultivo();


  $cultivo = $server->getCultivo($_SESSION["id"]);  

  //$fecha = $server->getFecha($_SESSION["id"]);       

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
 
 <!-- MENU DE NAVEGACION--> 
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
                  <li><a href="inicio.php">Inicio</a></li>
                  <li><div class="divider"></div></li>
                  <li class="no-padding">
                  <li class="active"><a href="cultivo.php">Mis Cultivos</a></li>
                  <li><div class="divider"></div></li>
                  <li><a href="../servidor/logout.php">Cerrar Sesion</a></li>
                </ul>                      
        </div>
      </div>
    </div>    
  </div>  
</nav> 
    
  <!--</div>-->

<div id="contenedor-principal" class="">
      <div class="banner" style="visibility: visible; width: 100%; height: 200px; position: relative; overflow: hidden;">

          <img class="z-depth-3 responsive-img img-banner" src="../../imagenes/banner1.jpg">
          <div class="box">
              <h1><b>Productos</b></h1>
          </div><!-- /.box -->
    </div> 
  <div class="row">
    <!-- Categorias -->
    <div class="col s4  hide-on-small-only">
      <div class="card">
        <div class="card-content center">
          <h2>Producto</h2>
        </div>
      </div>
    </div>                 
    <div class="col s12 m8">                   
      <div class="descripcion">
        <div>
          <h2><p>Bienvenido</p></h2> 
            <h3>Aqui se presentan los diferentes cultivos que se han creado para realizar el seguimiento de su progreso</h3>
        </div> 
      </div> 
      <br>
      <br>     


        <div class="row">
        <?php 
          	if (count($cultivo) != 0) {
	        	for ($i=0; $i <count($cultivo) ; $i++) {
		              echo ' 
		                <div class="col s10 l4 m12 offset-s1">
		                  <div class="card sticky-action"> 
		                    <div class="card-image waves-effect waves-block waves-light">
		                      <div class="row">
		                        <img class="activator responsive-img" src="../../imagenes/papa.jpg"  style="width: 262px; height: 230px">
		                      </div>
		                    </div>
		                    <div class="card-content" style="word-wrap: break-word;">
		                      <span class="card-title center activator grey-text text-darken-4"><b>'.$cultivo[$i]['nombre'].'</b></span>
                          <p class="center">
                          '.$cultivo[$i]['fecha'].'
                          </p>
		                    </div>
		                    <div class="card-action">
		                      <span>
		                      <a class="eliminar" id="'.$cultivo[$i]['id_cultivo'].'">Eliminar Cultivo<i class="material-icons left">delete</i></a>
		                      </span> 
		                      <br><br>                    
		                      <span>
		                      <a class="ver" id="'.$cultivo[$i]['id_cultivo'].'">Ver Cultivo<i class="material-icons left">folder_open</i></a>
		                      </span>                  
		                    </div>                        
		                </div> </div>
		              ';
	       		}
          	}  

          ?>
        </div>        
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
    });
  </script>

<script type="text/javascript">  
  
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay:10});
        

        $(".ver").click(function(e){
          //alert(e.target.id);
          window.location="verCultivo.php?id_cultivo=" + e.target.id; 
                  
        });        


        $(".eliminar").click(function(e){
          var r = confirm("Confirmar la Eliminacion del Cultivo");
            if (r == true) {
              var id = e.target.id;
              
                    var datos=[];
                      datos.push({
                        "operacion": "eliminarCultivo", 
                        "id_cultivo": id
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/cultivo_gestion.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Eliminar el Test', 300,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Test Eliminado Correctamente', 300,'',function(){
                          location.reload(true);              
                        });
                      }
                    });

                  return false;   
            }
       

        });        


            $("#crearProducto").click(function(){
               if ($("#crearProducto").val() == "Agregar"){
                var pro = $("#producto").val();
                var des = $("#descripcion").val();
                if (pro == "" || des == ""){
                  Materialize.toast('Complete los Campos', 3000,'',function(){          
                  });
                }else{
                  var datos=[];
                    datos.push({
                      "operacion": "crearProducto",
                      "descripcion": $("#descripcion").val(),
                      "producto": $("#producto").val(),                  
                      "id_administrador": <?php echo $_SESSION["id"]; ?>

                    }); 


                    
                  var text = {"datos": datos};   
                  var json = JSON.stringify(text);

                  ajax("../servidor/producto_gestion.php", {"json": json}).done(function(info) {
                    if (info) { 
                      Materialize.toast('Test Registrado Corectamente', 300,'',function(){
                      location.reload(true);
                      });
                    }else{
                      Materialize.toast('Error al Registrar el Test', 300,'',function(){
                        location.reload(true);              
                      });
                    }
                  });

                return false;
                } 
               }else{
                var pro = $("#producto").val();
                var des = $("#descripcion").val();
                  if (pro == "" || des == ""){
                      Materialize.toast('Complete los Campos', 3000,'',function(){          
                      });
                  }else{
                    var datos=[];
                      datos.push({
                        "operacion": "actualizarProducto",
                        "producto": $("#producto").val(), 
                        "descripcion": $("#descripcion").val(), 
                        "id": $("#idProducto").val()
                      }); 
                    var ha = {"datos": datos};    
                    var json = JSON.stringify(ha);
                    console.log(json);
                    ajax("../servidor/producto_gestion.php", {"json": json}).done(function(info) {

                      if (info) {
                        console.log(info);
                        Materialize.toast('Error al Actualizar la Pregunta', 300,'',function(){
                          location.reload(true);              
                        });
                      }else{
                        Materialize.toast('Pregunta Actualizada Correctamente', 300,'',function(){
                          location.reload(true);              
                        });
                      }
                    });

                    return false;           
                  }  
               }
             
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