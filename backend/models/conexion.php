<?php 

	class conexion{

		function conectar(){

			$conn=new PDO("mysql:host=localhost;dbname=cms","root","");

			return $conn;

		}

	}