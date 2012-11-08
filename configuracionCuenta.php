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
				if(strlen($numControl)<8){
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
					}
				}
				else{
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

				<a ";if(strlen(trim($user))<8)echo"href='seleccionFormatos.php?"; else echo"href='selFormatosAlumnos.php?"; echo"$idSesion'>Seleccionar formatos</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='cerrarSesion.php?$idSesion'>Cerrar sesi&oacute;n</a>
				</td></tr></table>";
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <p>&nbsp;</p>
          <h4 class="Estilo1">Configuraci&oacute;n de contraseña para el usuario</h4>
          
          <?php
	$password1=$_POST['clave'];
	$password2=$_POST['clave2'];
	$password3=$_POST['clave3'];
	$claveActual="";
	if ((isset($password1) && isset($password2) && isset($password3))){
		if (strlen(trim($password1))==0 || strlen(trim($password2))==0 || strlen(trim($password3))==0){
			echo "<h3 class='Error2'>Revisa tus valores ingresados</h3>";	
		}
		else{
			require_once("ClaseBDD.php");
			$conexion = new BDD();
			$conexion->conexionBDD();	
			if(strlen(trim($user))<8){
				$conexion->query = "SELECT * FROM profesores WHERE numNomina=".$user;
				$conexion->consultaSQL();
				while ($row = mysql_fetch_array($conexion->result)) {
					$claveActual = "$row[clave]";
				}
			}
			else{
				$conexion->query = "SELECT * FROM nombres WHERE numControl='".$user."'";
				$conexion->consultaSQL();
				while ($row = mysql_fetch_array($conexion->result)) {
					$claveActual = "$row[clave]";
				}
			}
			if (($password1==$claveActual)==false){
				echo "<h3 class='Error2'>La contraseña actual no es valida</h3>";	
			}
			else if (strlen(trim($password2))<6 || strlen(trim($password3))<6){
				echo "<h3 class='Error2'>Tu nueva contraseña debe contener <br>mimimo 6 caracteres</h3>";	
			}	
			else if ($password2!=$password3){
				echo "<h3 class='Error2'>La nueva contraseña y su confirmación <br>no coinciden</h3>";	
			}
			else{
				if(strlen(trim($user))<8){	
					$conexion->query ="UPDATE profesores SET clave='".$password2."' WHERE numNomina=".$user;
					$conexion->consultaSQL();
					$_SESSION['clave'] = $password2 ;
					echo "<p>&nbsp;</p><p></p><h3 class='Error2'>Tu contraseña ha sido actualizada con exito</h3>"; 
					echo "<SCRIPT LANGUAGE=\"Javascript\">
  						<!--
						function redireccionar() { location.href='seleccionFormatos.php' } 
						setTimeout ('redireccionar()', 5000);
						//-->
					</SCRIPT>"; 
					echo "
						</div>
      					</div>
    					</div>
    					<div id='antepie'></div>
  						</div>
						</div>
					";
					exit;
				}
				else{
					$conexion->query ="UPDATE nombres SET clave='".$password2."' WHERE numControl='".$user."'";
					$conexion->consultaSQL();
					$_SESSION['clave'] = $password2 ;
					echo "<p>&nbsp;</p><p></p><h3 class='Estilo1'>Tu contraseña ha sido actualizada con exito</h3>"; 
					echo "<SCRIPT LANGUAGE=\"Javascript\">
  						<!--
						function redireccionar() { location.href='selFormatosAlumnos.php' } 
						setTimeout ('redireccionar()', 5000);
						//-->
					</SCRIPT>"; 
					echo "
						</div>
      					</div>
    					</div>
    					<div id='antepie'></div>
  						</div>
						</div>
					";
					exit;
				}
				mysql_close($conexion->link);
			}
		}
	}
?>
		<form name="alta" method=POST action="">
		  <table width="350px" border="0" align="center" bgcolor="#FCFFFF">
			  <tr>
				    <td width="0" >&nbsp;</td>
				    <td width="160" >&nbsp;</td>
				    <td width="190" align="left">&nbsp;</td>
		      </tr>
				  <tr>
				    <td >&nbsp;</td>
				    <td class="Estilo4">Contrase&ntilde;a actual:</td>
				    <td align="left"><input name="clave" type="password" id="clave" size="20" /></td>
			      </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td class="Estilo4">Nueva contrase&ntilde;a:</td>
				    <td align="left"><input name="clave2" type="password" id="clave2" size="20" /></td>
			      </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td class="Estilo4">Confirmar contrase&ntilde;a:</td>
				    <td align="left"><input name="clave3" type="password" id="clave3" size="20" /></td>
			      </tr>
				  <tr>
				    <td colspan="3" align="center"><p>&nbsp;</p>
			        <input type=submit name="enviar"  class="boton2" value="Actualizar contraseña"><p>&nbsp;</p></td>
			      </tr>
		    </table>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
		</form>
</div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
