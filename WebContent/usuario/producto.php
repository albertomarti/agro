
<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../../");


  include_once '../servidor/conexion.php';

  $server = new conexion();
  $conexion = $server->conectar();


  $sql='SELECT nombre, descripcion FROM producto WHERE id_producto='.$_GET["id_producto"]; 

      $producto = $conexion->query($sql);
      $producto_encontrado = $producto->num_rows;  

      if($producto_encontrado > 0){
        for ($i=0; $i < $producto_encontrado; $i++) {
          $fila = $producto->fetch_object();
          $nombre_producto = $fila->nombre;     
          $descripcion_producto = $fila->descripcion; 
        }  
      }       

  
  $sql1 = "SELECT id_paso, descripcion FROM paso WHERE id_producto=".$_GET["id_producto"];     
       $paso = $conexion->query($sql1);
      //$paso_encontrado = $paso->num_rows;

  $sql2 = "SELECT id_usuario, id_producto FROM cultivo WHERE id_usuario=".$_SESSION["id"]."&& id_producto=".$_GET["id_producto"];     
       $cultivo = $conexion->query($sql2);
      $cultivo_encontrado = $cultivo->num_rows;  

  $sql3 = "SELECT p.id_plaga as id_plaga, p.nombre as nombre, p.descripcion as descripcion, p.prevencion as prevencion FROM plaga p, tuagro.producto_tiene_plaga pp where p.id_plaga=pp.id_plaga && pp.id_producto=".$_GET["id_producto"];     
       $plaga = $conexion->query($sql3);
      $plaga_encontrada = $plaga->num_rows;          



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
    
  <!--</div>-->

<div id="contenedor-principal" class="">
      <div class="banner" style="visibility: visible; width: 100%; height: 200px; position: relative; overflow: hidden;">

          <img class="z-depth-3 responsive-img img-banner" src="../../imagenes/banner1.jpg">
          <div class="box">
              <h1>
                <b>
                  <?php 
                      echo $nombre_producto;   
                  ?>   
                </b>
              </h1>
          </div>
    </div>   
    <br>
    <div class="container">
      <div class="row">
        <div class="col s10 l5 m5 offset-s1 img-producto">
          <div class="row center">
            <img class="responsive-img materialboxed circle" width="650" src="../../imagenes/papa.jpg"  style="width: 650px; height: 400px">
            <div class="input-field col s12">

                <input type="button" id="crear" value="Agregar" class="btn crear">

            </div>  
          </div>
        </div>                
        <div class="col s10 l7 m7 offset-s1"> 
          <div class="row">
            <div class="descripcion" style="padding-left: 20px;">
                      <?php 
                          echo '<p>'.$descripcion_producto.'</p>';     
                        
                       ?>        
            </div>    
          </div>                  
        </div>
        <div class="col s10 l12 m12 offset-s1">
          <div class="row">
            <div class="descripcion">
              <h2>Tratamiento o Pasos para su Cultivo</h2>
            </div>
            <?php 
              echo "<ul class='descripcion'>";
              for ($i=0; $i < $paso->num_rows; $i++) {
                $fila = $paso->fetch_object();
                echo "
                  
                    <li>".($i+1).". ".$fila->descripcion."</li>
                  

                ";
              }  
              echo "</ul>";
             ?>
          </div>
        </div> 
        <div class="col s10 l12 m12 offset-s1">
          <div class="row">
            <div >
              <h2>Posibles Plagas</h2>
              <br>
        <div class="row">
        <?php 
          if ($plaga_encontrada != 0) {
            for ($i=0; $i <$plaga_encontrada ; $i++) {
              $fila = $plaga->fetch_object();
              echo '
                <div class="col s10 l3 m3 offset-s1">
                  <div class="card sticky-action">
                    <!-- Datos Productos-->
 
                    <!-- fin datos-->  
                    <div class="card-image waves-effect waves-block waves-light">
                    <div class="row">
                      <img class="activator responsive-img" src="../../imagenes/plaga.jpg"  style="width: 262px; height: 230px">
                    </div>
                    </div>
                    <div class="card-content">
                      <span class="card-title activator grey-text text-darken-4">'.$fila->nombre.'<i class="material-icons right">more_vert</i></span>
                    </div>                                          
                    <div class="card-reveal" style="word-wrap: break-word;">
                      <b><span class="card-title grey-text text-darken-4">'.$fila->nombre.'<i class="material-icons right">close</i></span></b>
                      <br>
                      <hr>
                      <br>
                      <p ALIGN="justify">'.$fila->descripcion.'<a class="waves-effect waves-light modal-trigger" href="#modal'.$fila->id_plaga.'">ver mas...</a></p>
                      <br>
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
                  <!-- Modal Structure -->
                  <div id="modal'.$fila->id_plaga.'" class="modal">
                    <div class="modal-content">
                      <h2>Prevencion</h2>
                      <p ALIGN="justify">'.$fila->prevencion.'</p>
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
            </div>
          </div>
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


  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });

    });
  </script>

