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
<script language="javascript">
var fecha="",hora="", tema="", can="",seg="",res="";
var aux=0;
var sem=0,mes=0,ano=0;
</script>
<script type="text/javascript" src="jquery.js" ></script>
<script type="text/javascript" src="java.js" ></script>
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
				$bandera = $row[0];

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
	$numControl = $_SESSION["nombreUsuario"];
	$tema=$_POST['tema'];

	require_once("ClaseBDD.php");
	$conexion = new BDD();
	
	$conexion->conexionBDD();
	

	// Consulta SQL
	$anio='2012';
	
	$conexion->query = "SELECT * FROM nombres, historiales WHERE nombres.numControl='".$numControl."' && historiales.anio='".$anio."' && historiales.numControl='".$numControl."'" ;
	$conexion->consultaSQL();
  
while($row = mysql_fetch_array($conexion->result)){
	$nombreDelAlumno = $row['nombreAlumno'];
	$numeroDeControl = $row['numControl'];
	$carreraDelAlumno = $row['carrera'];
	$grupoDelAlumno = $row['grupo'];
	$claveGrupoDelAlumno = $row['claveGrupo'];
	$semestreDelAlumno = $row['semestre'];
}
	
	$conexion->query = "SELECT numNomina, grupoActual FROM horariosfebjun_2012 WHERE horariosfebjun_2012.grupoAnterior='".$grupoDelAlumno."'" ;
	$conexion->consultaSQL();
  	$row = mysql_fetch_array($conexion->result);
	$nomina = $row['numNomina'];	
	$grupoActual=$row['grupoActual'];
	
	$conexion->query = "SELECT nombre, aPaterno, aMaterno FROM profesores WHERE numNomina=$nomina" ;
	$conexion->consultaSQL();
	$row = mysql_fetch_array($conexion->result);
	$nombreDelTutor=$row['nombre']; 
	$aPaternoDelTutor=$row['aPaterno'];
	$aMaternoDelTutor=$row['aMaterno'];
	
	$tutor=$nombreDelTutor." ".$aPaternoDelTutor." ".$aMaternoDelTutor;
	
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
							

	?>
          <p class="Estilo1">Seguimiento Individual (Agosto – Diciembre 2012)<br><br>
          <table width="100%" border="0">
            <tr>
              <td align="center">Tutor: <?php echo "$tutor"; ?></td>
            </tr>
            <tr>
              <td align="center">Academia:
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
												$fecha=date("d-m-Y");
												$fecha2=date("Y-m-d");
												$hora=date("H:i");
											  ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="center"><strong><br>Datos personales del alumno:</strong><br><br></div></td>
            </tr>
            <tr>
              <td><div align="center">
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
              <br><br></div></td>
            </tr>
            <tr>
              <td align="center"><?php echo "$nombreDelAlumno"; ?></td>
            </tr>
            <tr>
              <td align="center">No. Control: <?php echo "$numeroDeControl"; ?></td>
            </tr>
            <tr>
              <td align="center">Carrera:
              <?php 
	  											
												switch($carreraDelAlumno){
													case 1:
														echo "Ingenier&iacute;a en Sistemas Computacionales";
														break;
													case 2:
														echo "Licenciatura en Administraci&oacute;n";
														break;
													case 3:
														echo "Ingenier&iacute;a Industrial";
														break;
													case 4:
														echo "Ingenier&iacute;a en Industrias Alimentarias";
														break;
													case 5:
														echo "Ingenier&iacute;a Electr&oacute;nica";
														break;
													case 6:
														echo "Ingenier&iacute;a Mecatr&oacute;nica";
														break;
													case 7:
														echo "Ingenier&iacute;a en Administraci&oacute;n";
														break;
													case 8:
														echo "Ingenier&iacute;a Mec&aacute;nica";
														break;
													default :
														echo "Carrera no identificada";
														break;
												  } 
											  ?></td>
            </tr>
            <tr>
              <td align="center">Semestre: <?php echo "$semestreDelAlumno"; ?></td>
            </tr>
            <tr>
              <td align="center">Grupo: <?php echo "$grupoDelAlumno"; ?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <form id="form1" name="form1" method="post" action="#temaSeguimiento">
          	<p>Cada semana puedes enviar un tema (problema personal acad&eacute;mico), el cual posteriormente ser&aacute; analizado y canalizado 
            	por tu tutor, con el objetivo de dar un seguimiento correcto.</p><br>
          	<?php 
          	require_once("ClaseSesion.php");
			$sesion = new Sesion();
			$user=$_SESSION["nombreUsuario"];
			$password=$_SESSION["clave"];
			if($user==null && $pasword==null){
				echo "<SCRIPT LANGUAGE=\"Javascript\">
					<!--
					window.location='index.php';
					//--> 
					</SCRIPT>";	
			}
			?>
            <div align="center">
            <A name="temaSeguimiento">
              <table width="500px" cellspacing="5" cellpadding="2" border=0 bordercolor="#344D06" class="ntab2">
                <tr>
                  <td>&nbsp;&nbsp;&nbsp; <?php echo $fecha; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $hora; ?></td>
                </tr>
                <tr>
                  <td width="380"><p class="Estilo1">Tema a abordar
                     <?php
						$tema=$_POST['tema'];
						if(strlen(trim($tema))>10){
							$conexion->query ="INSERT INTO tutorias(tutor,ncontrol,nombre,fecha,hora,tema)
												VALUES('$tutor','$numControl','$nombreDelAlumno','$fecha2','$hora','$tema')";
							$conexion->consultaSQL();
							echo "<h3 class='Error2'>Tu tema ha sido enviado con &eacute;xito, en breve ser&aacute;<br>
							canalizado por tu tutor.<p>&nbsp;</p></h3>
								 	</tr>
              					</table>
            				</div>
          					</form>
          					<p>&nbsp;</p>
        					</div>
      						</div>
    						</div>
    						<div id='antepie'></div>
  							</div>
							</div>"; 
							exit;
						}
						else{
							if(isset($tema)){
								echo "<h3 class='Error2'>Deves ingresar un tema</h3>"; 
							}
						}
						// Libera la consulta y cierra la conexión
						$conexion->liberaConsultaCierraConexion();
					?>
                  </p></td>
                </tr>
                <?php
					$conexion->conexionBDD();
					// Consulta SQL
					$conexion->query = "SELECT fechaInicio FROM semanas_seguimiento";
					$conexion->consultaSQL();
					$fechaInicio;
					$fechaFin;
					$permitirEnviar=false;
					$row = mysql_fetch_array($conexion->result);
					$fechaInicio=$row[0];
					while($row){
						while($row = mysql_fetch_array($conexion->result)){
							$fechaFin=$row[0];
							$conexion2 = new BDD();
							$conexion2->conexionBDD();
							$conexion2->query = "SELECT '$fechaInicio' <='$fecha2' AND '$fecha2' < '$fechaFin' FROM semanas_seguimiento";
							$conexion2->consultaSQL();
							$rango = mysql_fetch_array($conexion2->result);
							$validar= $rango[0];
						
							if($validar==1){
								$conexion2->query = "SELECT COUNT( * ) FROM tutorias WHERE  '$fechaInicio' <= fecha AND fecha <  '$fechaFin' 
													AND ncontrol = '$user' GROUP BY ncontrol";
								$conexion2->consultaSQL();
								$enviados = mysql_fetch_array($conexion2->result);
								$validar2= $enviados[0];
								if($validar2==0){
									$permitirEnviar=true;
								}
							}
							$fechaInicio=$row[0];
							break;
						}
						if($validar==1){
							break;
						}
					}
					$conexion->liberaConsultaCierraConexion();
					$conexion2->liberaConsultaCierraConexion();
					
					if($permitirEnviar){
						echo "<tr bgcolor='#DFEDBC'>
                  				<td align='center' valign='top'><textarea name='tema' id='tema' cols='50' rows='5'></textarea></td>
                			</tr>
                			<tr bgcolor='#DFEDBC'>
                  				<td align='center' height='50'>
                    				<input type='submit' name='Enviar' id='Enviar' class='boton2' value='Enviar tema al tutor' />
                  				</td>
                			</tr>";
					}
					else{
						echo "<tr bgcolor='#DFEDBC'>
                  				<td align='center' valign='top'><h3 class='Error2'>Solo puedes enviar un tema por semana, ya has enviado <br> 
																					el tema correspondiente a esta semana.</h3><br></td>
                			</tr>";
					}
				?>
                
              </table>
              </A>
            </div>
          </form>
          <br><br>
          <table width="100%" border="0">
        	<tr>
            	<td align="center"><input type='submit' name='visualizar' id='visualizar' class='boton2' value='Ver historial' onclick='mostrar_seguimiento_alumno()' /></td>
            </tr>
        </table>
          <p>&nbsp;</p>
        </div>
		<div class="pantalla"></div>
		<div class="loading"><img src="imagenes/cargando.gif" /></div>
		<div class="formulario2" align="center"><br />
			<?php
				require_once("Consultas.php");
				$c_query=new Consultar;
				$result=$c_query->consulta2($user);
				$color="#FCFFFF";
				echo "<h3><font color='#fcffff'>Historial Seguimiento Individual</font></h3>
				<table cellspacing='1' border=0 bordercolor='#344D06'>
					<tr bgcolor='#DFEDBC'>
						<th height='50'>Fecha</td>
						<th>Tema</td>
						<th>Canalizaci&oacute;n</td>
						<th>Seguimiento</td>
						<th>Resultado</td>
					</tr>";

					while ($regis=mysql_fetch_array($result)){
						$fechaSeguimiento=$regis["fecha"];
						$temaSeguimiento=$regis["tema"];
						$canalizacionSeguimiento=$regis["canalizacion"];
						$seguimiento=$regis["seguimiento"];
						$ResultadoSeguimiento=$regis["resultado"];
	
						echo "
							<tr bgcolor='$color'>
								<td width='80' align='center'>$fechaSeguimiento</td>
								<td width='120' align='center'>$temaSeguimiento</td>
								<td width='110' align='center'>$canalizacionSeguimiento</td>
								<td width='110' align='center'>$seguimiento</td>
								<td width='100' align='center'>$ResultadoSeguimiento</td>
							</tr>";
						if($color=="#F0F2BA"){
	  						$color="#FCFFFF";
  						}
						else{
							$color="#F0F2BA";
						}
					}
			echo "</table>";
		?>
   		<br><br>
        <a id="cerrar" class="cerrar">&#215;</a>
    	<input type="button" value="Regresar" class="button" id="btn_salir">
    	<br><br>
		</div>
		</div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
