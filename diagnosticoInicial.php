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
<title>F1 diagn&oacute;stico inicial</title>
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
				<a href='listaDiagnosticoInicial.php?$idSesion'>Lista alumnos</a>
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
				$numNomina = $_SESSION['nombreUsuario'];
				$clave = $_SESSION['clave'];
				$_SESSION['listaDI'] = $_POST['listaDI'];
				$numControl = $_SESSION['listaDI'];
			
				require_once("ClaseBDD.php");
				$conexion = new BDD();
				
				$conexion->conexionBDD();
			
				// Consulta SQL
				$conexion->query = 'SELECT * FROM nombres, datospersonales1_2012, historiales, profesores WHERE nombres.numControl=\''.	                                    $numControl.'\' && datospersonales1_2012.numControl=\''.$numControl.'\' && historiales.numControl=\''                                    .$numControl.'\' && profesores.numNomina=\''.$numNomina.'\'' ;
				$conexion->consultaSQL();
  
				while($row = mysql_fetch_array($conexion->result)){
					//echo "<tr><td>".$row['nombreAlumno'];
					//echo "</td>";
					//echo "<td>".$row['numControl'];
					//echo "</td>";
					$nombreDelTutor = $row['nombre'];
					$aPaternoDelTutor = $row['aPaterno'];
					$aMaternoDelTutor = $row['aMaterno'];
					$nombreDelAlumno = $row['nombreAlumno'];
					$numeroDeControl = $row['numControl'];
					$carreraDelAlumno = $row['carrera'];
					$grupoDelAlumno = $row['grupo'];
					$claveGrupoDelAlumno = $row['claveGrupo'];
					$semestreDelAlumno = $row['semestre'];
					$estadoDelAlumno = $row['estado'];
					$direccionDelAlumno = $row['calle'];
					$numeroExterior = $row['numExterior'];
					$numeroInterior = $row['numInterior'];
					$municipioDomicilio = $row['municipio'];
					$entidadDomicilio = $row['entidad'];
					$codigoPostal = $row['cp'];
					$emailDelAlumno = $row['email'];
					$telCasaDelAlumno = $row['telCasa'];
					$telCelDelAlumno = $row['telCel'];
					$lugarNacimiento = $row['lugarNacimiento'];
					$estadoCivil = $row['edoCivil'];
					$periodoDelAlumno = $row['periodo'];
					$anioDelPeriodo = $row['anio'];
					
					
					if($semestreDelAlumno!='primero' && $semestreDelAlumno!='Primero'){
						$grupoActual=$grupoDelAlumno{0}.($grupoDelAlumno{1}+1).$grupoDelAlumno{2};
						$grupoDelAlumno=$grupoActual;
						$claveGrupoActual=$claveGrupoDelAlumno{0}.($claveGrupoDelAlumno{1}+1).$claveGrupoDelAlumno{2}.$claveGrupoDelAlumno{3};
						$claveGrupoDelAlumno=$claveGrupoActual;
					}
					
					if($semestreDelAlumno=='segundo'){
						$semestreDelAlumno='tercero';
					}
					else if($semestreDelAlumno=='tercero'){
						$semestreDelAlumno='cuarto';
					}
					else if($semestreDelAlumno=='cuarto'){
						$semestreDelAlumno='quinto';
					}
					else if($semestreDelAlumno=='quinto'){
						$semestreDelAlumno='sexto';
					}
					else if($semestreDelAlumno=='sexto'){
						$semestreDelAlumno='septimo';
					}
					else if($semestreDelAlumno=='septimo'){
						$semestreDelAlumno='octavo';
					}
					else if($semestreDelAlumno=='octavo'){
						$semestreDelAlumno='noveno';
					}
					else if($semestreDelAlumno=='noveno'){
						$semestreDelAlumno='decimo';
					}
					
					if($periodoDelAlumno==1){
						$periodoDelAlumno=3;
					}
					else if($periodoDelAlumno==3){
						$periodoDelAlumno=1;
					}
				}

				// Libera la consulta y cierra la conexión
				//$conexion->liberaConsultaCierraConexion();

				?>
          		<h3 class="Estilo1"><strong>Formato 1 Diagnóstico Inicial</strong></h3>
          		<p>&nbsp;</p>
          		<table width="100%" border="0">
            		<tr>
              			<td>Tutor: <?php echo "$nombreDelTutor $aPaternoDelTutor $aMaternoDelTutor"; ?></td>
              			<td>Período:
							<?php 
                                switch($periodoDelAlumno){
                                    case 1:
                                        echo "Feb-Jun de ".$anioDelPeriodo;
                                        break;
                                    case 2:
                                        echo "Verano de ".$anioDelPeriodo;
                                        break;
                                    case 3:
                                        echo "Ago-Dic de ".$anioDelPeriodo;
                                        break;
                                    default :
                                        echo "Estado desconocido";
                                        break;
                                } 
                            ?>
                        </td>
     				</tr>
            		<tr>
              			<td colspan="2">
                            <div align="center">
                                <strong>
                                    <p>&nbsp;</p>
                                    Datos personales del alumno:
                                    <p>&nbsp;</p>
                                </strong>
                            </div>
                         </td>
            		</tr>
            		<tr>
              			<td colspan="2">
                            <div align="center">
							<?php 
								if(strlen($numControl) == 7){
									$numControl = "0".$numControl;
								}
                            	$filename = "fotos/$numControl.jpg";
								if (file_exists($filename)) {
    								echo "<img src='$filename' width='100' height='120'/>";
								} else {
    								echo "<img src='fotos/user.jpg' width='100' height='120'/>";
								} 
							?>
                            </div>
                            <p>&nbsp;</p>
               			</td>
            		</tr>
            		<tr>
                    	<td>Nombre: <?php echo "$nombreDelAlumno"; ?></td>
                      	<td>No. Control: <?php echo "$numeroDeControl"; ?></td>
            		</tr>
            		<tr>
                    	<td>Lugar de nacimiento: <?php echo "$lugarNacimiento"; ?></td>
                      	<td>Estado civil:
                			<?php 
								if($estadoCivil==1)
									echo "Soltero";
								if($estadoCivil==2)
									echo "Casado";
								if($estadoCivil==3)
									echo "Divorciado";
								if($estadoCivil==4)
									echo "Viudo";
								if($estadoCivil==5)
									echo "Union Libre";
							?>
                		</td>
            		</tr>
            		<tr>
              			<td>Dirección: <?php echo "$direccionDelAlumno"."  # "."$numeroExterior,  "."  Col. "."$coloniaDomicilio,  "."  							                                       CP. "."$codigoPostal,  "."$municipioDomicilio,  "."$entidadDomicilio"; ?>
                        </td>
              			<td>Celular: <?php echo "$telCelDelAlumno"; ?></td>
            		</tr>
            		<tr>
              			<td>Email: <?php echo "$emailDelAlumno"; ?></td>
              			<td>Teléfono casa: <?php echo "$telCasaDelAlumno"; ?></td>
            		</tr>
            		<tr>
              			<td colspan="2">
                            <div align="center">
                                <strong>
                                    <p>&nbsp;</p>
                                        Datos académicos del alumno:
                                    <p>&nbsp;</p>
                                </strong>
                            </div>
                        </td>
            		</tr>
            		<tr>
              			<td>Carrera:
                			<?php 
	  							switch($carreraDelAlumno){
									case 1:
										echo "Ingeniería en Sistemas Computacionales";
										break;
									case 2:
										echo "Licenciatura en Administración";
										break;
									case 3:
										echo "Ingeniería Industrial";
										break;
									case 4:
										echo "Ingeniería en Industrias Alimentarias";
										break;
									case 5:
										echo "Ingeniería Electrónica";
										break;
									case 6:
										echo "Ingeniería Mecatrónica";
										break;
									case 7:
										echo "Ingeniería en Administración";
										break;
									case 8:
										echo "Ingeniería Mecánica";
										break;
									default :
										echo "Carrera no identificada";
										break;
								} 
							?>
						</td>
              			<td>Semestre: <?php echo "$semestreDelAlumno"; ?></td>
            		</tr>
            		<tr>
              			<td>Grupo: <?php echo "$grupoDelAlumno"; ?></td>
              			<td>Clave del Grupo: <?php echo "$claveGrupoDelAlumno"; ?></td>
            		</tr>
            		<tr>
              			<td colspan="2">Situacion académica:
                			<?php 
	  							switch($estadoDelAlumno){
									case 1:
										echo "Curso normal";
										break;
									case 2:
										echo "Curso de repetición";
										break;
									default :
										echo "Estado desconocido";
										break;
								} 
							?>
						</td>
            		</tr>
                    <?php 
						if($nuevoIngreso==$numValido){
							$conexion5 = new BDD();
							$conexion5->conexionBDD();
							$conexion5->query = "SELECT * FROM historialesNuevoIngreso WHERE numControl='$numControl'";
							$conexion5->consultaSQL();
							$row = mysql_fetch_array($conexion5->result);
							$nombreMaterias = $row['nombreMaterias'];
							$caliMaterias = $row ['caliMaterias'];
							
							echo "<tr>
									<td colspan='2'>Escuela de Procedencia: ". $row ['escProcedencia']."</td>
								  </tr>
								  <tr>
									<td>Tipo de Bachillerato: ". $row['tipoBachillerato']."</td>
									<td>Promedio de Bachillerato: ".$row ['promedioBachillerato']."</td>
								  </tr>
								  <tr>
									<td>Promedio de examen de Admisión: ".$row ['promedioAdimision']." </td>
									<td>Vive con : ".$row['viveCon']."</td>
								  </tr>";
							}
				    	$conexion5->liberaConsultaCierraConexion();
					?>
          		</table>
