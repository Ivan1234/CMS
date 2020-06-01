<?php 

	require_once "../../controllers/gestorSlideControlador.php";
	require_once "../../models/gestorSlideModelo.php";

	//CLASE Y MÉTODOS
	//------------------------------------------------------------------------------

	class gestorSlideAjax{

		//SUBIR LA IMAGEN DEL SLIDE
		//--------------------------------------------------------------------------

		public $imagenNombre;
		public $imagenTemporal;		

		function gestorSlideAjaxFunction(){

			$datosAjax=array(

				"imagenNombre"=>$this->imagenNombre,
				"imagenTemporal"=>$this->imagenTemporal

			);

			$respuesta=gestorSlideControlador::mostrarImagenControlador($datosAjax);

			echo $respuesta;

		}
		
	}

	//OBJETOS
	//------------------------------------------------------------------------------

	$a = new gestorSlideAjax();
	$a -> imagenNombre=$_FILES["imagen"]["name"];
	$a -> imagenTemporal=$_FILES["imagen"]["tmp_name"];
	$a -> gestorSlideAjaxFunction();
