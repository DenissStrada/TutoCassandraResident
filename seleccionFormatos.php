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
<title>Selecci&oacute;n de Formatos</title>
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
					//require_once("ClaseBDD.php");
					//$conexion = new BDD();
					$conexion->conexionBDD();
					// Consulta SQL
					$conexion->query = "SELECT nombre, aPaterno, aMaterno, privilegios FROM profesores WHERE numNomina=".$user;
					$conexion->consultaSQL();
 					$row = mysql_fetch_array($conexion->result);
					$usuario=$row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];
					$tipoUsuario=$row['privilegios'];
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
if($bandera == "v"){
			$numNomina = $user;    
	echo " 
		<h4 class='Estilo1'>Consulta Formatos de Tutorías</h4>      
      <table width=\"420px\" align=\"center\" border=\"0\" style='border-collapse:collapse;'>
        
        <tr bgcolor='#DFEDBC'>
        <td align=\"left\">
        	<form id=\"form3\" name=\"form3\" method=\"post\" action=\"listaDiagnosticoInicial.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Formato Diagnostico Inicial<br>&nbsp;
		</td>
		<td align=\"center\">
        	    <input type=\"submit\" class='boton2' name=\"diagnosticoInicial\" id=\"diagnosticoInicial\" value=\"Formato1\" />
				<input type=\"hidden\" name=\"numNomina\" id=\"numNomina\" value=\"$numNomina\" />
      	      </label>                       
            </form>
        </td>
        </tr>
        <tr>
        <td align=\"left\">
        	<form id=\"form4\" name=\"form4\" method=\"post\" action=\"Calendario.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Formato Seguimiento Individual<br>&nbsp;
	    </td>
		<td align=\"center\">
        	    <input type=\"submit\" class='boton2' name=\"seguimientoIndividual\" id=\"seguimientoIndividual\" value=\"Formato2\" />
      	     </label>            
            </form>
        </td>
        </tr>
        <tr bgcolor='#DFEDBC'>";
if($tipoUsuario==2 || $tipoUsuario==3){
        echo "<td align=\"left\">
        	<form id=\"form5\" name=\"form5\" method=\"post\" action=\"f3Coordinador.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Formato 1er Informe por Carrera<br>&nbsp;
	    </td>
		<td align=\"center\">
        	    <input type=\"submit\" class='boton2' name=\"reporteParcial\" id=\"reporteParcial\" value=\"Formato3\" />
      	      </label>            
            </form>
        </td>
        </tr>
        <tr>";
     }
echo "<td align=\"left\">
        	<form id=\"form6\" name=\"form6\" method=\"post\" action=\"f4Coordinador.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Formato Informe Semestral<br>&nbsp;
		</td>
		<td align=\"center\">
        	    <input type=\"submit\" class='boton2' name=\"reporteFinal\" id=\"reporteFinal\" value=\"Formato4\" />
      	      </label>            
            </form>
        </td>
        </tr>";
if($tipoUsuario==2 || $tipoUsuario==3){
echo "<tr bgcolor='#DFEDBC'>";
}
echo"
        <td align=\"left\">
        	<form id=\"form7\" name=\"form7\" method=\"post\"  action=\"listaHabitosEstudio.php\">
        	  <label><br>&nbsp;&nbsp;&nbsp;Informe Individual Hábitos de Estudio<br>&nbsp;
		</td>
		<td align=\"center\">
        	    <input type=\"submit\" class='boton2' name=\"habitosEstudio\" id=\"habitosEstudio\" value=\"Ver\" />
				<input type=\"hidden\" name=\"numNomina\" id=\"numNomina\" value=\"$numNomina\" />
      	      </label>                       
            </form>
        </td>
        </tr>
 <tr>";
if($tipoUsuario==2 || $tipoUsuario==3){

}
else{
echo "<tr bgcolor='#DFEDBC'>";
}
       echo" <td align=\"left\">
        	<form id=\"form8\" name=\"form8\" method=\"post\" action=\"informeGrupal.php\">

        	  <label><br>&nbsp;&nbsp;&nbsp;Informe Grupal Hábitos de Estudio<br>&nbsp;
		</td>
		<td align=\"center\">

        	    <input type=\"submit\" class='boton2' name=\"reporteFinal\" id=\"reporteFinal\" value=\"Ver\" />
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

?>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
