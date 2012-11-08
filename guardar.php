<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();	
	
	$numControl=$_SESSION['nombreUsuario'];
	$clave=$_SESSION['clave'];

	require_once("ClaseBDD.php");
	$conexion = new BDD();
	$conexion->conexionBDD();
	
	$conexion2 = new BDD();
	$conexion2->conexionBDD();

	// Consulta SQL
	$conexion->query = 'SELECT grupo from historiales where numControl=\''.$numControl.'\'';
	$conexion->consultaSQL();

// Imprimir los resultados en HTML
while ($row = mysql_fetch_array($conexion->result)) {
    $grupo = $row['grupo'];
}

	// Libera la consulta y cierra la conexión
	//$conexion->liberaConsultaCierraConexion();


$r1=$_POST['radio1'];
$r2=$_POST['radio2'];
$r3=$_POST['radio3'];
$r4=$_POST['radio4'];
$r5=$_POST['radio5'];
$r6=$_POST['radio6'];
$r7=$_POST['radio7'];
$r8=$_POST['radio8'];
$r9=$_POST['radio9'];
$r10=$_POST['radio10'];

$r11=$_POST['radio11'];
$r12=$_POST['radio12'];
$r13=$_POST['radio13'];
$r14=$_POST['radio14'];
$r15=$_POST['radio15'];
$r16=$_POST['radio16'];
$r17=$_POST['radio17'];
$r18=$_POST['radio18'];
$r19=$_POST['radio19'];
$r20=$_POST['radio20'];

$r21=$_POST['radio21'];
$r22=$_POST['radio22'];
$r23=$_POST['radio23'];
$r24=$_POST['radio24'];
$r25=$_POST['radio25'];
$r26=$_POST['radio26'];
$r27=$_POST['radio27'];
$r28=$_POST['radio28'];
$r29=$_POST['radio29'];
$r30=$_POST['radio30'];

$r31=$_POST['radio31'];
$r32=$_POST['radio32'];
$r33=$_POST['radio33'];
$r34=$_POST['radio34'];
$r35=$_POST['radio35'];
$r36=$_POST['radio36'];
$r37=$_POST['radio37'];
$r38=$_POST['radio38'];
$r39=$_POST['radio39'];
$r40=$_POST['radio40'];

$r41=$_POST['radio41'];
$r42=$_POST['radio42'];
$r43=$_POST['radio43'];
$r44=$_POST['radio44'];
$r45=$_POST['radio45'];
$r46=$_POST['radio46'];
$r47=$_POST['radio47'];
$r48=$_POST['radio48'];
$r49=$_POST['radio49'];
$r50=$_POST['radio50'];

$r51=$_POST['radio51'];
$r52=$_POST['radio52'];
$r53=$_POST['radio53'];
$r54=$_POST['radio54'];
$r55=$_POST['radio55'];
$r56=$_POST['radio56'];
$r57=$_POST['radio57'];
$r58=$_POST['radio58'];
$r59=$_POST['radio59'];
$r60=$_POST['radio60'];

$r61=$_POST['radio61'];
$r62=$_POST['radio62'];
$r63=$_POST['radio63'];
$r64=$_POST['radio64'];
$r65=$_POST['radio65'];
$r66=$_POST['radio66'];
$r67=$_POST['radio67'];
$r68=$_POST['radio68'];
$r69=$_POST['radio69'];
$r70=$_POST['radio70'];



$sumaDT=$r1+$r8+$r15+$r22+$r29+$r36+$r43+$r50+$r57+$r64;
$sumaME=$r2+$r9+$r16+$r23+$r30+$r37+$r44+$r51+$r58+$r65;
$sumaDE=$r3+$r10+$r17+$r24+$r31+$r38+$r45+$r52+$r59+$r66;
$sumaNC=$r4+$r11+$r18+$r25+$r32+$r39+$r46+$r53+$r60+$r67;
$sumaOL=$r5+$r12+$r19+$r26+$r33+$r40+$r47+$r54+$r61+$r68;
$sumaPE=$r6+$r13+$r20+$r27+$r34+$r41+$r48+$r55+$r62+$r69;
$sumaAC=$r7+$r14+$r21+$r28+$r35+$r42+$r49+$r56+$r63+$r70;

