<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();
	$user=$_SESSION["nombreUsuario"];
	$password=$_SESSION["clave"];
	if($user==null && $pasword==null){
		echo
		"<SCRIPT LANGUAGE=\"Javascript\">+
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
<title>Programa de Tutoría</title>
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
				$conexion->query = 'SELECT validacion FROM nombres WHERE numControl=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.                                    $_SESSION['clave'].'\'';
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
				// Libera la consulta y cierra la conexión
				$conexion->liberaConsultaCierraConexion();
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
                    <a href='selFormatosAlumnos.php?$idSesion'>Seleccionar formatos</a>
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
							$numControl = $numNomina;
							require_once("ClaseBDD.php");
							$conexion = new BDD();
							$conexion->conexionBDD();
							// Consulta SQL
							$conexion->query = 'SELECT * FROM nombres, datospersonales1_2012 WHERE nombres.numControl=\''.					            				$numControl.'\' && datospersonales1_2012.numControl=\''.$numControl.'\'' ;
							$conexion->consultaSQL();
							  
							while($row = mysql_fetch_array($conexion->result)){
								$nombreDelAlumno = $row['nombreAlumno'];
								$numeroDeControl = $row['numControl'];
								$direccionDelAlumno = $row['calle'];
								$numeroExterior = $row['numExterior'];
								$numeroInterior = $row['numInterior'];
								$coloniaDomicilio = $row['colonia'];
								$municipioDomicilio = $row['municipio'];
								$entidadDomicilio = $row['entidad'];
								$codigoPostal = $row['cp'];
								$telCasaDelAlumno = $row['telCasa'];
								$telCelDelAlumno = $row['telCel'];
								$emailDelAlumno = $row['email'];
								$lugarNacimiento = $row['lugarNacimiento'];
								$estadoCivil = $row['edoCivil'];
								$validar=$row['numControl'];
							
								$carreraDelAlumno = $row['carrera'];
								$estadoDelAlumno = $row['estado'];
								
							}
							$conexion->query = "SELECT numControl FROM formulariof1 WHERE numControl='$numControl'";
							$conexion->consultaSQL();
							echo "<form id='form1' name='formulario' method='post' action='guardarF1.php'>";
							$cont=0;
							while(mysql_fetch_array($conexion->result)){
								$cont++;
							}
							// Libera la consulta y cierra la conexión
							$conexion->liberaConsultaCierraConexion();
							$valueBoton="Enviar";
							echo "<input type='hidden' name='valida' value='$cont'/>";
						?>
            			<table width="100%" border="0">
              			<tr>
                		<td colspan="2">
                        <table width="100%" border="0">
                                    <tr>
                                        <td colspan="3"><div align="center"><h3 class="Estilo1"> F1 Diagn&oacute;stico Inicial</h3><br></div></td>
                                    </tr>
                    				<tr>
                      					<td colspan="3"><div align="center"><strong> Datos personales del alumno:
                          					<p>&nbsp;</p></strong></div>
                                        </td>
                    		</tr>
                    		<tr>
                      			<td colspan="3">
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
                          				<p></p>
                                    </div>
								</td>
                    		</tr>
                    		<tr>
                      			<td colspan="3" align="center">Nombre: <?php echo "$nombreDelAlumno"; ?></td>
                    		</tr>
                    		<tr>
                      			<td colspan="3" align="center">No. Control: <?php echo "$numeroDeControl"; ?><p>&nbsp;</p></td>
                    		</tr>
                    		<tr>
                                <td width="20%">&nbsp;</td>
                                <td width="25%">Lugar de nacimiento: </td>
                                <td width="55%"><?php echo "<input type='text'  size='35' value='$lugarNacimiento' 				                                                  name='lugarNacimiento'>"; ?></td>
                    		</tr>
                    		<tr>
                                <td>&nbsp;</td>
                                <td>Estado civil:</td>
                                <td>
									<?php 
                                        echo "<select name='categorias'><option value='1'";
                                        if($estadoCivil==1){
                                            echo "selected";
                                        }
                                        echo ">Soltero</option><option value='2'";
                                        if($estadoCivil==2){
                                            echo "selected";
                                        }
                                        echo ">Casado</option><option value='3'";
                                        if($estadoCivil==3){
                                            echo "selected";
                                        }
                                        echo ">Divorciado</option><option value='4'";
                                        if($estadoCivil==4){
                                            echo "selected";
                                        }
                                        echo ">Viudo</option><option value='5'";
                                        if($estadoCivil==5){
                                            echo "selected";
                                        }
                                        echo ">Uni&oacute;n libre</option>
                                        </select>";
                                    ?>
                                </td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td width="25%">Direcci&oacute;n:</td>
                      			<td>&nbsp;</td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Calle: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$direccionDelAlumno' name='calle'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Numero Exterior: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$numeroExterior' name='numExt'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Numero Interior: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$numeroInterior' name='numInt'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Colonia: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$coloniaDomicilio' name='colonia'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Municipio: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$municipioDomicilio' name='municipio'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Entidad: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$entidadDomicilio' name='entidad'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>&nbsp;&nbsp;&nbsp;Código Postal: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$codigoPostal' name='cp'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>Tel&eacute;fono casa: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$telCasaDelAlumno' name='telCasa'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>Celular: </td>
                      			<td><?php echo "<input type='text'  size='35' value='$telCelDelAlumno' name='celular'>"; ?></td>
                    		</tr>
                    		<tr>
                      			<td>&nbsp;</td>
                      			<td>Email: </td>
                     			<td><?php echo "<input type='text'  size='35' value='$emailDelAlumno' name='email'>"; ?></td>
                    		</tr>
                  		</table></td></tr>
                        </table>
	             
                        	<?php if($cont==0){ ?>
                         <table width="100%" border="0">
						<tr>
                            <td colspan="2"><div align="center">
                                <strong>
                                    <p>&nbsp;</p>
                                    Datos académicos del alumno:
                                    <p>&nbsp;</p>
                                </strong></div>
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
                            
							
							<?php
                            $conexion = new BDD();
							$conexion->conexionBDD();
							// Consulta SQL
							$conexion->query = 'SELECT grupo, claveGrupo, semestre FROM historiales WHERE historiales.numControl=\''.$numControl.'\' ORDER BY idHistoriales DESC' ;
							$conexion->consultaSQL();
							$row=mysql_fetch_array($conexion->result);
                            $grupoDelAlumno = $row['grupo'];
							$claveGrupoDelAlumno = $row['claveGrupo'];
							$semestreDelAlumno = $row['semestre'];
							
							if($semestreDelAlumno!='primero' && $semestreDelAlumno!='Primero'){
							$grupoActual=$grupoDelAlumno{0}.($grupoDelAlumno{1}+1).$grupoDelAlumno{2};
							$grupoDelAlumno=$grupoActual;
							$claveGrupoActual=$claveGrupoDelAlumno{0}.($claveGrupoDelAlumno{1}+1).$claveGrupoDelAlumno{2}.$claveGrupoDelAlumno{3};
							$claveGrupoDelAlumno=$claveGrupoActual;
					
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
							?>
                            
                            
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
			$nuevoIngreso = substr($numControl, 0, -4);
			$numValido="1204";
			if($nuevoIngreso==$numValido){
				echo "<tr>
              				<td colspan='2'>Escuela de Procedencia: <input type='text'  size='70' value='' name='escProcedencia'></td>
            			</tr>
				<tr>
              				<td>Tipo de Bachillerato: <input type='text'  size='25' value='' name='tipoBachillerato'></td>
              				<td>Promedio de Bachillerato: <input type='text'  size='10' value='' name='promedioBachillerato'></td>
            			</tr>
				<tr>
              				<td>Promedio de examen de Admisión: <input type='text'  size='10' value='' name='promedioAdimision'></td>
              				<td>Vive con : <input type='text'  size='26' value='' name='viveCon'></td>
            			</tr>
				";
			}
			?>
            			</table>
                        	<br>
          			
            					<?php
			if($nuevoIngreso==$numValido){
				echo "<p><strong>Materias cursadas el semestre anterior:</strong></p>
          					<p>Escriva el nombre y calificacion de las materias, despues seleccione las materias en las que tuvo mayores dificultades</p>
          				<table align='center' width='500px' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
            				<tr>
              					<th width='190' scope='col'>Materia</th>
              					<th width='82' scope='col'>Calificación  obtenida</th>
								<th width='82' scope='col'>Problemas</th>
            				</tr>";
				$color="#DFEDBC";
			for($contMate=0;$contMate<10;$contMate++){
				echo "<tr bgcolor='$color'><td align='center'><input type='text' name='textoMa".$contMate; echo"' value='' size=40></td>";
					echo "<td align='center'><input type='text' name='textoCa".$contMate;echo"' value='' size=5></td>";
					echo "<td align='center'>
						<label> 
                    					<input type='radio' name='radio".$contMate; echo"' value='1' />
                    					Si</label>
                  				<label>
                    					<input type='radio' name='radio".$contMate; echo"' value='0' checked />
                    						No</label>
						</td></tr>";
							if($color=="#FCFFFF"){
	  							$color="#DFEDBC";
  							}else{
								$color="#FCFFFF";
							}
				}
			echo "<input type='hidden' name='contMate' value='$contMate'/>";
		}else{


		echo "<p><strong>Materias cursadas el semestre anterior:</strong></p>
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
									$conexion->query = 'SELECT * FROM historiales WHERE `periodo`=1 && `anio`=2012 && `numControl`=\''.	                                               $numControl.'\'' ;
									$conexion->consultaSQL();
									$color="#DFEDBC";
    								$contMate=0;
									while($row = mysql_fetch_array($conexion->result)){
										echo "<tr bgcolor='$color'><td>".$row['nombreMateria'];
										echo "</td>";
										echo "<td align='center'>".$row['calificacion'];
										echo "</td>";
										echo "<td align='center'>
										<label> 
                    						<input type='radio' name='radio".$contMate; echo"' value='1' />
                    						Si
										</label>
                  						<label>
                    					<input type='radio' name='radio".$contMate; echo"' value='0' checked />
                    						No
										</label>
										</td></tr>";
										if($color=="#FCFFFF"){
	  										$color="#DFEDBC";
  										}else{
											$color="#FCFFFF";
										}
										$contMate++;
									}
								echo "<input type='hidden' name='contMate' value='$contMate'/>";
								// Libera la consulta y cierra la conexión
								$conexion->liberaConsultaCierraConexion();
						}
							?>
          			</table>
            		<?php
							echo"<p>&nbsp;</p>
            					<p>&iquest;Cu&aacute;les son las posibles causas?</p>
        						<p>Seleccione las causas a las que usted le atribuye esas dificultades</p>
            					<p><strong>Causas atribuibles al alumno(a):</strong></p>
            					
								<table width='500px'  align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
              						<tr bgcolor='#DFEDBC'>
                						<td width='190'>Falta de atenci&oacute;n en clase</td>
                						<td width='82' align='center' bgcolor='#DFEDBC'>
										<label> 
											<input type='radio' name='radio11'  value='1' />
											Si
										</label>
                  						<label>
											<input type='radio' name='radio11'  value='0' checked />
											No
										</label>
              						</tr>
              						<tr>
                						<td>No estudi&eacute; lo suficiente</td>
                						<td align='center'>
											<label> 
												<input type='radio' name='radio12'  value='1' />
												Si
											</label>
											<label>
												<input type='radio' name='radio12'  value='0' checked />
												No
											</label>
										</td>
              						</tr>
              						<tr bgcolor='#DFEDBC'>
                						<td>Dificultades para   comprender</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio13'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio13'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr>
                						<td>Falta de apuntes o notas</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio14'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio14'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr bgcolor='#DFEDBC'>
                						<td>Inasistencia a clase</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio15'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio15'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
            					</table>
            					<p>&nbsp;</p>
            					<p><strong>Causas atribuibles al profesor(a):</strong></p>
            					<table width='500px' align='center' border='1' bordercolor='#95A329' style='border-collapse:collapse;'>
              						<tr bgcolor='#DFEDBC'>
                						<td width='190'>Falta de dominio de la materia</td>
                						<td width='82' align='center'>
											<label> 
                								<input type='radio' name='radio16'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio16'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr>
                						<td>Dificultades para explicar</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio17'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio17'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr bgcolor='#DFEDBC'>
                						<td>Malas relaciones con los   alumnos</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio18'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio18'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr>
										<td>Inasistencia</td>
										<td align='center'>
											<label> 
                								<input type='radio' name='radio19'  value='1' />
                    							Si
											</label>
                  							<label>
												<input type='radio' name='radio19'  value='0' checked />
												No
											</label>
										</td>
              						</tr>
              						<tr bgcolor='#DFEDBC'>
                						<td>Formas de evaluaci&oacute;n   inadecuadas</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio20'  value='1' />
                    							Si
											</label>
                  							<label>
                    							<input type='radio' name='radio20'  value='0' checked />
                    							No
											</label>
										</td>
              						</tr>
              						<tr>
                						<td>Falta de ejercicios   resueltos</td>
                						<td align='center'>
											<label> 
                								<input type='radio' name='radio21'  value='1' />
                    							Si
											</label>
                  						<label>
                    						<input type='radio' name='radio21'  value='0' checked />
                    						No
										</label>
									</td>
              					</tr>
            					</table>
            					<p>&nbsp;</p>
            					<p><strong>Otras causas (escríbalas):</strong></p>
 								<p><textarea rows='2' cols='77' name='pregunta1'></textarea></p>
            					<p>Si hubiera posibilidades de apoyarle a corregir esas deficiencias, &iquest;Cu&aacute;les acciones cree 								   usted que le ayudar&iacute;an?</p>
            					<p><textarea rows='2' cols='77' name='pregunta2'></textarea></p>
            					<p>&iquest;Estar&iacute;a dispuesto a trabajar en horas extra-clase para mejorar su desempe&ntilde;o                                   acad&eacute;mico?</p>
            					<p>
									<label>
            					   		<input type='radio' name='radio22'  value='1' />
                    					Si
									</label>
                  					<label>
                    					<input type='radio' name='radio22'  value='0' checked />
                    					No
									</label> 
								</p>
            					<p>si su respuesta es Si, &iquest;Cu&aacute;l ser&iacute;a el horario que propone?</p>
            					<p><textarea rows='2' cols='77' name='pregunta3'></textarea></p>
            					<p>&nbsp;</p>
            	                <p><strong>Actividades curriculares que cursa actualmente:</strong></p>
								<p>&nbsp;</p>
            					<p>Marque las actividades curriculares siguientes, que actualmente cursa:</p>
								<p>
									<label>Ingles: 
                    					<input type='radio' name='radio23'  value='1' />
                    					Si
									</label>
                  					<label>
                    					<input type='radio' name='radio23'  value='0' checked />
                    					No
									</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Nivel 1<input type='radio' name='radio24'  value='1'  /></label>&nbsp;&nbsp;
									<label>Nivel 2<input type='radio' name='radio24'  value='2' /></label>&nbsp;&nbsp;
									<label>Nivel 3<input type='radio' name='radio24'  value='3' /></label>&nbsp;&nbsp;
									<label>Nivel 4<input type='radio' name='radio24'  value='4' /></label>&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									
									<label>Nivel 5<input type='radio' name='radio24'  value='5' /></label>&nbsp;&nbsp;
									<label>Nivel 6<input type='radio' name='radio24'  value='6' /></label>&nbsp;&nbsp;
									<label>Nivel 7<input type='radio' name='radio24'  value='7' /></label>&nbsp;&nbsp;
									<label>Nivel 8<input type='radio' name='radio24'  value='8' /></label>
								</p>
								<br>
								<p>
									<label>Deportivo: 
                    					<input type='radio' name='radio25'  value='1' />
                    					Si
									</label>
                  					<label>
                   						<input type='radio' name='radio25'  value='0' checked />
               	 						No
									</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Volibol<input type='radio' name='radio26'  value='1' /></label>&nbsp;&nbsp;
									<label>Basquet bol<input type='radio' name='radio26'  value='2' /></label>&nbsp;&nbsp;
									<label>Futbol<input type='radio' name='radio26'  value='3' /></label>&nbsp;&nbsp;
								
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								<label>Atletismo<input type='radio' name='radio26'  value='4' /></label>&nbsp;&nbsp;
								<label>Tai Chi<input type='radio' name='radio26'  value='5' /></label>&nbsp;&nbsp;
								<label>Taekwondo<input type='radio' name='radio26'  value='6' /></label>&nbsp;&nbsp;
							</p>
							<br>
							<p>
								<label>Cultural: 
									<input type='radio' name='radio27'  value='1' />
									Si
								</label>
                  				<label>
                    				<input type='radio' name='radio27'  value='0' checked />
                    				No
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label>Danza<input type='radio' name='radio28'  value='1' /></label>&nbsp;&nbsp;
								<label>Artes Plásticas<input type='radio' name='radio28'  value='2' /></label>&nbsp;&nbsp;
								<label>B. de Guerra<input type='radio' name='radio28'  value='3' /></label>&nbsp;&nbsp;</p>

				            <p>&iquest;Tiene alguna dificultad con alguna de estas actividades?</p>
            				<p>
								<label> 
                    				<input type='radio' name='radio29'  value='1' />
                    				Si
								</label>
                  				<label>
                    				<input type='radio' name='radio29'  value='0' checked />
                    				No
								</label>
							</p>
            				<p>Escriba cual es la dificultad y la propuesta para corregir la situaci&oacute;n:</p>
							<p><textarea rows='2' cols='77' name='pregunta4'></textarea></p> 
            				<p>&nbsp;</p>           
							<p>&iquest;Tiene trabajo remunerado?</p>
            				<p>
								<label> 
									<input type='radio' name='radio30'  value='1' />
									Si
								</label>
			                  	<label>
									<input type='radio' name='radio30'  value='0' checked />
									No
								</label>
							</p>
            				<p>&iquest;Cu&aacute;ntas horas trabaja?</p>
            				<p><textarea rows='2' cols='77' name='pregunta5'></textarea></p>
							<br>
            				<p>&iquest;Actualmente, qu&eacute; tipo de problemas  le preocupa enfrentar?</p>
							<p> 
        						Académicos
								<label> 
        							<input type='radio' name='radio31'  value='1' />
            						Si
								</label>
                				<label>
            						<input type='radio' name='radio31'  value='0' checked />
                					No
								</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Familiares
								<label> 
									<input type='radio' name='radio32'  value='1' />
									Si
								</label>
								<label>
									<input type='radio' name='radio32'  value='0' checked />
									No
								</label>	
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Sociales
								<label> 
									<input type='radio' name='radio33'  value='1' />
									Si
								</label>
								<label>
									<input type='radio' name='radio33'  value='0' checked />
									No		
								</label>
							</p>
							<p>
								Economicos
								<label> 
									<input type='radio' name='radio34'  value='1' />
										Si
								</label>
								<label>
									<input type='radio' name='radio34'  value='0' checked />
									No
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Emocionales
								<label> 
									<input type='radio' name='radio35'  value='1' />
									Si
								</label>
								<label>
									<input type='radio' name='radio35'  value='0' checked />
									No
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								De Salud
								<label> 
									<input type='radio' name='radio36'  value='1' />
									Si
								</label>
								<label>
									<input type='radio' name='radio36'  value='0' checked />
									No
								</label>
							</p>
							<p>
								Otro (Especifique)
								<label> 
									<input type='radio' name='radio37'  value='1' />
									Si
								</label>
								<label>
									<input type='radio' name='radio37'  value='0' checked />
										No
								</label>			         	
								&nbsp;<textarea rows='2' cols='48' name='pregunta6'></textarea>
							</p>           
							";
						}else{
							echo "<p>&nbsp;</p>";
							$valueBoton="Actualizar";
						}
					?>
                    <br>
                    <h5>
              			<input type="submit" class='boton2' name="enviar" id="enviar" value="<?php echo $valueBoton?>" />
            		</h5>
            		<p>&nbsp;</p>
          				</form>
