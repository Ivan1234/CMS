<?php 

	require_once "../../controllers/gestorSlideControlador.php";
	require_once "../../models/gestorSlideModelo.php";

	class gestorSlideAjax{

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

	$a = new gestorSlideAjax();
	$a -> imagenNombre=$_FILES["imagen"]["name"];
	$a -> imagenTemporal=$_FILES["imagen"]["tmp_name"];
	$a -> gestorSlideAjaxFunction();
