
<?php 

  @session_start();

  if (!isset($_SESSION["usuario"])) 
      header("Location: ../../");


  include_once '../servidor/conexion.php';

  $server = new conexion();
  $conexion = $server->conectar();


  $sql='SELECT * FROM producto WHERE id_producto='.$_GET["id_producto"]; 

      $producto = $conexion->query($sql);
      $producto_encontrado = $producto->num_rows;

  
  $sql1 = "SELECT pp.id_plaga as id_plaga, p.nombre as nombre FROM producto_tiene_plaga pp, plaga p WHERE p.id_plaga=pp.id_plaga && pp.id_producto=".$_GET["id_producto"];     
       $paso = $conexion->query($sql1);
      $paso_encontrado = $paso->num_rows;

  $sql2 = "SELECT id_plaga, nombre, descripcion FROM plaga";     
       $plaga = $conexion->query($sql2);
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
                              <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                      <li class="active">
                        <a href="#" class="collapsible-header"><i class="material-icons 
      right">arrow_drop_down</i>Cultivo</a>
                          <div class="collapsible-body">
                            <ul>
                              <li><a href="verProducto.php?id_producto=<?php echo $_GET["id_producto"] ?>" class="collection-item"><i class="material-icons left">assignment</i>Instrucciones de Cultivo</a></li> 
                              <li class="active"><a href="asignarPlaga.php?id_producto=<?php echo $_GET["id_producto"] ?>" class="collection-item"><i class="material-icons left">assignment</i>Asignar Plaga</a></li> 
                            </ul>
                          </div>
                      </li>
                    </ul>
                  </li>                     
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
          <h2>Menú Producto</h2>
        </div>
        <div class="collection">
          <a href="verProducto.php?id_producto=<?php echo $_GET["id_producto"] ?>" class="collection-item"><i class="material-icons left">assignment</i>Instrucciones de Cultivo</a> 
          <a href="asignarPlaga.php?id_producto=<?php echo $_GET["id_producto"] ?>" class="collection-item active"><i class="material-icons left">assignment</i>Asignar Plagas</a> 
        </div>
      </div>
    </div>                 
    <div class="col s12 m8"> 
      <div class="row">
        <div class="descripcion">
                  <?php 
                    for ($i=0; $i < $producto_encontrado; $i++) {
                      $fila = $producto->fetch_object();
                      echo '<h2><p>'.$fila->nombre.'</p></h2>';
                      echo '<h3><center>'.$fila->descripcion.'</center> </h3>';     
                    }  
                   ?>        
        </div>    
      </div>                  
      <br>
      <hr>
      <br>
      <div class="row">
        <h2><p>Seleccionar Plaga para el Producto</p></h2>
        <div class="nuevoItem">
          <div class="container">
            <input type="hidden" id="idProducto" value="<?php echo $_GET["id_producto"] ?>">
            <div class="row">          
              <div class="col s12 m6 l6">
                <div class="input-field">
                  <select id="plaga">
                   <?php 
                    for ($i=0; $i < $plaga_encontrada; $i++) {
                      $fila = $plaga->fetch_object();
                      echo '<option value="'.$fila->id_plaga.'">'.$fila->nombre.'</option>';     
                    }  
                   ?>  
                  </select>
                </div>                       
              </div>
              <div class="col s12 m6 l6">
              	<div class="nuevoTest">
                	<div class="input-field col s12">
                  		<input type="button" id="asignar" value="Agregar" class="btn">
                	</div>                      
              	</div> 
              </div>                         
            </div>
            <div class="row">
              <div class="col s12 l8 m8">
                <?php 
                  for ($i=1; $i <= $paso_encontrado; $i++) {
                    $fila = $paso->fetch_object();
                    echo '                  
                      <div class="card">
                        <input type="hidden" id="idPaso" value="">
                        <div class="card-content">
                          <div class="row">
                            <div class="col s12">
                              <input type="hidden" id="plaga'.$fila->id_plaga.'" value="'.$fila->id_plaga.'">
                              <p><b>'.$i.'</b>. '.$fila->nombre.'<a class="eliminarPlaga right"><i class="material-icons" id="'.$fila->id_plaga.'">delete</i></a></p>
                              <br>
                              <hr> 
                            </div>
                          </div>
                        </div>  
                      </div>
                    ';
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


      $("#asignar").click(function(){  
     //   alert($("#agregarItem").val());
     //   alert($("#idItem").val());

            var datos=[];
              datos.push({
                "operacion": "asignarPlaga",
                "id_plaga": $("#plaga").val(), 
                "id_producto": <?php echo $_GET["id_producto"]; ?>
              }); 
            var ha = {"datos": datos};    
            var json = JSON.stringify(ha);
            console.log(json);
            ajax("../servidor/plaga_gestion.php", {"json": json}).done(function(info) {
                        
              if (info) {
                console.log(info);
                Materialize.toast('Error al Registrar', 500,'',function(){
                  location.reload(true);              
                });
              }else{
                Materialize.toast('Agregado Correctamente', 500,'',function(){
                  location.reload(true);              
                });
              }
            });

            return false;           

 
      });

        $(".eliminarPlaga").click(function(e){
          var r = confirm("Confirmar la Eliminacion del Paso");
            if (r == true) {
              var id = e.target.id;
              
                    var datos=[];
                      datos.push({
                        "operacion": "eliminarPlagaAsignada", 
                        "id_plaga": id,
                        "id_producto": <?php echo $_GET["id_producto"]; ?>
                      }); 

                      
                    var text = {"datos": datos};   
                    var json = JSON.stringify(text);

                    ajax("../servidor/plaga_gestion.php", {"json": json}).done(function(info) {
                      if (info) { 
                        Materialize.toast('Error al Eliminar', 500,'',function(){
                        location.reload(true);
                        });
                      }else{
                        Materialize.toast('Eliminado Correctamente', 500,'',function(){
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
