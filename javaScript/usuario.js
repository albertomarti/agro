

// REgistrar Usuario
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
       	    				"usuario": $("#usuario").val(), 
       	    				"contraseña": $("#contraseña").val()
       	    			}); 
       	    	var usuario = {"datos": datos};		
       	    	var json = JSON.stringify(usuario);

       	    	ajax("servidor/usuario.php", {"json": json}).done(function(info) {

       	    		if (info) {
		    			Materialize.toast('Usuario Registrado Correctamente', 500,'',function(){
							location.reload(true);		    	
		    			});
       	    		}else{
		    			Materialize.toast('Error al Registrar el Usuario', 500,'',function(){
							location.reload(true);
			    	
		    			});
       	    		}
       	    	});

       	    	return false;



    	        
    	        
    	    });



  });
   	    

	