if (strlen(trim($r1))==0 	||	strlen(trim($r2))==0 	||	strlen(trim($r3))==0 	||	strlen(trim($r4))==0 	||	strlen(trim($r5))==0 	||
	strlen(trim($r6))==0 	||	strlen(trim($r7))==0 	||	strlen(trim($r8))==0 	||	strlen(trim($r9))==0 	||	strlen(trim($r10))==0 	||
	strlen(trim($r11))==0 	||	strlen(trim($r12))==0 	||	strlen(trim($r13))==0 	||	strlen(trim($r14))==0	||	strlen(trim($r15))==0 	||
	strlen(trim($r16))==0 	||	strlen(trim($r17))==0 	||	strlen(trim($r18))==0 	||	strlen(trim($r19))==0	||	strlen(trim($r20))==0 	||
	strlen(trim($r21))==0 	||	strlen(trim($r22))==0 	||	strlen(trim($r23))==0 	||	strlen(trim($r24))==0	||	strlen(trim($r25))==0 	||
	strlen(trim($r26))==0 	||	strlen(trim($r27))==0 	||	strlen(trim($r28))==0 	||	strlen(trim($r29))==0	||	strlen(trim($r30))==0 	||
	strlen(trim($r31))==0 	||	strlen(trim($r32))==0 	||	strlen(trim($r33))==0 	||	strlen(trim($r34))==0	||	strlen(trim($r35))==0 	||
	strlen(trim($r36))==0 	||	strlen(trim($r37))==0 	||	strlen(trim($r38))==0 	||	strlen(trim($r39))==0	||	strlen(trim($r40))==0 	||
	strlen(trim($r41))==0 	||	strlen(trim($r42))==0 	||	strlen(trim($r43))==0 	||	strlen(trim($r44))==0	||	strlen(trim($r45))==0 	||
	strlen(trim($r46))==0 	||	strlen(trim($r47))==0 	||	strlen(trim($r48))==0 	||	strlen(trim($r49))==0	||	strlen(trim($r50))==0 	||
	strlen(trim($r51))==0 	||	strlen(trim($r52))==0 	||	strlen(trim($r53))==0 	||	strlen(trim($r54))==0 	||	strlen(trim($r55))==0 	||
	strlen(trim($r56))==0 	||	strlen(trim($r57))==0 	||	strlen(trim($r58))==0 	||	strlen(trim($r59))==0 	||	strlen(trim($r60))==0 	||
	strlen(trim($r61))==0 	||	strlen(trim($r62))==0 	||	strlen(trim($r63))==0 	||	strlen(trim($r64))==0 	||	strlen(trim($r65))==0 	||
	strlen(trim($r66))==0 	||	strlen(trim($r67))==0 	||	strlen(trim($r68))==0 	||	strlen(trim($r69))==0 	||	strlen(trim($r70))==0 	){
		
		echo "<SCRIPT LANGUAGE=\"Javascript\">
  		<!--
		alert(\"Debes responder todas las preguntas !\");
		//-->
		window.location='cuestionario.php'; 
		</SCRIPT>";
  		exit;
}
 $conexion2->query ="INSERT INTO axhunico_tutorias.respuestas(num_control, grupo, 
 p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,
 p11,p12,p13,p14,p15,p16,p17,p18,p19,p20,
 p21,p22,p23,p24,p25,p26,p27,p28,p29,p30,
 p31,p32,p33,p34,p35,p36,p37,p38,p39,p40,
 p41,p42,p43,p44,p45,p46,p47,p48,p49,p50,
 p51,p52,p53,p54,p55,p56,p57,p58,p59,p60,
 p61,p62,p63,p64,p65,p66,p67,p68,p69,p70,
 sumaDT, sumaME, sumaDE, sumaNC, sumaOL, sumaPE, sumaAC) VALUES ('$numControl', '$grupo',
 $r1,$r2,$r3,$r4,$r5,$r6,$r7,$r8,$r9,$r10,
 $r11,$r12,$r13,$r14,$r15,$r16,$r17,$r18,$r19,$r20,
 $r21,$r22,$r23,$r24,$r25,$r26,$r27,$r28,$r29,$r30,
$r31,$r32,$r33,$r34,$r35,$r36,$r37,$r38,$r39,$r40,
$r41,$r42,$r43,$r44,$r45,$r46,$r47,$r48,$r49,$r50,
$r51,$r52,$r53,$r54,$r55,$r56,$r57,$r58,$r59,$r60,
$r61,$r62,$r63,$r64,$r65,$r66,$r67,$r68,$r69,$r70,
$sumaDT, $sumaME, $sumaDE, $sumaNC, $sumaOL, $sumaPE, $sumaAC)";
$conexion2->consultaSQL();
/**/
if ($conexion2-> result){
  echo "<SCRIPT LANGUAGE=\"Javascript\">
  	<!--
	alert(\"El cuestionario se ha enviado con exito !\");
	window.location='selFormatosAlumnos.php'; 
	//-->
	</SCRIPT>";
	}
	$conexion->liberaConsultaCierraConexion();
		$conexion2->liberaConsultaCierraConexion();

?>
