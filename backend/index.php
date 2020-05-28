<?php 

	require_once "controllers/controlador.php";
	require_once "controllers/gestorSlideControlador.php";
	require_once "models/enlaces.php";
	require_once "models/sentencias.php";
	require_once "models/gestorSlideModelo.php";

	$a=new controlador();

	$a->template();