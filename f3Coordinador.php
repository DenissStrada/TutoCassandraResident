<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();

	$user=$_SESSION["nombreUsuario"];
	$password=$_SESSION["clave"];
	if($user==null && $pasword==null){
		echo
		"<SCRIPT LANGUAGE=\"Javascript\">
		<!--
		window.location='index.php';
		//--> 
		</SCRIPT>";	
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Acceso al programa Tutorias</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F4F6DE">
<div id="centrar">
  <div id="contenedor">
    <div id="banner"><br>
    </div>
    <div id="areat">
      <div id="marcoIzquierdo">
        <div id="arbol"> </div>
        <div id="menuIzquierdo">
          <?php
				include ("menuVertical.php");
				$logo = new menuVertical();
				$logo->imprimeMenu();
			?>
        </div>
      </div>
      <div id="marcoSesion"></div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <p>&nbsp;</p>
          <div>
          <p align="center" class="Estilo1"><strong>F3 1er INFORME POR CARRERA (ENERO – JUNIO 2012)</strong></p>
          </div>
		<?php
			require_once("ClaseBDD.php");
			$conexion = new BDD();
			$conexion->conexionBDD();
			$conexion->query = "SELECT area,nombre,aPaterno,aMaterno FROM profesores WHERE numNomina=$user";
			$conexion->consultaSQL();
 			$row = mysql_fetch_array($conexion->result);
			$area= $row['area'];	
			$nombre= $row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];

			$conexion->query = "SELECT nombreArea FROM area WHERE idArea=$area";
			$conexion->consultaSQL();
 			$row = mysql_fetch_array($conexion->result);
			$nombreArea=$row['nombreArea'];
			$conexion->liberaConsultaCierraConexion();

		
        echo"  <p>&nbsp;</p>
          <p>Jefe de Carrera: $nombre</p>
          <p>Academia: $nombreArea <p/>
          <p>No. De Tutores: </p>
          <p>No. De Tutorados: </p>
          <p>Semestres: </p>
          <p>Grupos: <p/>
          <p>Fechas de aplicación (1ra y última): </p>
          <p>&nbsp;</p>";
?>
	 </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