<script type="text/javascript">  
  
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay:10});

      $(".crear").click(function(e){  
 
            var datos=[];
              datos.push({
                "operacion": "crearCultivo",
                "id_usuario": <?php echo $_SESSION["id"]; ?>, 
                "id_producto": <?php echo $_GET["id_producto"]; ?>

              }); 
            var ha = {"datos": datos};    
            var json = JSON.stringify(ha);
            console.log(json);
            ajax("../servidor/cultivo_gestion.php", {"json": json}).done(function(info) {
     
              if (info) {
                
                Materialize.toast('Error al Registrar el Item', 500,'',function(){
                  location.reload(true);              
                });
              }else{
                Materialize.toast('Item Agregado Correctamente', 500,'',function(){
                  location.reload(true);              
                });
              }
            });
           
            return false;           
                        

 
      });

        $(".eliminarItem").click(function(){
          var r = confirm("Confirmar la Eliminacion del Item");
            if (r == true) {
              var id = $(this).parents("tr").find("td").eq(0).html();
              
                    var datos=[];
                      datos.push({
                        "operacion": "eliminarItemHA", 
                        "id_item": id
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/test.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Eliminar el Item', 500,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Item Eliminado Correctamente', 500,'',function(){
                          location.reload(true);              
                        });
                      }
                    });

                  return false;   
            }
       

        });  

        $(".verDatosItem").click(function(){
            $("#idItem").val($(this).parents("tr").find("td").eq(0).html());
            $("#descripcion").val($(this).parents("tr").find("td").eq(1).html());
            $("#agregarItem").val("Actualizar");
        });     

        $(".actualizar").click(function(){
              var des = $("#descripcion").val();
              var id = $("#idItem").val();
            if (des != "" && id != "") {
              alert();
                    var datos=[];
                      datos.push({
                        "operacion": "actualizarItemHA", 
                        "id_item": $("#idItem").val(),
                        "descripcion": $("#descripcion").val(),
                        "estilo": $("#estilo").val()
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/test.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Actualizar el Item', 3000,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Item Actualizado Correctamente', 3000,'',function(){
                          location.reload(true);              
                        });
                      }
                    });

                  return false; 
            }else{
              Materialize.toast('Error al Actualizar el Item', 3000,'',function(){
                        
              });
            }

        });    

      $("#agregarcriterio").click(function(){   

        if($("#mbminimo_activo").val() == "" || $("#mbmaximo_activo").val() == "" || $("#bminimo_activo").val() == "" || $("#bmaximo_activo").val() == "" || $("#mminimo_activo").val() == "" || $("#mmaximo_activo").val() == "" || $("#aminimo_activo").val() == "" || $("#amaximo_activo").val() == "" || $("#maminimo_activo").val() == "" || $("#mamaximo_activo").val() == "" || $("#mbminimo_reflexivo").val() == "" || $("#mbmaximo_reflexivo").val() == "" || $("#bminimo_reflexivo").val() == "" || $("#bmaximo_reflexivo").val() == "" || $("#mminimo_reflexivo").val() == "" || $("#mmaximo_reflexivo").val() == "" || $("#aminimo_reflexivo").val() == "" || $("#amaximo_reflexivo").val() == "" || $("#maminimo_reflexivo").val() == "" || $("#mamaximo_reflexivo").val() == "" || $("#mbminimo_teorico").val() == "" || $("#mbmaximo_teorico").val() == "" || $("#bminimo_teorico").val() == "" || $("#bmaximo_teorico").val() == "" || $("#mminimo_teorico").val() == "" || $("#mmaximo_teorico").val() == "" || $("#aminimo_teorico").val() == "" || $("#amaximo_teorico").val() == "" || $("#maminimo_teorico").val() == "" || $("#mamaximo_teorico").val() == "" || $("#mbminimo_pragmatico").val() == "" || $("#mbmaximo_pragmatico").val() == "" || $("#bminimo_pragmatico").val() == "" || $("#bmaximo_pragmatico").val() == "" || $("#mminimo_pragmatico").val() == "" || $("#mmaximo_pragmatico").val() == "" || $("#aminimo_pragmatico").val() == "" || $("#amaximo_pragmatico").val() == "" || $("#maminimo_pragmatico").val() == "" || $("#mamaximo_pragmatico").val() == ""){

                Materialize.toast('Complete Todos los Campos para Continuar', 300,'',function(){
                              
                });

        }else{

            var guia=[];
              guia.push({
                "operacion": "crearCriterioHA",
                "id_test": $("#idTest").val()
              });

            var activo=[];
              activo.push({  
                  // rango de valores muy bajo activo 
                  "mbminimo_activo": $("#mbminimo_activo").val(),
                  "mbmaximo_activo": $("#mbmaximo_activo").val(),
                  // rango de valores bajo activo 
                  "bminimo_activo": $("#bminimo_activo").val(),
                  "bmaximo_activo": $("#bmaximo_activo").val(), 
                  // rango de valores moderado activo 
                  "mminimo_activo": $("#mminimo_activo").val(),
                  "mmaximo_activo": $("#mmaximo_activo").val(), 
                  // rango de valores alto activo 
                  "aminimo_activo": $("#aminimo_activo").val(),
                  "amaximo_activo": $("#amaximo_activo").val(),
                  // rango de valores muy alto activo 
                  "maminimo_activo": $("#maminimo_activo").val(),
                  "mamaximo_activo": $("#mamaximo_activo").val()                      
              }); 
            var reflexivo=[];
              reflexivo.push({
                 // rango de valores muy bajo reflexivo
                  "mbminimo_reflexivo": $("#mbminimo_reflexivo").val(),
                  "mbmaximo_reflexivo": $("#mbmaximo_reflexivo").val(),
                  // rango de valores bajo reflexivo 
                  "bminimo_reflexivo": $("#bminimo_reflexivo").val(),
                  "bmaximo_reflexivo": $("#bmaximo_reflexivo").val(), 
                  // rango de valores moderado reflexivo 
                  "mminimo_reflexivo": $("#mminimo_reflexivo").val(),
                  "mmaximo_reflexivo": $("#mmaximo_reflexivo").val(), 
                  // rango de valores alto reflexivo
                  "aminimo_reflexivo": $("#aminimo_reflexivo").val(),
                  "amaximo_reflexivo": $("#amaximo_reflexivo").val(),
                  // rango de valores muy alto reflexivo 
                  "maminimo_reflexivo": $("#maminimo_reflexivo").val(),
                  "mamaximo_reflexivo": $("#mamaximo_reflexivo").val()                 
              });
            var teorico = [];
              teorico.push({
                 // rango de valores muy bajo teorico
                  "mbminimo_teorico": $("#mbminimo_teorico").val(),
                  "mbmaximo_teorico": $("#mbmaximo_teorico").val(),
                  // rango de valores bajo teorico 
                  "bminimo_teorico": $("#bminimo_teorico").val(),
                  "bmaximo_teorico": $("#bmaximo_teorico").val(), 
                  // rango de valores moderado teorico 
                  "mminimo_teorico": $("#mminimo_teorico").val(),
                  "mmaximo_teorico": $("#mmaximo_teorico").val(), 
                  // rango de valores alto teorico
                  "aminimo_teorico": $("#aminimo_teorico").val(),
                  "amaximo_teorico": $("#amaximo_teorico").val(),
                  // rango de valores muy alto teorico 
                  "maminimo_teorico": $("#maminimo_teorico").val(),
                  "mamaximo_teorico": $("#mamaximo_teorico").val()
              }); 
            var pragmatico = [];
              pragmatico.push({
                 // rango de valores muy bajo pragamatico
                  "mbminimo_pragmatico": $("#mbminimo_pragmatico").val(),
                  "mbmaximo_pragmatico": $("#mbmaximo_pragmatico").val(),
                  // rango de valores bajo pragamatico 
                  "bminimo_pragmatico": $("#bminimo_pragmatico").val(),
                  "bmaximo_pragmatico": $("#bmaximo_pragmatico").val(), 
                  // rango de valores moderado pragamatico 
                  "mminimo_pragmatico": $("#mminimo_pragmatico").val(),
                  "mmaximo_pragmatico": $("#mmaximo_pragmatico").val(), 
                  // rango de valores alto pragamatico
                  "aminimo_pragmatico": $("#aminimo_pragmatico").val(),
                  "amaximo_pragmatico": $("#amaximo_pragmatico").val(),  
                  // rango de valores muy alto pragamatico 
                  "maminimo_pragmatico": $("#maminimo_pragmatico").val(),
                  "mamaximo_pragmatico": $("#mamaximo_pragmatico").val()               
              });   

              var datos = [];
                datos.push({
                  "guia": guia,
                  "activo": activo,
                  "reflexivo": reflexivo,
                  "teorico": teorico,
                  "pragmatico": pragmatico
                });
              var valores = {"datos": datos}; 
              var json = JSON.stringify(valores);            
              
              ajax("../servidor/criterio.php", {"json": json}).done(function(info) {
                          console.log(info); 
                if (info) {
                  Materialize.toast('Error', 3000,'',function(){
                    location.reload(true);              
                  });
                }else{
                  Materialize.toast('Criterios Actualizados Correctamente', 300,'',function(){
                    location.reload(true);              
                  });
                }
              });

            return false; 

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
