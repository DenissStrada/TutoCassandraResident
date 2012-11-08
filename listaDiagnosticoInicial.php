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
<title>Lista de Diagn&oacute;stico Inicial</title>
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
          <h3 class="Estilo1">Lista de Alumnos</h3>
          <p>
            <?php
	$numNomina=$_SESSION['nombreUsuario'];
	$clave=$_SESSION['clave'];

	require_once("ClaseBDD.php");
	$conexion = new BDD();
	
	$conexion->conexionBDD();

	// Consulta SQL
	$conexion->query = "SELECT distinct historiales.numControl, historiales.grupo, historiales.periodo, historiales.anio, nombres.numControl, nombres.nombreAlumno, horariosfebjun_2012.numNomina, horariosfebjun_2012.grupoAnterior FROM historiales,nombres,horariosfebjun_2012 WHERE historiales.periodo=1 && historiales.anio=2012 && historiales.tipoCurso='CN' && historiales.opcion!=2 && horariosfebjun_2012.numNomina=".$numNomina."&& historiales.grupo=horariosfebjun_2012.grupoAnterior && historiales.numControl = nombres.numControl order by nombres.nombreAlumno";
	$conexion->consultaSQL();
	$color="#DFEDBC";
// Imprimir los resultados en HTML
echo "<form id=\"form7\" name=\"form7\" method=\"post\" action=\"diagnosticoInicial.php\">";
echo "<table width=\"600px\" align=\"center\" border=\"0\" style='border-collapse:collapse;'>\n";
while ($row = mysql_fetch_array($conexion->result)) {
    echo "<tr bgcolor='$color' height='60'>";
	$filename = "fotos/$row[numControl].jpg";
	if (file_exists($filename)) {
    	echo "<td><div align='left'><img src='$filename' width='50' height='60'/></div></td>";
	} else {		
    	echo "<td><div align='left'><img src='fotos/usuario.jpg' width='50' height='60'/></div></td>";
	}    
	
    echo "<td>&nbsp;&nbsp;".$row['nombreAlumno']."</td>\n";
	
    echo "<td align=\"center\" colspan=\"2\">
				ver F1:
        	    <input type=\"submit\" class='boton2' name='listaDI' id='.$row[numControl]' value='$row[numControl]' />
				<input type=\"hidden\" name=\"numNomina\" id=\"numNomina\" value=\"$numNomina\" />
		  </td>";
    echo "</tr>\n";
	if($color=="#FCFFFF"){
	  $color="#DFEDBC";
  	}
	else{
		$color="#FCFFFF";
	}
}
echo "</table>\n";
echo "</form>";

	// Libera la consulta y cierra la conexión
	$conexion->liberaConsultaCierraConexion();

?>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
