<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../index.php");



  include_once '../servidor/productos.php';


  $server = new producto();

  $producto = $server->getProducto();  


 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
    <title>
     tuAGRO - administrador
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
            <li><a href="inicio.php">Inicio</a></li>
            <li><div class="divider"></div></li>
            <li class="active"><a href="productos.php">Productos</a></li>
            <li><div class="divider"></div></li>            
            <li><a href="plagas.php">Plagas</a></li>
            <li><div class="divider"></div></li>
            <li><a href="../servidor/logout.php">Cerrar Sesion</a></li>
          </ul>
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
          <h2>Productos</h2>
        </div>
      </div>
    </div>                 
    <div class="col s12 m8">                   
      <div class="descripcion">
        <div class="center">
          <h2><p>Bienvenido</p></h2> 
            <h3>Aqui se presentan los diferentes productos que nutriran la aplicacion.</h3>
        </div> 
      </div> 
      <div class="container">
        <div class="nuevoItem">
          <input type="hidden" id="idProducto" value="">
          <div class="row">
            <div class="input-field col s12">
              <input id="producto" name="producto"  type="text" class="validate">
              <label for="producto">Producto</label>
            </div>  
          </div>
          <div class="row">           
            <div class="col s12">
              <div class="input-field">
                <textarea id="descripcion" rows="" cols="" class="materialize-textarea"></textarea>
                  <label for="descripcion">Descripcion</label>
              </div>                       
            </div>      
          </div>
          <div class="row">  
            <div class="file-field input-field col s12">
              <div class="btn">
                <span>Imagen</span>
                <input type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" id="campofotografia" placeholder="Cargue uno imagen">
              </div>           
            </div>
          </div>          
          <div class="row">        
            <div class="nuevoTest center">
              <div class="input-field col s12">
                <input type="button" id="crearProducto" value="Agregar" class="btn">
              </div>                      
            </div>   
          </div>           
        </div>        
      </div> 
      <br>
      <br>     
      <div class="tests">
        <?php 
          if (count($producto) != 0) {
            for ($i=0; $i <count($producto) ; $i++) {
              echo '
                <div class="col s10 l4 m12 offset-s1">
                  <div class="card sticky-action">
                    <!-- Datos Productos-->
                    <input type="hidden" id="descripcion'.$producto[$i]['id_producto'].'" value="'.$producto[$i]['descripcion'].'">
                    <input type="hidden" id="nombre'.$producto[$i]['id_producto'].'" value="'.$producto[$i]['nombre'].'">  
                    <!-- fin datos-->  
                    <div class="card-image waves-effect waves-block waves-light">
                      <div class="row">
                        <img class="activator responsive-img" src="../../imagenes/papa.jpg"  style="width: 262px; height: 230px">
                      </div>
                    </div>
                    <div class="card-content"  style="word-wrap: break-word;">
                      <span class="card-title activator grey-text text-darken-4">'.$producto[$i]['nombre'].'<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-action">
                      <a class="verProducto"><i class="material-icons left" id="'.$producto[$i]['id_producto'].'">folder_open</i></a>
                      <a class="modificarProducto"><i class="material-icons left" id="'.$producto[$i]['id_producto'].'">update</i></a>
                      <a class="eliminarProducto"><i class="material-icons left" id="'.$producto[$i]['id_producto'].'">delete</i></a>
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
      <br>
      <br>                                     
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
        

        $(".verProducto").click(function(e){
          
          window.location="verProducto.php?id_producto=" +e.target.id; 
          //alert(e.target.id);
                  
        });  

        $(".modificarProducto").click(function(e){
          $("#producto").val($("#nombre"+e.target.id).val());
          $("#descripcion").val($("#descripcion"+e.target.id).val()); 
          $("#idProducto").val(e.target.id); 
          $("#crearProducto").val("Actualizar");
                  
        });          


        $(".eliminarProducto").click(function(e){
          var r = confirm("Confirmar la Eliminacion del Producto");
            if (r == true) {
              var id = e.target.id;
              
                    var datos=[];
                      datos.push({
                        "operacion": "eliminarProducto", 
                        "id_producto": id
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/producto_gestion.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Eliminar el Producto', 300,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Producto Eliminado Correctamente', 300,'',function(){
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
                if (pro == "" || des == "" || $("#campofotografia").val() == ""){
                  Materialize.toast('Complete los Campos', 3000,'',function(){          
                  });
                }else{
                  var datos=[];
                    datos.push({
                      "operacion": "crearProducto",
                      "descripcion": $("#descripcion").val(),
                      "producto": $("#producto").val(),
                      "imagen": $("#campofotografia").val(),                   
                      "id_administrador": <?php echo $_SESSION["id"]; ?>

                    }); 


                    
                  var text = {"datos": datos};   
                  var json = JSON.stringify(text);

                  ajax("../servidor/producto_gestion.php", {"json": json}).done(function(info) {
                    if (info) { 
                      Materialize.toast('Error al Registrar el Producto', 300,'',function(){
                      location.reload(true);
                      });
                    }else{
                      Materialize.toast('Producto Registrado Corectamente', 300,'',function(){
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
                        Materialize.toast('Producto Actualizada Correctamente', 300,'',function(){
                          location.reload(true);              
                        });
                      }else{
                        Materialize.toast('Error al Actualizar el Producto', 300,'',function(){
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