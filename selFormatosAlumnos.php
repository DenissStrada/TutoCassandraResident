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
<title>Programa Tutorias</title>
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
				$conexion->query = 'SELECT validacion FROM nombres WHERE numControl=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
				$conexion->consultaSQL();
				$bandera = "f";
				$row = mysql_fetch_array($conexion->result);
					$bandera = "$row[validacion]";
				if($bandera=="v"){
					$conexion = new BDD();
					$conexion->conexionBDD();
					// Consulta SQL
					$conexion->query = "SELECT nombreAlumno FROM nombres WHERE numControl=".$user;
					$conexion->consultaSQL();
 					$row = mysql_fetch_array($conexion->result);
					$min = strtolower($row['nombreAlumno']);
					$usuario = ucwords($min);
					$partes = explode(" ",$usuario); 
					$tamaño = sizeof($partes);
					$usuario="";
					if($tamaño==4)
						$usuario= $partes[2]." ".$partes[3]." ".$partes[0]." ".$partes[1]; 
					else
						$usuario= $partes[3]." ".$partes[2]." ".$partes[0]." ".$partes[1];
					
					echo "<p class='Estilo7'>¡ Bienvenido !<br><br>$usuario</p>";
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

	if($bandera=="v"){
		$idSesion = SID;
    	echo "<table align=\"right\"><tr><td>
		<a href='configuracionCuenta.php?$idSesion'>Configurar cuenta</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='cerrarSesion.php?$idSesion'>Cerrar sesi&oacute;n</a>
		</td></tr></table>"; 
	}
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
		<?php
        if($bandera=="v"){  	
	echo "
    <h4 class='Estilo1'>Formatos de Tutorías</h4>    
      <table width=\"420px\" align=\"center\" border=\"0\" style='border-collapse:collapse;'>
        
        <tr bgcolor='#DFEDBC'>
        <td align='left'>
        	<form id=\"form3\" name=\"form3\" method=\"post\" action=\"datosPersonales.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Diagnostico Inicial<br>&nbsp;
		</td>
		<td align='center'>
        	    <input type=\"submit\" class='boton2' name=\"diagnosticoInicial\" id=\"diagnosticoInicial\" value=\"Responder\" />
				<input type=\"hidden\" name=\"numControl\" id=\"numControl\" value=\"$numControl\" />
      	      </label>                       
            </form>
        </td>
        </tr>
        <tr>
        <td align='left'>
        	<form id=\"form4\" name=\"form4\" method=\"post\" action=\"cuestionario.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Habitos de Estudio<br>&nbsp;
	    </td>
		<td align='center'>
        	    <input type=\"submit\" class='boton2' name=\"habitosEstudio\" id=\"habitosEstudio\" value=\"Responder\" />
      	     </label>            
            </form>
        </td>
        </tr>
        <tr bgcolor='#DFEDBC'>
        <td align='left'>
        	<form id=\"form5\" name=\"form5\" method=\"post\" action=\"verDatosPersonales.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Visualizar Diagnostico inicial<br>&nbsp;
	    </td>
		<td align='center'>
        	    <input type=\"submit\"  class='boton2' name=\"reporteParcial\" id=\"reporteParcial\" value=\"Revisar\" />
      	      </label>            
            </form>
        </td>
        </tr>
        <tr>
        <td align='left'>
        	<form id=\"form6\" name=\"form6\" method=\"post\" action=\"verHabitosEstudio.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Resultados Habitos de Estudio<br>&nbsp;
		</td>
		<td align='center'>
        	    <input type=\"submit\" class='boton2' name=\"reporteFinal\" id=\"reporteFinal\" value=\"Revisar\" />
      	      </label>            
            </form>
        </td>
        </tr>	
		<tr bgcolor='#DFEDBC'>
        <td align='left'>
        	<form id=\"form7\" name=\"form7\" method=\"post\" action=\"seguimientoAlumno.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Seguimiento individual<br>&nbsp;
	    </td>
		<td align='center'>
        	    <input type=\"submit\"  class='boton2' name=\"seguimiento\" id=\"seguimiento\" value=\"Ingresar\" />
      	      </label>            
            </form>
        </td>
        </tr>
	</table>
      
	<p>&nbsp;</p>
    
   ";
}
else {
	echo "<p>&nbsp;</p><p>&nbsp;</p><h3 class='Error'>Datos no válidos !</h3>";
	echo "<SCRIPT LANGUAGE=\"Javascript\">
  		<!--
		function redireccionar() { location.href='index.php' } 
		setTimeout ('redireccionar()', 2000);
		//-->
	</SCRIPT>"; 
}

	// Libera la consulta y cierra la conexión
	$conexion->liberaConsultaCierraConexion();

?>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
