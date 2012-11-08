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
                        $user=$_SESSION['nombreUsuario'];
                        $clave2 = $_SESSION['clave'];
                        // Consulta SQL
                        $conexion->query = 'SELECT validacion 
											FROM profesores 
											WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' 
											&&clave=\''.$_SESSION['clave'].'\'';
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
<?php
    require_once("ClaseBDD.php");
	$conexion = new BDD();
	$conexion2 = new BDD();
	$conexion3 = new BDD();
	$conexion->conexionBDD();
	$conexion2->conexionBDD();
	$conexion3->conexionBDD();
	// Consulta SQL
	$conexion->query = 'SELECT * FROM profesores 
	                    WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' &&
						      clave=\''.$_SESSION['clave'].'\'';
	$conexion->consultaSQL();
				
	while($row = mysql_fetch_array($conexion->result)){
		$nombreProfe = $row ['nombre'];
		$aPaterno = $row ['aPaterno'];
		$aMaterno = $row ['aMaterno'];
		$numNomina = $row ['numNomina'];
		
	}
		
				
	$conexion->query = 'SELECT DISTINCT nombres.carrera, historiales.grupo, 
								historiales.numControl, nombres.nombreAlumno, 
								historiales.tipoCurso, horariosfebjun_2012.numNomina
						FROM    historiales, nombres, horariosfebjun_2012
						WHERE   historiales.periodo =1 && historiales.anio =2012 && 
								horariosfebjun_2012.numNomina =\''.$numNomina.'\' && 
								historiales.grupo=horariosfebjun_2012.grupoAnterior 
								&& historiales.numControl = nombres.numControl
								&& historiales.tipoCurso="CN"
								ORDER BY nombres.nombreAlumno';
								
								
	$conexion->consultaSQL();
	$tRegulares=0;
	$tIrregulares=0;
	$totalAlumnos=0;
	$respondieron=0;
	$tutoradosAsignados=0;
	$faltaAtencion=0;
	$noEstudie=0;
	$faltaApuntes=0;
	$dificultadesAprender=0;
	$inasistenciaAlumno=0;
	$faltaDominio=0; 
	$DificultadesExplicar=0;
	$malasRelaciones=0;
	$inasistenciaProfesor=0; 
	$evaluacionInadecuada=0;
	$faltaEjercicios=0; 
	
	while($row = mysql_fetch_array($conexion->result)){
		$grupo = $row ['grupo'];
		$numControl = $row ['numControl'];
		$tipoCurso = $row ['tipoCurso'];				
				
		$tutoradosAsignados++;
		if($tipoCurso=="CN")
			$tRegulares++;
		else
			$tIrregulares++;
		
		$conexion2->query = 'SELECT numControl 
							 FROM   formulariof1 
		                     WHERE  formulariof1.numControl=\''.$numControl.'\' ';	
		$conexion2->consultaSQL();
		while($row = mysql_fetch_array($conexion2->result)){
			$respondieron++;
	
		}
		$conexion3->query='SELECT *
						   FROM   formulariof1 
						   WHERE  formulariof1.numControl=\''.$numControl.'\'';
		$conexion3->consultaSQL();	
		
		$arr_materias;
			
		if($row = mysql_fetch_array($conexion3->result)){
			$materiaDificultades = $row ['materiasDificultades'];
			$arr_materias[$totalAlumnos] = $materiaDificultades;
					
			if($row ['faltaAtencion']==1)
				$faltaAtencion++;
				
			if($row ['noEstudie']==1)
				$noEstudie ++;
							
			if($row ['dificultadesAprender']==1)
				$dificultadesAprender ++;
							
			if($row ['faltaApuntes']==1)
				$faltaApuntes ++;
							
			if($row ['inasistenciaAlumno'])
				$inasistenciaAlumno ++;
									
			if($row['faltaDominio'])
				$faltaDominio ++;
							
			if($row['DificultadesExplicar'])		
				$DificultadesExplicar ++;
								
			if($row['malasRelaciones'])
				$malasRelaciones ++;
									
			if($row['inasistenciaProfesor'])
				$inasistenciaProfesor ++;
									
			if($row['evaluacionInadecuada'])
				$evaluacionInadecuada ++;
								
			if($row['faltaEjercicios '])
				$faltaEjercicios  ++;					
		}		
		$totalAlumnos++;
	}
	
	
	
	$conexion->query = "SELECT descripcion 
						FROM formulariof4 
						WHERE numNomina='$numControl'";
	$conexion->consultaSQL();
	echo "<form id='form4' name='formulario' method='post' action='guardarF4.php'>";
	$cont=0;
	while(mysql_fetch_array($conexion->result)){
		$cont++;
	}
	// Libera la consulta y cierra la conexión
	$conexion->liberaConsultaCierraConexion();
	$valueBoton="Enviar";
	$nombreProfe = ucwords(strtolower($nombreProfe));
	$aPaterno = ucwords(strtolower($aPaterno));
	$aMaterno = ucwords(strtolower($aMaterno));
	echo "<input type='hidden' name='valida' value='$cont'/>";
	echo"
		<h3>PROGRAMA DE TUTORIA</h3>
		<h3>F4 INFORME SEMESTRAL (AGOSTO – DICIEMBRE 2011)</h3>
		<p>&nbsp;</p>
					<h4>Tutor: $nombreProfe $aPaterno $aMaterno</h4>
