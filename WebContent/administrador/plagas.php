<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../index.php");



  include_once '../servidor/plagas.php';


  $server = new plaga();

  $plaga = $server->getPlaga();  

  

//include_once '../servidor/estilos.php';

//$server = new estilo();

//$estilo = $server->getEstilo();    

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
          <a href="../index.html" class="brand-logo"><h1>SOCEA</h1></a> 
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>     
                
          <!--Menu escritorio-->
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li  ><a href="inicio.php">Inicio</a></li>
              <!--boton del menu desplegable-->
              <li class="active">
                <a href="productos.php" >Productos</a>
              </li>
              <li><a href="plagas.php">Plagas</a></li>
              <li>
                <a class="dropdown-button" href="#!" data-activates="dropdown2"><?php echo $_SESSION["nombre"]; ?></a>
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
                  <img src="../../imagenes/aprendizaje.png">
                </div>
                <a href="#"><img class="circle" src="../../imagenes/aprendizaje.png"></a>
                <a href="#"><span class="name"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"] ?></span></a>
                <a href="#"><span class="email"><?php echo $_SESSION["email"]; ?></span></a>
              </div>
            </li>
            <li class="active"><a href="inicio.php">Inicio</a></li>
            <li><div class="divider"></div></li>
            <li class="no-padding">
              <ul class="collapsible collapsible-accordion">
                <li>
                  <a href="#" class="collapsible-header"> Test<i class="material-icons 
right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="testsHA.php" class="collection-item"><i class="material-icons left">assignment</i>Honey Alonso</a></li> 
                        <li><a href="testsVark.php" class="collection-item"><i class="material-icons left">assignment</i>Vark</a></li> 
                        <li><a href="evaluacion.php" class="collection-item"><i class="material-icons left">assignment</i>Evaluacion por Estudiantes</a></li>                         
                      </ul>
                    </div>
                </li>
              </ul>
            </li>
            <li><div class="divider"></div></li>
            <li class="no-padding">
              <ul class="collapsible collapsible-accordion">
                <li>
                  <a href="#" class="collapsible-header"> Reportes<i class="material-icons 