<?php
 	$conexion2 = new BDD();
	
	$conexion2->conexionBDD();

	// Consulta SQL
	$conexion2->query = "SELECT * FROM formulariof1 WHERE numControl='$numControl'" ;
	$conexion2->consultaSQL();
	$row = mysql_fetch_array($conexion2->result);
	$materiasDificultades=$row['materiasDificultades'];
	$posiblesCausas=$row['posiblesCausas'];
	$faltaAtencion=$row['faltaAtencion'];
	$noEstudie=$row['noEstudie'];
	$dificultadesAprender=$row['dificultadesAprender'];
	$faltaApuntes=$row['faltaApuntes'];
	$inasistenciaAlumno=$row['inasistenciaAlumno'];
	$faltaDominio=$row['faltaDominio'];
	$DificultadesExplicar=$row['dificultadesExplicar'];
	$malasRelaciones=$row['malasRelaciones'];
	$inasistenciaProfesor=$row['inasistenciaProfesor'];
	$evaluacionInadecuada=$row['evaluacionInadecuada'];
	$faltaEjercicios=$row['faltaEjercicios'];
	$apoyoDeficiencias=$row['apoyoDeficiencias'];
	$trabajoExtra=$row['trabajoExtra'];
	$horarioPropuesto=$row['horarioPropuesto'];
	$dificultadActividades=$row['dificultadActividades'];
	$trabajoRemunerado=$row['trabajoRemunerado'];
	$horasTrabajo=$row['horasTrabajo'];
	$otro = $row['otro'];
	$otroDescripcion=$row['otroDescripcion'];
	$ingles=$row['ingles'];
	$nivelInlges=$row['nivelIngles'];
	$deportivo=$row['deportivo'];
	$actividadDeportivo=$row['actividadDeportivo'];
	$cultural=$row['cultural'];
	$actividadCultural=$row['actividadCultural'];
	$otrasCausas=$row['otrasCausas'];
	$corregirSituacion=$row['corregirSituacion'];
	$dificultad = $row['dificultadActividades'];

	if($faltaAtencion==0)
		$faltaAtencion="No";
	else
		$faltaAtencion="Si";
		
	if($noEstudie==0)
		$noEstudie="No";
	else
		$noEstudie="Si";
		
	if($dificultadesAprender==0)
		$dificultadesAprender="No";
	else
		$dificultadesAprender="Si";
		
	if($faltaApuntes==0)
		$faltaApuntes="No";
	else
		$faltaApuntes="Si";
		
	if($inasistenciaAlumno==0)
		$inasistenciaAlumno="No";
	else
		$inasistenciaAlumno="Si";
		
	if($faltaDominio==0)
		$faltaDominio="No";
	else
		$faltaDominio="Si";
		
	if($DificultadesExplicar==0)
		$DificultadesExplicar="No";
	else
		$DificultadesExplicar="Si";
		
	if($malasRelaciones==0)
		$malasRelaciones="No";
	else
		$malasRelaciones="Si";
		
	if($inasistenciaProfesor==0)
		$inasistenciaProfesor="No";
	else
		$inasistenciaProfesor="Si";
		
	if($evaluacionInadecuada==0)
		$evaluacionInadecuada="No";
	else
		$evaluacionInadecuada="Si";
		
	if($faltaEjercicios==0)
		$faltaEjercicios="No";
	else
		$faltaEjercicios="Si";
		
	if($academicos=$row['academicos']==1)
		$academicos="Si";
	else
		$academicos="No";
		
	if($familiares=$row['familiares']==1)
		$familiares="Si";
	else
		$familiares="No";
		
	if($sociales=$row['sociales']==1)
		$sociales="Si";
	else
		$sociales="No";
	
	if($economicos=$row['economicos']==1)
		$economicos="Si";
	else
		$economicos="No";
		
	if($emocionales=$row['emocionales']==1)
		$emocionales="Si";
	else
		$emocionales="No";
	
	if($salud=$row['salud']==1)
		$salud="Si";
	else
		$salud="No";
		
	
	$conexion->query = "SELECT numControl FROM formulariof1 WHERE numControl='$numControl'";
       	$conexion->consultaSQL();
        $aux=0;
        while(mysql_fetch_array($conexion->result)){
          	$aux=1;
		}
    // Libera la consulta y cierra la conexión
    $conexion->liberaConsultaCierraConexion();
          
	if($aux==1){		
		if($nuevoIngreso==$numValido){
		echo"
            <p>&nbsp;</p>
			<p><strong>Materias cursadas el semestre anterior:</strong></p>
          	<p>Seleccione las materias en las que tuvo mayores dificultades</p>
            <table align='center' width='500px' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
				<tr>
              		<th width='190' scope='col'>Materia</th>
              		<th width='82' scope='col'>Calificación  obtenida</th>
					<th width='82' scope='col'>Problemas</th>
            	</tr>";
					$color="#DFEDBC";
					for($contMate=0; $contMate<10; $contMate++){
						echo "<tr bgcolor='$color'>
						    	<td>";
									$nomMaterias = split('-',$nombreMaterias);
									echo $nomMaterias[$contMate];	
						  echo "</td>";
						  echo "<td align='center'>";
									$calif = split('-',$caliMaterias);
									echo $calif[$contMate];
										
						  echo "</td>";
						  echo "<td align='center'>
								<label>"; 
									$materias = split('-',$materiasDificultades);
									if($materias[$contMate]==1){
										echo"Si";
									}else{
										echo"No";
									}
									echo"
								</label>
								</td></tr>";
									if($color=="#FCFFFF"){
	  									$color="#DFEDBC";
  									}else{
										$color="#FCFFFF";
									}
									}
					echo "</table>";
		}
		else{
		echo"
            <p>&nbsp;</p>
			<p><strong>Materias cursadas el semestre anterior:</strong></p>
          	<p>Seleccione las materias en las que tuvo mayores dificultades</p>
            <table align='center' width='500px' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
				<tr>
              		<th width='190' scope='col'>Materia</th>
              		<th width='82' scope='col'>Calificación  obtenida</th>
					<th width='82' scope='col'>Problemas</th>
            	</tr>";
				require_once("ClaseBDD.php");
									$conexion = new BDD();
									$conexion->conexionBDD();
									// Consulta SQL
									$conexion->query = 'SELECT * FROM historiales WHERE `periodo`=3 && `anio`=2011 && `numControl`=\''.	                                               $numControl.'\'' ;
									$conexion->consultaSQL();
									$color="#DFEDBC";
    								$contMate=0;
									while($row = mysql_fetch_array($conexion->result)){
										echo "<tr bgcolor='$color'><td>".$row['nombreMateria'];
										echo "</td>";
										echo "<td align='center'>".$row['calificacion'];
										echo "</td>";
										echo 
										"<td align='center'>
											<label>"; 
											$materias = split('-',$materiasDificultades);
												if($materias[$contMate]==1){
													echo"Si";
												}else{
													echo"No";
												}
											echo"
											</label>
										</td></tr>";
										if($color=="#FCFFFF"){
	  										$color="#DFEDBC";
  										}else{
											$color="#FCFFFF";
										}
										$contMate++;
									}
									
								echo "</table>";
								// Libera la consulta y cierra la conexión
								$conexion->liberaConsultaCierraConexion();
		}

		echo"<p>&nbsp;</p>
            <p>&iquest;Cu&aacute;les son las posibles causas?</p>
            <p>Seleccione las causas a las que usted le atribuye esas dificultades</p>
            <p><strong>Causas atribuibles al alumno(a):</strong></p> 					
            <table width='500px'  align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
            	<tr bgcolor='#DFEDBC'>
					<td width='190'>Falta de atenci&oacute;n en clase</td>
					<td width='82' align='center' bgcolor='#DFEDBC'>
						<label>
                			$faltaAtencion
				  	</td>
              	</tr>
              	<tr>
                	<td>No estudi&eacute; lo suficiente</td>
                	<td align='center'>$noEstudie</td>
              	</tr>
              	<tr bgcolor='#DFEDBC'>
                	<td>Dificultades para   comprender</td>
                	<td align='center'>$dificultadesAprender</td>
              	</tr>
              	<tr>
					<td>Falta de apuntes o notas</td>
					<td align='center'>$faltaApuntes</td>
              	</tr>
              	<tr bgcolor='#DFEDBC'>
                	<td>Inasistencia a clase</td>
                	<td align='center'>$inasistenciaAlumno</td>
              	</tr>
            </table>
            	<p>&nbsp;</p>
            	<p><strong>Causas atribuibles al profesor(a):</strong></p>
            	<table width='500px' align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
              		<tr bgcolor='#DFEDBC'>
                		<td width='190'>Falta de dominio de la materia</td>
                		<td width='82' align='center'>$faltaDominio</td>
              		</tr>
             		<tr>
                		<td>Dificultades para explicar</td>
                		<td align='center'>$DificultadesExplicar</td>
              		</tr>
              		<tr bgcolor='#DFEDBC'>
                		<td>Malas relaciones con los alumnos</td>
                		<td align='center'>$malasRelaciones</td>
              		</tr>
              		<tr>
                		<td>Inasistencia</td>
                		<td align='center'>$inasistenciaProfesor</td>
              		</tr>
              		<tr bgcolor='#DFEDBC'>
                		<td>Formas de evaluaci&oacute;n   inadecuadas</td>
                		<td align='center'>$evaluacionInadecuada</td>
              		</tr>
              		<tr>
                		<td>Falta de ejercicios   resueltos</td>
                		<td align='center'>$faltaEjercicios</td>
              		</tr>
            	</table>
            	<p>&nbsp;</p>";
		
				if($otrasCausas!=""){	
					echo"<p><strong>Otras causas:</strong></p>
						 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$otrasCausas</p>";
				}
				if($apoyoDeficiencias!=""){
					echo"
						<p>Si hubiera posibilidades de apoyarle a corregir esas deficiencias, &iquest;Cu&aacute;les acciones cree  que le                   			ayudar&iacute;an?</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$apoyoDeficiencias</p>";
				}
				echo"<p>&iquest;Estar&iacute;a dispuesto a trabajar en horas extra-clase para mejorar su desempe&ntilde;o                     acad&eacute;mico?</p>";
				if($trabajoExtra==1){
					echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si.</p>
						  <p>&iquest;Cu&aacute;l ser&iacute;a el horario que propone?</p>
            	          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$horarioPropuesto</p>";
				}else{
					echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.";
				}
				echo"
            	<p>&nbsp;</p>
				<p><strong>Actividades curriculares que cursa actualmente:</strong></p>";
				if($ingles==0 || $deportivo==0 || $cultural==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No se selecciono ninguna de las actividades curriculares.";
				}
					if($ingles==1){
						echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ingles ".$nivelInlges."º Nivel</p>";
					}
					if($deportivo==1){
						switch($actividadDeportivo){
							case 1:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Volibol</p>";
								break;
							case 2:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Basquet bol</p>";
								break;
							case 3:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Futbol</p>";
								break;
							case 4:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Atletismo</p>";
								break;
							case 5:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Tai Chi</p>";
								break;
							case 6:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deportivo en Taekwondo</p>";
								break;
							default :
								echo "Estado desconocido";
								break;
						}
					}
					if($cultural==1){
						switch($actividadCultural){
							case 1:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cultural en Danza</p>";
								break;
							case 2:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cultural en Artes Plásticas</p>";
								break;
							case 3:
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cultural en Banda de Guerra</p>";
								break;
							default :
								echo "Estado desconocido";
								break;
						}
					}
					
				echo"<p>&iquest;Tiene alguna dificultad con alguna de estas actividades?</p>";
            				 
							if($dificultad == 1){
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si.</p>
            						  <p>Escriba cual es la dificultad y la propuesta para corregir la situaci&oacute;n:</p>
									  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$corregirSituacion</p> 
            				          <p>&nbsp;</p>
								";
							}else{
								echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.</p>";
							}
			echo"
				<p>&iquest;Tiene trabajo remunerado?</p>";
				if($trabajoRemunerado==1){
					echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si.</p>
					      <p>&iquest;Cu&aacute;ntas horas trabaja?</p>
					      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$horasTrabajo</p>";
				}else{
					echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.</p>";
				}
					
				echo"
				<p>&iquest;Actualmente, qu&eacute; tipo de problemas  le preocupa enfrentar?</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   Academicos ( $academicos )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				   Familiares( $familiares )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   Sociales ( $sociales )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   Economicos ( $economicos )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   Emocionales ( $emocionales )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   Salud ( $salud )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</p>";
				if($otro==1){
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Otro ( ".$otroDescripcion." )";
				}
				echo" 
				<p>&nbsp;</p>
				";
			
	}else{
		echo "
			<p>&nbsp;</p>
			<p class='Error'>¡El cuestionario Diagnostico Inicial aun no ha sido contestado!</p>
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