";	
			
		
if($respondieron!=0){		

	echo"	
        <table width='500px'  align='center' style='border-collapse:collapse;'>
           	<tr>
              	<td width='200'>Grupo:</td>
				<td width='40' align='center'>$grupo</td>
                <td width='200'>Fecha:</td>
				<td width='40' align='center'>".date("d/m/Y")."</td>
            </tr>
            <tr>
               	<td>No. Tutorados Asignados:</td>
				<td align='center'>$tutoradosAsignados</td>
				<td>No. De tutorados atendidos:</td>
				<td align='center'>$respondieron</td>
            </tr>
            <tr>
              	<td>No. De Tutorías individuales:</td>
				<td align='center'>$respondieron</td>
				<td>No. De Tutorías Grupales:</td>
				<td align='center'>$totalAlumnos</td>
            </tr>
            <tr>
               	<td>Tutorados Regulares:</td>
                <td align='center'>$tRegulares</td>
				<td>Tutorados Irregulares:</td>
				<td align='center'>$tIrregulares</td>
            </tr>
            <tr>
               	<td>Promedio Regulares:</td>
				<td align='center'>".round((100*$tRegulares)/$totalAlumnos)."%</td>
				<td>Promedio Irreguares:</td>
				<td align='center'>".round((100*$tIrregulares)/$totalAlumnos)." %</td>
            </tr>
                    
        </table>";
		
    echo" <p>&nbsp;</p>
		<p><strong>Problema Específicos de Materias actuales:</strong></p> 
             
        <table align='center' width='500px' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
            <tr>
				<th width='190' scope='col'>Materia</th>
				<th width='82'  scope='col'>No. Tutorados</th>
                <th width='82' scope='col'>Porcentaje</th>
            </tr>";
			$conexion = new BDD();
			$conexion->conexionBDD();
			// Consulta SQL
			
			$conexion->query = 'SELECT nombreMateria, tipoCurso  FROM historiales 
								WHERE `periodo`=1 && `anio`=2012 && `numControl`=\''.$numControl.'\'';

			$conexion->consultaSQL();
			$color="#DFEDBC";
    		$contMate=0;
			$aux=0;
			while($row = mysql_fetch_array($conexion->result)){
				echo "<tr bgcolor='$color'>
				<td>".$row['nombreMateria']."</td>";
				echo "<td align='center'>
				<label>";
					$unos=0;
					$valor= split('-',$arr_materias[$x]);
					for($x = 1; $x <= count($valor); $x++){	
						
						echo "x= ".$x." valor= ".$valor[$aux];
						if($valor[$aux]==1){
							$unos++;
						}
					}
					echo"</label>
					</td>";
					echo"<td align='center'>".round(((100*$unos)/$respondieron))." %</td> 
					</tr>";
					if($color=="#FCFFFF"){
	  					$color="#DFEDBC";
  					}else{
					$color="#FCFFFF";
					}
			}
			$conexion->liberaConsultaCierraConexion();
						
            echo"</table>
			<p>&nbsp;</p>
			<table width='500px'  align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
				<th width='190' scope='col'>Dificultades del alumno</th>
				<th width='82' scope='col'>No. Tutorados</th>
				<th width='82' scope='col'>Porcentaje</th>
				<tr bgcolor='#DFEDBC'>
					<td >Falta de atenci&oacute;n en clase</td>
					<td align='center' bgcolor='#DFEDBC'>$faltaAtencion</td>
					<td align='center'>".round(((100*$faltaAtencion)/$respondieron))." %</td>
				</tr>
				<tr>
					<td>No estudi&eacute; lo suficiente</td>
					<td align='center'>$noEstudie</td>
					<td align='center'>".round(((100*$noEstudie)/$respondieron))." %</td>
				</tr>
				<tr bgcolor='#DFEDBC'>
					<td>Dificultades para   comprender</td>
					<td align='center'>$dificultadesAprender</td>
					<td align='center'>".round(((100*$dificultadesAprender)/$respondieron))." %</td>
				</tr>
				<tr>
					<td>Falta de apuntes o notas</td>
					<td align='center'>$faltaApuntes</td>
					<td align='center'>".round(((100*$faltaApuntes)/$respondieron))." %</td>
				</tr>
				<tr bgcolor='#DFEDBC'>
					<td>Inasistencia a clase</td>
					<td align='center'>$inasistenciaAlumno</td>
					<td align='center'>".round(((100*$inasistenciaAlumno)/$respondieron))." %</td>
				</tr>
			</table>
		<p>&nbsp;</p>
			<table width='500px' align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
				<th width='190' scope='col'>Dificultades por Docentes</th>
				<th width='82' scope='col'>No. Tutorados</th>
				<th width='82' scope='col'>Porcentaje</th>
				<tr bgcolor='#DFEDBC'>
					<td >Falta de dominio de la materia</td>
					<td align='center'>$faltaDominio</td>
					<td align='center'>".round(((100*$faltaDominio)/$respondieron))." %</td>
				</tr>
				<tr>
					<td>Dificultades para explicar</td>
					<td align='center'>$DificultadesExplicar</td>
					<td align='center'>".round(((100*$DificultadesExplicar)/$respondieron))." %</td>
				</tr>
				<tr bgcolor='#DFEDBC'>
					<td>Malas relaciones con los alumnos</td>
					<td align='center'>$malasRelaciones</td>
					<td align='center'>".round(((100*$malasRelaciones)/$respondieron))." %</td>
				</tr>
				<tr>
					<td>Inasistencia</td>
					<td align='center'>$inasistenciaProfesor</td>
					<td align='center'>".round(((100*$inasistenciaProfesor)/$respondieron))." %</td>
				</tr>
				<tr bgcolor='#DFEDBC'>
					<td>Formas de evaluaci&oacute;n   inadecuadas</td>
					<td align='center'>$evaluacionInadecuada</td>
					<td align='center'>".round(((100*$evaluacionInadecuada)/$respondieron))." %</td>
				</tr>
				<tr>
					<td>Falta de ejercicios   resueltos</td>
					<td align='center'>$faltaEjercicios</td>
					<td align='center'>".round(((100*$faltaEjercicios)/$respondieron))." %</td>
				</tr> 
			</table>";
			$conexion4 = new BDD();
			$conexion4->conexionBDD();
			$conexion4->query = 'SELECT * FROM formulariof4 
								WHERE numNomina=\''.$numNomina.'\'';
            $conexion4->consultaSQL();
			$row = mysql_fetch_array($conexion4->result);
			$newNumNomina = $row['numNomina'];
			$descripcion = $row['descripcion'];
			if($newNumNomina==""){
			
		echo"	
        <p>&nbsp;</p>
			<h4 align='center'>Acciones de apoyo realizada con los tutorados: 
			(académicos, familiares, sociales, conómicos,emocionales, de salud, otros.)</h4>
			<p>Describa de manera breve, las acciones realizadas para abordar los problemas detectados durante el semestre 			                        </p>
			<p><textarea rows='5' cols='77' name='descripcionProblema'></textarea></p>
		<br>
<h5>
	<input type='submit' class='boton2' name='enviar' id='enviar' value= '$valueBoton' />
</h5>
<p>&nbsp;</p>
</form>";

		}else{
			echo"<p>&nbsp;</p>
			<h4 align='center'>Acciones de apoyo realizada con los tutorados: 
			(académicos, familiares, sociales, conómicos,emocionales, de salud, otros.</h4>
			<p>Describa de manera breve, las acciones realizadas para abordar los problemas detectados durante el semestre 			                        </p>
			<p align='justify'>$descripcion</p>";
		}
}else{
	echo "
		<p>&nbsp;</p>
		<p class='Error'>¡No existe ningún diagnostico inicial contestado!</p>
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