right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="reportes.php" class="collection-item"><i class="material-icons left">assignment</i>Por Genero</a></li> 
                        <li><a href="reportesSemestres.php" class="collection-item"><i class="material-icons left">assignment</i>Por Semestre</a></li> 
                        <li><a href="reportePrograma.php" class="collection-item"><i class="material-icons left">assignment</i>Por Programa</a></li>
                      </ul>
                    </div>
                </li>
              </ul>
            </li>
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
              <h1><b>Plagas</b></h1>
          </div><!-- /.box -->
    </div> 
  <div class="row">
    <!-- Categorias -->
    <div class="col s4  hide-on-small-only">
      <div class="card">
        <div class="card-content center">
          <h2>Plagas</h2>
        </div>
      </div>
    </div>                 
    <div class="col s12 m8">                   
      <div class="descripcion center">
        <div>
          <h2><p>Ingrese los tipos de plagas</p></h2> 
            <h3></h3>
        </div> 
      </div> 
      <div class="container">
        <div class="nuevoItem">
          <input type="hidden" id="idPlaga" value="">
          <div class="row">
            <div class="input-field col s12">
              <input id="plaga" name="plaga"  type="text" class="validate">
              <label for="plaga">Plaga</label>
            </div> 
          </div>
          <div class="row">           
            <div class="input-field col s12">
              <textarea id="descripcion" rows="" cols="" class="materialize-textarea"></textarea>
              <label for="descripcion">Descripcion</label>
            </div>                       
          </div>
          <div class="row">           
            <div class="input-field col s12">
              <textarea id="prevencion" rows="" cols="" class="materialize-textarea"></textarea>
              <label for="prevencion">Formas de prevencion</label>
            </div>                       
          </div>          
          <div class="row">  
            <div class="file-field input-field col s12">
              <div class="btn">
                <span>Imagen</span>
                <input type="file" multiple>
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Cargue uno o mas imagenes">
              </div>           
            </div>
          </div>  
          <div class="row center">          
            <div class="nuevoTest">
              <div class="input-field col s12">
                <input type="button" id="crearPlaga" value="Agregar" class="btn">
              </div>                      
            </div>   
          </div>           
        </div>
      </div>  
      <br>
      <br>     
      <div class="tests">
        <div class="row">
        <?php 
          if (count($plaga) != 0) {
            for ($i=0; $i <count($plaga) ; $i++) {
              echo '
                <div class="col s10 l4 m12 offset-s1">
                  <div class="card sticky-action">
                    <!-- Datos Productos-->
                      <input type="hidden" id="plaga'.$plaga[$i]['id_plaga'].'" value="'.$plaga[$i]['nombre'].'">
                      <input type="hidden" id="descripcion'.$plaga[$i]['id_plaga'].'" value="'.$plaga[$i]['descripcion'].'">
                      <input type="hidden" id="prevencion'.$plaga[$i]['id_plaga'].'" value="'.$plaga[$i]['prevencion'].'">                      
                    <!-- fin datos-->  
                    <div class="card-image waves-effect waves-block waves-light">
                    <div class="row">
                      <img class="activator responsive-img" src="../../imagenes/plaga.jpg"  style="width: 262px; height: 230px">
                    </div>
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">'.$plaga[$i]['nombre'].'<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-action">
                      <a class="verPlaga"><i class="material-icons left" id="'.$plaga[$i]['id_plaga'].'">update</i></a>
                      <a class="eliminarPlaga"><i class="material-icons left" id="'.$plaga[$i]['id_plaga'].'">delete</i></a>
                    </div>                        
                    <div class="card-reveal" style="word-wrap: break-word;">
                      <b><span class="card-title grey-text text-darken-4">'.$plaga[$i]['nombre'].'<i class="material-icons right">close</i></span></b>
                      <br>
                      <hr>
                      <br>
                      <p ALIGN="justify">'.$plaga[$i]['descripcion'].'<a class="waves-effect waves-light modal-trigger" href="#modal'.$plaga[$i]['id_plaga'].'">ver mas...</a></p>
                      <br>
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
                  <!-- Modal Structure -->
                  <div id="modal'.$plaga[$i]['id_plaga'].'" class="modal">
                    <div class="modal-content">
                      <h2>Prevencion</h2>
                      <p ALIGN="justify">'.$plaga[$i]['prevencion'].'</p>
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
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
                <h5 class="white-text">SOCEA</h5>
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
         
    $('.modal').modal();
  
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
        

        $(".verPlaga").click(function(e){
          $("#plaga").val($("#plaga"+e.target.id).val()); 
          $("#idPlaga").val(e.target.id); 
          $("#descripcion").val($("#descripcion"+e.target.id).val());
          $("#prevencion").val($("#prevencion"+e.target.id).val());
          $("#crearPlaga").val("Actualizar");
               
        });        


        $(".eliminarPlaga").click(function(e){
          var r = confirm("Confirmar la Eliminacion de la plaga");
            if (r == true) {
              var id = e.target.id;
              
                    var datos=[];
                      datos.push({
                        "operacion": "eliminarPlaga", 
                        "id_plaga": id
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/plaga_gestion.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Eliminar la Plaga', 300,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Plaga Eliminado Correctamente', 300,'',function(){
                          location.reload(true);              
                        });
                      }
                    });

                  return false;   
            }
       

        });        


            $("#crearPlaga").click(function(){
               if ($("#crearPlaga").val() == "Agregar"){
                var pro = $("#plaga").val();
                var des = $("#descripcion").val();
                var pre = $("#prevencion").val();
                if (pro == "" || des == "" || pre == ""){
                  Materialize.toast('Complete los Campos', 3000,'',function(){          
                  });
                }else{
                  var datos=[];
                    datos.push({
                      "operacion": "crearPlaga",
                      "plaga": $("#plaga").val(),
                      "descripcion": $("#descripcion").val(),
                      "prevencion": $("#prevencion").val()
                    }); 


                    
                  var text = {"datos": datos};   
                  var json = JSON.stringify(text);
                  console.log(json);
                  
                  ajax("../servidor/plaga_gestion.php", {"json": json}).done(function(info) {
                    console.log(info);
                    //return false;
                    if (info) { 
                      Materialize.toast('Error al Registrar', 300,'',function(){
                      location.reload(true);
                      });
                    }else{
                      Materialize.toast('Registrado Corectamente', 300,'',function(){
                        location.reload(true);              
                      });
                    }
                  });

                return false;
                } 
               }else{
                var pro = $("#plaga").val();
                var des = $("#descripcion").val();
                var pre = $("#prevencion").val();
                if (pro == "" || des == "" || pre ==""){
                      Materialize.toast('Complete los Campos', 3000,'',function(){          
                      });
                  }else{
                    var datos=[];
                      datos.push({
                        "operacion": "actualizarPlaga",
                        "plaga": $("#plaga").val(), 
                        "descripcion": $("#descripcion").val(), 
                        "prevencion": $("#prevencion").val(),
                        "id": $("#idPlaga").val()
                      }); 
                    var ha = {"datos": datos};    
                    var json = JSON.stringify(ha);
                    console.log(json);
                    ajax("../servidor/plaga_gestion.php", {"json": json}).done(function(info) {

                      if (info) {

                        Materialize.toast('Plaga Actualizada Correctamente', 300,'',function(){
                          location.reload(true);              
                        });
                      }else{
                        Materialize.toast('Error al Actualizar la Palga', 300,'',function(){
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