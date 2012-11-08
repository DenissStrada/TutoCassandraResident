<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();	
	
	$numControl=$_SESSION['nombreUsuario'];
	$clave=$_SESSION['clave'];

	require_once("ClaseBDD.php");
	$conexion = new BDD();
	$conexion->conexionBDD();
	
	$nombreDelAlumno = $_POST['nombreDelAlumno'];
	$numeroDeControl = $_POST['numeroDeControl'];
	$calle = $_POST['calle'];
	$numeroExterior = $_POST['numExt'];
	$numeroInterior = $_POST['numInt'];
	$colonia = $_POST['colonia'];
	$municipio = $_POST['municipio'];
	$entidad = $_POST['entidad'];
	$codigoPostal = $_POST['cp'];
	$telCasa = $_POST['telCasa'];
	$telCel = $_POST['celular'];
	$email = $_POST['email'];
	$lugarNacimiento = $_POST['lugarNacimiento'];
	$estadoCivil = $_POST['categorias'];
	$contMaterias = $_POST['contMate'];
	
	$escProcedencia = $_POST['escProcedencia'];
	$tipoBachillerato = $_POST['tipoBachillerato'];
	$promedioBachillerato = $_POST['promedioBachillerato'];
	$promedioAdimision = $_POST['promedioAdimision'];
	$viveCon = $_POST['viveCon'];
	
	$nuevoIngreso = substr($numControl, 0, -4);
	
	for($x = 0; $x < $contMaterias; $x++){
		$textoMa=$_POST['textoMa'.$x];
		$cadenatextoMa=$cadenatextoMa.$textoMa."-";
		
		$textoCa=$_POST['textoCa'.$x];
		$cadenatextoCa=$cadenatextoCa.$textoCa."-";

		$materia=$_POST['radio'.$x];
		$cadenaMaterias= $cadenaMaterias.$materia."-";
	}
	
	$radio11 = $_POST['radio11'];
	$radio12 = $_POST['radio12'];
	$radio13 = $_POST['radio13'];
	$radio14 = $_POST['radio14'];
	$radio15 = $_POST['radio15'];
	$radio16 = $_POST['radio16'];
	$radio17 = $_POST['radio17'];
	$radio18 = $_POST['radio18'];
	$radio19 = $_POST['radio19'];
	$radio20 = $_POST['radio20'];
	$radio21 = $_POST['radio21'];
	$pregunta1 = $_POST['pregunta1'];
	$pregunta2 = $_POST['pregunta2'];
	$radio22 = $_POST['radio22'];
	$pregunta3 = $_POST['pregunta3'];
	$radio23 = $_POST['radio23'];
	$radio24 = $_POST['radio24'];
	$radio25 = $_POST['radio25'];
	$radio26 = $_POST['radio26'];
	$radio27 = $_POST['radio27'];
	$radio28 = $_POST['radio28'];
	$radio29 = $_POST['radio29'];
	$pregunta4 = $_POST['pregunta4'];
	$radio30 = $_POST['radio30'];
	$pregunta5 = $_POST['pregunta5'];
	$radio31 = $_POST['radio31'];
	$radio32 = $_POST['radio32'];
	$radio33 = $_POST['radio33'];
	$radio34 = $_POST['radio34'];
	$radio35 = $_POST['radio35'];
	$radio36 = $_POST['radio36'];
	$radio37 = $_POST['radio37'];
	$pregunta6 = $_POST['pregunta6'];
	
	$valida=$_POST['valida'];
	
	// update
	
	$conexion->query ="UPDATE axhunico_tutorias.datospersonales1_2012 SET 
					 calle='$calle', numExterior='$numeroExterior', numInterior='$numeroInterior', colonia='$colonia', 	                     municipio='$municipio', entidad='$entidad', cp='$codigoPostal', telCasa='$telCasa', 
					 telCel='$telCel',email='$email', lugarNacimiento='$lugarNacimiento', 		                    edoCivil=$estadoCivil
					 WHERE numControl='$numControl'";
	$conexion->consultaSQL();
	mysql_close($conexion->link);
	
	if	($valida==0){
		if($radio22==1 && strlen(trim($pregunta3))==0 || $radio29==1 && strlen(trim($pregunta4))==0 ||
		   $radio30==1 && strlen(trim($pregunta5))==0 || $radio37==1 && strlen(trim($pregunta6))==0 ||
		   $radio23==1 && $radio24=="" || $radio25==1 && $radio26=="" || $radio27==1 && $radio28==""){
				echo "<SCRIPT LANGUAGE=\"Javascript\">
						<!--
						alert(\"Debes responder todas las preguntas !\");
						//-->
						window.location='datosPersonales.php'; 
						</SCRIPT>";
  				exit;
		}
		if($radio23==0){
			$radio24=0;
		}
		if($radio25==0){
			$radio26=0;
		}
		if($radio27==0){
			$radio28=0;
		}


if($nuevoIngreso=='1204'){
			$conexion3 = new BDD();
			$conexion3->conexionBDD();
			$conexion3->query ="INSERT INTO axhunico_tutorias.historialesNuevoIngreso(numControl,escProcedencia,tipoBachillerato,promedioBachillerato,promedioAdimision,viveCon,nombreMaterias,caliMaterias)VALUES ('$numControl','$escProcedencia','$tipoBachillerato','$promedioBachillerato','$promedioAdimision','$viveCon','$cadenatextoMa','$cadenatextoCa');";
$conexion3->consultaSQL();
mysql_close($conexion3->link);

}
	$conexion2 = new BDD();
	$conexion2->conexionBDD();
	$conexion2->query ="INSERT INTO axhunico_tutorias.formulariof1(numControl,materiasDificultades,
							faltaAtencion,noEstudie,dificultadesAprender,faltaApuntes,
							inasistenciaAlumno,faltaDominio,DificultadesExplicar,malasRelaciones,inasistenciaProfesor,
							evaluacionInadecuada,faltaEjercicios,otrasCausas,apoyoDeficiencias,trabajoExtra,horarioPropuesto,
							ingles,nivelIngles,deportivo,actividadDeportivo,cultural,actividadCultural,dificultadActividades,
							corregirSituacion,trabajoRemunerado,horasTrabajo,academicos,familiares,sociales,economicos,emocionales,
							salud,otro,otroDescripcion)
						VALUES ('$numControl', '$cadenaMaterias', $radio11, $radio12, $radio13, $radio14, $radio15, $radio16, 
							$radio17, $radio18, $radio19, $radio20, $radio21, '$pregunta1', '$pregunta2', $radio22, '$pregunta3',
							$radio23, $radio24, $radio25, $radio26, $radio27, $radio28, $radio29, '$pregunta4', $radio30, '$pregunta5',
							$radio31, $radio32, $radio33, $radio34, $radio35, $radio36, $radio37, '$pregunta6');";
	$conexion2->consultaSQL();
		if ($conexion2-> result){
			mysql_close($conexion2->link);

			echo "<SCRIPT LANGUAGE=\"Javascript\">
					  <!--
					  alert(\"El formulario se ha enviado con exito !\");
					  window.location='selFormatosAlumnos.php'; 
					  //-->
				  </SCRIPT>";
		}
	}else{
 		echo"<SCRIPT LANGUAGE=\"Javascript\">
				<!--
				alert(\"Tus datos personales se han actualizado con exito !\");
				window.location='selFormatosAlumnos.php'; 
				//-->
		    </SCRIPT>";
	}
?>
