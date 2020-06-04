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

					$("#columnasSlide").append('<li class="bloqueSlide"><span class="fa fa-times eliminarSlide"></span><img src="'+respuesta["ruta"].slice(6)+'" class="handleImg"></li>');

					$("#ordenarTextSlide").append('<li><span class="fa fa-pencil" style="background:blue"></span><img src="'+respuesta["ruta"].slice(6)+'" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p></li>');

					//window.location.reload();

					swal({

						title: "¡OK!",
						text: "¡La imagen se subió correctamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					},
					function(isConfirm){

						if(isConfirm){

							window.location = "slide";	

						}

					});

				}

			}
			
		});

	}

});

//Fin de Área de subir imágenes//

//Eliminar Item Slide

$(".eliminarSlide").click(function(){

	if($(".eliminarSlide").length == 1){

		$("#columnasSlide").css({"height":"100px"});

	}

	idSlide	= $(this).parent().attr("id");
	$(this).parent().remove();

	rutaSlide = $(this).attr("ruta");
	$("#item"+idSlide).remove();

	var borrarItem = new FormData();
	borrarItem.append("idSlide", idSlide);
	borrarItem.append("rutaSlide", rutaSlide);

	$.ajax({

		url: "views/ajax/gestorSlideAjax.php",
		method: "POST",
		data: borrarItem,
		cache: false,
		contentType: false,
		processData: false,
		success: function(){}

	});

});

//Fin de Eliminar Item Slide

//Editar Item Slide

$(".editarSlide").click(function(){

	idSlide = $(this).parent().attr("id");

	rutaImagen = $(this).parent().children("img").attr("src");
	rutaTitulo = $(this).parent().children("h1").html();
	rutaDescripcion = $(this).parent().children("p").html();

	$(this).parent().html('<img src="'+rutaImagen+'" class="img-thumbnail"><input type="text" class="form-control" id="enviarTitulo" placeholder="Título" value="'+rutaTitulo+'"><textarea row="5" class="form-control" id="enviarDescripcion" placeholder="Descripción">'+rutaDescripcion+'</textarea><button class="btn btn-info pull-right" id="guardar'+idSlide+'" style="margin:10px">Guardar</button>');

	$("#guardar"+idSlide).click(function(){

		enviarID = idSlide.slice(4);

		enviarTitulo = $("#enviarTitulo").val();

		enviarDescripcion = $("#enviarDescripcion");

		var actualizarSlide = new FormData();

		actualizarSlide.append("enviarID", enviarID);

		actualizarSlide.append("enviarTitulo", enviarTitulo);

		actualizarSlide.append("enviarDescripcion", enviarDescripcion);

		$.ajax({

			url: "views/ajax/gestorSlideAjax.php",
			method: "POST",
			data: actualizarSlide,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				console.log("respuesta: ", respuesta);

			}

		});

	});

});

//Fin de Editar Item Slide
