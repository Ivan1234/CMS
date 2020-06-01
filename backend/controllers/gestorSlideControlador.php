<?php 

class gestorSlideControlador{

	//MOSTRAR IMAGEN SLIDE CON AJAX
	//--------------------------------------------------------------------------------------------------

	function mostrarImagenControlador($datosControlador){

		//getimagesize -> obtiene el tamaño de una imagen
		//list() -> no es una función, es un constructor el lenguaje y se utiliza para asignar una lista
		//de variables en una sola operación

		list($ancho, $alto) = getimagesize($datosControlador["imagenTemporal"]);	

		if($ancho < 1600 || $alto < 600){

			echo 0;

		}
		else{

			$aleatorio = mt_rand(100,999);

			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

			//imagecreatefromjpeg -> crea una nueva imagen a partir de un fichero o de una URL

			$origen = imagecreatefromjpeg($datosControlador["imagenTemporal"]);

			//imagejpeg -> exporta la imagen al navegador o un fichero

			imagejpeg($origen, $ruta);

			GestorSlideModelo::subirImagenSlideModelo($ruta, "slide");

			$respuesta = GestorSlideModelo::mostrarImagenSlideModelo($ruta, "slide");

			$enviarDatos = array("ruta" => $respuesta["ruta"]);

			echo json_encode($enviarDatos);

		}

	}

	//MOSTRAR IMAGENES EN LA VISTA 
	//----------------------------------------------------------------------------------------
	function mostrarImagenVistaControlador(){

		$respuesta = GestorSlideModelo::mostrarImagenVistaModelo("slide");


		foreach($respuesta as $row => $item){

			echo '<li class="bloqueSlide"><span class="fa fa-times"></span><img src="'.substr($item["ruta"], 6).'" class="handleImg"></li>';

		}

	}

	//MOSTRAR IMAGENES EN EL EDITOR
	//-----------------------------------------------------------------------------------------
	function editorSlideControlador(){

		$respuesta = GestorSlideModelo::mostrarImagenVistaModelo("slide");

  		foreach($respuesta as $row => $item){

			echo '<li>
					<span class="fa fa-pencil" style="background:blue"></span>
					<img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
					<h1>'.$item["titulo"].'</h1>
					<p>'.$item["descripcion"].'</p>
				</li>';

		}		

	}

}