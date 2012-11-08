<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();	
	$numNomina=$_SESSION['nombreUsuario'];
	$clave=$_SESSION['clave'];
	require_once("ClaseBDD.php");
	$conexion2 = new BDD();
	$conexion2->conexionBDD();
	
	$descripcion = $_POST['descripcionProblema'];
	
	$conexion2->query ="INSERT INTO axhunico_tutorias.formulariof4(numNomina,descripcion)
						VALUES ($numNomina, '$descripcion');";
											
	$conexion2->consultaSQL();
		if ($conexion2-> result){
			mysql_close($conexion2->link);

			echo "<SCRIPT LANGUAGE=\"Javascript\">
					  <!--
					  alert(\"El formulario se ha enviado con exito !\");
					  window.location='selFormatosAlumnos.php'; 
					  //-->
				  </SCRIPT>";
		}
?>