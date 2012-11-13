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
    	<div id="banner"><br></div>
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
                        $conexion->query = 'SELECT validacion FROM profesores WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' &&                                            clave=\''.$_SESSION['clave'].'\'';
                        $conexion->consultaSQL();
                        $bandera = "f";
                        $row = mysql_fetch_array($conexion->result);
                            $bandera = "$row[validacion]";
                        if($bandera=="v"){
                            require_once("ClaseBDD.php");
                            $conexion = new BDD();
                            $conexion->conexionBDD();
                            // Consulta SQL
                            $conexion->query = "SELECT nombre, aPaterno, aMaterno, privilegios FROM profesores WHERE numNomina=".$user;
                            $conexion->consultaSQL();
                            $row = mysql_fetch_array($conexion->result);
                            $usuario=$row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];
                            $tipoUsuario=$row['privilegios'];
                            echo "<p class='Estilo7'>� Bienvenido !<br><br>$usuario</p>";
                            // Libera la consulta y cierra la conexi�n
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
						
<?php
	require_once("ClaseBDD.php");
	$conexion = new BDD();
	$conexion2 = new BDD();
	
	$conexion->conexionBDD();
	$conexion2->conexionBDD();

	// Consulta SQL
	$conexion->query = 'SELECT * FROM profesores WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
	$conexion->consultaSQL();
	
  	while($row = mysql_fetch_array($conexion->result)){
		$nombreProfe = $row['nombre'];
		$aPaterno = $row['aPaterno'];
		$aMaterno = $row['aMaterno'];
		$numNomina = $row['numNomina'];
	}
	// Consulta SQL
	$conexion->query = 'SELECT distinct nombres.carrera, historiales.semestre, 
	                           historiales.grupo, historiales.numControl,  			                        
							   historiales.periodo, historiales.anio, 
							   nombres.nombreAlumno, horariosfebjun_2012.numNomina
                        FROM historiales,nombres,horariosfebjun_2012 
                        WHERE historiales.periodo=1 && historiales.anio=2012 
						      &&  horariosfebjun_2012.numNomina=\''.$numNomina .'\' &&                        historiales.grupo=horariosfebjun_2012.grupoAnterior 
							  && historiales.numControl = nombres.numControl 
							  order by nombres.nombreAlumno';
	$conexion->consultaSQL();
	$contador=0;
	$respondieron=0;
	$numsContro= array();
	while($row = mysql_fetch_array($conexion->result)){
		$carrera = $row['carrera'];
		$semestre = $row['semestre'];
		$claveGrupo = $row['grupo'];
		$numControl= $row['numControl'];
		$contador++;
		$conexion2->query = 'SELECT sumaDT,sumaME,sumaDE,sumaNC,sumaOL,sumaPE,sumaAC FROM respuestas 
		                     WHERE respuestas.num_Control=\''.$numControl.'\' ';	
		$conexion2->consultaSQL();
		while($row = mysql_fetch_array($conexion2->result)){
			$DT1 = $row ['sumaDT'];
			$sumaDT = $sumaDT + $DT1;
			$ME1 = $row ['sumaME'];
			$sumaME = $dumaME + $ME1;
			$DE1 = $row ['sumaDE'];
			$sumaDE = $dumaDE + $DE1;
			$NC1 = $row ['sumaNC'];
			$sumaNC = $dumaNC + $NC1;
			$OL1 = $row ['sumaOL'];
			$sumaOL = $dumaOL + $OL1;
			$PE1 = $row ['sumaPE'];
			$sumaPE = $dumaPE + $PE1;
			$ME1 = $row ['sumaME'];
			$sumaME = $dumaME + $ME1;
			$AC1 = $row ['sumaAC'];
			$sumaAC = $dumaAC + $AC1;
			$respondieron++;
		}
	}
	
	if($respondieron!=0){

	$porcentajeDT= ((($sumaDT/$respondieron)*100)/30);
	$porcentajeME= ((($sumaME/$respondieron)*100)/30);
	$porcentajeDE= ((($sumaDE/$respondieron)*100)/30);
	$porcentajeNC= ((($sumaNC/$respondieron)*100)/30);
	$porcentajeOL= ((($sumaOL/$respondieron)*100)/30);
	$porcentajePE= ((($sumaPE/$respondieron)*100)/30);
	$porcentajeAC= ((($sumaAC/$respondieron)*100)/30);
	
	if ($porcentajeDT<70)
		$debilidades = $debilidades."  DT= ".round($porcentajeDT)."% ,  ";
	else
		$fortalezas = $fortalezas."  DT= ".round($porcentajeDT)."% ,  ";
	
	if (round($porcentajeME)<70)
		$debilidades = $debilidades."  ME= ".round($porcentajeME)."% ,  ";
	else
		$fortalezas = $fortalezas."  ME= ".round($porcentajeME)."% ,  ";
	
	if (round($porcentajeDE)<70)
		$debilidades = $debilidades."  DE= ".round($porcentajeDE)."% ,  ";
	else
		$fortalezas = $fortalezas."  DE= ".round($porcentajeDE)."% ,  ";
	
	if (round($porcentajeNC)<70)
		$debilidades = $debilidades."  NC= ".round($porcentajeNC)."% ,  ";
	else
		$fortalezas = $fortalezas."  NC= ".round($porcentajeNC)."% ,  ";
	
	if (round($porcentajeOL)<70)
		$debilidades = $debilidades."  OL= ".round($porcentajeOL)."% ,  ";
	else
		$fortalezas = $fortalezas."  OL= ".round($porcentajeOL)."% ,  ";
	
	if (round($porcentajePE)<70)
		$debilidades = $debilidades."  PE= ".round($porcentajePE)."% ,  ";
	else
		$fortalezas = $fortalezas."  PE= ".round($porcentajePE)."% ,  ";
	
	if (round($porcentajeAC)<70)
		$debilidades = $debilidades."  AC= ".round($porcentajeAC)."% ,  ";
	else
		$fortalezas = $fortalezas."  AC= ".round($porcentajeAC)."% ,  ";
	

	echo "
    	<h2>INSTITUTO TECNOL&Oacute;GICO SUPERIOR DE URUAPAN </h2>
        <h2>COORDINADORES DEL PROGRAMA INSTITUCIONAL DE TUTORIA</h2>
        <h3>SEMESTRE AGOSTO 2012 ENERO 2013</h3>
        <h3>Informe de resultados del cuestionario autoevaluaci�n de h�bitos de estudio</h3>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<h4>Nombre tutor: $nombreProfe $aPaterno $aMaterno</h4>
		<h4>carrera:";
		switch($carrera){
			case 1:
				echo "Ingenier�a en Sistemas Computacionales";
				break;
			case 2:
				echo "Licenciatura en Administraci�n";
				break;
			case 3:
				echo "Ingenier�a Industrial";
				break;
			case 4:
				echo "Ingenier�a en Industrias Alimentarias";
				break;
			case 5:
				echo "Ingenier�a Electr�nica";
				break;
			case 6:
				echo "Ingenier�a Mecatr�nica";
				break;
			case 7:
				echo "Ingenier�a en Administraci�n";
				break;
			case 8:
				echo "Ingenier�a Mec�nica";
				break;
			default :
				echo "Carrera no identificada";
				break;
		} 
		echo"</h4>
                <h4>DATOS DEL GRUPO</h4>
		<h4>Semestre: $semestre</h4>
		<h4>Clave de grupo: $claveGrupo</h4>
		<h4>No. de alumnos tutorados: $contador </h4>
		<h4>No. de cuestionarios contestados: $respondieron</h4>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<table border='0' align='center'>
			
			<tr>
				<td>Aspectos considerados</td>
				<td><p>Porcentaje obtenido</td>
			</tr>
			
			<tr>
				<td>Distribuci�n de tiempo (DT)</td>
				<td align='center'>".($sumaDT/$respondieron); echo"</td>
			</tr>
			
			<tr>
				<td>Motivaci�n para el estudio (ME)</td>
				<td align='center'>".($sumaME/$respondieron); echo "</td>
			</tr>
			
			<tr>
				<td>Distractores durante el estudio (DE)</td>
				<td align='center'>".($sumaDE/$respondieron); echo "</td>
			</tr>
			
			<tr>
				<td>Como tomar notas de clase (NC)</td>
				<td align='center'>".($sumaNC/$respondieron); echo "</td>
			</tr>
			
			<tr>
				<td>Optimizaci�n de la lectura (OL)</td>
				<td align='center'>".($sumaOL/$respondieron); echo"</td>
			</tr>
			
			<tr>
				<td>Como preparar un examen (PE)</td>
				<td align='center'>".($sumaPE/$respondieron); echo"</td>
			</tr>
			
			<tr>
				<td>Actitudes y conductas productivas ante el estudio (AC)</td>
				<td align='center'>".($sumaAC/$respondieron); echo"</td>
			</tr>
		</table>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<h5><canvas id='micanvas' width='650' height='350'></h5>
		<p>Puntos fuertes identificados en el grupo: $fortalezas</p>
		<p>Puntos d�biles identificados en el grupo: $debilidades</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<script>
		window.onload = function(){0
   		//Recibimos el elemento canvas
   		var elemento = document.getElementById('micanvas');
   		//Comprobacion sobre si encontramos un elemento
   		//y podemos extraer su contexto con getContext(), que indica compatibilidad con canvas
   		if (elemento && elemento.getContext) {
      		//Accedo al contexto de '2d' de este canvas, necesario para dibujar
      		var contexto = elemento.getContext('2d');
      		if (contexto) {
         		//Si tengo el contexto 2d es que todo ha ido bien y puedo empezar a dibujar en el canvas
         		//Comienzo dibujando un rectangulo
				contexto.strokeStyle = '#344D06';
				contexto.strokeRect(30, 0, 560, 50);
				contexto.strokeRect(30, 50, 560, 300);
				contexto.lineWidth = 2;
				contexto.strokeStyle = 'red';
				contexto.beginPath();
				contexto.moveTo(30,140);
				contexto.lineTo(590,140);
				contexto.stroke();
				contexto.strokeStyle = '#344D06';
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(70,50);
				contexto.lineTo(70,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();	
				contexto.moveTo(110,0);
				contexto.lineTo(110,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(150,50);
				contexto.lineTo(150,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(190,0);
				contexto.lineTo(190,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(230,50);
				contexto.lineTo(230,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(270,0);
				contexto.lineTo(270,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(310,50);
				contexto.lineTo(310,350);
				contexto.stroke();
				contexto.lineWidth = 1;
				contexto.beginPath();
				contexto.moveTo(350,0);
				contexto.lineTo(350,350);
				contexto.stroke();			
				contexto.lineWidth = 1;
				contexto.beginPath();			
				contexto.moveTo(390,50);			
				contexto.lineTo(390,350);			
				contexto.stroke();			
				contexto.lineWidth = 1;
				contexto.beginPath();			
				contexto.moveTo(430,0);			
				contexto.lineTo(430,350);			
				contexto.stroke();			
				contexto.lineWidth = 1;			
				contexto.beginPath();			
				contexto.moveTo(470,50);			
				contexto.lineTo(470,350);
				contexto.stroke();			
				contexto.lineWidth = 1;			
				contexto.beginPath();			
				contexto.moveTo(510,0);
				contexto.lineTo(510,350);			
				contexto.stroke();			
				contexto.lineWidth = 1;			
				contexto.beginPath();
				contexto.moveTo(550,50);			
				contexto.lineTo(550,350);			
				contexto.stroke();	
				contexto.fillStyle = '#344D06';
				contexto.fillText('P  30-',0,53);
				contexto.fillText('U  27-',0,83);			
				contexto.fillText('N  24-',0,113);			
				contexto.fillText('T  21-',0,143);			
				contexto.fillText('U  18-',0,173);			
				contexto.fillText('A  15-',0,203);			
				contexto.fillText('C  12-',0,233);			
				contexto.fillText('I     9-',0,263);
				contexto.fillText('O   6-',0,293);			
				contexto.fillText('N   3-',0,323); 
				contexto.fillText('-100%',592,53);			
				contexto.fillText('- 90%',592,83);			
				contexto.fillText('- 80%',592,113);
				contexto.fillText('- 70%',592,143);
				contexto.fillText('- 60%',592,173);
				contexto.fillText('- 50%',592,203);
				contexto.fillText('- 40%',592,233);			
				contexto.fillText('- 30%',592,263);			
				contexto.fillText('- 20%',592,293);			
				contexto.fillText('- 10%',592,323);
				contexto.font='18px Arial';
				contexto.fillText('DT',57,33);
				contexto.fillText('ME',135,33);
				contexto.fillText('DE',217,33);
				contexto.fillText('NC',297,33);
				contexto.fillText('OL',376,33);
				contexto.fillText('PE',458,33);
				contexto.fillText('AC',538,33); 
	";

	$DT=350-((($sumaDT/$respondieron)*300)/30);
	$ME=350-((($sumaME/$respondieron)*300)/30);
	$DE=350-((($sumaDE/$respondieron)*300)/30);
	$NC=350-((($sumaNC/$respondieron)*300)/30);
	$OL=350-((($sumaOL/$respondieron)*300)/30);
	$PE=350-((($sumaPE/$respondieron)*300)/30);
	$AC=350-((($sumaAC/$respondieron)*300)/30);

	echo "
		contexto.lineWidth = 3;
		contexto.lineCap = 'butt'; 
		contexto.strokeStyle = '#336699';
		contexto.beginPath();
		contexto.moveTo(70,$DT);
		contexto.lineTo(150,$ME);
		contexto.moveTo(150,$ME);
		contexto.lineTo(230,$DE);
		contexto.moveTo(230,$DE);
		contexto.lineTo(310,$NC);
		contexto.moveTo(310,$NC);
		contexto.lineTo(390,$OL);
		contexto.moveTo(390,$OL);
		contexto.lineTo(470,$PE);
		contexto.moveTo(470,$PE);
		contexto.lineTo(550,$AC);
		contexto.stroke();
		  }
	   }
	}
	</script>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	
	";
	
	}else{
		echo "
			<p>&nbsp;</p>
			<p class='Error'>�El cuestionario Habitos de Esturio aun no ha sido contestado!</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			";
	}
?>
				
						<p>&nbsp;</p>
						</div>
				</div>
		</div>
		<div id="antepie"></div>
	</div>
</div>
</body>
</html>
