<?php 

require_once "conexion.php";

class sentencias extends conexion{

	function ingresoModelo($datosModelo,$tabla){

		$stmt=conexion::conectar()->prepare("SELECT usuario, password, intentos FROM $tabla WHERE usuario=:usuario");

		$stmt->bindParam(":usuario",$datosModelo,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	function intentosModel($datosModelo,$tabla){

		$stmt=conexion::conectar()->prepare("UPDATE $tabla SET intentos=:intentos WHERE usuario=:usuario");

		$stmt->bindParam(":intentos",$datosModelo["actualizarIntentos"],PDO::PARAM_INT);

		$stmt->bindParam(":usuario",$datosModelo["usuarioActual"],PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

}