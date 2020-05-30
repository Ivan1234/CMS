<?php 

class gestorSlideControlador{

	function mostrarImagenControlador($datosControlador){

		list($ancho, $alto) = getimagesize($datosControlador["imagenTemporal"]);	

		if($ancho < 1600 || $alto < 600){

			echo 0;

		}
		else{

			$aleatorio = mt_rand(100,999);

			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

			$origen = imagecreatefromjpeg($datosControlador["imagenTemporal"]);

			imagejpeg($origen, $ruta);

			GestorSlideModelo::subirImagenSlideModelo($ruta, "slide");

			$respuesta = GestorSlideModelo::mostrarImagenSlideModelo($ruta, "slide");

			$enviarDatos = array("ruta" => $respuesta["ruta"]);

			echo json_encode($enviarDatos);

		}

	}		

}