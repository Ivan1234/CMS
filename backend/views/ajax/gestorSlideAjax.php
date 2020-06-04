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
		public $idSlide;
		public $rutaSlide;	

		function gestorSlideAjaxFunction(){

			$datosAjax=array(

				"imagenNombre"=>$this->imagenNombre,
				"imagenTemporal"=>$this->imagenTemporal

			);

			$respuesta=gestorSlideControlador::mostrarImagenControlador($datosAjax);

			echo $respuesta;

		}
		//ELIMINAR ITEM DEL SLIDE
		//--------------------------------------------------------------------------

		function eliminarSlideAjax(){

			$datos = array(

				"idSlide" => $this->idSlide,
				"rutaSlide" => $this->rutaSlide

			);

			$respuesta = gestorSlideControlador::eliminarSlideControlador($datos);

			echo $respuesta;

		}
		
	}

	//OBJETOS
	//------------------------------------------------------------------------------

	if(isset($_FILES["imagen"]["name"])){

		$a = new gestorSlideAjax();
		$a -> imagenNombre=$_FILES["imagen"]["name"];
		$a -> imagenTemporal=$_FILES["imagen"]["tmp_name"];
		$a -> gestorSlideAjaxFunction();

	}

	if(isset($_POST["idSlide"])){

		$b = new gestorSlideAjax();
		$b -> idSlide = $_POST["idSlide"];
		$b -> rutaSlide = $_POST["rutaSlide"];
		$b -> eliminarSlideAjax();

	}
