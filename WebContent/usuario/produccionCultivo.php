
<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../../");


  include_once '../servidor/conexion.php';

  $server = new conexion();
  $conexion = $server->conectar();


  $sql='SELECT p.nombre as nombre FROM producto p, cultivo c WHERE p.id_producto=c.id_producto && c.id_cultivo='.$_GET["id_cultivo"]; 

      $cultivo = $conexion->query($sql);
      $cultivo_encontrado = $cultivo->num_rows;

  $sql1='SELECT * FROM recurso WHERE id_cultivo='.$_GET["id_cultivo"]; 

      $recurso = $conexion->query($sql1);
      $recurso_encontrado = $recurso->num_rows;

  $sql2='SELECT * FROM produccion WHERE id_cultivo='.$_GET["id_cultivo"]; 

      $produccion = $conexion->query($sql2);
      $produccion_encontrada = $produccion->num_rows;      


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
     
<body class="font-cover" id="main" style="">
 
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
                  <li><a href="cultivo.php">Mis Cultivos</a></li>
                  <li><div class="divider"></div></li>
                  <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                      <li class="active">
                        <a href="#" class="collapsible-header"><i class="material-icons 
      right">arrow_drop_down</i>Calcular Estimado</a>
                          <div class="collapsible-body">
                            <ul>
                              <li><a href="verCultivo.php?id_cultivo=<?php echo $_GET["id_cultivo"]; ?>" class="collection-item"><i class="material-icons left">assignment</i>Estimado Inicial</a></li> 
                              <li class="active"><a href="produccionCultivo.php?id_cultivo=<?php echo $_GET["id_cultivo"]; ?>" class="collection-item"><i class="material-icons left">assignment</i>Datos Finales</a></li> 
                            </ul>
                          </div>
                      </li>
                    </ul>
                  </li>                  
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
              <h1><b>Cultivo</b></h1>
          </div><!-- /.box -->
    </div>   
  <div class="row">
    <!-- Categorias -->
    <div class="col s4  hide-on-small-only">
      <div class="card">
        <div class="card-content center">
          <h2>Calcular Estimado</h2>
        </div>
        <div class="collection">
          <a href="verCultivo.php?id_cultivo=<?php echo $_GET["id_cultivo"]; ?>" class="collection-item"><i class="material-icons left">assignment</i>Estimado Inicial</a> 
          <a href="produccionCultivo.php?id_cultivo=<?php echo $_GET["id_cultivo"]; ?>" class="collection-item active"><i class="material-icons left">assignment</i>Datos finales</a> 
        </div>
      </div>
    </div>                 
    <div class="col s12 m8"> 
      <div class="row">
        <div class="descripcion">
                  <?php 
                    for ($i=0; $i < $cultivo_encontrado; $i++) {
                      $fila = $cultivo->fetch_object();
                      echo '<h2><p>'.$fila->nombre.'</p></h2>';
                    }  
                   ?> 
          <br>
          <p class="center">Realice un estimado de su produccion con datos de la materia prima y terrono a utilzar</p>                
        </div>    
      </div>
      <div class="row">
        <div class="col s12 l12 m12">
          <?php 

            if ($recurso_encontrado == 0) {
              echo '
                <div class="login center-align">      
                        <div class="row">
                            <p class="left-align">Estimado Inicial</p>
                            <hr>
                            <br> 
                            <div class="container">
                              <div class="input-field col s12 l6 m12  offset-s1">
                                <input id="estimado_semillas" name="estimado_semillas"  type="text" class="validate" value="" disabled>
                                <label for="estimado_semillas">Semillas Necesarias</label>
                              </div> 
                              <div class="input-field col s12 l6 m12  offset-s1">
                                <input id="estimado_germinar" name="estimado_germinar"  type="text" class="validate"  value="" disabled>
                                <label for="estimado_germinar">Plantas a Germinar</label>
                              </div>                      
                            </div>                
                        </div>                                       
                </div>   

              ';
            }else{
              for ($i=0; $i < $recurso_encontrado; $i++) {
                $fila = $recurso->fetch_object();
                echo '

                  <div class="login center-align">      
                        <div class="row">
                            <p class="left-align">Estimado Inicial</p>
                            <hr>
                            <br> 
                            <div class="container">
                              <div class="input-field col s12 l6 m12  offset-s1">
                                <input id="estimado_semillas" name="estimado_semillas"  type="text" class="validate" value="'.$fila->semillas_requeridas.'" disabled>
                                <label for="estimado_semillas">Semillas Necesarias</label>
                              </div> 
                              <div class="input-field col s12 l6 m12  offset-s1">
                                <input id="estimado_germinar" name="estimado_germinar"  type="text" class="validate"  value="'.$fila->plantas_esperadas.'" disabled>
                                <label for="estimado_germinar">Plantas a Germinar</label>
                              </div>                      
                            </div>                
                        </div>     
                ';
                	if ($produccion_encontrada == 0) {
	 		                echo '                   
			                        <div class="row">
			                            <p class="left-align">Produccion Obtenida</p>
			                            <hr>
			                            <br> 
			                            <div class="container">
			                              <div class="input-field col s12 l6 m12  offset-s1">
			                                <input id="semillas_germinadas" name="semillas_germinadas"  type="text" class="validate" value="">
			                                <label for="semillas_germinadas">Semillas Germinadas</label>
			                              </div>                     
			                            </div>                
			                        </div>     
			                        <div class="row guardar">
			                          <div class="col s12 m12 l12">
			                            <input type="button" id="crearResultado" value="Guardar" class="btn">
			                          </button>     
			                          </div>
			                        </div>                           
			                  </div>   

			                ';
                	}else{
                		for ($j=0; $j < $produccion_encontrada; $j++) { 
                			$fila1 = $produccion->fetch_object();
	 		                echo '                   
			                        <div class="row">
			                            <p class="left-align">Produccion Obtenida</p>
			                            <hr>
			                            <br> 
			                            <div class="container">
			                              <div class="input-field col s12 l6 m12  offset-s1">
			                              	<input type="hidden" id="id_produccion" value="'.$fila1->id_produccion.'">
			                                <input id="semillas_germinadas" name="semillas_germinadas"  type="text" class="validate" value="'.$fila1->semillas_germinadas.'">
			                                <label for="semillas_germinadas">Semillas Germinadas</label>
			                              </div>                     
			                            </div>                
			                        </div>     
			                        <div class="row guardar">
			                          <div class="col s12 m12 l12">
			                            <input type="button" id="crearResultado" value="Modificar" class="btn">
			                          </button>     
			                          </div>
			                        </div>                           
			                  </div>   

			                ';
                		}
                	}
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
  $(document).ready(function(){
    $('.modal').modal();
  });      
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

            $("#crearResultado").click(function(){
               if ($("#crearResultado").val() == "Guardar"){
                var semillas_germinadas = $("#semillas_germinadas").val();
  
                if (semillas_germinadas == ""){
                  Materialize.toast('Complete los Campos', 3000,'',function(){          
                  });
                }else{
                  var datos=[];
                    datos.push({
                      "operacion": "crearResultado",
                      "semillas_germinadas": semillas_germinadas,
                      "id_cultivo": <?php echo $_GET["id_cultivo"]; ?>
                    }); 


                    
                  var text = {"datos": datos};   
                  var json = JSON.stringify(text);

                  ajax("../servidor/cultivo_gestion.php", {"json": json}).done(function(info) {
                    if (info) { 
                      Materialize.toast('Error al Guardar', 300,'',function(){
                      location.reload(true);
                      });
                    }else{
                      Materialize.toast('Guardado Corectamente', 300,'',function(){
                        location.reload(true);              
                      });
                    }
                  });

                return false;
                } 
               }else{
                var semillas_germinadas = $("#semillas_germinadas").val();
  
                if (semillas_germinadas == ""){
                  Materialize.toast('Complete los Campos', 3000,'',function(){          
                  });
                }else{
                  var datos=[];
                    datos.push({
                      "operacion": "modificarResultado",
                      "semillas_germinadas": semillas_germinadas,
                      "id_produccion": $("#id_produccion").val()
                    }); 


                    
                  var text = {"datos": datos};   
                  var json = JSON.stringify(text);

                  ajax("../servidor/cultivo_gestion.php", {"json": json}).done(function(info) {

                      if (info) {
          
                        Materialize.toast('Error al Actualizar', 300,'',function(){
                          location.reload(true);              
                        });
                      }else{
                        Materialize.toast('Actualizada Correctamente', 300,'',function(){
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
