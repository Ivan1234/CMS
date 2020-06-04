<?php 

require_once "conexion.php";

class gestorSlideModelo{


	//SUBIR RUTA DE LA IMAGEN
	//--------------------------------------------------------------------------------------------------

	function subirImagenSlideModelo($datosModelo, $tabla){

		$stmt=conexion::conectar()->prepare("INSERT INTO $tabla(ruta) VALUES (:ruta)");

		$stmt -> bindParam(":ruta", $datosModelo, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}
		else{

			return "error";

		}

		$stmt -> close();

	}


	//MOSTRAR RUTA DE LA IMAGEN
	//--------------------------------------------------------------------------------------------------

	function mostrarImagenSlideModelo($datosModelo, $tabla){

		$stmt=conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $datosModelo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	//MOSTRAR IMAGENES EN LA VISTA
	//----------------------------------------------------------------------------------------------------

	function mostrarImagenVistaModelo($tabla){
		
		$stmt=conexion::conectar()->prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();		

	}

	function eliminarSlideModelo($datosModelo, $tabla){

		$stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datosModelo["idSlide"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}
		else{

			return "error";

		}

		$stmt -> close();

	}

}