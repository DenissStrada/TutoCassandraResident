<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();
	
	$_SESSION['nombreUsuario'] = $_POST['nombreUsuario'] ;
    $_SESSION['clave'] = $_POST['clave'] ;
		
	$tamanoCadena = strlen($_SESSION['nombreUsuario']);
	if($tamanoCadena<8){
		require_once("ClaseBDD.php");
		$conexion = new BDD();
		$conexion->conexionBDD();		
		// Consulta SQL
		$conexion->query = 'SELECT * FROM profesores WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
		$conexion->consultaSQL();
		header('location: seleccionFormatos.php');
	}
	else if($tamanoCadena>=8){
		require_once("ClaseBDD.php");
		$conexion = new BDD();
		$conexion->conexionBDD();		
		// Consulta SQL
		$conexion->query = 'SELECT * FROM nombres WHERE numControl=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
		$conexion->consultaSQL();
		header('location: selFormatosAlumnos.php');
	}
	
	/* if(isset($_POST["numNomina"]) == "52" && $_POST["clave"] == "usuario"){
        $_SESSION['numNomina'] = $_POST['numNomina'] ;
        $_SESSION['clave'] = $_POST['clave'] ;
		
		header('location: usuario.php') ;
	}
	else if(isset($_POST["numNomina"]) == "52" && $_POST["clave"] == "administrador"){
		$_SESSION['numNomina'] = $_POST['numNomina'] ;
        $_SESSION['clave'] = $_POST['clave'] ;
		
		header('location: http://localhost:8888/MAMP/sesiones/administrador.php') ;
	}
    else {
        echo "Debes introducir tus datos correctos.";
    } */
?>
