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
<title>Calendario Tutorias</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F4F6DE">
<div id="centrar">
  <div id="contenedor">
    <div id="banner"><br>
    </div>
    <div id="areat">
      <div id="marcoIzquierdo">
        <div id="arbol"> 
        	<div id="bienvenida"> 
        		<?php
				require_once("ClaseBDD.php");
				$conexion = new BDD();
	
				$conexion->conexionBDD();
				$numControl=$_SESSION['nombreUsuario'];
				$clave2 = $_SESSION['clave'];
				// Consulta SQL
				$conexion->query = 'SELECT validacion FROM profesores WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
				$conexion->consultaSQL();
				$bandera = "f";
				$row = mysql_fetch_array($conexion->result);
					$bandera = "$row[validacion]";
				if($bandera=="v"){
					require_once("ClaseBDD.php");
					$conexion = new BDD();
					$conexion->conexionBDD();
					// Consulta SQL
					$conexion->query = "SELECT nombre, aPaterno, aMaterno FROM profesores WHERE numNomina=".$user;
					$conexion->consultaSQL();
 					$row = mysql_fetch_array($conexion->result);
					$usuario=$row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];
					echo "<p class='Estilo7'>¡ Bienvenido !<br><br>$usuario</p>";
					// Libera la consulta y cierra la conexión
					$conexion->liberaConsultaCierraConexion();
				}
				?>
    		</div>
        </div>
        <div id="menuIzquierdo">
          <?php
				include ("menuVertical.php");
				$logo = new menuVertical();
				$logo->imprimeMenu();
			?>
        </div>
      </div>
      <div id="marcoSesion">
      	 <?php
        	$idSesion = SID;
    		echo "<table align=\"right\"><tr><td>
				<a href='seleccionFormatos.php?$idSesion'>Seleccionar formatos</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='configuracionCuenta.php?$idSesion'>Configurar cuenta</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='cerrarSesion.php?$idSesion'>Cerrar sesi&oacute;n</a>
				</td></tr></table>";
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <p>&nbsp;</p>
          <?php
		require_once("Funciones_Cal.php");
		$call = new Calendarios;
		$tiempo_actual = time();
		$dia_solo_hoy = date("d",$tiempo_actual);
		if (!isset($_GET["nuevo_mes"]) && !isset($_GET["nuevo_ano"])){
			$mes = date("n", $tiempo_actual);
			$ano = date("Y", $tiempo_actual);
		}elseif ($_POST) {
			$mes = $_POST["nuevo_mes"];
			$ano = $_POST["nuevo_ano"];
		}else{
			$mes = $_GET["nuevo_mes"];
			$ano = $_GET["nuevo_ano"];
		}
		if(isset($_GET["m"])){
			$mes = $_GET["m"];
			$ano = $_GET["a"];
		}
		$call->mostrar_calendario($mes,$ano);
	?>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
