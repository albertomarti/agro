<?php 

	/**
	* 
	*/
	include_once 'conexion.php';
		
	
	$resultado = false;
	$server = new conexion();
	$conexion = $server->conectar();
	

	if (isset($_POST["json"])){
		$usuario = json_decode($_POST["json"]);
		if ($usuario->{"datos"}[0]->{"operacion"} == "registrarUsuario") {

			$documento = $usuario->{"datos"}[0]->{"documento"};	
			$nombre = $usuario->{"datos"}[0]->{"nombre"};
			$apellido = $usuario->{"datos"}[0]->{"apellido"};
			$email = $usuario->{"datos"}[0]->{"email"};
			$nombre_usuario = $usuario->{"datos"}[0]->{"usuario"};
			$contraseña = $usuario->{"datos"}[0]->{"contraseña"};
			

			$sql='INSERT INTO usuario(documento, nombre, apellido, email, usuario, contrasena) VALUES("'.$documento.'","'.$nombre.'","'.$apellido.'","'.$email.'","'.$nombre_usuario.'","'.$contraseña.'")'; 

			if ($conexion->query($sql)) {
				

				$resultado = true;

	            
	        }else{
		    	$resultado = false;     	
	        }

		}
 		
		echo $resultado;

		

	}



 ?>