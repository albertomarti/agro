<?php 

	/**
	* 
	*/
	include_once 'conexion.php';
		
	
	$resultado = false;
	$server = new conexion();
	$conexion = $server->conectar();
	

	if (isset($_POST["json"])){
		$producto = json_decode($_POST["json"]);

#####################   TEST HONEY ALONSO ###########################################		
		if ($producto->{"datos"}[0]->{"operacion"} == "crearProducto") {
			$descripcion = $producto->{"datos"}[0]->{"descripcion"};
			$id_administrador = $producto->{"datos"}[0]->{"id_administrador"};
			$imagen = $producto->{"datos"}[0]->{"imagen"};
			$producto = $producto->{"datos"}[0]->{"producto"};
			
			$directorio_destino = "../../imagenes/productos";
					
			
			$sql='INSERT INTO producto(nombre, descripcion, imagen, id_administrador) VALUES("'.$producto.'","'.$descripcion.'","'.$imagen.'","'.$id_administrador.'")'; 
			$stmts = $conexion->prepare($sql);
			
			if ($stmts->execute()) {

				return $resultado = true;			

	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($producto->{"datos"}[0]->{"operacion"} == "actualizarProducto") {
			    	
$idProducto = $producto->{"datos"}[0]->{"id"};
			$descripcion = $producto->{"datos"}[0]->{"descripcion"};	
			$producto = $producto->{"datos"}[0]->{"producto"};
			

			//echo $descripcion." ".$estilo." ".$id_item;

			$sql="UPDATE producto SET nombre='$producto', descripcion='$descripcion' WHERE id_producto='$idProducto'"; 
			if ($conexion->query($sql)) {
				 $respuesta = true;
	        }else{
		    	 $respuesta = false;     	
	        }

	        echo $respuesta;

		}

		if ($producto->{"datos"}[0]->{"operacion"} == "eliminarProducto") {

			$id= $producto->{"datos"}[0]->{"id_producto"};	

			$sql='DELETE FROM producto WHERE id_producto = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}


		if ($producto->{"datos"}[0]->{"operacion"} == "crearInstruccion") {

			$id_producto = $producto->{"datos"}[0]->{"id_producto"};
			$descripcion = $producto->{"datos"}[0]->{"descripcion"};

		

			$sql='INSERT INTO paso(descripcion, id_producto) VALUES("'.$descripcion.'","'.$id_producto.'")'; 
			$stmts = $conexion->prepare($sql);
			
			if ($stmts->execute()) {

				return $resultado = true;			

	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($producto->{"datos"}[0]->{"operacion"} == "actualizarPaso") {
			    	
			$idPaso = $producto->{"datos"}[0]->{"id_paso"};
			$descripcion = $producto->{"datos"}[0]->{"descripcion"};
			

			//echo $descripcion." ".$estilo." ".$id_item;

			$sql="UPDATE paso SET descripcion='$descripcion' WHERE id_paso='$idPaso'"; 
			if ($conexion->query($sql)) {
				 $respuesta = true;
	        }else{
		    	 $respuesta = false;     	
	        }

	        echo $respuesta;

		}		

		if ($producto->{"datos"}[0]->{"operacion"} == "eliminarPaso") {

			$id= $producto->{"datos"}[0]->{"id_paso"};	

			$sql='DELETE FROM paso WHERE id_paso = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}		



/*
		if ($test->{"datos"}[0]->{"operacion"} == "habilitarTestHA") {
			    	

			$habilitado = $test->{"datos"}[0]->{"habilitado"};
			$id_test = $test->{"datos"}[0]->{"id_test"};

			$sql='UPDATE test_ha SET habilitado='.$habilitado.' WHERE id_test_ha='.$id_test.';'; 

			if ($habilitado == 1) {
				$sql2='UPDATE test_ha SET habilitado="0" WHERE id_test_ha !='.$id_test.';';
			}
			
			if ($conexion->query($sql) && $conexion->query($sql2)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}				

		if ($test->{"datos"}[0]->{"operacion"} == "crearItemHA") {
			    	

			$descripcion = $test->{"datos"}[0]->{"descripcion"};	
			$estilo = $test->{"datos"}[0]->{"estilo"};
			$id_test = $test->{"datos"}[0]->{"id_test"};

			$sql='INSERT INTO item(item, id_estilo, id_test_ha) VALUES("'.$descripcion.'","'.$estilo.'","'.$id_test.'")'; 
			
			if ($conexion->query($sql)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($test->{"datos"}[0]->{"operacion"} == "eliminarItemHA") {

			$id= $test->{"datos"}[0]->{"id_item"};	

			$sql='DELETE FROM item WHERE id_item = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}

	


#####################   TEST VARK ###########################################		
		if ($test->{"datos"}[0]->{"operacion"} == "crearTestVark") {

			$id_administrador = $test->{"datos"}[0]->{"id_administrador"};

			$sql='INSERT INTO test_vark(id_administrador) VALUES("'.$id_administrador.'")'; 
			$stmts = $conexion->prepare($sql);
			
			if ($stmts->execute()) {

				return $resultado = true;			

	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($test->{"datos"}[0]->{"operacion"} == "eliminarTestVark") {

			$id= $test->{"datos"}[0]->{"id_test"};	

			$sql='DELETE FROM test_vark WHERE id_test_vark = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($test->{"datos"}[0]->{"operacion"} == "habilitarTestVark") {
			    	

			$habilitado = $test->{"datos"}[0]->{"habilitado"};
			$id_test = $test->{"datos"}[0]->{"id_test"};

			$sql='UPDATE test_vark SET habilitado='.$habilitado.' WHERE id_test_vark='.$id_test.';'; 

			if ($habilitado == 1) {
				$sql2='UPDATE test_vark SET habilitado="0" WHERE id_test_vark !='.$id_test.';';
			}
			
			if ($conexion->query($sql) && $conexion->query($sql2)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}				

		if ($test->{"datos"}[0]->{"operacion"} == "crearPreguntaVark") {
			    	

			$descripcion = $test->{"datos"}[0]->{"descripcion"};	
			$estilo = $test->{"datos"}[0]->{"estilo"};
			$id_test = $test->{"datos"}[0]->{"id_test"};

			$sql='INSERT INTO pregunta(pregunta, id_test_vark) VALUES("'.$descripcion.'","'.$id_test.'")'; 
			
			if ($conexion->query($sql)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($test->{"datos"}[0]->{"operacion"} == "eliminarPregunta") {

			$id = $test->{"datos"}[0]->{"id_pregunta"};	

			$sql='DELETE FROM respuesta WHERE id_pregunta = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {
				
				$sql='DELETE FROM pregunta WHERE id_pregunta = '.$id.';'; 
				$stmts = $conexion->prepare($sql);
				if ($stmts->execute()) {
					return $resultado = true;
				}else{
					return $resultado = false; 
				}	
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}

		if ($test->{"datos"}[0]->{"operacion"} == "eliminarRespuesta") {

			$id = $test->{"datos"}[0]->{"id_respuesta"};	

			$sql='DELETE FROM respuesta WHERE id_respuesta = '.$id.';'; 
			$stmts = $conexion->prepare($sql);
			if ($stmts->execute()) {

				echo $resultado = true;					
	            
	        }else{
		    	echo $resultado = false;     	
	        }

		}		

		if ($test->{"datos"}[0]->{"operacion"} == "actualizarPregunta") {
			    	

			$pregunta = $test->{"datos"}[0]->{"descripcion"};
			$id_pregunta = $test->{"datos"}[0]->{"id_pregunta"};

			$sql='UPDATE pregunta SET pregunta="'.$pregunta.'" WHERE id_pregunta="'.$id_pregunta.'";'; 
			
			if ($conexion->query($sql)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}	

		if ($test->{"datos"}[0]->{"operacion"} == "crearRespuestaVark") {
			    	

			$respuesta = $test->{"datos"}[0]->{"respuesta"};	
			$id_tipo_persepcion = $test->{"datos"}[0]->{"estilo"};
			$id_pregunta = $test->{"datos"}[0]->{"id_pregunta"};

			$sql='INSERT INTO respuesta(respuesta, id_pregunta, id_tipo_persepcion) VALUES("'.$respuesta.'","'.$id_pregunta.'","'.$id_tipo_persepcion.'")'; 
			
			if ($conexion->query($sql)) {
				

				return $resultado = true;
					
	            
	        }else{
		    	return $resultado = false;     	
	        }

		}	*/
													



	}



 ?>