<?php 

class controlador{

	function template(){

		include "views/template.php";

	}

	function enlacesControlador(){

		if(isset($_GET["action"])){

			$enlaces=$_GET["action"];

		}
		else{

			$enlaces="index";

		}

		$respuesta=lista::enlacesModelo($enlaces);

		include $respuesta;

	}

	function ingresoControlador(){

		if(isset($_POST["usuarioIngreso"])){

			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioIngreso"]) && preg_match('/^[a-zA-Z0-9]*$/',$_POST["passwordIngreso"])){

				$datosControlador=$_POST["usuarioIngreso"];

				$respuesta=sentencias::ingresoModelo($datosControlador,"usuarios");

				$intentos=$respuesta["intentos"];

				$usuario=$_POST["usuarioIngreso"];

				$maximoIntentos=3;

				if($intentos<$maximoIntentos){

					if($_POST["usuarioIngreso"]==$respuesta["usuario"] && $_POST["passwordIngreso"]==$respuesta["password"]){

						$intentos=0;

						$datosIntentos=array(

							"usuarioActual"=>$usuario,
							"actualizarIntentos"=>$intentos

						);

						$respuestaActualizarIntentos=sentencias::intentosModel($datosIntentos,"usuarios");

						session_start();

						$_SESSION["validar"]=true;

						$_SESSION["usuario"]=$respuesta["usuario"];

						header("location: inicio");

					}
					else{

						$intentos++;

						$datosIntentos=array(

							"usuarioActual"=>$usuario,
							"actualizarIntentos"=>$intentos

						);

						$respuestaActualizarIntentos=sentencias::intentosModel($datosIntentos,"usuarios");

						header("location: fallo");

					}

				}
				else{

					$intentos=0;

					$datosIntentos=array(

						"usuarioActual"=>$usuario,
						"actualizarIntentos"=>$intentos

					);

					$respuestaActualizarIntentos=sentencias::intentosModel($datosIntentos,"usuarios");

					header("location: fallo3Intentos");

				}

			}

		}

	}

}