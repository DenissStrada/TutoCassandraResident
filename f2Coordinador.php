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
        $idSesion = SID;
    	echo "<table align=\"right\"><tr><td>
		<input type=\"image\" name=\"selecFormatos\" id=\"selecFormatos\" value=\"Seleccionar formatos\" onclick=\"javascript:location.replace('seleccionFormatos.php?$idSesion');\"/>  &nbsp;
		<input type=\"image\" name=\"listaDI\" id=\"listaDI\" value=\"Lista\" onclick=\"javascript:location.replace('listaF2Coordinador.php?$idSesion');\"/>  &nbsp;
		<input type=\"image\" name=\"cerrarSesion\" id=\"cerrarSesion\" value=\"Cerrar sesión\" onclick=\"javascript:location.replace('cerrarSesion.php?$idSesion');\"/>
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
	$conexion->query = 'SELECT * FROM nombres, historiales, profesores WHERE nombres.numControl=\''.$numControl.'\' && historiales.numControl=\''.$numControl.'\' && profesores.numNomina=\''.$numNomina.'\'' ;
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
}

	// Libera la consulta y cierra la conexión
	$conexion->liberaConsultaCierraConexion();
	?>
          <p class="Estilo1"><strong>F2 FORMATO DE SEGUIMIENTO INDIVIDUAL (ENERO – JUNIO 2012)</strong></p>
          <table width="100%" border="0">
            <tr>
              <td>Tutor: <?php echo "$nombreDelTutor $aPaternoDelTutor $aMaternoDelTutor"; ?></td>
              <td>Academia:
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
$fecha=date("d-m-Y")
											  ?></td>
              <td></td>
                </td>
            </tr>
            <tr>
              <td colspan="2"><div align="center"><strong>Datos personales del alumno:</strong></div></td>
            </tr>
            <tr>
              <td colspan="2"><div align="center"><img src="fotos/<?php 
	  														 if(strlen($numControl) == 7){
															 	echo "0$numControl";
															 }
															 else{
															 	echo "$numControl";
															 }
	  													      
	  													  ?>.jpg" alt="" width="100" height="120" /></div></td>
            </tr>
            <tr>
              <td>Nombre: <?php echo "$nombreDelAlumno"; ?></td>
              <td>No. Control:<?php echo "$numeroDeControl"; ?></td>
            </tr>
            <tr> </tr>
            <tr> </tr>
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
											  ?></td>
              <td>Semestre: <?php echo "$semestreDelAlumno"; ?></td>
            </tr>
            <tr>
              <td>Grupo: <?php echo "$grupoDelAlumno"; ?></td>
              <td>Clave del Grupo: <?php echo "$claveGrupoDelAlumno"; ?></td>
            </tr>
            <tr> </tr>
          </table>
          <p>&nbsp;</p>
          <form id="form1" name="form1" method="post" action="guardaSeguimiento.php">
            <div align="center">
              <table border="1" cellspacing="" cellpadding="" align="center" width="743">
                <tr>
                  <td width="50" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                    <p align="center"><strong>Fecha</strong></p></td>
                  <td width="92" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                    <p align="center"><strong>Tema   abordado</strong></p></td>
                  <td width="120" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                    <p align="center"><strong>Área de   canalización</strong></p></td>
                  <td width="121" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                    <p align="center"><strong>Seguimiento   de canalización</strong></p></td>
                  <td width="107" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                    <p align="center"><strong>Resultado de   la canalización</strong></p></td>
                </tr>
                <tr>
                  <td width="50" height="85" valign="top"><p>&nbsp;</p>
                    <p><?php echo $fecha; ?> </p></td>
                  <td width="92" valign="top"><p>
                      <textarea name="tema" id="textarea2" cols="30" rows="5"></textarea>
                    </p></td>
                  <td width="120" valign="top"><p>
                      <select name="area" id="select">
                        <option value="ninguna"> </option>
                        <option value="Depto. Psicologia">Depto. Psicología</option>
                        <option value="Consultorio Medico">Consultorio Médico</option>
                        <option value="Ciencias Basicas">Ciencias Básicas</option>
                        <option value="Programacion IS">Programación ISC</option>
                      </select>
                    </p></td>
                  <td width="121" valign="top"><p>
                      <textarea name="seguimiento" id="textarea" cols="30" rows="5"></textarea>
                    </p></td>
                  <td width="107" valign="top"><p>
                      <textarea name="resultado" id="textarea3" cols="30" rows="5"></textarea>
                    </p></td>
                </tr>
              </table>
              <p>
                <input type="submit" name="Enviar" id="Enviar" value="Enviar" />
              </p>
            </div>
          </form>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
