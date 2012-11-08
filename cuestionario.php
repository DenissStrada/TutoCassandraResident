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
		
		require_once("ClaseBDD.php");
		$conexion = new BDD();
		$conexion->conexionBDD();
		
		$numControl = $_SESSION['nombreUsuario'];
		
		$conexion->query = "SELECT num_control FROM respuestas WHERE num_control='$numControl'";
		$conexion->consultaSQL();
		$cont=0;
		while(mysql_fetch_array($conexion->result)){
			$cont++;
		}
		$conexion->liberaConsultaCierraConexion();
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
        <?php
			if($cont==0){
				echo "
				<form id='form1' name='formulario' method='post' action='guardar.php'>
            <h3>Instituto Tecnol&oacute;gico Superior de Uruapan </h3>
            <h3 class='Estilo1'>Subdirecci&oacute;n Acad&eacute;mica</h3>
            <h3 class='Estilo1'>Desarrollo Académico</h3>
            <h3 class='Estilo1'>Programa de tutoría académica</h3>
			<br><br>
            <h3 class='Estilo1'>Cuestionario de auto evaluación de hábitos de estudio</h3>
            <p>&nbsp;</p>
            <p>INSTRUCCIONES: Lea cuidadosamente cada pregunta y seleccione la respuesta de la letra correspondiente (S = siempre, A = a menudo, R = raras veces, N = nunca).</p>
            <p>Seleccione la respuesta que refleje más acertadamente su forma de trabajo en cada especto que se plantea. Para que los resultados de éste cuestionario realmente le sean útiles, es importante que conteste con toda honestidad.</p>
            <p>&nbsp;</p>
            <p>1.¿Tomo en cuenta todas mis materias al distribuir el tiempo de estudio?</p>
            <h5>
                <label>
                <input type='radio' name='radio1' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio1' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio1' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio1' id='n' value='0' />
                N </label>
            </h5>
            <p>2.¿Responsabilizo de mis fracasos académicos a otras personas o las circunstancias?</p>
            <h5>
              <label>
                <input type='radio' name='radio2' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio2' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio2' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio2' id='n' value='0' />
                N </label>
            </h5>
            <p>3.¿Hay personas conversando o ruidos que molesten o distraigan mientras estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio3' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio3' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio3' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio3' id='n' value='3'/>
                N </l.abel>
            </h5>
            <p>4.¿Escribo notas de todas mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio4' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio4' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio4' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio4' id='n' value='0' />
                N </label>
            </h5>
            <p>5.¿Adopto una actitud crítica ante lo que leo y obtengo mis propias conclusiones?</p>
            <h5>
              <label>
                <input type='radio' name='radio5' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio5' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio5' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio5' id='n' value='0' />
                N </label>
            </h5>
            <p>6.¿Durante un examen distribuyo mi tiempo de acuerdo con el número de preguntas formuladas?</p>
            <h5>
              <label>
                <input type='radio' name='radio6' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio6' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio6' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio6' id='n' value='0' />
                N </label>
            </h5>
            <p>7.¿Falto a mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio7' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio7' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio7' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio7' id='n' value='3' />
                N </label>
            </h5>
            <p>8.¿Planifico mis actividades?</p>
            <h5>
              <label>
                <input type='radio' name='radio8' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio8' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio8' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio8' id='n' value='0' />
                N </label>
            </h5>
            <p>9.¿Siento satisfacción al intervenir con actividades relacionadas con el estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio9' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio9' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio9' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio9' id='n' value='0' />
                N </label>
            </h5>
            <p>10.¿Interfieren mis problemas personales en mis intenciones de estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio10' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio10' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio10' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio10' id='n' value='3' />
                N </label>
            </h5>
            <p> 11.¿Utilizo abreviaturas para escribir más rápido?</p>
            <h5>
              <label>
                <input type='radio' name='radio11' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio11' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio11' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio11' id='n' value='0' />
                N </label>
            </h5>
            <p>12.¿Subrayo las ideas que me parecen más importantes durante la lectura?</p>
            <h5>
              <label>
                <input type='radio' name='radio12' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio12' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio12' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio12' id='n' value='0' />
                N </label>
            </h5>
            <p>13.¿En los exámenes señalo de manera visible las respuestas?</p>
            <h5>
              <label>
                <input type='radio' name='radio13' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio13' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio13' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio13' id='n' value='0' />
                N </label>
            </h5>
            <p>14.¿Frecuento a compañeros que presentan un bajo rendimiento académico?</p>
            <h5>
              <label>
                <input type='radio' name='radio14' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio14' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio14' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio14' id='n' value='3' />
                N </label>
            </h5>
            <p>15.¿Destino tiempo de clases para mis materias?</p>
            <h5>
              <label>
                <input type='radio' name='radio15' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio15' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio15' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio15' id='n' value='0' />
                N </label>
            </h5>
            <p>16.¿Estoy seguro(a) de que realmente me gusta estudiar?</p>
            <h5>
              <label>
                <input type='radio' name='radio16' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio16' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio16' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio16' id='n' value='0' />
                N </label>
            </h5>
            <p>17.¿Mientras estudio me distraigo con asuntos ajenos al tema?</p>
            <h5>
              <label>
                <input type='radio' name='radio17' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio17' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio17' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio17' id='n' value='3' />
                N </label>
            </h5>
            <p>18.¿Anoto textualmente las fórmulas, las leyes, los principios, las reglas, etc. que expone el maestro en la clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio18' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio18' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio18' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio18' id='n' value='0' />
                N </label>
            </h5>
            <p>19.¿Exploro e investigó el contenido general de un libro antes de comenzar su lectura sistemática?</p>
            <h5>
              <label>
                <input type='radio' name='radio19' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio19' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio19' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio19' id='n' value='0' />
                N </label>
            </h5>
            <p>20.¿Durante un examen leo dos veces la misma pregunta?</p>
            <h5>
              <label>
                <input type='radio' name='radio20' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio20' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio20' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio20' id='n' value='0' />
                N </label>
            </h5>
            <p>21.¿Aclaro mis dudas con el profesor?</p>
            <h5>
              <label>
                <input type='radio' name='radio21' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio21' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio21' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio21' id='n' value='0' />
                N </label>
            </h5>
            <p>22.¿Elaboro un plan de estudios antes de empezar mi periodo de clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio22' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio22' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio22' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio22' id='n' value='0' />
                N </label>
            </h5>
            <p>23.¿Me siento frustrado por ser estudiante?</p>
            <h5>
              <label>
                <input type='radio' name='radio23' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio23' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio23' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio23' id='n' value='0' />
                N </label>
            </h5>
            <p>24.¿Cuándo estudio tengo cerca destractores visuales como la televisión, el retrato de mi novia(o), artistas, carteles?</p>
            <h5>
              <label>
                <input type='radio' name='radio24' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio24' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio24' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio24' id='n' value='3' />
                N </label>
            </h5>
            <p>25.¿Me resulta fácil concentrarme en la exposición del maestro?</p>
            <h5>
              <label>
                <input type='radio' name='radio25' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio25' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio25' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio25' id='n' value='0' />
                N </label>
            </h5>
            <p>26.¿Repito en voz alta y con el libro cerrado el material que considero más relevante, a fin de asimilarlo?</p>
            <h5>
              <label>
                <input type='radio' name='radio26' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio26' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio26' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio26' id='n' value='0' />
                N </label>
            </h5>
            <p>27.¿Tengo confianza en mis conocimientos o capacidades de presentar un examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio27' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio27' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio27' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio27' id='n' value='0' />
                N </label>
            </h5>
            <p>28.¿Adopto actitudes positivas ante mis compañeros y maestros?</p>
            <h5>
              <label>
                <input type='radio' name='radio28' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio28' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio28' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio28' id='n' value='0' />
                N </label>
            </h5>
            <p>29.¿Inicio y concluyo puntualmente cada una de mis actividades?</p>
            <h5>
              <label>
                <input type='radio' name='radio29' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio29' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio29' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio29' id='n' value='0' />
                N </label>
            </h5>
            <p>30.¿Encuentro agradable el ambiente de la intitución educativa donde estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio30' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio30' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio30' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio30' id='n' value='0' />
                N </label>
            </h5>
            <p>31.Cuando estudio ¿tengo demasiados objetos sobre mi mesa?</p>
            <h5>
              <label>
                <input type='radio' name='radio31' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio31' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio31' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio31' id='n' value='3' />
                N </label>
            </h5>
            <p>32.¿Cuento con hojas y plumas o lápiz durante cada una de mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio32' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio32' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio32' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio32' id='n' value='0' />
                N </label>
            </h5>
            <p>33.¿Me pongo a leer aunque me sienta cansado?</p>
            <h5>
              <label>
                <input type='radio' name='radio33' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio33' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio33' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio33' id='n' value='3' />
                N </label>
            </h5>
            <p>34.¿Estoy nervioso(a) antes de presentar un examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio34' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio34' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio34' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio34' id='n' value='3' />
                N </label>
            </h5>
            <p>35.¿Cumplo con mis tareas o actividades extra clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio35' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio35' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio35' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio35' id='n' value='0' />
                N </label>
            </h5>
            <p>36.Cuando estudio ¿me concentro durante periodos cortos y dedico mas tiempo a fantasear?</p>
            <h5>
              <label>
                <input type='radio' name='radio36' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio36' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio36' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio36' id='n' value='3' />
                N </label>
            </h5>
            <p>37.¿Dudo cuando tengo que tomar una decisión respecto a mis estudios?</p>
            <h5>
              <label>
                <input type='radio' name='radio37' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio37' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio37' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio38' id='n' value='3' />
                N </label>
            </h5>
            <p>38.¿Busco apuntes o libros en los momentos en que debería estar estudiando?</p>
            <h5>
              <label>
                <input type='radio' name='radio38' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio38' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio38' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio38' id='n' value='3' />
                N </label>
            </h5>
            <p>39.¿Copio los ejemplos que proporciona el maestro?</p>
            <h5>
              <label>
                <input type='radio' name='radio39' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio39' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio39' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio39' id='n' value='0' />
                N </label>
            </h5>
            <p>40.¿Elaboro cuadros sinópticos o diagramas a fin de seleccionar y sintetizar lo que e leído?</p>
            <h5>
              <label>
                <input type='radio' name='radio40' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio40' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio40' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio40' id='n' value='0' />
                N </label>
            </h5>
            <p>41.¿Duermo normalmente la noche anterior al examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio41' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio41' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio41' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio41' id='n' value='0' />
                N </label>
            </h5>
            <p>42.¿Investigo por iniciativa propia aspectos relacionados con las diferentes materias de estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio42' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio42' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio42' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio42' id='n' value='0' />
                N </label>
            </h5>
            <p>43.¿Reviso diariamente el horario que elaboré por escrito para saber cual es la actividad planeada para determinar hora?</p>
            <h5>
              <label>
                <input type='radio' name='radio43' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio43' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio43' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio43' id='n' value='0' />
                N </label>
            </h5>
            <p>44.¿Considero que el estudio es tedioso y desagradable?</p>
            <h5>
              <label>
                <input type='radio' name='radio44' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio44' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio44' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio44' id='n' value='3' />
                N </label>
            </h5>
            <p>45.¿Cuento con una área bien ventilada, iluminada y ordenada para estudiar?</p>
            <h5>
              <label>
                <input type='radio' name='radio45' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio45' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio45' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio45' id='n' value='0' />
                N </label>
            </h5>
            <p>46.¿Pido prestados apuntes a mis compañeros de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio46' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio46' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio46' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio46' id='n' value='0' />
                N </label>
            </h5>
            <p>47.¿Tengo dificultades para aprender lo que leo?</p>
            <h5>
              <label>
                <input type='radio' name='radio47' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio47' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio47' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio47' id='n' value='3' />
                N </label>
            </h5>
            <p>48.¿Reviso las respuestas de los exámenes antes de entregarlo?</p>
            <h5>
              <label>
                <input type='radio' name='radio48' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio48' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio48' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio48' id='n' value='0' />
                N </label>
            </h5>
            <p>49.¿Me quedo con dudas sobre lo que expuso el profesor?</p>
            <h5>
              <label>
                <input type='radio' name='radio49' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio49' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio49' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio49' id='n' value='3' />
                N </label>
            </h5>
            <p>50.¿Utilizo la mayor parte de mi tiempo en cosas productivas y significativas?</p>
            <h5>
              <label>
                <input type='radio' name='radio50' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio50' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio50' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio50' id='n' value='0' />
                N </label>
            </h5>
            <p>51.¿Estoy dispuesto y tengo deseo de estudiar en cualquier momento?</p>
            <h5>
              <label>
                <input type='radio' name='radio51' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio51' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio51' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio51' id='n' value='0' />
                N </label>
            </h5>
            <p>52.¿Acudo a las bibliotecas o centros de información?</p>
            <h5>
              <label>
                <input type='radio' name='radio52' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio52' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio52' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio52' id='n' value='0' />
                N </label>
            </h5>
            <p>53.¿Mis apuntes de clases están limpios, ordenados y legibles, de tal manera que puedo entenderlos posteriormente?</p>
            <h5>
              <label>
                <input type='radio' name='radio53' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio53' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio53' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio53' id='n' value='0' />
                N </label>
            </h5>
            <p>54.¿Consulto el diccionario cuando desconozco el significado de alguna palabra?</p>
            <h5>
              <label>
                <input type='radio' name='radio54' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio54' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio54' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio54' id='n' value='0' />
                N </label>
            </h5>
            <p>55.¿Escribo legiblemente en mis apuntes de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio55' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio55' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio55' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio55' id='n' value='0' />
                N </label>
            </h5>
            <p>56.¿Estudio diariamente en mis apuntes de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio56' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio56' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio56' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio56' id='n' value='0' />
                N </label>
            </h5>
            <p>57.¿Tengo un registro del tiempo que destino al estudio de cada día?</p>
            <h5>
              <label>
                <input type='radio' name='radio57' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio57' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio57' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio57' id='n' value='0' />
                N </label>
            </h5>
            <p>58.¿Me fijo una calificación mínima por obtener en cada una de mis materias de un periodo escolar?</p>
            <h5>
              <label>
                <input type='radio' name='radio58' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio58' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio58' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio58' id='n' value='0' />
                N </label>
            </h5>
            <p>59.¿Escucho música mientras estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio59' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio59' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio59' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio59' id='n' value='3' />
                N </label>
            </h5>
            <p>60.¿Vuelvo a leer los apuntes de clases anteriores?</p>
            <h5>
              <label>
                <input type='radio' name='radio60' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio60' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio60' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio60' id='n' value='0' />
                N </label>
            </h5>
            <p>61.¿Me formulo preguntas a partir de las lecturas que realizo?</p>
            <h5>
              <label>
                <input type='radio' name='radio61' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio61' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio61' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio61' id='n' value='0' />
                N </label>
            </h5>
            <p>62.¿Respondo de manera precisa las preguntas que me formulan en los exámenes?</p>
            <h5>
              <label>
                <input type='radio' name='radio62' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio62' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio62' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio62' id='n' value='0' />
                N </label>
            </h5>
            <p>63.¿Durante la clase intercambio con mis compañeros comentarios ajenos a la misma?</p>
            <h5>
              <label>
                <input type='radio' name='radio63' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio63' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio63' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio63' id='n' value='3' />
                N </label>
            </h5>
            <p>64.¿Cuento con programa de actividades diarias?</p>
            <h5>
              <label>
                <input type='radio' name='radio64' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio64' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio64' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio64' id='n' value='0' />
                N </label>
            </h5>
            <p>65.¿Cuándo tengo que estudiar me encuentro cansado o somnoliento?</p>
            <h5>
              <label>
                <input type='radio' name='radio65' id='s' value='0' />
                S</label>
              <label>
                <input type='radio' name='radio65' id='a' value='1' />
                A </label>
              <label>
                <input type='radio' name='radio65' id='r' value='2' />
                R </label>
              <label>
                <input type='radio' name='radio65' id='n' value='3' />
                N </label>
            </h5>
            <p>66.¿Antes de empezar a estudiar consigo papel, goma de borrar, pluma o lápiz y demás recursos necesarios?</p>
            <h5>
              <label>
                <input type='radio' name='radio66' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio66' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio66' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio66' id='n' value='0' />
                N </label>
            </h5>
            <p>67.¿Utilizo mis propias palabras para redactar mis apuntes en clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio67' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio67' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio67' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio67' id='n' value='0' />
                N </label>
            </h5>
            <p>68.¿Elaboro resúmenes, empleando mis propias palabras, sobre los temas expuestos en el libro?</p>
            <h5>
              <label>
                <input type='radio' name='radio68' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio68' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio68' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio68' id='n' value='0' />
                N </label>
            </h5>
            <p>69.¿Preparo con anticipación lo exámenes?</p>
            <h5>
              <label>
                <input type='radio' name='radio69' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio69' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio69' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio69' id='n' value='0' />
                N </label>
            </h5>
            <p>70.¿Asisto puntualmente a cada una de mis clases? </p>
            <h5>
              <label>
                <input type='radio' name='radio70' id='s' value='3' />
                S</label>
              <label>
                <input type='radio' name='radio70' id='a' value='2' />
                A </label>
              <label>
                <input type='radio' name='radio70' id='r' value='1' />
                R </label>
              <label>
                <input type='radio' name='radio70' id='n' value='0' />
                N </label>
            </h5>
            <p>&nbsp;</p>
            <p class='Error'>Nota: debes de contestar todas las preguntas</p>
              <h5><input type='submit' class='boton2' name='enviar' id='enviar' value='Enviar' /></h5>
            <p>&nbsp;</p>
          </form>";
		  	
			}
			else{
				echo "<p>&nbsp;</p><p>&nbsp;</p><h3 class='Error'>El cuestionario ya ha sido contestado !</h3>";
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
