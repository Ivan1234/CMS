//Área de arrastre de imágenes//

if($("#columnasSlide").html()==0){

	$("#columnasSlide").css({"height":"100px"});

}
else{

	$("#columnasSlide").css({"height":"auto"});

}

//Fin de Área de arrastre de imágenes//

//Área de subir imágenes//

$("#columnasSlide").on("dragover",function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"url(views/images/sort_desc_disabled.png)"});

});

$("#columnasSlide").on("drop",function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"white"});

	var archivo = e.originalEvent.dataTransfer.files;

	var imagen=archivo[0];

	//Validar tamaño de la imagen

	var imagenSize=imagen.size;

	if(Number(imagenSize)>1000000){

		$("#columnasSlide").
		before('<div class="alert alerta alert-warning text-center">Se ha exedido el peso máximo de 1Mb</div>');

	}
	else{

		$(".alerta").remove();

	}

	var imagenType=imagen.type;

	if(imagenType=="image/jpeg" || imagenType=="image/png"){

		$(".alerta").remove();

	}
	else{

		$("#columnasSlide").
		before('<div class="alert alerta alert-warning text-center">El archivo no es formato JPEG ó PNG</div>');

	}

	//Subir imagen al servidor
	if(Number(imagenSize)<1000000 && imagenType=="image/jpeg" || imagenType=="image/png"){

		var datos = new FormData();

		datos.append("imagen",imagen);

		$.ajax({

			url: "views/ajax/gestorSlideAjax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function(){

				$("#columnasSlide").before('<img src="views/images/status.gif" id="status">');

			},
			success: function(respuesta){

				$("#status").remove();

				if(respuesta == 0){

					$("#columnasSlide").
					before('<div class="alert alerta alert-warning text-center">La imagen es inferior a 1600px * 600px</div>');

				}
				else{

					$("#columnasSlide").css({"height":"auto"});

					$("#columnasSlide").append('<li class="bloqueSlide"><span class="fa fa-times"></span><img src="'+respuesta["ruta"].slice(6)+'" class="handleImg"></li>');

				}

			}
			
		});

	}

});

//Fin de Área de subir imágenes//