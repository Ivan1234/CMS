<?php 

	class lista{

		function enlacesModelo($enlaces){

			if($enlaces=="articulos" || $enlaces=="botonera" || $enlaces=="cabezote" || $enlaces=="galeria" || $enlaces=="ingreso" || $enlaces=="inicio" || $enlaces=="mensajes" || $enlaces=="perfil" || $enlaces=="slide" || $enlaces=="suscriptores" || $enlaces=="videos" || $enlaces=="salir"){

				$retorno="views/modules/".$enlaces.".php";

			}
			else if($enlaces=="index"){

				$retorno="views/modules/ingreso.php";

			}
			else if($enlaces=="fallo"){

				$retorno="views/modules/ingreso.php";

			}
			else if($enlaces=="fallo3Intentos"){

				$retorno="views/modules/ingreso.php";

			}
			else if($enlaces==""){

				$retorno="views/modules/ingreso.php";

			}
			else{

				$retorno="views/modules/ingreso.php";

			}

			return $retorno;

		}

	}