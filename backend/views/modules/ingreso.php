<!--=====================================
FORMULARIO DE INGRESO            
======================================-->
<div id="backIngreso">
	<form method="post" id="formIngreso" onsubmit="return validarIngreso()">

		<h1 id="tituloFormIngreso">INGRESO AL PANEL DE CONTROL</h1>

		<input class="form-control formIngreso" type="text" placeholder="Ingrese su Usuario" name="usuarioIngreso" id="usuarioIngreso">
		<input class="form-control formIngreso" type="password" placeholder="Ingrese su Contraseña" name="passwordIngreso" id="passwordIngreso">
		<?php 

		$c=new controlador();

		$c->ingresoControlador();

		if(isset($_GET["action"])){

			if($_GET["action"]=="fallo"){

				echo '<div class="alert alert-danger">Error al ingresar</div>';

			}

			if($_GET["action"]=="fallo3Intentos"){

				echo '<div class="alert alert-danger">Ha fallado 3 veces, demuestre que no es un robot</div>';

			}

		}

		?>

		<input class="form-control formIngreso btn btn-primary" type="submit" value="Enviar">

	</form>
</div>
<!--====  Fin de FORMULARIO DE INGRESO  ====-->


