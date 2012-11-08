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
<title>Informe Grupal</title>
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
      <div id="marcoSesion">
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
	}
	// Consulta SQL
	$conexion->query = 'SELECT distinct nombres.carrera, historiales.semestre, historiales.grupo, historiales.numControl,  			                        historiales.periodo, historiales.anio, nombres.nombreAlumno, horariosfebjun_2012.numNomina
                        FROM historiales,nombres,horariosfebjun_2012 
                        WHERE historiales.periodo=3 && historiales.anio=2011 &&  horariosfebjun_2012.numNomina=52 &&                        historiales.grupo=horariosfebjun_2012.grupoAnterior && historiales.numControl = nombres.numControl order by 		                        nombres.nombreAlumno';
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
		$conexion2->query = 'SELECT sumaDT,sumaME,sumaDE,sumaNC,sumaOL,sumaPE,sumaAC FROM respuestas where respuestas.num_Control=\''.	        $numControl.'\' ';	
		$conexion2->consultaSQL();
		while($row = mysql_fetch_array($conexion2->result)){
			$sumaDT = $dumaDT + $row ['sumaDT'];
			$sumaME = $dumaME + $row ['sumaME'];
			$sumaDE = $dumaDE + $row ['sumaDE'];
			$sumaNC = $dumaNC + $row ['sumaNC'];
			$sumaOL = $dumaOL + $row ['sumaOL'];
			$sumaPE = $dumaPE + $row ['sumaPE'];
			$sumaAC = $dumaAC + $row ['sumaAC'];
			$respondieron++;
		}
	}
	$PorcentajeDT= (($sumaDT/$respondieron)*100)/30;
	$PorcentajeME= (($sumaME/$respondieron)*100)/30;
	$PorcentajeDE= (($sumaDE/$respondieron)*100)/30;
	$PorcentajeNC= (($sumaNC/$respondieron)*100)/30;
	$PorcentajeOL= (($sumaOL/$respondieron)*100)/30;
	$PorcentajePE= (($sumaPE/$respondieron)*100)/30;
	$PorcentajeAC= (($sumaAC/$respondieron)*100)/30;
	
	$identificadoresFuertes="";
	$identificadoresDebiles="";
	
	if($PorcentajeDT>70 ){
		$identificadoresFuertes=$identificadoresFuertes." DT= ".$porcentajeDT."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." DT= ".$porcentajeDT."%  ";
	}
	
	if($PorcentajeME>70 ){
		$identificadoresFuertes=$identificadoresFuertes." ME= ".$porcentajeME."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." ME= ".$porcentajeME."%  ";
	}
	if($PorcentajeDE>70 ){
		$identificadoresFuertes=$identificadoresFuertes." DE= ".$porcentajeDE."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." DE= ".$porcentajeDE."%  ";
	}
	if($PorcentajeNC>70 ){
		$identificadoresFuertes=$identificadoresFuertes." NC= ".$porcentajeNC."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." NC= ".$porcentajeNC."%  ";
	}
	if($PorcentajeOL>70 ){
		$identificadoresFuertes=$identificadoresFuertes." OL= ".$porcentajeOL."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." OL= ".$porcentajeOL."%  ";
	}
	if($PorcentajePE>70 ){
		$identificadoresFuertes=$identificadoresFuertes." PE= ".$porcentajePE."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." PE= ".$porcentajePE."%  ";
	}
	if($PorcentajeAC>70 ){
		$identificadoresFuertes=$identificadoresFuertes." AC ".$porcentajeAC."%  ";
	}else{
		$identificadoresDebiles=$identificadoresFuertes." AC ".$porcentajeAC."%  ";
	}
?>
      </div>
      <div id="area">
      <div id="ajuste"> </div>
      <div id="texto">
<?php
	echo "
    	<h2>INSTITUTO TECNOL&Oacute;GICO SUPERIOR DE URUAPAN </h2>
        <h2>COORDINADORES DEL PROGRAMA INSTITUCIONAL DE TUTORIA</h2>
        <h3>SEMESTRE AGOSTO 2012 ENERO 2013</h3>
        <h3>Informe de resultados del cuestionario autoevaluación de hábitos de estudio</h3>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<h4>Nombre tutor: $nombreProfe $aPaterno $aMaterno</h4>
		<h4>carrera: $carrera</h4>
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
				<td>Distribución de tiempo (DT)</td>
				<td>($sumaDT/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Motivación para el estudio (ME)</td>
				<td>($sumaME/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Distractores durante el estudio (DE)</td>
				<td>($sumaDE/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Como tomar notas de clase (NC)</td>
				<td>($sumaNC/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Optimización de la lectura (OL)</td>
				<td>($sumaOL/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Como preparar un examen (PE)</td>
				<td>($sumaPE/$respondieron)</td>
			</tr>
			
			<tr>
				<td>Actitudes y conductas productivas ante el estudio (AC)</td>
				<td>($sumaAC/$respondieron)</td>
			</tr>
			
		</table>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<h5><canvas id='micanvas' width='650' height='350'></h5>
		<p>La puntuaci&oacute;n igual o por encima del 70% son los puntos fuertes del alumno.</p>
		<p>La puntuaci&oacute;n menor al 70% son los puntos debiles del alumno.</p>
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

	$DT=350-(($sumaDT*300)/30);
	$ME=350-(($sumaME*300)/30);
	$DE=350-(($sumaDE*300)/30);
	$NC=350-(($sumaNC*300)/30);
	$OL=350-(($sumaOL*300)/30);
	$PE=350-(($sumaPE*300)/30);
	$AC=350-(($sumaAC*300)/30);

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
	
	<p>Puntos fuertes identificados en el grupo: $identificadoresFuertes
	</p>
	<p>Puntos fuertes identificados en el grupo: $identificadoresDebiles
	</p>
	
	";
?>
</div>
</div>
</div>
<div id="antepie"></div>
</div>
</div>



<body>

</body>
</html>