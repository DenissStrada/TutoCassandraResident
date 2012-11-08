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
<link href="css/estilo.css" rel="stylesheet" type="text/css" "; echo"

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
					$conexion->query = "SELECT nombre Alumno FROM nombres WHERE numControl=".$user;
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
		
	$numNomina = $_SESSION['nombreUsuario'];
	$clave = $_SESSION['clave'];
	$numControl = $numNomina;

	require_once("ClaseBDD.php");
	$conexion = new BDD();
	
	$conexion->conexionBDD();

	// Consulta SQL
	$conexion->query = 'SELECT * FROM respuestas where num_Control=\''.$numControl.'\'';
	$conexion->consultaSQL();
  	$cont=0;
while($row = mysql_fetch_array($conexion->result)){
	$cont=1;
	$r1=$row['p1'];
	$r2=$row['p2'];
	$r3=$row['p3'];
	$r4=$row['p4'];
	$r5=$row['p5'];
	$r6=$row['p6'];
	$r7=$row['p7'];
	$r8=$row['p8'];
	$r9=$row['p9'];
	$r10=$row['p10'];
	
	$r11=$row['p11'];
	$r12=$row['p12'];
	$r13=$row['p13'];
	$r14=$row['p14'];
	$r15=$row['p15'];
	$r16=$row['p16'];
	$r17=$row['p17'];
	$r18=$row['p18'];
	$r19=$row['p19'];
	$r20=$row['p20'];
	
	$r21=$row['p21'];
	$r22=$row['p22'];
	$r23=$row['p23'];
	$r24=$row['p24'];
	$r25=$row['p25'];
	$r26=$row['p26'];
	$r27=$row['p27'];
	$r28=$row['p28'];
	$r29=$row['p29'];
	$r30=$row['p30'];
	
	$r31=$row['p31'];
	$r32=$row['p32'];
	$r33=$row['p33'];
	$r34=$row['p34'];
	$r35=$row['p35'];
	$r36=$row['p36'];
	$r37=$row['p37'];
	$r38=$row['p38'];
	$r39=$row['p39'];
	$r40=$row['p40'];
	
	$r41=$row['p41'];
	$r42=$row['p42'];
	$r43=$row['p43'];
	$r44=$row['p44'];
	$r45=$row['p45'];
	$r46=$row['p46'];
	$r47=$row['p47'];
	$r48=$row['p48'];
	$r49=$row['p49'];
	$r50=$row['p50'];
	
	$r51=$row['p51'];
	$r52=$row['p52'];
	$r53=$row['p53'];
	$r54=$row['p54'];
	$r55=$row['p55'];
	$r56=$row['p56'];
	$r57=$row['p57'];
	$r58=$row['p58'];
	$r59=$row['p59'];
	$r60=$row['p60'];
	
	$r61=$row['p61'];
	$r62=$row['p62'];
	$r63=$row['p63'];
	$r64=$row['p64'];
	$r65=$row['p65'];
	$r66=$row['p66'];
	$r67=$row['p67'];
	$r68=$row['p68'];
	$r69=$row['p69'];
	$r70=$row['p70'];
	
	$sumaDT=$row['sumaDT'];
	$sumaME=$row['sumaME'];
	$sumaDE=$row['sumaDE'];
	$sumaNC=$row['sumaNC'];
	$sumaOL=$row['sumaOL'];
	$sumaPE=$row['sumaPE'];
	$sumaAC=$row['sumaAC'];
}
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <?php
	if($cont==1){
	echo "
            <h3>Instituto Tecnol&oacute;gico Superior de Uruapan </h3>
            <h3 class='Estilo1'>Subdirecci&oacute;n Acad&eacute;mica</h3>
            <h3 class='Estilo1'>Desarrollo Académico</h3>
            <h3 class='Estilo1'>Programa de tutoría académica</h3>
			<br><br>
	<p><h3 class='Estilo1'>Resultados del Cuestionario Habitos de Estudio</h3></p>
	<p>&nbsp;</p>
	<p>Distribuci&oacute;n de tiempo (DT) = $sumaDT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Optimizaci&oacute;n de la lectura (OL) = $sumaOL </p>
<p>Motivaci&oacute;n para el estudio (ME) = $sumaME &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
Como prepara un examen (PE) = $sumaPE </p>
<p>Distractores durante el estudio (DE)= $sumaDE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Actitudes y conductas productivas </p>
<p>Como tomar notas de clase (NC) =$sumaNC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ante el estudio (AC) = $sumaAC </p>

<p>&nbsp;</p>
<h5><canvas id='micanvas' width='650' height='350'></h5>
<p>La puntuaci&oacute;n igual o por encima del 70% son los puntos fuertes del alumno.</p>
<p>La puntuaci&oacute;n menor al 70% son los puntos debiles del alumno.</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
window.onload = function(){
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

            <h3 class='Estilo1'>Respuestas del Cuestionario</h3>
            <p>&nbsp;</p>
            <p>INSTRUCCIONES: (S = siempre, A = a menudo, R = raras veces, N = nunca).</p>
            <p>&nbsp;</p>
			<p>1.&iquest;Tomo en cuenta todas mis materias al distribuir el tiempo de estudio?</p>
            <h5>
                <label>
                <input type='radio' name='radio1' id='s' value='3' disabled"; if($r1==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio1' id='a' value='2' disabled "; if($r1==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio1' id='r' value='1' disabled "; if($r1==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio1' id='n' value='0' disabled "; if($r1==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>2.&iquest;Responsabilizo de mis fracasos acad&eacute;micos a otras personas o las circunstancias?</p>
            <h5>
              <label>
                <input type='radio' name='radio2' id='s' value='3' disabled "; if($r2==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio2' id='a' value='2' disabled "; if($r2==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio2' id='r' value='1' disabled "; if($r2==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio2' id='n' value='0' disabled "; if($r2==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>3.&iquest;Hay personas conversando o ruidos que molesten o distraigan mientras estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio3' id='s' value='0' disabled "; if($r3==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio3' id='a' value='1' disabled "; if($r3==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio3' id='r' value='2' disabled "; if($r3==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio3' id='n' value='3' disabled "; if($r3==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>4.&iquest;Escribo notas de todas mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio4' id='s' value='3' disabled "; if($r4==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio4' id='a' value='2' disabled "; if($r4==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio4' id='r' value='1' disabled "; if($r4==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio4' id='n' value='0' disabled "; if($r4==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>5.&iquest;Adopto una actitud cr&iacute;tica ante lo que leo y obtengo mis propias conclusiones?</p>
            <h5>
              <label>
                <input type='radio' name='radio5' id='s' value='3' disabled "; if($r5==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio5' id='a' value='2' disabled "; if($r5==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio5' id='r' value='1' disabled "; if($r5==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio5' id='n' value='0' disabled "; if($r5==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>6.&iquest;Durante un examen distribuyo mi tiempo de acuerdo con el n&uacute;mero de preguntas formuladas?</p>
            <h5>
              <label>
                <input type='radio' name='radio6' id='s' value='3' disabled "; if($r6==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio6' id='a' value='2' disabled "; if($r6==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio6' id='r' value='1' disabled "; if($r6==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio6' id='n' value='0' disabled "; if($r6==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>7.&iquest;Falto a mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio7' id='s' value='0' disabled  "; if($r7==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio7' id='a' value='1' disabled "; if($r7==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio7' id='r' value='2' disabled "; if($r7==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio7' id='n' value='3' disabled "; if($r7==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>8.&iquest;Planifico mis actividades?</p>
            <h5>
              <label>
                <input type='radio' name='radio8' id='s' value='3' disabled "; if($r8==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio8' id='a' value='2' disabled "; if($r8==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio8' id='r' value='1' disabled "; if($r8==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio8' id='n' value='0' disabled "; if($r8==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>9.&iquest;Siento satisfacci&oacute;n al intervenir con actividades relacionadas con el estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio9' id='s' value='3' disabled "; if($r9==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio9' id='a' value='2' disabled "; if($r9==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio9' id='r' value='1' disabled "; if($r9==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio9' id='n' value='0' disabled "; if($r9==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>10.&iquest;Interfieren mis problemas personales en mis intenciones de estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio10' id='s' value='0' disabled "; if($r10==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio10' id='a' value='1' disabled "; if($r10==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio10' id='r' value='2' disabled "; if($r10==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio10' id='n' value='3' disabled "; if($r10==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p> 11.&iquest;Utilizo abreviaturas para escribir m&aacute;s r&aacute;pido?</p>
            <h5>
              <label>
                <input type='radio' name='radio11' id='s' value='3' disabled "; if($r11==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio11' id='a' value='2' disabled "; if($r11==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio11' id='r' value='1' disabled "; if($r11==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio11' id='n' value='0' disabled "; if($r11==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>12.&iquest;Subrayo las ideas que me parecen m&aacute;s importantes durante la lectura?</p>
            <h5>
              <label>
                <input type='radio' name='radio12' id='s' value='3' disabled "; if($r12==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio12' id='a' value='2' disabled "; if($r12==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio12' id='r' value='1' disabled "; if($r12==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio12' id='n' value='0' disabled "; if($r12==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>13.&iquest;En los ex&aacute;menes se&ntilde;alo de manera visible las respuestas?</p>
            <h5>
              <label>
                <input type='radio' name='radio13' id='s' value='3' disabled "; if($r13==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio13' id='a' value='2' disabled "; if($r13==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio13' id='r' value='1' disabled "; if($r13==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio13' id='n' value='0' disabled "; if($r13==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>14.&iquest;Frecuento a compa&ntilde;eros que presentan un bajo rendimiento acad&eacute;mico?</p>
            <h5>
              <label>
                <input type='radio' name='radio14' id='s' value='0' disabled "; if($r14==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio14' id='a' value='1' disabled "; if($r14==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio14' id='r' value='2' disabled "; if($r14==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio14' id='n' value='3' disabled "; if($r14==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>15.&iquest;Destino tiempo de clases para mis materias?</p>
            <h5>
              <label>
                <input type='radio' name='radio15' id='s' value='3' disabled "; if($r15==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio15' id='a' value='2' disabled "; if($r15==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio15' id='r' value='1' disabled "; if($r15==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio15' id='n' value='0' disabled "; if($r15==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>16.&iquest;Estoy seguro(a) de que realmente me gusta estudiar?</p>
            <h5>
              <label>
                <input type='radio' name='radio16' id='s' value='3' disabled "; if($r16==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio16' id='a' value='2' disabled "; if($r16==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio16' id='r' value='1' disabled "; if($r16==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio16' id='n' value='0' disabled "; if($r16==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>17.&iquest;Mientras estudio me distraigo con asuntos ajenos al tema?</p>
            <h5>
              <label>
                <input type='radio' name='radio17' id='s' value='0' disabled "; if($r17==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio17' id='a' value='1' disabled "; if($r17==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio17' id='r' value='2' disabled "; if($r17==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio17' id='n' value='3' disabled "; if($r17==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>18.&iquest;Anoto textualmente las f&oacute;rmulas, las leyes, los principios, las reglas, etc. que expone el maestro en la clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio18' id='s' value='3' disabled "; if($r18==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio18' id='a' value='2' disabled "; if($r18==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio18' id='r' value='1' disabled "; if($r18==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio18' id='n' value='0' disabled "; if($r18==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>19.&iquest;Exploro e investig&oacute; el contenido general de un libro antes de comenzar su lectura sistem&aacute;tica?</p>
            <h5>
              <label>
                <input type='radio' name='radio19' id='s' value='3' disabled "; if($r19==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio19' id='a' value='2' disabled "; if($r19==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio19' id='r' value='1' disabled "; if($r19==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio19' id='n' value='0' disabled "; if($r19==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>20.&iquest;Durante un examen leo dos veces la misma pregunta?</p>
            <h5>
              <label>
                <input type='radio' name='radio20' id='s' value='3' disabled "; if($r20==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio20' id='a' value='2' disabled "; if($r20==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio20' id='r' value='1' disabled "; if($r20==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio20' id='n' value='0' disabled "; if($r20==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>21.&iquest;Aclaro mis dudas con el profesor?</p>
            <h5>
              <label>
                <input type='radio' name='radio21' id='s' value='3' disabled "; if($r21==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio21' id='a' value='2' disabled "; if($r21==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio21' id='r' value='1' disabled "; if($r21==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio21' id='n' value='0' disabled "; if($r21==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>22.&iquest;Elaboro un plan de estudios antes de empezar mi periodo de clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio22' id='s' value='3' disabled "; if($r22==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio22' id='a' value='2' disabled "; if($r22==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio22' id='r' value='1' disabled "; if($r22==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio22' id='n' value='0' disabled "; if($r22==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>23.&iquest;Me siento frustrado por ser estudiante?</p>
            <h5>
              <label>
                <input type='radio' name='radio23' id='s' value='3' disabled "; if($r23==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio23' id='a' value='2' disabled "; if($r23==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio23' id='r' value='1' disabled "; if($r23==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio23' id='n' value='0' disabled "; if($r23==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>24.&iquest;Cu&aacute;ndo estudio tengo cerca destractores visuales como la televisi&oacute;n, el retrato de mi novia(o), artistas, carteles</p>
            <h5>
              <label>
                <input type='radio' name='radio24' id='s' value='0' disabled "; if($r24==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio24' id='a' value='1' disabled "; if($r24==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio24' id='r' value='2' disabled "; if($r24==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio24' id='n' value='3' disabled "; if($r24==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>25.&iquest;Me resulta f&aacute;cil concentrarme en la exposici&oacute;n del maestro?</p>
            <h5>
              <label>
                <input type='radio' name='radio25' id='s' value='3' disabled "; if($r25==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio25' id='a' value='2' disabled "; if($r25==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio25' id='r' value='1' disabled "; if($r25==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio25' id='n' value='0' disabled "; if($r25==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>26.&iquest;Repito en voz alta y con el libro cerrado el material que considero m&aacute;s relevante, a fin de asimilarlo?</p>
            <h5>
              <label>
                <input type='radio' name='radio26' id='s' value='3' disabled "; if($r26==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio26' id='a' value='2' disabled "; if($r26==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio26' id='r' value='1' disabled "; if($r26==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio26' id='n' value='0' disabled "; if($r26==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>27.&iquest;Tengo confianza en mis conocimientos o capacidades de presentar un examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio27' id='s' value='3' disabled "; if($r27==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio27' id='a' value='2' disabled "; if($r27==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio27' id='r' value='1' disabled "; if($r27==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio27' id='n' value='0' disabled "; if($r27==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>28.&iquest;Adopto actitudes positivas ante mis compa&ntilde;eros y maestros?</p>
            <h5>
              <label>
                <input type='radio' name='radio28' id='s' value='3' disabled "; if($r28==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio28' id='a' value='2' disabled "; if($r28==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio28' id='r' value='1' disabled "; if($r28==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio28' id='n' value='0' disabled "; if($r28==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>29.&iquest;Inicio y concluyo puntualmente cada una de mis actividades?</p>
            <h5>
              <label>
                <input type='radio' name='radio29' id='s' value='3' disabled "; if($r29==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio29' id='a' value='2' disabled "; if($r29==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio29' id='r' value='1' disabled "; if($r29==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio29' id='n' value='0' disabled "; if($r29==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>30.&iquest;Encuentro agradable el ambiente de la intituci&oacute;n educativa donde estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio30' id='s' value='3' disabled "; if($r30==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio30' id='a' value='2' disabled "; if($r30==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio30' id='r' value='1' disabled "; if($r30==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio30' id='n' value='0' disabled "; if($r30==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>31.Cuando estudio &iquest;tengo demasiados objetos sobre mi mesa?</p>
            <h5>
              <label>
                <input type='radio' name='radio31' id='s' value='0' disabled "; if($r31==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio31' id='a' value='1' disabled "; if($r31==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio31' id='r' value='2' disabled "; if($r31==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio31' id='n' value='3' disabled "; if($r31==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>32.&iquest;Cuento con hojas y plumas o l&aacute;piz durante cada una de mis clases?</p>
            <h5>
              <label>
                <input type='radio' name='radio32' id='s' value='3' disabled "; if($r32==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio32' id='a' value='2' disabled "; if($r32==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio32' id='r' value='1' disabled "; if($r32==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio32' id='n' value='0' disabled "; if($r32==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>33.&iquest;Me pongo a leer aunque me sienta cansado?</p>
            <h5>
              <label>
                <input type='radio' name='radio33' id='s' value='0' disabled "; if($r33==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio33' id='a' value='1' disabled "; if($r33==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio33' id='r' value='2' disabled "; if($r33==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio33' id='n' value='3' disabled "; if($r33==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>34.&iquest;Estoy nervioso(a) antes de presentar un examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio34' id='s' value='0' disabled "; if($r34==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio34' id='a' value='1' disabled "; if($r34==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio34' id='r' value='2' disabled "; if($r34==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio34' id='n' value='3' disabled "; if($r34==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>35.&iquest;Cumplo con mis tareas o actividades extra clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio35' id='s' value='3' disabled "; if($r35==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio35' id='a' value='2' disabled "; if($r35==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio35' id='r' value='1' disabled "; if($r35==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio35' id='n' value='0' disabled "; if($r35==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>36.Cuando estudio &iquest;me concentro durante periodos cortos y dedico mas tiempo a fantasear?</p>
            <h5>
              <label>
                <input type='radio' name='radio36' id='s' value='0' disabled "; if($r36==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio36' id='a' value='1' disabled "; if($r36==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio36' id='r' value='2' disabled "; if($r36==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio36' id='n' value='3' disabled "; if($r36==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>37.&iquest;Dudo cuando tengo que tomar una decisi&oacute;n respecto a mis estudios?</p>
            <h5>
              <label>
                <input type='radio' name='radio37' id='s' value='0' disabled "; if($r37==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio37' id='a' value='1' disabled "; if($r37==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio37' id='r' value='2' disabled "; if($r37==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio37' id='n' value='3' disabled "; if($r37==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>38.&iquest;Busco apuntes o libros en los momentos en que deber&iacute;a estar estudiando?</p>
            <h5>
              <label>
                <input type='radio' name='radio38' id='s' value='0' disabled "; if($r38==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio38' id='a' value='1' disabled "; if($r38==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio38' id='r' value='2' disabled "; if($r38==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio38' id='n' value='3' disabled "; if($r38==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>39.&iquest;Copio los ejemplos que proporciona el maestro?</p>
            <h5>
              <label>
                <input type='radio' name='radio39' id='s' value='3' disabled "; if($r39==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio39' id='a' value='2' disabled "; if($r39==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio39' id='r' value='1' disabled "; if($r39==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio39' id='n' value='0' disabled "; if($r39==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>40.&iquest;Elaboro cuadros sin&oacute;pticos o diagramas a fin de seleccionar y sintetizar lo que e le&iacute;do?</p>
            <h5>
              <label>
                <input type='radio' name='radio40' id='s' value='3' disabled "; if($r40==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio40' id='a' value='2' disabled "; if($r40==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio40' id='r' value='1' disabled "; if($r40==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio40' id='n' value='0' disabled "; if($r40==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>41.&iquest;Duermo normalmente la noche anterior al examen?</p>
            <h5>
              <label>
                <input type='radio' name='radio41' id='s' value='3' disabled "; if($r41==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio41' id='a' value='2' disabled "; if($r41==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio41' id='r' value='1' disabled "; if($r41==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio41' id='n' value='0' disabled "; if($r41==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>42.&iquest;Investigo por iniciativa propia aspectos relacionados con las diferentes materias de estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio42' id='s' value='3' disabled "; if($r42==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio42' id='a' value='2' disabled "; if($r42==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio42' id='r' value='1' disabled "; if($r42==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio42' id='n' value='0' disabled "; if($r42==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>43.&iquest;Reviso diariamente el horario que elabor&oacute; por escrito para saber cual es la actividad planeada para determinar hora?</p>
            <h5>
              <label>
                <input type='radio' name='radio43' id='s' value='3' disabled "; if($r43==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio43' id='a' value='2' disabled "; if($r43==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio43' id='r' value='1' disabled "; if($r43==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio43' id='n' value='0' disabled "; if($r43==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>44.&iquest;Considero que el estudio es tedioso y desagradable?</p>
            <h5>
              <label>
                <input type='radio' name='radio44' id='s' value='0' disabled "; if($r44==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio44' id='a' value='1' disabled "; if($r44==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio44' id='r' value='2' disabled "; if($r44==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio44' id='n' value='3' disabled "; if($r44==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>45.&iquest;Cuento con una &aacute;rea bien ventilada, iluminada y ordenada para estudiar?</p>
            <h5>
              <label>
                <input type='radio' name='radio45' id='s' value='3' disabled "; if($r45==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio45' id='a' value='2' disabled "; if($r45==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio45' id='r' value='1' disabled "; if($r45==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio45' id='n' value='0' disabled "; if($r45==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>46.&iquest;Pido prestados apuntes a mis compa&ntilde;eros de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio46' id='s' value='3' disabled "; if($r46==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio46' id='a' value='2' disabled "; if($r46==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio46' id='r' value='1' disabled "; if($r46==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio46' id='n' value='0' disabled "; if($r46==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>47.&iquest;Tengo dificultades para aprender lo que leo?</p>
            <h5>
              <label>
                <input type='radio' name='radio47' id='s' value='0' disabled "; if($r47==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio47' id='a' value='1' disabled "; if($r47==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio47' id='r' value='2' disabled "; if($r47==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio47' id='n' value='3' disabled "; if($r47==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>48.&iquest;Reviso las respuestas de los ex&aacute;menes antes de entregarlo?</p>
            <h5>
              <label>
                <input type='radio' name='radio48' id='s' value='3' disabled "; if($r48==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio48' id='a' value='2' disabled "; if($r48==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio48' id='r' value='1' disabled "; if($r48==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio48' id='n' value='0' disabled "; if($r48==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>49.&iquest;Me quedo con dudas sobre lo que expuso el profesor?</p>
            <h5>
              <label>
                <input type='radio' name='radio49' id='s' value='0' disabled "; if($r49==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio49' id='a' value='1' disabled "; if($r49==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio49' id='r' value='2' disabled "; if($r49==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio49' id='n' value='3' disabled "; if($r49==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>50.&iquest;Utilizo la mayor parte de mi tiempo en cosas productivas y significativas?</p>
            <h5>
              <label>
                <input type='radio' name='radio50' id='s' value='3' disabled "; if($r50==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio50' id='a' value='2' disabled "; if($r50==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio50' id='r' value='1' disabled "; if($r50==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio50' id='n' value='0' disabled "; if($r50==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>51.&iquest;Estoy dispuesto y tengo deseo de estudiar en cualquier momento?</p>
            <h5>
              <label>
                <input type='radio' name='radio51' id='s' value='3' disabled "; if($r51==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio51' id='a' value='2' disabled "; if($r51==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio51' id='r' value='1' disabled "; if($r51==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio51' id='n' value='0' disabled "; if($r51==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>52.&iquest;Acudo a las bibliotecas o centros de informaci&oacute;n?</p>
            <h5>
              <label>
                <input type='radio' name='radio52' id='s' value='3' disabled "; if($r52==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio52' id='a' value='2' disabled "; if($r52==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio52' id='r' value='1' disabled "; if($r52==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio52' id='n' value='0' disabled "; if($r52==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>53.&iquest;Mis apuntes de clases est&aacute;n limpios, ordenados y legibles, de tal manera que puedo entenderlos posteriormente?</p>
            <h5>
              <label>
                <input type='radio' name='radio53' id='s' value='3' disabled "; if($r53==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio53' id='a' value='2' disabled "; if($r53==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio53' id='r' value='1' disabled "; if($r53==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio53' id='n' value='0' disabled "; if($r53==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>54.&iquest;Consulto el diccionario cuando desconozco el significado de alguna palabra?</p>
            <h5>
              <label>
                <input type='radio' name='radio54' id='s' value='3' disabled "; if($r54==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio54' id='a' value='2' disabled "; if($r54==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio54' id='r' value='1' disabled "; if($r54==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio54' id='n' value='0' disabled "; if($r54==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>55.&iquest;Escribo legiblemente en mis apuntes de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio55' id='s' value='3' disabled "; if($r55==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio55' id='a' value='2' disabled "; if($r55==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio55' id='r' value='1' disabled "; if($r55==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio55' id='n' value='0' disabled "; if($r55==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>56.&iquest;Estudio diariamente en mis apuntes de clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio56' id='s' value='3' disabled "; if($r56==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio56' id='a' value='2' disabled "; if($r56==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio56' id='r' value='1' disabled "; if($r56==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio56' id='n' value='0' disabled "; if($r56==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>57.&iquest;Tengo un registro del tiempo que destino al estudio de cada d&iacute;a?</p>
            <h5>
              <label>
                <input type='radio' name='radio57' id='s' value='3' disabled "; if($r57==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio57' id='a' value='2' disabled "; if($r57==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio57' id='r' value='1' disabled "; if($r57==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio57' id='n' value='0' disabled "; if($r57==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>58.&iquest;Me fijo una calificaci&oacute;n m&oacute;nima por obtener en cada una de mis materias de un periodo escolar?</p>
            <h5>
              <label>
                <input type='radio' name='radio58' id='s' value='3' disabled "; if($r58==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio58' id='a' value='2' disabled "; if($r58==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio58' id='r' value='1' disabled "; if($r58==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio58' id='n' value='0' disabled "; if($r58==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>59.&iquest;Escucho m&uacute;sica mientras estudio?</p>
            <h5>
              <label>
                <input type='radio' name='radio59' id='s' value='0' disabled "; if($r59==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio59' id='a' value='1' disabled "; if($r59==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio59' id='r' value='2' disabled "; if($r59==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio59' id='n' value='3' disabled "; if($r59==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>60.&iquest;Vuelvo a leer los apuntes de clases anteriores?</p>
            <h5>
              <label>
                <input type='radio' name='radio60' id='s' value='3' disabled "; if($r60==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio60' id='a' value='2' disabled "; if($r60==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio60' id='r' value='1' disabled "; if($r60==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio60' id='n' value='0' disabled "; if($r60==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>61.&iquest;Me formulo preguntas a partir de las lecturas que realizo?</p>
            <h5>
              <label>
                <input type='radio' name='radio61' id='s' value='3' disabled "; if($r61==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio61' id='a' value='2' disabled "; if($r61==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio61' id='r' value='1' disabled "; if($r61==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio61' id='n' value='0' disabled "; if($r61==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>62.&iquest;Respondo de manera precisa las preguntas que me formulan en los ex&aacute;menes?</p>
            <h5>
              <label>
                <input type='radio' name='radio62' id='s' value='3' disabled "; if($r62==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio62' id='a' value='2' disabled "; if($r62==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio62' id='r' value='1' disabled "; if($r62==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio62' id='n' value='0' disabled "; if($r62==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>63.&iquest;Durante la clase intercambio con mis compa&ntilde;eros comentarios ajenos a la misma?</p>
            <h5>
              <label>
                <input type='radio' name='radio63' id='s' value='0' disabled "; if($r63==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio63' id='a' value='1' disabled "; if($r63==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio63' id='r' value='2' disabled "; if($r63==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio63' id='n' value='3' disabled "; if($r63==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>64.&iquest;Cuento con programa de actividades diarias?</p>
            <h5>
              <label>
                <input type='radio' name='radio64' id='s' value='3' disabled "; if($r64==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio64' id='a' value='2' disabled "; if($r64==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio64' id='r' value='1' disabled "; if($r64==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio64' id='n' value='0' disabled "; if($r64==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>65.&iquest;Cu&aacute;ndo tengo que estudiar me encuentro cansado o somnoliento?</p>
            <h5>
              <label>
                <input type='radio' name='radio65' id='s' value='0' disabled "; if($r65==0)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio65' id='a' value='1' disabled "; if($r65==1)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio65' id='r' value='2' disabled "; if($r65==2)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio65' id='n' value='3' disabled "; if($r65==3)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>66.&iquest;Antes de empezar a estudiar consigo papel, goma de borrar, pluma o l&aacute;piz y dem&aacute;s recursos necesarios?</p>
            <h5>
              <label>
                <input type='radio' name='radio66' id='s' value='3' disabled "; if($r66==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio66' id='a' value='2' disabled "; if($r66==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio66' id='r' value='1' disabled "; if($r66==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio66' id='n' value='0' disabled "; if($r66==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>67.&iquest;Utilizo mis propias palabras para redactar mis apuntes en clase?</p>
            <h5>
              <label>
                <input type='radio' name='radio67' id='s' value='3' disabled "; if($r67==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio67' id='a' value='2' disabled "; if($r67==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio67' id='r' value='1' disabled "; if($r67==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio67' id='n' value='0' disabled "; if($r67==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>68.&iquest;Elaboro res&uacute;menes, empleando mis propias palabras, sobre los temas expuestos en el libro?</p>
            <h5>
              <label>
                <input type='radio' name='radio68' id='s' value='3' disabled "; if($r68==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio68' id='a' value='2' disabled "; if($r68==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio68' id='r' value='1' disabled "; if($r68==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio68' id='n' value='0' disabled "; if($r68==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>69.&iquest;Preparo con anticipaci&oacute;n lo ex&aacute;menes?</p>
            <h5>
              <label>
                <input type='radio' name='radio69' id='s' value='3' disabled "; if($r69==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio69' id='a' value='2' disabled "; if($r69==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio69' id='r' value='1' disabled "; if($r69==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio69' id='n' value='0' disabled "; if($r69==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>70.&iquest;Asisto puntualmente a cada una de mis clases? </p>
            <h5>
              <label>
                <input type='radio' name='radio70' id='s' value='3' disabled "; if($r70==3)echo " checked"; echo"/>
                S</label>
              <label>
                <input type='radio' name='radio70' id='a' value='2' disabled "; if($r70==2)echo " checked"; echo"/>
                A </label>
              <label>
                <input type='radio' name='radio70' id='r' value='1' disabled "; if($r70==1)echo " checked"; echo"/>
                R </label>
              <label>
                <input type='radio' name='radio70' id='n' value='0' disabled "; if($r70==0)echo " checked"; echo"/>
                N </label>
            </h5>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
          ";
	}
else{
	
echo "
<p>&nbsp;</p>
<p class='Error'>&iexcl;&Eacute;ste cuestionario a&uacute;n no ha sido contestado!</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
";

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
