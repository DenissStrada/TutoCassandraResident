<?php
class Calendarios{
	
function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0) 
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el último día de un mes y año dados
function ultimoDia($mes,$ano){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$ano)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="Enero";
			break;
	 	case 2:
			$nombre_mes="Febrero";
			break;
	 	case 3:
			$nombre_mes="Marzo";
			break;
	 	case 4:
			$nombre_mes="Abril";
			break;
	 	case 5:
			$nombre_mes="Mayo";
			break;
	 	case 6:
			$nombre_mes="Junio";
			break;
	 	case 7:
			$nombre_mes="Julio";
			break;
	 	case 8:
			$nombre_mes="Agosto";
			break;
	 	case 9:
			$nombre_mes="Septiembre";
			break;
	 	case 10:
			$nombre_mes="Octubre";
			break;
	 	case 11:
			$nombre_mes="Noviembre";
			break;
	 	case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}

function dame_estilo($dia_imprimir){
	global $mes,$ano,$dia_solo_hoy,$tiempo_actual;
	//dependiendo si el día es Hoy, Domigo o Cualquier otro, devuelvo un estilo
	if ($dia_solo_hoy == $dia_imprimir && $mes==date("n", $tiempo_actual) && $ano==date("Y", $tiempo_actual)){
		//si es hoy
		$estilo = " class='hoy'";
	}else{
		$fecha=mktime(12,0,0,$mes,$dia_imprimir,$ano);
		if (date("w",$fecha)==0 || date("w",$fecha)==6){
			//si es domingo 
			$estilo = " class='domingo'";
		}else{
			//si es cualquier dia
			$estilo = " class='diario'";
		}
	}
	return $estilo;
}

function mostrar_calendario($mes,$ano){
	global $parametros_formulario;
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = $this->dame_nombre_mes($mes);
	
	//construyo la tabla general
	echo '<div align="center">';
	echo '<table class="tablacalendario" cellspacing="3" cellpadding="2" border="0">';
	echo '<tr><td colspan="7" class="tit">';
	//tabla para mostrar el mes el año y los controles para pasar al mes anterior y siguiente
	echo '<table width="100%" cellspacing="2" cellpadding="2" border="0"><tr><td>';
	//calculo el mes y ano del mes anterior
	$mes_anterior = $mes - 1;
	$ano_anterior = $ano;
	if ($mes_anterior==0){
		$ano_anterior--;
		$mes_anterior=12;
	}
	echo "<a href='Calendario.php?$parametros_formulario&nuevo_mes=$mes_anterior&nuevo_ano=$ano_anterior'><span class='mesanterior'>&lt;&lt;</span></a></td>";
	echo "<td class='titmesano'>$nombre_mes $ano</td>";
	echo "<td class='mesanterior'>";
	//calculo el mes y ano del mes siguiente
	$mes_siguiente = $mes + 1;
	$ano_siguiente = $ano;
	if ($mes_siguiente==13){
		$ano_siguiente++;
		$mes_siguiente=1;
	}
	echo "<a href='Calendario.php?$parametros_formulario&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente'><span class='messiguiente'>&gt;&gt;</span></a></td></tr></table></td></tr>";
	echo '	<tr>
			    <td width=14% class="diasemana">L</td>
			    <td width=14% class="diasemana">M</td>
			    <td width=14% class="diasemana">X</td>
			    <td width=14% class="diasemana">J</td>
			    <td width=14% class="diasemana">V</td>
			    <td width=14% class="diasemana">S</td>
			    <td width=14% class="diasemana">D</td>
			</tr>';
	
	//Variable para llevar la cuenta del dia actual
	$dia_actual = 1;
	
	//calculo el numero del dia de la semana del primer dia
	$numero_dia = $this->calcula_numero_dia_semana(1,$mes,$ano);
	//echo "Numero del dia de semana del primer: $numero_dia <br>";
	
	//calculo el último dia del mes
	$ultimo_dia = $this->ultimoDia($mes,$ano);
	$aux=1;
	?>
	<script language="javascript">
	var mes=<?php echo $mes; ?>;
	var ano=<?php echo $ano; ?>;
	</script>
	<?php
	$quitar=1;
	$onmov="sobre(this)";
	$onmou="fuera(this)";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			$quitar++;
		}
	}
	if($quitar>4){
		$onmov="";
		$onmou="";	
	}
	//escribo la primera fila de la semana
	echo "<tr id='".$aux."' onmouseover='$onmov' onmouseout='$onmou' onclick='reenviar(this.id)'>";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			echo '<td class="diainvalido"><span></span></td>';
		} else {
			echo "<td ". $this->dame_estilo($dia_actual) .">$dia_actual</td>";
			$dia_actual++;
		}
	}
	echo "</tr>";	
	//recorro todos los demás días hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		//si estamos a principio de la semana escribo el <TR>
		if ($numero_dia == 0){
			$aux++;
			echo "<tr id='".$aux."' onmouseover='sobre(this)' onmouseout='fuera(this)' onclick='reenviar(this.id)'>";
		}
			echo "<td ". $this->dame_estilo($dia_actual) .">$dia_actual</a>";
		$dia_actual++;
		$numero_dia++;
		//si es el uñtimo de la semana, me pongo al principio de la semana y escribo el </tr>
		if ($numero_dia == 7){
			$numero_dia = 0;
			echo "</tr>";
		}
	}
	
	//compruebo que celdas me faltan por escribir vacias de la última semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo '<td class="diainvalido"><span></span></td>';
	}
	
	echo "</tr>";
	echo "</table></div>";
}
}
require_once("ClaseSesion.php");
	$sesion = new Sesion();
?>
<script language="javascript">
function sobre(celda){ celda.style.backgroundColor="#f0f2ba" }
function fuera(celda){ celda.style.backgroundColor="white" }
function reenviar(fila){ 
location.href="Registro.php?fila="+fila+"&mes="+mes+"&ano="+ano+"";
}
</script>